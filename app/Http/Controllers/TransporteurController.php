<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransporteurRequest;
use App\Http\Requests\UpdateTransporteurRequest;
use App\Repositories\TransporteurRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Transporteur;
use Illuminate\Http\Request;
use Flash;
use Response;
use Carbon\Carbon;
use App\Repositories\HistoriqueRepository;
use Illuminate\Support\Facades\Auth;

class TransporteurController extends AppBaseController
{
    /** @var TransporteurRepository $transporteurRepository*/
    private $transporteurRepository;

    private $historiqueRepository;

    public function __construct(TransporteurRepository $transporteurRepo, HistoriqueRepository $historiqueRepo)
    {
        $this->transporteurRepository = $transporteurRepo;
        $this->historiqueRepository = $historiqueRepo;
    }

    /**
     * Display a listing of the Transporteur.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->filled('nom')) {
            $nom = $request->input('nom');

            $transporteurs = Transporteur::where('nom', 'like', '%' . $nom . '%')->orderBy('id', 'desc')->paginate(5);
        } else {
            $transporteurs = Transporteur::orderBy('id', 'desc')->paginate(5);
        }

        return view('transporteurs.index')
            ->with('transporteurs', $transporteurs);
    }

    /**
     * Show the form for creating a new Transporteur.
     *
     * @return Response
     */
    public function create()
    {
        return view('transporteurs.create');
    }

    /**
     * Store a newly created Transporteur in storage.
     *
     * @param CreateTransporteurRequest $request
     *
     * @return Response
     */
    public function store(CreateTransporteurRequest $request)
    {
        $input = $request->all();

        $transporteur = $this->transporteurRepository->create($input);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Ajout d'un transporteur",
            "date" => $currentDate,
            "ref" => $transporteur->nom,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Enregistrer avec succès', ['model' => __('models/transporteurs.singular')]));

        return redirect(route('transporteurs.index'));
    }

    /**
     * Display the specified Transporteur.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transporteur = $this->transporteurRepository->find($id);

        if (empty($transporteur)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transporteurs.singular')]));

            return redirect(route('transporteurs.index'));
        }

        return view('transporteurs.show')->with('transporteur', $transporteur);
    }

    /**
     * Show the form for editing the specified Transporteur.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transporteur = $this->transporteurRepository->find($id);

        if (empty($transporteur)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transporteurs.singular')]));

            return redirect(route('transporteurs.index'));
        }

        return view('transporteurs.edit')->with('transporteur', $transporteur);
    }

    /**
     * Update the specified Transporteur in storage.
     *
     * @param int $id
     * @param UpdateTransporteurRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransporteurRequest $request)
    {
        $transporteur = $this->transporteurRepository->find($id);

        if (empty($transporteur)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transporteurs.singular')]));

            return redirect(route('transporteurs.index'));
        }

        $transporteur = $this->transporteurRepository->update($request->all(), $id);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Modification d'un transporteur",
            "date" => $currentDate,
            "ref" => $transporteur->nom,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Modifier avec succès', ['model' => __('models/transporteurs.singular')]));

        return redirect(route('transporteurs.index'));
    }

    /**
     * Remove the specified Transporteur from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transporteur = $this->transporteurRepository->find($id);

        if (empty($transporteur)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transporteurs.singular')]));

            return redirect(route('transporteurs.index'));
        }

        $this->transporteurRepository->delete($id);
        return redirect(route('transporteurs.index'));
    }
}
