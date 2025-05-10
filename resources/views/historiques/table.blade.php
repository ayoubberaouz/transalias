<div class="table-responsive table-striped">
    <table class="table" id="historiques-table">
        <thead>
            <tr>
                <th>Tache</th>
                <th>@lang('models/historiques.fields.date')</th>
                <th>@lang('models/historiques.fields.ref')</th>
                <th>Utilisateur</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historiques as $historique)
                <tr>
                    <td>{{ $historique->taches }}</td>
                    <td>{{ $historique->date }}</td>
                    <td>{{ $historique->ref }}</td>
                    <td>{{ $historique->user }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
