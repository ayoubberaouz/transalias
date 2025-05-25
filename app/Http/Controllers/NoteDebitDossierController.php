<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNoteDebitDossierRequest;
use App\Http\Requests\UpdateNoteDebitDossierRequest;
use App\Repositories\NoteDebitDossierRepository;
use App\Repositories\HistoriqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Dossiers;
use App\Models\NoteDebitDossier;
use App\Models\anneedossier;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use NumberToWords\NumberToWords;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\NotesDebitExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\Clients;

class NoteDebitDossierController extends AppBaseController
{
    /** @var NoteDebitDossierRepository $noteDebitDossierRepository*/
    private $noteDebitDossierRepository;

    private $historiqueRepository;

    public function __construct(NoteDebitDossierRepository $noteDebitDossierRepo, HistoriqueRepository $historiqueRepo)
    {
        $this->noteDebitDossierRepository = $noteDebitDossierRepo;
        $this->historiqueRepository = $historiqueRepo;
    }

    /**
     * Display a listing of the NoteDebitDossier.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $dates = NoteDebitDossier::distinct()->pluck('datenotationdebit');
        $years = $dates->map(function ($date) {
            return $date->year;
        });

        $currentDate = Carbon::now();

        $query = NoteDebitDossier::join('dossiers', 'NoteDebitDossier.iddossier', '=', 'dossiers.id')->join('Clients', 'dossiers.client', '=', 'Clients.id')
            ->join('anneedossier', 'dossiers.id', '=', 'anneedossier.iddossier');

        // Filter by year
        if ($request->filled('year')) {
            $query->where('NoteDebitDossier.datenotationdebit', 'like', '%' . $request->input('year') . '%');
        } else {
            $query->where('NoteDebitDossier.datenotationdebit', 'like', '%' . $currentDate->year . '%');
        }

        // Filter by societe
        if ($request->filled('societe')) {
            $query->where('Clients.societe', $request->input('societe'));
        } else {
            $query->where('Clients.societe', 1);
        }

        // Filter by client
        if ($request->filled('client')) {
            $query->where('dossiers.client', $request->input('client'));
        }

        // Filter by num
        if ($request->filled('num')) {
            $query->where('anneedossier.annee_dossier', 'like', '%' . $request->input('num') . '%');
        }

        // Filter by transporteur
        if ($request->filled('transporteur')) {
            $query->where('dossiers.transporteur', 'like', '%' . $request->input('transporteur') . '%');
        }

        // Filter by mat_remorque
        if ($request->filled('mat_remorque')) {
            $query->where('dossiers.mat_remorque', 'like', '%' . $request->input('mat_remorque') . '%');
        }

        // Filter by mat_tracteur
        if ($request->filled('mat_tracteur')) {
            $query->where('dossiers.mat_tracteur', 'like', '%' . $request->input('mat_tracteur') . '%');
        }

        // Filter by num_facture
        if ($request->filled('num_facture')) {
            $query->where('NoteDebitDossier.numnotedebit', 'like', '%' . $request->input('num_facture') . '%');
        }

        // Finally, paginate the results
        $noteDebitDossiers = $query->where('dossiers.etat_cloture', 1)->where('dossiers.etat_notedebit', 1)->orderBy('NoteDebitDossier.id', 'desc')
            ->select([
                'NoteDebitDossier.id as idNoteDebit',
                'NoteDebitDossier.etat_validation as isValidate',
                'NoteDebitDossier.*',
                'dossiers.*',
                'Clients.societe as selectedSociete',
                'anneedossier.*'
            ])->paginate(5)->appends($request->except('page')); // Append query parameters to pagination links

        $clients = DB::table('Clients')->get();
        $clientsOptions = ['' => ''] + $clients->pluck('nom', 'id')->toArray();

        return view('note_debit_dossiers.index', compact('clientsOptions', 'years'))
            ->with('noteDebitDossiers', $noteDebitDossiers);
    }

    public function indexNonDebiter(Request $request)
    {
        $query = Dossiers::join('anneedossier', 'dossiers.id', '=', 'anneedossier.iddossier');

        // Filter by client
        if ($request->filled('client')) {
            $query->where('dossiers.client', $request->input('client'));
        }

        // Filter by num
        if ($request->filled('num')) {
            $query->where('anneedossier.annee_dossier', 'like', '%' . $request->input('num') . '%');
        }

        // Filter by transporteur
        if ($request->filled('transporteur')) {
            $query->where('dossiers.transporteur', 'like', '%' . $request->input('transporteur') . '%');
        }

        // Filter by mat_remorque
        if ($request->filled('mat_remorque')) {
            $query->where('dossiers.mat_remorque', 'like', '%' . $request->input('mat_remorque') . '%');
        }

        // Filter by mat_tracteur
        if ($request->filled('mat_tracteur')) {
            $query->where('dossiers.mat_tracteur', 'like', '%' . $request->input('mat_tracteur') . '%');
        }

        // Finally, paginate the results
        $dossiers = $query->where('dossiers.etat_cloture', 1)
            ->where('dossiers.etat_notedebit', 0)
            ->orderBy('dossiers.id', 'desc')
            ->paginate(5)
            ->appends($request->except('page')); // Append query parameters to pagination links

        $clients = DB::table('Clients')->get();
        $clientsOptions = ['' => ''] + $clients->pluck('nom', 'id')->toArray();

        return view('note_debit_dossiers.index-non-debiter', compact('clientsOptions'))
            ->with('dossiers', $dossiers);
    }

    /**
     * Show the form for creating a new NoteDebitDossier.
     *
     * @return Response
     */
    public function create()
    {
        return view('note_debit_dossiers.create');
    }

