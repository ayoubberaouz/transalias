<div class="table-responsive table-striped">
    <table class="table" id="dossiers-table">
        <thead>
            <tr class="table-user">
                <th>N°</th>
                <th>@lang('models/dossiers.fields.client')</th>
                <th>Référence</th>
                <th>Transporteur</th>
                <th>Date Chargement</th>
                <th>Matricule Remorque</th>
                <th>Matricule Tracteur</th>
                <th>Expéditeur</th>
                <th>Destinateur</th>
                <th>Etat Validation</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dossiers as $dossiers)
                <tr>
                    <td>{{ $dossiers->annee_dossier }}</td>
                    <td>{{ $dossiers->clients ? $dossiers->clients->nom : '-' }}</td>
                    <td>{{ $dossiers->reference }}</td>
                    <td>{{ $dossiers->transporteur }}</td>
                    <td>{{ $dossiers->date_charg }}</td>
                    <td>{{ $dossiers->mat_remorque }}</td>
                    <td>{{ $dossiers->mat_tracteur }}</td>
                    <td>{{ $dossiers->expediteur }}</td>
                    <td>{{ $dossiers->destinsation }}</td>
                    <td>
                        @if ($dossiers->etat_validation == 0)
                            <button class="btn btn-default" style="font-size: smaller;">Non Validé</button>
                        @elseif($dossiers->etat_validation == 1)
                            <button class="btn btn-info" style="font-size: smaller;">Oui Validé</button>
                        @else
                            -
                        @endif
                    </td>
                    <td width="100">
                        <div class='btn-group'>
                            <a href="{{ route('show-valide', [$dossiers->id]) }}" class='btn btn-outline-primary p-2'
                                title="Détails">
                                <i class="fas fa-check"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
