<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransitaireAlgRequest;
use App\Http\Requests\UpdateTransitaireAlgRequest;
use App\Repositories\TransitaireAlgRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\TransitaireAlg;
use Illuminate\Http\Request;
use Flash;
use Response;
use Carbon\Carbon;
use App\Repositories\HistoriqueRepository;
use Illuminate\Support\Facades\Auth;

class TransitaireAlgController extends AppBaseController
{
    /** @var TransitaireAlgRepository $transitaireAlgRepository*/
    private $transitaireAlgRepository;

    private $historiqueRepository;

    public function __construct(TransitaireAlgRepository $transitaireAlgRepo, HistoriqueRepository $historiqueRepo)
    {
        $this->transitaireAlgRepository = $transitaireAlgRepo;
        $this->historiqueRepository = $historiqueRepo;
    }

    /**
     * Display a listing of the TransitaireAlg.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if ($request->filled('nom')) {
            $nom = $request->input('nom');

            $transitaireAlgs = TransitaireAlg::where('nom', 'like', '%' . $nom . '%')->orderBy('id', 'desc')->paginate(5);
        } else {
            $transitaireAlgs = TransitaireAlg::orderBy('id', 'desc')->paginate(5);
        }

        return view('transitaire_algs.index')
            ->with('transitaireAlgs', $transitaireAlgs);
    }

    /**
     * Show the form for creating a new TransitaireAlg.
     *
     * @return Response
     */
    public function create()
    {
        return view('transitaire_algs.create');
    }

    /**
     * Store a newly created TransitaireAlg in storage.
     *
     * @param CreateTransitaireAlgRequest $request
     *
     * @return Response
     */
    public function store(CreateTransitaireAlgRequest $request)
    {
        $input = $request->all();

        $transitaireAlg = $this->transitaireAlgRepository->create($input);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Ajout d'un transitaire alg",
            "date" => $currentDate,
            "ref" => $transitaireAlg->nom,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Enregistrer avec succès', ['model' => __('models/transitaireAlgs.singular')]));

        return redirect(route('transitaireAlgs.index'));
    }

    /**
     * Display the specified TransitaireAlg.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transitaireAlg = $this->transitaireAlgRepository->find($id);

        if (empty($transitaireAlg)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transitaireAlgs.singular')]));

            return redirect(route('transitaireAlgs.index'));
        }

        return view('transitaire_algs.show')->with('transitaireAlg', $transitaireAlg);
    }

    /**
     * Show the form for editing the specified TransitaireAlg.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transitaireAlg = $this->transitaireAlgRepository->find($id);

        if (empty($transitaireAlg)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transitaireAlgs.singular')]));

            return redirect(route('transitaireAlgs.index'));
        }

        return view('transitaire_algs.edit')->with('transitaireAlg', $transitaireAlg);
    }

    /**
     * Update the specified TransitaireAlg in storage.
     *
     * @param int $id
     * @param UpdateTransitaireAlgRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTransitaireAlgRequest $request)
    {
        $transitaireAlg = $this->transitaireAlgRepository->find($id);

        if (empty($transitaireAlg)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transitaireAlgs.singular')]));

            return redirect(route('transitaireAlgs.index'));
        }

        $transitaireAlg = $this->transitaireAlgRepository->update($request->all(), $id);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Modification d'un transitaire alg",
            "date" => $currentDate,
            "ref" => $transitaireAlg->nom,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success(__('Modifier avec succès', ['model' => __('models/transitaireAlgs.singular')]));

        return redirect(route('transitaireAlgs.index'));
    }

    /**
     * Remove the specified TransitaireAlg from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transitaireAlg = $this->transitaireAlgRepository->find($id);

        if (empty($transitaireAlg)) {
            Flash::error(__('messages.not_found', ['model' => __('models/transitaireAlgs.singular')]));

            return redirect(route('transitaireAlgs.index'));
        }

        $this->transitaireAlgRepository->delete($id);
        return redirect(route('transitaireAlgs.index'));
    }
}