    public function createDebit($id)
    {
        $dossiers = Dossiers::findOrFail($id);
        $isEditMode = false;

        // add num facturation 
        $client = Clients::findOrFail($dossiers->client)->where('id', $dossiers->societe)->get();
        $currentDate = Carbon::now('Africa/Casablanca');
        $numNoteDebit = $client->count();
        $numNoteDebit += 1;
        $nd = $numNoteDebit .  'T/' . $currentDate->year;

        $modePaiment = [
            '' => '',
            'Espèce' => 'Espèce',
            'Chèque' => 'Chèque',
            'Virement' => 'Virement',
            'Autres' => 'Autres'
        ];

        $a_payer = [
            '' => '',
            'MAD' => 'MAD (Dirham marocain)',
            'EUR' => 'EUR (Euro)',
            'USD' => 'USD (Dollar des Etats-Unis)'
        ];

        return view('note_debit_dossiers.create', compact('modePaiment', 'a_payer', 'isEditMode', 'nd'))->with('dossiers', $dossiers);
    }

    /**
     * Store a newly created NoteDebitDossier in storage.
     *
     * @param CreateNoteDebitDossierRequest $request
     *
     * @return Response
     */
    public function store(CreateNoteDebitDossierRequest $request)
    {
        $input = $request->all();

        $noteDebitDossier = $this->noteDebitDossierRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/noteDebitDossiers.singular')]));

        return redirect(route('noteDebitDossiers.index'));
    }

