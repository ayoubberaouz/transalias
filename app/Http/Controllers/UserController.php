<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Hash;
use Response;
use Carbon\Carbon;
use App\Repositories\HistoriqueRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;
    /** @var  RoleRepository */
    private $roleRepository;

    private $historiqueRepository;

    public function __construct(RoleRepository $roleRepo, UserRepository $userRepo, HistoriqueRepository $historiqueRepo)
    {
        $this->userRepository = $userRepo;
        $this->roleRepository = $roleRepo;
        $this->historiqueRepository = $historiqueRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        $users = $this->userRepository->paginate(20);

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create')->with('roles', $this->roleRepository->all()->pluck('name', 'id'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = $this->userRepository->create($input);

        $role_data = $request->get('role_data');
        $user->syncRoles($role_data);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Ajout d'un utilisateur",
            "date" => $currentDate,
            "ref" => $user->name,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success('Enregistrer avec succès');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user)->with('roles', $this->roleRepository->all()->pluck('name', 'id'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $user = $this->userRepository->update($request->all(), $id);

        $role_data = $request->get('role_data');
        $user->syncRoles($role_data);

        // add historique
        $currentDate = Carbon::now('Africa/Casablanca');

        $historique = [
            "taches" => "Modification d'un utilisateur",
            "date" => $currentDate,
            "ref" => $user->name,
            "user" => Auth::user()->name,
        ];
        $this->historiqueRepository->create($historique);

        Flash::success('Modifier avec succès');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('Supprimer avec succès');

        return redirect(route('users.index'));
    }

    public function showProfile()
    {
        $user = auth()->user();
        return view('users.profile')->with('user', $user);
    }
    
    public function updateProfile(UpdateProfileRequest $request)
    {
        $id = auth()->user()->id;
        $data = $request->only(['name', 'email']);
        if ($request->get('password_new') && $request->get('password_new') != "") {
            $data['password'] = Hash::make($request->get('password_new'));
        }
        $this->userRepository->update($data, $id);

        Flash::success('Modifier avec succès');
        return redirect(route('users.profile'));
    }
}
