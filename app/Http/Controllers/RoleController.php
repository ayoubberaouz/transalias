<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Carbon\Carbon;
use App\Repositories\HistoriqueRepository;
use Illuminate\Support\Facades\Auth;

class RoleController extends AppBaseController
{
    /** @var  PermissionRepository */
    private $permissionRepository;

    /** @var  RoleRepository */
    private $roleRepository;

    private $historiqueRepository;

    public function __construct(RoleRepository $roleRepo, PermissionRepository $permissionRepo, HistoriqueRepository $historiqueRepo)
    {
        $this->roleRepository = $roleRepo;
        $this->permissionRepository = $permissionRepo;
        $this->historiqueRepository = $historiqueRepo;
    }

    /**
     * Display a listing of the Role.
     *
     * @param RoleDataTable $roleDataTable
     * @return Response
     */
    public function index(RoleDataTable $roleDataTable)
    {
        $roles = $this->roleRepository->paginate(20);

        return view('roles.index')->with('roles', $roles);    
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        $allPermission = $this->permissionRepository->all();
        return view('roles.create')->with('allPermission', $allPermission);
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();
        $role = $this->roleRepository->create($input);

        $permission_data = $request->get('permission_data');
        $role->syncPermissions($permission_data);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Ajout d'un role",
            "date" => $currentDate,
            "ref" => $role->name,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success('Enregistrer avec succès');
        return redirect(route('roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $allPermission = $this->permissionRepository->all();
        return view('roles.show')->with('role', $role)->with('allPermission', $allPermission);
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $allPermission = $this->permissionRepository->all();

        return view('roles.edit')->with('role', $role)->with('allPermission', $allPermission);
    }
 
    /**
     * Update the specified Role in storage.
     *
     * @param  int              $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);
        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }
        $permission_data = $request->get('permission_data');

        $role = $this->roleRepository->update($request->all(), $id);
        $role->syncPermissions($permission_data);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');
        
        $historique = [
            "taches" => "Modification d'un role",
            "date" => $currentDate,
            "ref" => $role->name,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success('Modifier avec succès');
        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $this->roleRepository->delete($id);
        return redirect(route('roles.index'));
    }
}