    public function storeDebit(CreateNoteDebitDossierRequest $request, $id)
    {
        $input = $request->all();

        $dossier = Dossiers::findOrFail($id);
        $client = Clients::findOrFail($dossier->client);

        $query = NoteDebitDossier::join('dossiers', 'dossiers.id', '=', 'NoteDebitDossier.iddossier')->join('Clients', 'dossiers.client', '=', 'Clients.id');

        // add num notedebit 
        $currentDate = Carbon::now('Africa/Casablanca');
        $nb = $query->where('Clients.societe', $client->societe)->get();
        $numNoteDebit = $nb->count();
        $numNoteDebit += 1;

        $input['numnotedebit'] = $numNoteDebit . ' T/ ' . $currentDate->year;
        $input['iddossier'] = $id;
        $input['etat_paiement'] = 'Non';

        $input['dateinsertion'] = $currentDate;

        $dossier->etat_notedebit = 1;
        $dossier->save();

        $noteDebitDossier = $this->noteDebitDossierRepository->create($input);

        // add historique
        $historique = [
            "taches" => "Ajout d'une note de débit",
            "date" => $currentDate,
            "ref" => $noteDebitDossier->numnotedebit,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Enregistrer avec succès', ['model' => __('models/noteDebitDossiers.singular')]));

        return redirect(route('index-non-debiter'));
    }

    /**
     * Display the specified NoteDebitDossier.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $noteDebitDossier = $this->noteDebitDossierRepository->find($id);

        $dossiers = Dossiers::findOrFail($noteDebitDossier->iddossier);

        if (empty($noteDebitDossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/noteDebitDossiers.singular')]));

            return redirect(route('noteDebitDossiers.index'));
        }

        return view('note_debit_dossiers.show')->with('noteDebitDossier', $noteDebitDossier)->with('dossiers', $dossiers);
    }

    /**
     * Show the form for editing the specified NoteDebitDossier.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $noteDebitDossier = $this->noteDebitDossierRepository->find($id);
        $dossiers = Dossiers::findOrFail($noteDebitDossier->iddossier);
        $isEditMode = true;

        $modePaiment = [
            '' => '',
            'Espèce' => 'Espèce',
            'Chèque' => 'Chèque',
            'Virement' => 'Virement',
            'Autres' => 'Autres'
        ];
        $a_payer = [
            '' => '',
            'MAD' => 'MAD (Dirham marocain)',
            'EUR' => 'EUR (Euro)',
            'USD' => 'USD (Dollar des Etats-Unis)'
        ];

        if (empty($noteDebitDossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/noteDebitDossiers.singular')]));

            return redirect(route('noteDebitDossiers.index'));
        }

        return view('note_debit_dossiers.edit', compact('modePaiment', 'a_payer', 'isEditMode'))->with('noteDebitDossier', $noteDebitDossier)->with('dossiers', $dossiers);
    }

    /**
     * Update the specified NoteDebitDossier in storage.
     *
     * @param int $id
     * @param UpdateNoteDebitDossierRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNoteDebitDossierRequest $request)
    {
        $noteDebitDossier = $this->noteDebitDossierRepository->find($id);

        if (empty($noteDebitDossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/noteDebitDossiers.singular')]));

            return redirect(route('noteDebitDossiers.index'));
        }

        $noteDebitDossier = $this->noteDebitDossierRepository->update($request->all(), $id);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Modification d'une note de débit",
            "date" => $currentDate,
            "ref" => $noteDebitDossier->numnotedebit,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Modifier avec succès', ['model' => __('models/noteDebitDossiers.singular')]));

        return redirect(route('noteDebitDossiers.index'));
    }

    /**
     * Remove the specified NoteDebitDossier from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $noteDebitDossier = $this->noteDebitDossierRepository->find($id);

        if (empty($noteDebitDossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/noteDebitDossiers.singular')]));

            return redirect(route('noteDebitDossiers.index'));
        }

        $this->noteDebitDossierRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/noteDebitDossiers.singular')]));

        return redirect(route('noteDebitDossiers.index'));
    }

    public function updatePaiement($id)
    {
        $noteDebitDossier = $this->noteDebitDossierRepository->find($id);

        $noteDebitDossier->etat_paiement = "Oui";
        $noteDebitDossier->save();

        Flash::success(__('La note de débit est payée avec succès', ['model' => __('models/noteDebitDossiers.singular')]));

        return redirect()->route('noteDebitDossiers.index', request()->query());
    }

    public function updateValidation($id)
    {
        $noteDebitDossier = $this->noteDebitDossierRepository->find($id);

        $noteDebitDossier->etat_validation = 1;
        $noteDebitDossier->save();

        Flash::success(__('La note de débit est validée avec succès', ['model' => __('models/noteDebitDossiers.singular')]));

        return redirect()->route('noteDebitDossiers.index', request()->query());
    }

    private function generatePdfData($id)
    {
        $noteDebitDossier = $this->noteDebitDossierRepository->find($id);
        if ($noteDebitDossier !== null) {
            $notedebit1 = (float)($noteDebitDossier->notedebit1 ?? 0);
            $notedebit2 = (float)($noteDebitDossier->notedebit2 ?? 0);
            $notedebit3 = (float)($noteDebitDossier->notedebit3 ?? 0);
            $notedebit4 = (float)($noteDebitDossier->notedebit4 ?? 0);
            $notedebit5 = (float)($noteDebitDossier->notedebit5 ?? 0);

            $total_ht = $notedebit1 + $notedebit2 + $notedebit3 + $notedebit4 + $notedebit5;
        } else {
            $total_ht = 0; // or handle the null case as needed
        }

        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('fr');

        // Split the total amount into integer and fractional parts
        $integerPart = (int)$total_ht;
        $fractionalPart = (int)(($total_ht - $integerPart) * 100); // Assumes two decimal places

        // Convert each part to words
        $integerPartInWords = $numberTransformer->toWords($integerPart);
        $fractionalPartInWords = $numberTransformer->toWords($fractionalPart);

        // Combine the parts
        if ($noteDebitDossier->a_paye == "MAD") {
            if ($fractionalPart > 0) {
                $numberInWords = strtoupper($integerPartInWords . ' DIRHAMS ET ' . $fractionalPartInWords . ' CENTIMES');
            } else {
                $numberInWords = strtoupper($integerPartInWords . ' DIRHAMS');
            }
        } else if ($noteDebitDossier->a_paye == "EUR") {
            if ($fractionalPart > 0) {
                $numberInWords = strtoupper($integerPartInWords . ' EUROS ET ' . $fractionalPartInWords . ' CENTIMES');
            } else {
                $numberInWords = strtoupper($integerPartInWords . ' EUROS');
            }
        } else if ($noteDebitDossier->a_paye == "USD") {
            if ($fractionalPart > 0) {
                $numberInWords = strtoupper($integerPartInWords . ' DOLLARS ET ' . $fractionalPartInWords . ' CENTS');
            } else {
                $numberInWords = strtoupper($integerPartInWords . ' DOLLARS');
            }
        }

        $dossier = Dossiers::where('id', $noteDebitDossier->iddossier)->first();

        $data = [
            'numberInWords' => $numberInWords,
            'total_ht' => $total_ht,
            'noteDebitDossier' => $noteDebitDossier,
            'dossier' => $dossier,
        ];

        return $data;
    }

    public function imprimer($id)
    {
        $data = $this->generatePdfData($id);
        $pdf = Pdf::loadView('note_debit_dossiers.imprimer', $data);
        $pdf->setOption('isPhpEnabled', true);

        $noteDebitDossier = $this->noteDebitDossierRepository->find($id);
        $fileName = $noteDebitDossier->numnotedebit . ' ' . $noteDebitDossier->dossiers->clients->nom . '.pdf';

        return $pdf->stream($fileName);
    }

    public function download($id)
    {
        $data = $this->generatePdfData($id);
        $pdf = Pdf::loadView('note_debit_dossiers.imprimer', $data);
        $pdf->setOption('isPhpEnabled', true);

        $noteDebitDossier = $this->noteDebitDossierRepository->find($id);
        $fileName = $noteDebitDossier->numnotedebit . ' ' . $noteDebitDossier->dossiers->clients->nom . '.pdf';

        return $pdf->download($fileName);
    }

    public function export(Request $request)
    {
        $year = $request->input('year-export', Carbon::now()->year);
        $societe = $request->input('societe-export');

        return Excel::download(new NotesDebitExport($year, $societe), 'liste-notes-debit.xlsx');
    }
}
