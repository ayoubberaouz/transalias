<div class="table-responsive table-striped">
    <table class="table" id="transitaireTangers-table">
        <thead>
            <tr class="table-user">
                <th>@lang('models/transporteurs.fields.nom')</th>
                <th>Téléphone</th>
                <th>@lang('models/transporteurs.fields.fax')</th>
                <th>@lang('models/transporteurs.fields.gsm')</th>
                <th>@lang('models/transporteurs.fields.email')</th>
                <th>@lang('models/transporteurs.fields.adresse')</th>
                <th>@lang('models/transporteurs.fields.ville')</th>
                <th>N° Compte</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transitaireTangers as $transitaireTanger)
                <tr>
                    <td>{{ $transitaireTanger->nom }}</td>
                    <td>{{ $transitaireTanger->tel }}</td>
                    <td>{{ $transitaireTanger->fax }}</td>
                    <td>{{ $transitaireTanger->gsm }}</td>
                    <td>{{ $transitaireTanger->email }}</td>
                    <td>{{ $transitaireTanger->adresse }}</td>
                    <td>{{ $transitaireTanger->ville }}</td>
                    <td>{{ $transitaireTanger->Ncompte }}</td>
                    <td width="200">
                        <div class='action-buttons d-flex flex-wrap gap-2'>
                            <a href="{{ route('transitaireTangers.show', [$transitaireTanger->id]) }}" title="Détails"
                                class='btn btn-outline-secondary px-2 py-1'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('transitaireTangers.edit', [$transitaireTanger->id]) }}" title="Modifier"
                                class='btn btn-outline-warning px-2 py-1'>
                                <i class="fas fa-edit"></i>
                            </a>
                            {!! Form::open(['route' => ['transitaireTangers.destroy', $transitaireTanger->id], 'method' => 'delete']) !!}
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
                    title: 'Voulez-vous vraiment supprimer cet transitaire tanger ?',
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
                            title: "Le transitaire tanger a été supprimé avec succès",
                            icon: 'success',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            form.submit(); // Submit after showing success
                        });
                    } else {
                        Swal.fire({
                            title: "Suppression annulée",
                            text: "Le transitaire tanger n'a pas été supprimé.",
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
