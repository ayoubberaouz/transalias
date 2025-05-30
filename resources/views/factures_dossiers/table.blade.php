<div class="table-responsive table-striped">
    <table class="table" id="facturesDossiers-table">
        <thead>
            <tr class="table-user">
                <th>Société</th>
                <th>N° Facture</th>
                <th>N° Dossier</th>
                <th>Client</th>
                <th>Transporteur</th>
                <th>Matricule Tracteur</th>
                <th>Matricule Remorque</th>
                <th>Date Facturation</th>
                <th>Etat Paiement</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facturesDossiers as $f)
                <tr>
                    <td>
                        @if ($f->selectedSociete == 1)
                            <img src="{{ url('images/transalias_logo.png') }}" style="width: 5rem">
                        @elseif($f->selectedSociete == 2)
                            <img src="{{ url('images/akbar-removebg-preview.png') }}" style="width: 5rem">
                        @elseif($f->selectedSociete == 3)
                            <img src="{{ url('images/iga-removebg-preview.png') }}" style="width: 3rem">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $f->numFacturation }}</td>
                    <td>{{ $f->annee_dossier }}</td>
                    <td>{{ $f->client ? $f->dossiers->clients->nom : '-' }}</td>
                    <td>{{ $f->transporteur }}</td>
                    <td>{{ $f->mat_tracteur }}</td>
                    <td>{{ $f->mat_remorque }}</td>
                    <td>{{ $f->dateFacturation->format('Y-m-d') }}</td>
                    <td>
                        @if ($f->etat_paiement == 'Non')
                            {!! Form::open([
                                'route' => ['facturesDossiers.update-paiement', $f->idfacture] + request()->query(),
                                'method' => 'PUT',
                            ]) !!}
                            {!! Form::button('Non Payée', [
                                'type' => 'button', // prevent form from auto-submitting
                                'class' => 'btn btn-default p-2 btn-paiement-confirm',
                                'title' => 'Cliquer pour payée',
                                'style' => 'font-size: smaller',
                            ]) !!}
                            {!! Form::close() !!}
                        @elseif($f->etat_paiement == 'Oui')
                            <button class="btn btn-info" style="font-size: smaller;">Oui Payée</button>
                        @else
                            -
                        @endif

                    </td>
                    <td width="200">
                        <div class='action-buttons d-flex flex-wrap gap-2'>
                            {{-- <a href="{{ route('facturesDossiers.show', [$f->idfacture]) }}"
                                class='btn btn-outline-secondary px-2 py-1' title="Détails">
                                <i class="far fa-eye"></i>
                            </a> --}}
                            <a href="{{ route('facturesDossiers.edit', [$f->idfacture]) }}"
                                class='btn btn-outline-warning px-2 py-1' title="Modifier">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="{{ route('imprimer-facture', [$f->idfacture]) }}" target="_blank"
                                class='btn btn-outline-danger px-2 py-1' title="Imprimer">
                                <i class="fas fa-print"></i>
                            </a>
                            <a href="{{ route('download-facture', [$f->idfacture]) }}" target="_blank"
                                class='btn btn-outline-info px-2 py-1' title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                            {!! Form::open(['route' => ['facturesDossiers.destroy', $f->idfacture], 'method' => 'delete']) !!}
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
                    title: 'Voulez-vous vraiment supprimer cette facture ?',
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
                            title: "La facture a été supprimée avec succès",
                            icon: 'success',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            form.submit(); // Submit after showing success
                        });
                    } else {
                        Swal.fire({
                            title: "Suppression annulée",
                            text: "La facture n'a pas été supprimée.",
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Paiement confirmation
        document.querySelectorAll('.btn-paiement-confirm').forEach(function(button) {
            button.addEventListener('click', function() {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Êtes-vous sûr que cette facture a été déjà payée ?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Oui',
                    cancelButtonText: 'Non',
                    customClass: {
                        title: 'swal-title-dark',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "La facture est payée avec succès",
                            icon: 'success',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            form.submit();
                        });
                    } else {
                        Swal.fire({
                            title: "La facture est non payée",
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
