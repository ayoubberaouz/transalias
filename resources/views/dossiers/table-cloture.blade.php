<div class="table-responsive table-striped">
    <table class="table" id="dossiers-table" style="font-size: 12px;">
        <thead>
            <tr class="table-user">
                <th>N°</th>
                <th>@lang('models/dossiers.fields.client')</th>
                <th>Référence</th>
                <th>Date Chargement</th>
                <th>Matricule Remorque</th>
                <th>Matricule Tracteur</th>
                <th>N° Facture</th>
                <th>N° Note Débit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dossiers as $d)
                <tr>
                    <td>{{ $d->annee_dossier }}</td>
                    <td>{{ $d->clients ? $d->clients->nom : '-' }}</td>
                    <td>{{ $d->reference }}</td>
                    <td>{{ $d->date_charg->format('Y-m-d') }}</td>
                    <td>{{ $d->mat_remorque }}</td>
                    <td>{{ $d->mat_tracteur }}</td>
                    <td>{{ $d->num_facture ? $d->num_facture : '-' }}</td>
                    <td>{{ $d->num_note_debit ? $d->num_note_debit : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
