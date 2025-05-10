<div class="table-responsive table-striped">
    <table class="table" id="dossiers-table">
        <thead>
            <tr>
                <th>Société</th>
                <th>Client</th>
                <th>N° Dossier</th>
                <th>Transporteur</th>
                <th>Matricule Tracteur</th>
                <th>Matricule Remorque</th>
                <th>Date Chargement</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dossiers as $dossiers)
                <tr>
                    <td class="text-center">
                        @if ($dossiers->clients->societe == 1)
                        <img src="{{ url('images/transalias_logo.png') }}" style="width: 5rem">
                        @elseif($dossiers->clients->societe == 2)
                        <img src="{{ url('images/akbar-removebg-preview.png') }}" style="width: 5rem">
                        @elseif($dossiers->clients->societe == 3)
                            <img src="{{ url('images/iga-removebg-preview.png') }}" style="width: 3rem">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $dossiers->clients ? $dossiers->clients->nom : '-' }}</td>
                    <td>{{ $dossiers->annee_dossier }}</td>
                    <td>{{ $dossiers->transporteur }}</td>
                    <td>{{ $dossiers->mat_tracteur }}</td>
                    <td>{{ $dossiers->mat_remorque }}</td>
                    <td>{{ $dossiers->date_charg }}</td>
                    <td>
                        <div class='btn-group'>
                            <a href="{{ route('facturesDossiers.create-facture', [$dossiers->iddossier]) }}" class='btn btn-info text-white p-2'>
                                Facturer
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
