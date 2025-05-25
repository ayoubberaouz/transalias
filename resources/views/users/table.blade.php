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
                        {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete', 'class' => 'delete-form']) !!}
                        <div>
                            <a href="{{ route('users.edit', [$user->id]) }}"
                                class="btn btn-outline-warning px-2 py-1" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-outline-danger px-2 py-1 show-confirm"
                                title="Supprimer">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.show-confirm').forEach(function(button) {
            button.addEventListener('click', function() {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Voulez-vous vraiment supprimer cet utilisateur ?',
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui',
                    cancelButtonText: 'Non',
                    customClass: {
                        title: 'swal-title-dark',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "L'utilisateur a été supprimé avec succès",
                            icon: 'success',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            form.submit(); // Submit after showing success
                        });
                    } else {
                        Swal.fire({
                            title: "Suppression annulée",
                            text: "L'utilisateur n'a pas été supprimé.",
                            icon: 'info',
                            confirmButtonColor: '#007bff',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    });
</script>

