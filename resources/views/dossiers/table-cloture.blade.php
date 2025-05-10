<div class="table-responsive table-striped">
    <table class="table" id="dossiers-table" style="font-size: 12px;">
        <thead>
            <tr>
                <th>N°</th>
                <th>@lang('models/dossiers.fields.client')</th>
                <th>Référence</th>
                <th>Date Chargement</th>
                <th>Matricule Remorque</th>
                <th>Matricule Tracteur</th>
                <th>N° Facture</th>
                <th>N° Note Débit</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dossiers as $d)
                <tr>
                    <td>{{ $d->annee_dossier }}</td>
                    <td>{{ $d->clients ? $d->clients->nom : '-' }}</td>
                    <td>{{ $d->reference }}</td>
                    <td>{{ $d->date_charg }}</td>
                    <td>{{ $d->mat_remorque }}</td>
                    <td>{{ $d->mat_tracteur }}</td>
                    <td>{{ $d->num_facture ? $d->num_facture : '-' }}</td>
                    <td>{{ $d->num_note_debit ? $d->num_note_debit : '-' }}</td>
                    <td>
                        <div class='btn-group'>
                            @if ($d->etat_facture == 1 && $d->etat_notedebit == 1 && $d->etat_validation_facture == 1 && $d->etat_validation_note == 1)
                                <a href="{{ route('imprimer-merged', [$d->iddossier]) }}" target="_blank"
                                    class='btn btn-danger text-white p-2' title="Imprimer facture et note débit">
                                    <i class="fas fa-print"></i>
                                </a>
                            @elseif ($d->etat_facture == 1 && $d->etat_notedebit == 0 && $d->id_facture && $d->etat_validation_facture == 1 && $d->etat_validation_note == 0)
                                <a href="{{ route('imprimer-facture', [$d->id_facture]) }}" target="_blank"
                                    class='btn btn-danger text-white p-2' title="Imprimer facture">
                                    <i class="fas fa-print"></i>
                                </a>
                            @elseif ($d->etat_facture == 0 && $d->etat_notedebit == 1 && $d->id_note_debit && $d->etat_validation_facture == 0 && $d->etat_validation_note == 1)
                                <a href="{{ route('imprimer-note-debit', [$d->id_note_debit]) }}" target="_blank"
                                    class='btn btn-danger text-white p-2' title="Imprimer note débit">
                                    <i class="fas fa-print"></i>
                                </a>
                            @else
                                -
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
