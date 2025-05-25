<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHistoriqueRequest;
use App\Http\Requests\UpdateHistoriqueRequest;
use App\Repositories\HistoriqueRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Historique;

class HistoriqueController extends AppBaseController
{
    /** @var HistoriqueRepository $historiqueRepository*/
    private $historiqueRepository;

    public function __construct(HistoriqueRepository $historiqueRepo)
    {
        $this->historiqueRepository = $historiqueRepo;
    }

    /**
     * Display a listing of the Historique.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $historiques = Historique::orderBy('id', 'desc')->paginate(5);

        return view('historiques.index')
            ->with('historiques', $historiques);
    }

    /**
     * Show the form for creating a new Historique.
     *
     * @return Response
     */
    public function create()
    {
        return view('historiques.create');
    }

    /**
     * Store a newly created Historique in storage.
     *
     * @param CreateHistoriqueRequest $request
     *
     * @return Response
     */
    public function store(CreateHistoriqueRequest $request)
    {
        $input = $request->all();

        $historique = $this->historiqueRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/historiques.singular')]));

        return redirect(route('historiques.index'));
    }

    /**
     * Display the specified Historique.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $historique = $this->historiqueRepository->find($id);

        if (empty($historique)) {
            Flash::error(__('messages.not_found', ['model' => __('models/historiques.singular')]));

            return redirect(route('historiques.index'));
        }

        return view('historiques.show')->with('historique', $historique);
    }

    /**
     * Show the form for editing the specified Historique.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $historique = $this->historiqueRepository->find($id);

        if (empty($historique)) {
            Flash::error(__('messages.not_found', ['model' => __('models/historiques.singular')]));

            return redirect(route('historiques.index'));
        }

        return view('historiques.edit')->with('historique', $historique);
    }

    /**
     * Update the specified Historique in storage.
     *
     * @param int $id
     * @param UpdateHistoriqueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateHistoriqueRequest $request)
    {
        $historique = $this->historiqueRepository->find($id);

        if (empty($historique)) {
            Flash::error(__('messages.not_found', ['model' => __('models/historiques.singular')]));

            return redirect(route('historiques.index'));
        }

        $historique = $this->historiqueRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/historiques.singular')]));

        return redirect(route('historiques.index'));
    }

    /**
     * Remove the specified Historique from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $historique = $this->historiqueRepository->find($id);

        if (empty($historique)) {
            Flash::error(__('messages.not_found', ['model' => __('models/historiques.singular')]));

            return redirect(route('historiques.index'));
        }

        $this->historiqueRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/historiques.singular')]));

        return redirect(route('historiques.index'));
    }
}
