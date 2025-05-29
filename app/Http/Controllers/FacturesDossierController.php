<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFacturesDossierRequest;
use App\Http\Requests\UpdateFacturesDossierRequest;
use App\Repositories\FacturesDossierRepository;
use App\Repositories\HistoriqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Dossiers;
use App\Models\FacturesDossier;
use App\Models\anneedossier;
use App\Models\Clients;
use Flash;
use Response;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use NumberToWords\NumberToWords;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FacturesExport;
use Illuminate\Support\Facades\Auth;

class FacturesDossierController extends AppBaseController
{
    /** @var FacturesDossierRepository $facturesDossierRepository*/
    private $facturesDossierRepository;

    private $historiqueRepository;

    public function __construct(FacturesDossierRepository $facturesDossierRepo, HistoriqueRepository $historiqueRepo)
    {
        $this->facturesDossierRepository = $facturesDossierRepo;
        $this->historiqueRepository = $historiqueRepo;
    }

    /**
     * Display a listing of the FacturesDossier.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $dates = FacturesDossier::distinct()->pluck('dateFacturation');
        $years = $dates->map(function ($date) {
            return $date->year;
        });

        $currentDate = Carbon::now();

        $query = FacturesDossier::join('dossiers', 'FacturesDossier.iddossier', '=', 'dossiers.id')->join('Clients', 'dossiers.client', '=', 'Clients.id')
            ->join('anneedossier', 'dossiers.id', '=', 'anneedossier.iddossier');

        // Filter by year
        if ($request->filled('year')) {
            $query->where('FacturesDossier.dateFacturation', 'like', '%' . $request->input('year') . '%');
        } else {
            $query->where('FacturesDossier.dateFacturation', 'like', '%' . $currentDate->year . '%');
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
            $query->where('FacturesDossier.numFacturation', 'like', '%' . $request->input('num_facture') . '%');
        }

        // Finally, paginate the results
        $facturesDossiers = $query->where('dossiers.etat_cloture', 1)->where('dossiers.etat_facture', 1)->orderBy('FacturesDossier.id', 'desc')
            ->select([
                'FacturesDossier.id as idfacture',
                'FacturesDossier.etat_validation as isValidate',
                'FacturesDossier.*',
                'dossiers.*',
                'Clients.societe as selectedSociete',
                'anneedossier.*'
            ])->paginate(5)->appends($request->except('page')); // Append query parameters to pagination links

        $clients = Clients::all();
        $clientsOptions = ['' => ''] + $clients->pluck('nom', 'id')->toArray();

        return view('factures_dossiers.index', compact('clientsOptions', 'years'))
            ->with('facturesDossiers', $facturesDossiers);
    }

    public function indexNonFacturer(Request $request)
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
            ->where('dossiers.etat_facture', 0)
            ->orderBy('dossiers.id', 'desc')
            ->paginate(5)
            ->appends($request->except('page')); // Append query parameters to pagination links

        $clients = Clients::all();
        $clientsOptions = ['' => ''] + $clients->pluck('nom', 'id')->toArray();

        return view('factures_dossiers.index-non-facturer', compact('clientsOptions'))
            ->with('dossiers', $dossiers);
    }

    /**
     * Show the form for creating a new FacturesDossier.
     *
     * @return Response
     */
    public function create()
    {
        return view('factures_dossiers.create');
    }

    public function createFacture($id)
    {
        $dossiers = Dossiers::findOrFail($id);
        $isEditMode = false;

        // add num facturation 
        $client = Clients::findOrFail($dossiers->client)->where('id', $dossiers->societe)->get();
        $currentDate = Carbon::now('Africa/Casablanca');
        $numFacturation = $client->count();
        $numFacturation += 1;
        $nf = $numFacturation . '/' . $currentDate->year;

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

        return view('factures_dossiers.create', compact('modePaiment', 'a_payer', 'isEditMode', 'nf'))->with('dossiers', $dossiers);
    }

    /**
     * Store a newly created FacturesDossier in storage.
     *
     * @param CreateFacturesDossierRequest $request
     *
     * @return Response
     */
    public function store(CreateFacturesDossierRequest $request)
    {
        $input = $request->all();

        $facturesDossier = $this->facturesDossierRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/facturesDossiers.singular')]));

        return redirect(route('facturesDossiers.index'));
    }

