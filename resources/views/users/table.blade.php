<style>
    .action-buttons a,
    .action-buttons button {
        margin-right: 8px;
    }

    .action-buttons button:last-child {
        margin-right: 0;
    }
</style>


<div class="table-responsive table-striped">
    <table class="table" id="users-table">
        <thead>
            <tr class="table-user">
                <th>Nom</th>
                <th>Email</th>
                <th>Statut</th>
                <th>Role</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->status_online }}</td>
                    <td>{{ $user->role_text }}</td>
                    <td>
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                        <div class="">
                            <a href="{{ route('users.edit', [$user->id]) }}"
                                class="btn btn-outline-warning px-3 py-2 me-2" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-outline-danger px-3 py-2',
                                'onclick' => "return confirm('Vous êtes sur ?')",
                                'title' => 'Supprimer',
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
