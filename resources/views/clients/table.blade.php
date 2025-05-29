<div class="table-responsive table-striped">
    <table class="table" id="clients-table">
        <thead>
            <tr class="table-user">
                <th>Nom</th>
                <th>Nom du contact</th>
                <th>Référence</th>
                <th>Téléphone</th>
                <th>@lang('models/clients.fields.email')</th>
                <th>@lang('models/clients.fields.ville')</th>
                <th>Société</th>
                <th>N° Compte</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $clients)
                <tr>
                    <td>{{ $clients->nom }}</td>
                    <td>{{ $clients->raison_social }}</td>
                    <td>{{ $clients->referenc }}</td>
                    <td>{{ $clients->tel }}</td>
                    <td>{{ $clients->email }}</td>
                    <td>{{ $clients->ville }}</td>
                    <td>
                        @if ($clients->societe == 1)
                            Transalias
                        @elseif($clients->societe == 2)
                            Akbar Services
                        @elseif($clients->societe == 3)
                            Inter Global Africa
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $clients->nCompte }}</td>
                    <td width="200">
                        <div class="action-buttons d-flex flex-wrap gap-2">
                            <a href="{{ route('clients.show', [$clients->id]) }}"
                                class='btn btn-outline-secondary px-2 py-1' title="Détails">
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('clients.edit', [$clients->id]) }}"
                                class='btn btn-outline-warning px-2 py-1' title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            {!! Form::open(['route' => ['clients.destroy', $clients->id], 'method' => 'delete']) !!}
                            <button type="button" class="btn btn-outline-danger px-2 py-1 show-confirm"
                                title="Supprimer">
                                <i class="far fa-trash-alt"></i>
                            </button>
                            {!! Form::close() !!}
                        </div>

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
                    title: 'Voulez-vous vraiment supprimer cet client ?',
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
                            title: "Le client a été supprimé avec succès",
                            icon: 'success',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            form.submit(); // Submit after showing success
                        });
                    } else {
                        Swal.fire({
                            title: "Suppression annulée",
                            text: "Le client n'a pas été supprimé.",
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
