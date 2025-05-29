<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDossiersRequest;
use App\Http\Requests\UpdateDossiersRequest;
use App\Repositories\DossiersRepository;
use App\Repositories\anneedossierRepository;
use App\Repositories\HistoriqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Dossiers;
use App\Models\FacturesDossier;
use App\Models\anneedossier;
use App\Models\Transporteur;
use App\Models\TransitaireAlg;
use App\Models\NoteDebitDossier;
use App\Models\TransitaireTanger;
use App\Models\Clients;
use Response;
use Flash;
use App\Exports\DossiersExport;
use App\Exports\DossiersCloturesExport;
use App\Models\File;
use Maatwebsite\Excel\Facades\Excel;
use NumberToWords\NumberToWords;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DossiersController extends AppBaseController
{
    /** @var DossiersRepository $dossiersRepository*/
    private $dossiersRepository;

    private $anneedossierRepository;
    private $historiqueRepository;

    public function __construct(DossiersRepository $dossiersRepo, anneedossierRepository $anneedossierRepo, HistoriqueRepository $historiqueRepo)
    {
        $this->dossiersRepository = $dossiersRepo;
        $this->anneedossierRepository = $anneedossierRepo;
        $this->historiqueRepository = $historiqueRepo;
    }

    /**
     * Display a listing of the Dossiers.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $years = anneedossier::distinct()->pluck('annee')->sortDesc();
        $currentDate = Carbon::now();

        $query = Dossiers::join('anneedossier', 'dossiers.id', '=', 'anneedossier.iddossier');

        // Filter by year
        if ($request->filled('year')) {
            $query->where('anneedossier.annee', $request->input('year'));
        } else {
            $query->where('anneedossier.annee', $currentDate->year);
        }

        // Filter by client
        if ($request->filled('client')) {
            $query->where('dossiers.client', $request->input('client'));
        }

        // Filter by num
        if ($request->filled('num')) {
            $query->where('anneedossier.annee_dossier', 'like', '%' . $request->input('num') . '%');
        }

        // Filter by reference
        if ($request->filled('reference')) {
            $query->where('dossiers.reference', 'like', '%' . $request->input('reference') . '%');
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
        $dossiers = $query->orderBy('dossiers.id', 'desc')
            ->select(
                'dossiers.id',
                'dossiers.client',
                'dossiers.reference',
                'dossiers.etat_cloture',
                'dossiers.transporteur',
                'dossiers.date_charg',
                'dossiers.mat_remorque',
                'dossiers.mat_tracteur',
                'dossiers.expediteur',
                'dossiers.destinsation',
                'anneedossier.annee_dossier'
            )
            ->paginate(5)->appends($request->except('page')); // Append query parameters to pagination links

        $clients = Clients::all();
        $clientsOptions = ['' => ''] + $clients->pluck('nom', 'id')->toArray();

        return view('dossiers.index', compact('clientsOptions', 'years'))->with('dossiers', $dossiers);
    }

    public function indexCloture(Request $request)
    {
        $years = anneedossier::distinct()->pluck('annee')->sortDesc();
        $currentDate = Carbon::now();

        $query = Dossiers::join('anneedossier', 'dossiers.id', '=', 'anneedossier.iddossier');

        // Filter by year
        if ($request->filled('year')) {
            $query->where('anneedossier.annee', $request->input('year'));
        } else {
            $query->where('anneedossier.annee', $currentDate->year);
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

        // Filter by reference
        if ($request->filled('reference')) {
            $query->where('dossiers.reference', 'like', '%' . $request->input('reference') . '%');
        }

        // Finally, paginate the results
        $dossiers = $query->where('dossiers.etat_cloture', 1)->orderBy('dossiers.id', 'desc')
            ->select(
                'dossiers.id',
                'dossiers.client',
                'dossiers.reference',
                'dossiers.etat_cloture',
                'dossiers.date_charg',
                'dossiers.mat_remorque',
                'dossiers.mat_tracteur',
                'anneedossier.annee_dossier',
                'anneedossier.iddossier',
                'dossiers.etat_facture',
                'dossiers.etat_notedebit'
            )
            ->paginate(5)->appends($request->except('page')); // Append query parameters to pagination links

        // Get num_facture
        $facturesDossier = FacturesDossier::orderBy('id', 'desc')->select('id', 'iddossier', 'etat_validation', 'numFacturation')->get();
        foreach ($facturesDossier as $f) {
            foreach ($dossiers as $d) {
                if ($f->iddossier == $d->iddossier) {
                    $d->num_facture = $f->numFacturation;
                    $d->id_facture = $f->id;
                    $d->etat_validation_facture = $f->etat_validation;
                }
            }
        }

        // Get num_note_debit
        $noteDebitDossier = NoteDebitDossier::orderBy('id', 'desc')->select('id', 'iddossier', 'etat_validation', 'numnotedebit')->get();
        foreach ($noteDebitDossier as $n) {
            foreach ($dossiers as $d) {
                if ($n->iddossier == $d->iddossier) {
                    $d->num_note_debit = $n->numnotedebit;
                    $d->id_note_debit = $n->id;
                    $d->etat_validation_note = $n->etat_validation;
                }
            }
        }

        $clients = Clients::all();
        $clientsOptions = ['' => ''] + $clients->pluck('nom', 'id')->toArray();

        return view('dossiers.index-cloture', compact('clientsOptions', 'years'))->with('dossiers', $dossiers);
    }

    public function indexValide(Request $request)
    {
        $years = anneedossier::distinct()->pluck('annee')->sortDesc();
        $currentDate = Carbon::now();

        $query = Dossiers::join('anneedossier', 'dossiers.id', '=', 'anneedossier.iddossier');

        // Filter by year
        if ($request->filled('year')) {
            $query->where('anneedossier.annee', $request->input('year'));
        } else {
            $query->where('anneedossier.annee', $currentDate->year);
        }

        // Filter by num
        if ($request->filled('num')) {
            $query->where('anneedossier.annee_dossier', 'like', '%' . $request->input('num') . '%');
        }

        // Finally, paginate the results
        $dossiers = $query->orderBy('dossiers.id', 'desc')
            ->select(
                'dossiers.id',
                'dossiers.client',
                'dossiers.reference',
                'dossiers.etat_cloture',
                'dossiers.transporteur',
                'dossiers.date_charg',
                'dossiers.mat_remorque',
                'dossiers.mat_tracteur',
                'dossiers.expediteur',
                'dossiers.destinsation',
                'anneedossier.annee_dossier',
                'dossiers.etat_validation'
            )
            ->paginate(5)->appends($request->except('page')); // Append query parameters to pagination links

        return view('dossiers.index-valide', compact('years'))->with('dossiers', $dossiers);
    }

    /**
     * Show the form for creating a new Dossiers.
     *
     * @return Response
     */
    public function create()
    {
        $transporteurs = Transporteur::all();
        $transitairesTanger = TransitaireTanger::all();
        $transitairesAlg = TransitaireAlg::all();

        $transporteursOptions = ['' => ''] + $transporteurs->pluck('nom', 'nom')->toArray();
        $transitairesTangerOptions = ['' => ''] + $transitairesTanger->pluck('nom', 'nom')->toArray();
        $transitairesAlgOptions = ['' => ''] + $transitairesAlg->pluck('nom', 'nom')->toArray();

        return view('dossiers.create', compact('transporteursOptions', 'transitairesTangerOptions', 'transitairesAlgOptions'));
    }

    /**
     * Store a newly created Dossiers in storage.
     *
     * @param CreateDossiersRequest $request
     *
     * @return Response
     */
    public function store(CreateDossiersRequest $request)
    {
        $input = $request->all();

        $currentDate = Carbon::now('Africa/Casablanca');

        $input['etat_cloture'] = 0;
        $input['etat_facture'] = 0;
        $input['etat_notedebit'] = 0;
        $input['date_insertion'] = $currentDate;
        $input['etat_validation'] = 0;

        $dossiers = $this->dossiersRepository->create($input);

        // add anneedossier
        $anneedossiers = anneedossier::where('annee', $currentDate->year)->get();
        $numAnneedossiers = $anneedossiers->count();
        $numAnneedossiers += 1;

        $inputAnnee = [
            "annee_dossier" => $currentDate->year . '/' . $numAnneedossiers,
            "annee" => $currentDate->year,
            "iddossier" => $dossiers->id
        ];
        $this->anneedossierRepository->create($inputAnnee);

        // add historique
        $historique = [
            "taches" => "Ajout d'un dossier",
            "date" => $currentDate,
            "ref" => $dossiers->reference,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Enregistrer avec succès', ['model' => __('models/dossiers.singular')]));

        return redirect(route('dossiers.index'));
    }

    /**
     * Display the specified Dossiers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dossiers = $this->dossiersRepository->find($id);

        if (empty($dossiers)) {
            Flash::error(__('messages.not_found', ['model' => __('models/dossiers.singular')]));

            return redirect(route('dossiers.index'));
        }

        return view('dossiers.show')->with('dossiers', $dossiers);
    }

    /**
     * Show the form for editing the specified Dossiers.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dossiers = $this->dossiersRepository->find($id);

        $transporteurs = Transporteur::all();
        $transitairesTanger = TransitaireTanger::all();
        $transitairesAlg = TransitaireAlg::all();

        if (empty($dossiers)) {
            Flash::error(__('messages.not_found', ['model' => __('models/dossiers.singular')]));

            return redirect(route('dossiers.index'));
        }

        $transporteursOptions = ['' => ''] + $transporteurs->pluck('nom', 'nom')->toArray();
        $transitairesTangerOptions = ['' => ''] + $transitairesTanger->pluck('nom', 'nom')->toArray();
        $transitairesAlgOptions = ['' => ''] + $transitairesAlg->pluck('nom', 'nom')->toArray();

        return view('dossiers.edit', compact('transporteursOptions', 'transitairesTangerOptions', 'transitairesAlgOptions'))
            ->with('dossiers', $dossiers);
    }

    /**
     * Update the specified Dossiers in storage.
     *
     * @param int $id
     * @param UpdateDossiersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDossiersRequest $request)
    {
        $dossiers = $this->dossiersRepository->find($id);

        if (empty($dossiers)) {
            Flash::error(__('messages.not_found', ['model' => __('models/dossiers.singular')]));

            return redirect(route('dossiers.index'));
        }

        $dossiers = $this->dossiersRepository->update($request->all(), $id);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Modification d'un dossier",
            "date" => $currentDate,
            "ref" => $dossiers->reference,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Modifier avec succès', ['model' => __('models/dossiers.singular')]));

        return redirect(route('dossiers.index'));
    }

    /**
     * Remove the specified Dossiers from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dossiers = $this->dossiersRepository->find($id);

        if (empty($dossiers)) {
            Flash::error(__('messages.not_found', ['model' => __('models/dossiers.singular')]));

            return redirect(route('dossiers.index'));
        }

        $this->dossiersRepository->delete($id);

        return redirect(route('dossiers.index'));
    }

    public function updateEtat($id)
    {
        $dossier = Dossiers::findOrFail($id);

        $dossier->etat_cloture = 1;
        $dossier->save();

        Flash::success(__('Le dossier est cloturé avec succès', ['model' => __('models/dossiers.singular')]));

        return redirect()->route('dossiers.index');
    }

    public function export(Request $request)
    {
        $year = $request->input('year-export', Carbon::now()->year);

        return Excel::download(new DossiersExport($year), 'liste-dossiers.xlsx');
    }

    public function imprimerMerged($id)
    {
        // Note de Débit PDF
        $noteDebitDossier = NoteDebitDossier::where('iddossier', $id)->first();
        if ($noteDebitDossier !== null) {
            $notedebit1 = (float)($noteDebitDossier->notedebit1 ?? 0);
            $notedebit2 = (float)($noteDebitDossier->notedebit2 ?? 0);
            $notedebit3 = (float)($noteDebitDossier->notedebit3 ?? 0);
            $notedebit4 = (float)($noteDebitDossier->notedebit4 ?? 0);
            $notedebit5 = (float)($noteDebitDossier->notedebit5 ?? 0);

            $total_ht_note = $notedebit1 + $notedebit2 + $notedebit3 + $notedebit4 + $notedebit5;
        } else {
            $total_ht_note = 0; // or handle the null case as needed
        }

        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('fr');

        // Split the total amount into integer and fractional parts
        $integerPart_note = (int)$total_ht_note;
        $fractionalPart_note = (int)(($total_ht_note - $integerPart_note) * 100); // Assumes two decimal places

        // Convert each part to words
        $integerPartInWords_note = $numberTransformer->toWords($integerPart_note);
        $fractionalPartInWords_note = $numberTransformer->toWords($fractionalPart_note);

        // Combine the parts
        if ($noteDebitDossier->a_paye == "MAD") {
            if ($fractionalPart_note > 0) {
                $numberInWords_note = strtoupper($integerPartInWords_note . ' DIRHAMS ET ' . $fractionalPartInWords_note . ' CENTIMES');
            } else {
                $numberInWords_note = strtoupper($integerPartInWords_note . ' DIRHAMS');
            }
        } else if ($noteDebitDossier->a_paye == "EUR") {
            if ($fractionalPart_note > 0) {
                $numberInWords_note = strtoupper($integerPartInWords_note . ' EUROS ET ' . $fractionalPartInWords_note . ' CENTIMES');
            } else {
                $numberInWords_note = strtoupper($integerPartInWords_note . ' EUROS');
            }
        } else if ($noteDebitDossier->a_paye == "USD") {
            if ($fractionalPart_note > 0) {
                $numberInWords_note = strtoupper($integerPartInWords_note . ' DOLLARS ET ' . $fractionalPartInWords_note . ' CENTS');
            } else {
                $numberInWords_note = strtoupper($integerPartInWords_note . ' DOLLARS');
            }
        }

        // Facture PDF
        $facturesDossier = FacturesDossier::where('iddossier', $id)->first();
        if ($facturesDossier !== null) {
            $facturer1 = (float)($facturesDossier->facturer1 ?? 0);
            $facturer2 = (float)($facturesDossier->facturer2 ?? 0);
            $facturer3 = (float)($facturesDossier->facturer3 ?? 0);
            $facturer4 = (float)($facturesDossier->facturer4 ?? 0);
            $facturer5 = (float)($facturesDossier->facturer5 ?? 0);

            $total_ht_facture = $facturer1 + $facturer2 + $facturer3 + $facturer4 + $facturer5;
        } else {
            $total_ht_facture = 0; // or handle the null case as needed
        }

        // Split the total amount into integer and fractional parts
        $integerPart_facture = (int)$total_ht_facture;
        $fractionalPart_facture = (int)(($total_ht_facture - $integerPart_facture) * 100); // Assumes two decimal places

        // Convert each part to words
        $integerPartInWords_facture = $numberTransformer->toWords($integerPart_facture);
        $fractionalPartInWords_facture = $numberTransformer->toWords($fractionalPart_facture);

        // Combine the parts
        if ($facturesDossier->a_paye == "MAD") {
            if ($fractionalPart_facture > 0) {
                $numberInWords_facture = strtoupper($integerPartInWords_facture . ' DIRHAMS ET ' . $fractionalPartInWords_facture . ' CENTIMES');
            } else {
                $numberInWords_facture = strtoupper($integerPartInWords_facture . ' DIRHAMS');
            }
        } else if ($facturesDossier->a_paye == "EUR") {
            if ($fractionalPart_facture > 0) {
                $numberInWords_facture = strtoupper($integerPartInWords_facture . ' EUROS ET ' . $fractionalPartInWords_facture . ' CENTIMES');
            } else {
                $numberInWords_facture = strtoupper($integerPartInWords_facture . ' EUROS');
            }
        } else if ($facturesDossier->a_paye == "USD") {
            if ($fractionalPart_facture > 0) {
                $numberInWords_facture = strtoupper($integerPartInWords_facture . ' DOLLARS ET ' . $fractionalPartInWords_facture . ' CENTS');
            } else {
                $numberInWords_facture = strtoupper($integerPartInWords_facture . ' DOLLARS');
            }
        }

        $dossier = Dossiers::where('id', $noteDebitDossier->iddossier)->first();

        $data = [
            'numberInWords_note' => $numberInWords_note,
            'total_ht_note' => $total_ht_note,
            'noteDebitDossier' => $noteDebitDossier,
            'numberInWords_facture' => $numberInWords_facture,
            'total_ht_facture' => $total_ht_facture,
            'facturesDossier' => $facturesDossier,
            'dossier' => $dossier,
        ];

        $pdf = Pdf::loadView('dossiers.imprimer', $data);
        $pdf->setOption('isPhpEnabled', true);

        // Set a dynamic filename
        $fileName = $facturesDossier->dossiers->clients->nom . ' ' . $facturesDossier->numFacturation . ' ' . $noteDebitDossier->numnotedebit . '.pdf';
        return $pdf->stream($fileName);
    }

    public function exportCloture(Request $request)
    {
        $year = $request->input('year-export', Carbon::now()->year);

        return Excel::download(new DossiersCloturesExport($year), 'liste-dossiers-clotures.xlsx');
    }

    public function upload(Request $request)
    {
        // Validate that at least one file is selected and that all files meet the criteria
        $request->validate([
            'files.*' => 'required|mimes:pdf|max:2048', // Validate each file
        ]);

        $files = $request->file('files');

        foreach ($files as $file) {
            $path = $file->store('uploads', 'public');

            // Store file information in the database
            File::create([
                'id_dossier' => $request->input('id_dossier'),
                'order' => 0,
                'file_path' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Fichiers téléchargés avec succès');
    }

    public function showUploads($id)
    {
        $dossier = Dossiers::findOrFail($id);
        $files = File::where('id_dossier', $id)->orderBy('order')->get();
        return view('dossiers.upload', compact('dossier', 'files'));
    }

    public function deleteFile($id)
    {
        $file = File::findOrFail($id);
        Storage::disk('public')->delete($file->file_path); // Delete the file from storage
        $file->delete(); // Delete the file record from the database

        return redirect()->back()->with('success', 'Supprimer avec succès');
    }

    public function showValide($id)
    {
        $dossiers = $this->dossiersRepository->find($id);
        $files = File::where('id_dossier', $id)->get();
        $factureDossier = FacturesDossier::where('iddossier', $id)->get();
        $noteDebitDossier = NoteDebitDossier::where('iddossier', $id)->get();

        if (empty($dossiers)) {
            Flash::error(__('messages.not_found', ['model' => __('models/dossiers.singular')]));

            return redirect(route('dossiers.index'));
        }

        return view('dossiers.show-valide', compact('files', 'factureDossier', 'noteDebitDossier'))->with('dossiers', $dossiers);
    }

    public function updateValidation($id)
    {
        $dossiers = $this->dossiersRepository->find($id);

        $dossiers->etat_validation = 1;
        $dossiers->save();

        Flash::success(__('Le dossiers est validé avec succès', ['model' => __('models/dossiers.singular')]));

        return redirect()->route('index-valide');
    }

    public function updateFileOrder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $index => $id) {
            $file = File::find($id);
            $file->order = $index;
            $file->save();
        }

        return response()->json(['success' => true]);
    }
}
