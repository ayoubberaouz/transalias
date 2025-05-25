<div class="table-responsive table-striped">
    <table class="table" id="noteDebitDossiers-table">
        <thead>
            <tr class="table-user">
                <th>Société</th>
                <th>N° Note de Débit</th>
                <th>N° Dossier</th>
                <th>Client</th>
                <th>Transporteur</th>
                <th>Matricule Tracteur</th>
                <th>Matricule Remorque</th>
                <th>Date Note de Débit</th>
                <th>Etat Paiement</th>
                <th>Etat Validation</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($noteDebitDossiers as $noteDebitDossier)
                <tr>
                    <td>
                        @if ($noteDebitDossier->selectedSociete == 1)
                            <img src="{{ url('images/transalias_logo.png') }}" style="width: 5rem">
                        @elseif($noteDebitDossier->selectedSociete == 2)
                            <img src="{{ url('images/akbar-removebg-preview.png') }}" style="width: 5rem">
                        @elseif($noteDebitDossier->selectedSociete == 3)
                            <img src="{{ url('images/iga-removebg-preview.png') }}" style="width: 3rem">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $noteDebitDossier->numnotedebit }}</td>
                    <td>{{ $noteDebitDossier->annee_dossier }}</td>
                    <td>{{ $noteDebitDossier->client ? $noteDebitDossier->dossiers->clients->nom : '-' }}</td>
                    <td>{{ $noteDebitDossier->transporteur }}</td>
                    <td>{{ $noteDebitDossier->mat_tracteur }}</td>
                    <td>{{ $noteDebitDossier->mat_remorque }}</td>
                    <td>{{ $noteDebitDossier->datenotationdebit }}</td>
                    <td>
                        @if ($noteDebitDossier->etat_paiement == 'Non')
                            {!! Form::open([
                                'route' => ['noteDebitDossiers.update-paiement', $noteDebitDossier->idNoteDebit] + request()->query(),
                                'method' => 'PUT',
                            ]) !!}
                            {!! Form::button('Non Payée', [
                                'type' => 'submit',
                                'class' => 'btn btn-default p-2',
                                'title' => 'Cliquer pour payée',
                                'onclick' => "return confirm('Etes-vous sûr que cette note de débit a été déjà payée ?')",
                                'style' => 'font-size: smaller',
                            ]) !!}
                            {!! Form::close() !!}
                        @elseif($noteDebitDossier->etat_paiement == 'Oui')
                            <button class="btn btn-info" style="font-size: smaller;">Oui Payée</button>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($noteDebitDossier->isValidate == 0)
                            {!! Form::open([
                                'route' => ['noteDebitDossiers.update-validation', $noteDebitDossier->idNoteDebit] + request()->query(),
                                'method' => 'PUT',
                            ]) !!}
                            {!! Form::button('Non Validée', [
                                'type' => 'submit',
                                'class' => 'btn btn-default p-2',
                                'title' => 'Cliquer pour validée',
                                'onclick' => "return confirm('Etes-vous sûr de validée cette note de débit ?')",
                                'style' => 'font-size: smaller',
                            ]) !!}
                            {!! Form::close() !!}
                        @elseif($noteDebitDossier->isValidate == 1)
                            <button class="btn btn-info" style="font-size: smaller;">Oui Validée</button>
                        @else
                            -
                        @endif
                    </td>
                    <td width="120">
                        <div class='btn-group'>
                            <a href="{{ route('noteDebitDossiers.show', [$noteDebitDossier->idNoteDebit]) }}"
                                class='btn btn-secondary p-2' title="Détails">
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('noteDebitDossiers.edit', [$noteDebitDossier->idNoteDebit]) }}"
                                class='btn btn-warning text-white p-2' title="Modifier">
                                <i class="far fa-edit"></i>
                            </a>
                            <a href="{{ route('imprimer-note-debit', [$noteDebitDossier->idNoteDebit]) }}"
                                target="_blank" class='btn btn-danger text-white p-2' title="Imprimer">
                                <i class="fas fa-print"></i>
                            </a>
                            <a href="{{ route('download-note-debit', [$noteDebitDossier->idNoteDebit]) }}"
                                target="_blank" class='btn btn-info text-white p-2' title="Télécharger">
                                <i class="fas fa-download"></i>
                            </a>
                            {!! Form::open(['route' => ['noteDebitDossiers.destroy', $noteDebitDossier->idNoteDebit], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-outline-danger px-3 py-2',
                                'onclick' => "return confirm('Vous êtes sur ?')",
                                'title' => 'Supprimer',
                            ]) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
