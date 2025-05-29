<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransitaireTangerRequest;
use App\Http\Requests\UpdateTransitaireTangerRequest;
use App\Repositories\TransitaireTangerRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\TransitaireTanger;
use Illuminate\Http\Request;
use Flash;
use Response;
use Carbon\Carbon;
use App\Repositories\HistoriqueRepository;
use Illuminate\Support\Facades\Auth;

class TransitaireTangerController extends AppBaseController
{
    /** @var TransitaireTangerRepository $transitaireTangerRepository*/
    private $transitaireTangerRepository;

    private $historiqueRepository;

    public function __construct(TransitaireTangerRepository $transitaireTangerRepo, HistoriqueRepository $historiqueRepo)
    {
        $this->transitaireTangerRepository = $transitaireTangerRepo;
        $this->historiqueRepository = $historiqueRepo;
    }

    /**
     * Display a listing of the TransitaireTanger.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->filled('nom')) {
            $nom = $request->input('nom');

            $transitaireTangers = TransitaireTanger::where('nom', 'like', '%' . $nom . '%')->orderBy('id', 'desc')->paginate(5);
        } else {
            $transitaireTangers = TransitaireTanger::orderBy('id', 'desc')->paginate(5);
        }

        return view('transitaire_tangers.index')
            ->with('transitaireTangers', $transitaireTangers);
    }

    /**
     * Show the form for creating a new TransitaireTanger.
     *
     * @return Response
     */
    public function create()
    {
        return view('transitaire_tangers.create');
    }

    /**
     * Store a newly created TransitaireTanger in storage.
     *
     * @param CreateTransitaireTangerRequest $request
     *
     * @return Response
     */
    public function store(CreateTransitaireTangerRequest $request)
    {
        $input = $request->all();

        $transitaireTanger = $this->transitaireTangerRepository->create($input);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Ajout d'un transitaire tanger",
            "date" => $currentDate,
            "ref" => $transitaireTanger->nom,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Enregistrer avec succès', ['model' => __('models/transitaireTangers.singular')]));

        return redirect(route('transitaireTangers.index'));
    }

    /**
     * Display the specified TransitaireTanger.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transitaireTanger = $this->transitaireTangerRepository->find($id);

        if (empty($transitaireTanger)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transitaireTangers.singular')]));

            return redirect(route('transitaireTangers.index'));
        }

        return view('transitaire_tangers.show')->with('transitaireTanger', $transitaireTanger);
    }

    /**
     * Show the form for editing the specified TransitaireTanger.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transitaireTanger = $this->transitaireTangerRepository->find($id);

        if (empty($transitaireTanger)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transitaireTangers.singular')]));

            return redirect(route('transitaireTangers.index'));
        }

        return view('transitaire_tangers.edit')->with('transitaireTanger', $transitaireTanger);
    }

    /**
     * Update the specified TransitaireTanger in storage.
     *
     * @param int $id
     * @param UpdateTransitaireTangerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransitaireTangerRequest $request)
    {
        $transitaireTanger = $this->transitaireTangerRepository->find($id);

        if (empty($transitaireTanger)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transitaireTangers.singular')]));

            return redirect(route('transitaireTangers.index'));
        }

        $transitaireTanger = $this->transitaireTangerRepository->update($request->all(), $id);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Modification d'un transitaire tanger",
            "date" => $currentDate,
            "ref" => $transitaireTanger->nom,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Modifier avec succès', ['model' => __('models/transitaireTangers.singular')]));

        return redirect(route('transitaireTangers.index'));
    }

    /**
     * Remove the specified TransitaireTanger from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transitaireTanger = $this->transitaireTangerRepository->find($id);

        if (empty($transitaireTanger)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transitaireTangers.singular')]));

            return redirect(route('transitaireTangers.index'));
        }

        $this->transitaireTangerRepository->delete($id);
        return redirect(route('transitaireTangers.index'));
    }
}
