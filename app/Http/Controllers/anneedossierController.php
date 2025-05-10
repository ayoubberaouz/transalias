<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateanneedossierRequest;
use App\Http\Requests\UpdateanneedossierRequest;
use App\Repositories\anneedossierRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class anneedossierController extends AppBaseController
{
    /** @var anneedossierRepository $anneedossierRepository*/
    private $anneedossierRepository;

    public function __construct(anneedossierRepository $anneedossierRepo)
    {
        $this->anneedossierRepository = $anneedossierRepo;
    }

    /**
     * Display a listing of the anneedossier.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $anneedossiers = $this->anneedossierRepository->paginate(20);

        return view('anneedossiers.index')
            ->with('anneedossiers', $anneedossiers);
    }

    /**
     * Show the form for creating a new anneedossier.
     *
     * @return Response
     */
    public function create()
    {
        return view('anneedossiers.create');
    }

    /**
     * Store a newly created anneedossier in storage.
     *
     * @param CreateanneedossierRequest $request
     *
     * @return Response
     */
    public function store(CreateanneedossierRequest $request)
    {
        $input = $request->all();

        $anneedossier = $this->anneedossierRepository->create($input);

        Flash::success(__('messages.saved', ['model' => __('models/anneedossiers.singular')]));

        return redirect(route('anneedossiers.index'));
    }

    /**
     * Display the specified anneedossier.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $anneedossier = $this->anneedossierRepository->find($id);

        if (empty($anneedossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/anneedossiers.singular')]));

            return redirect(route('anneedossiers.index'));
        }

        return view('anneedossiers.show')->with('anneedossier', $anneedossier);
    }

    /**
     * Show the form for editing the specified anneedossier.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $anneedossier = $this->anneedossierRepository->find($id);

        if (empty($anneedossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/anneedossiers.singular')]));

            return redirect(route('anneedossiers.index'));
        }

        return view('anneedossiers.edit')->with('anneedossier', $anneedossier);
    }

    /**
     * Update the specified anneedossier in storage.
     *
     * @param int $id
     * @param UpdateanneedossierRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateanneedossierRequest $request)
    {
        $anneedossier = $this->anneedossierRepository->find($id);

        if (empty($anneedossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/anneedossiers.singular')]));

            return redirect(route('anneedossiers.index'));
        }

        $anneedossier = $this->anneedossierRepository->update($request->all(), $id);

        Flash::success(__('messages.updated', ['model' => __('models/anneedossiers.singular')]));

        return redirect(route('anneedossiers.index'));
    }

    /**
     * Remove the specified anneedossier from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $anneedossier = $this->anneedossierRepository->find($id);

        if (empty($anneedossier)) {
            Flash::error(__('messages.not_found', ['model' => __('models/anneedossiers.singular')]));

            return redirect(route('anneedossiers.index'));
        }

        $this->anneedossierRepository->delete($id);

        Flash::success(__('messages.deleted', ['model' => __('models/anneedossiers.singular')]));

        return redirect(route('anneedossiers.index'));
    }
}
