<div class="table-responsive table-striped">
    <table class="table" id="transporteurs-table">
        <thead>
            <tr>
                <th>@lang('models/transporteurs.fields.nom')</th>
                <th>Téléphone</th>
                <th>@lang('models/transporteurs.fields.fax')</th>
                <th>@lang('models/transporteurs.fields.gsm')</th>
                <th>@lang('models/transporteurs.fields.email')</th>
                <th>@lang('models/transporteurs.fields.adresse')</th>
                <th>@lang('models/transporteurs.fields.ville')</th>
                <th>Numéro de Compte</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transporteurs as $transporteur)
                <tr>
                    <td>{{ $transporteur->nom }}</td>
                    <td>{{ $transporteur->tel }}</td>
                    <td>{{ $transporteur->fax }}</td>
                    <td>{{ $transporteur->gsm }}</td>
                    <td>{{ $transporteur->email }}</td>
                    <td>{{ $transporteur->adresse }}</td>
                    <td>{{ $transporteur->ville }}</td>
                    <td>{{ $transporteur->Ncompte }}</td>
                    <td width="120">
                        <div class='btn-group'>
                            <a href="{{ route('transporteurs.show', [$transporteur->id]) }}" title="Détails"
                                class='btn btn-secondary p-2'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('transporteurs.edit', [$transporteur->id]) }}" title="Modifier"
                                class='btn btn-warning text-white p-2'>
                                <i class="far fa-edit"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