    public function storeFacture(CreateFacturesDossierRequest $request, $id)
    {
        $input = $request->all();

        $dossier = Dossiers::findOrFail($id);
        $client = Clients::findOrFail($dossier->client);

        $query = FacturesDossier::join('dossiers', 'dossiers.id', '=', 'FacturesDossier.iddossier')->join('Clients', 'dossiers.client', '=', 'Clients.id');

        // add num facturation 
        $currentDate = Carbon::now('Africa/Casablanca');
        $nb = $query->where('Clients.societe', $client->societe)->get();
        $numFacturation = $nb->count();
        $numFacturation += 1;

        $input['numFacturation'] = $numFacturation . '/' . $currentDate->year;
        $input['iddossier'] = $id;
        $input['etat_paiement'] = 'Non';
        $input['etat_validation'] = 0;

        $input['dateInsertion'] = $currentDate;

        $dossier->etat_facture = 1;
        $dossier->save();

        $facturesDossier = $this->facturesDossierRepository->create($input);

        // add historique
        $historique = [
            "taches" => "Ajout d'une facture",
            "date" => $currentDate,
            "ref" => $facturesDossier->numFacturation,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Enregistrer avec succès', ['model' => __('models/facturesDossiers.singular')]));

        return redirect(route('index-non-facturer'));
    }

    /**
     * Display the specified FacturesDossier.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $facturesDossier = $this->facturesDossierRepository->find($id);

        $dossiers = Dossiers::findOrFail($facturesDossier->iddossier);

        if (empty($facturesDossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/facturesDossiers.singular')]));

            return redirect(route('facturesDossiers.index'));
        }

        return view('factures_dossiers.show')->with('facturesDossier', $facturesDossier)->with('dossiers', $dossiers);
    }

    /**
     * Show the form for editing the specified FacturesDossier.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $facturesDossier = $this->facturesDossierRepository->find($id);
        $dossiers = Dossiers::findOrFail($facturesDossier->iddossier);
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

        if (empty($facturesDossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/facturesDossiers.singular')]));

            return redirect(route('facturesDossiers.index'));
        }

        return view('factures_dossiers.edit', compact('modePaiment', 'a_payer', 'isEditMode'))->with('facturesDossier', $facturesDossier)->with('dossiers', $dossiers);
    }

    /**
     * Update the specified FacturesDossier in storage.
     *
     * @param int $id
     * @param UpdateFacturesDossierRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFacturesDossierRequest $request)
    {
        $facturesDossier = $this->facturesDossierRepository->find($id);

        if (empty($facturesDossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/facturesDossiers.singular')]));

            return redirect(route('facturesDossiers.index'));
        }

        $facturesDossier = $this->facturesDossierRepository->update($request->all(), $id);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Modification d'une facture",
            "date" => $currentDate,
            "ref" => $facturesDossier->numFacturation,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Modifier avec succès', ['model' => __('models/facturesDossiers.singular')]));

        return redirect(route('facturesDossiers.index'));
    }

    /**
     * Remove the specified FacturesDossier from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $facturesDossier = $this->facturesDossierRepository->find($id);

        if (empty($facturesDossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/facturesDossiers.singular')]));

            return redirect(route('facturesDossiers.index'));
        }

        $this->facturesDossierRepository->delete($id);
        return redirect(route('facturesDossiers.index'));
    }

    public function updatePaiement($id)
    {
        $facturesDossier = $this->facturesDossierRepository->find($id);

        $facturesDossier->etat_paiement = "Oui";
        $facturesDossier->save();

        return redirect()->route('facturesDossiers.index', request()->query());
    }

    public function updateValidation($id)
    {
        $facturesDossier = $this->facturesDossierRepository->find($id);

        $facturesDossier->etat_validation = 1;
        $facturesDossier->save();

        Flash::success(__('La facture est validée avec succès', ['model' => __('models/facturesDossiers.singular')]));

        return redirect()->route('facturesDossiers.index', request()->query());
    }

    private function generatePdfData($id)
    {
        $facturesDossier = $this->facturesDossierRepository->find($id);
        if ($facturesDossier !== null) {
            $facturer1 = (float)($facturesDossier->facturer1 ?? 0);
            $facturer2 = (float)($facturesDossier->facturer2 ?? 0);
            $facturer3 = (float)($facturesDossier->facturer3 ?? 0);
            $facturer4 = (float)($facturesDossier->facturer4 ?? 0);
            $facturer5 = (float)($facturesDossier->facturer5 ?? 0);

            $total_ht = $facturer1 + $facturer2 + $facturer3 + $facturer4 + $facturer5;
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
        if ($facturesDossier->a_paye == "MAD") {
            if ($fractionalPart > 0) {
                $numberInWords = strtoupper($integerPartInWords . ' DIRHAMS ET ' . $fractionalPartInWords . ' CENTIMES');
            } else {
                $numberInWords = strtoupper($integerPartInWords . ' DIRHAMS');
            }
        } else if ($facturesDossier->a_paye == "EUR") {
            if ($fractionalPart > 0) {
                $numberInWords = strtoupper($integerPartInWords . ' EUROS ET ' . $fractionalPartInWords . ' CENTIMES');
            } else {
                $numberInWords = strtoupper($integerPartInWords . ' EUROS');
            }
        } else if ($facturesDossier->a_paye == "USD") {
            if ($fractionalPart > 0) {
                $numberInWords = strtoupper($integerPartInWords . ' DOLLARS ET ' . $fractionalPartInWords . ' CENTS');
            } else {
                $numberInWords = strtoupper($integerPartInWords . ' DOLLARS');
            }
        }

        $dossier = Dossiers::where('id', $facturesDossier->iddossier)->first();

        $data = [
            'numberInWords' => $numberInWords,
            'total_ht' => $total_ht,
            'facturesDossier' => $facturesDossier,
            'dossier' => $dossier,
        ];

        return $data;
    }

    public function imprimer($id)
    {
        $data = $this->generatePdfData($id);
        $pdf = Pdf::loadView('factures_dossiers.imprimer', $data);
        $pdf->setOption('isPhpEnabled', true);

        $facturesDossier = $this->facturesDossierRepository->find($id);
        $fileName = $facturesDossier->numFacturation . ' ' . $facturesDossier->dossiers->clients->nom . '.pdf';

        return $pdf->stream($fileName);
    }

    public function download($id)
    {
        $data = $this->generatePdfData($id);
        $pdf = Pdf::loadView('factures_dossiers.imprimer', $data);
        $pdf->setOption('isPhpEnabled', true);

        $facturesDossier = $this->facturesDossierRepository->find($id);
        $fileName = $facturesDossier->numFacturation . ' ' . $facturesDossier->dossiers->clients->nom . '.pdf';

        return $pdf->download($fileName);
    }

    public function export(Request $request)
    {
        $year = $request->input('year-export', Carbon::now()->year);
        $societe = $request->input('societe-export');

        return Excel::download(new FacturesExport($year, $societe), 'liste-factures.xlsx');
    }
}
