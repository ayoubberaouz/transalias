<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClientsRequest;
use App\Http\Requests\UpdateClientsRequest;
use App\Repositories\ClientsRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Clients;
use Flash;
use Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Repositories\HistoriqueRepository;

class ClientsController extends AppBaseController
{
    /** @var ClientsRepository $clientsRepository*/
    private $clientsRepository;

    private $historiqueRepository;

    public function __construct(ClientsRepository $clientsRepo, HistoriqueRepository $historiqueRepo)
    {
        $this->clientsRepository = $clientsRepo;
        $this->historiqueRepository = $historiqueRepo;
    }

    /**
     * Display a listing of the Clients.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->filled('nom')) {
            $nom = $request->input('nom');
            
            $clients = Clients::where('nom', 'like' , '%'.$nom.'%')->orderBy('id', 'desc')->paginate(20);
        }
        else{
            $clients = Clients::orderBy('id', 'desc')->paginate(20);
        }

        return view('clients.index')
            ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new Clients.
     *
     * @return Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created Clients in storage.
     *
     * @param CreateClientsRequest $request
     *
     * @return Response
     */
    public function store(CreateClientsRequest $request)
    {
        $input = $request->all();

        $clients = $this->clientsRepository->create($input);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Ajout d'un client",
            "date" => $currentDate,
            "ref" => $clients->referenc,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Enregistrer avec succès', ['model' => __('models/clients.singular')]));

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified Clients.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clients.singular')]));

            return redirect(route('clients.index'));
        }

        return view('clients.show')->with('clients', $clients);
    }

    /**
     * Show the form for editing the specified Clients.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clients.singular')]));

            return redirect(route('clients.index'));
        }

        return view('clients.edit')->with('clients', $clients);
    }

    /**
     * Update the specified Clients in storage.
     *
     * @param int $id
     * @param UpdateClientsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateClientsRequest $request)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clients.singular')]));

            return redirect(route('clients.index'));
        }

        $clients = $this->clientsRepository->update($request->all(), $id);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Modification d'un client",
            "date" => $currentDate,
            "ref" => $clients->referenc,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Modifier avec succès', ['model' => __('models/clients.singular')]));

        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified Clients from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $clients = $this->clientsRepository->find($id);

        if (empty($clients)) {
            Flash::error(__('messages.not_found', ['model' => __('models/clients.singular')]));

            return redirect(route('clients.index'));
        }

        $this->clientsRepository->delete($id);

        Flash::success(__('Supprimer avec succès', ['model' => __('models/clients.singular')]));

        return redirect(route('clients.index'));
    }

    public function getClientsBySociete($societeId){
        $clients = Clients::where('societe', $societeId)->pluck('nom', 'id');
        return response()->json($clients);
    }
}
