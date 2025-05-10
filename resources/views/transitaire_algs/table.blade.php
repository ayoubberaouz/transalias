<div class="table-responsive table-striped">
    <table class="table" id="transitaireAlgs-table">
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
            @foreach ($transitaireAlgs as $transitaireAlg)
                <tr>
                    <td>{{ $transitaireAlg->nom }}</td>
                    <td>{{ $transitaireAlg->tel }}</td>
                    <td>{{ $transitaireAlg->fax }}</td>
                    <td>{{ $transitaireAlg->gsm }}</td>
                    <td>{{ $transitaireAlg->email }}</td>
                    <td>{{ $transitaireAlg->adresse }}</td>
                    <td>{{ $transitaireAlg->ville }}</td>
                    <td>{{ $transitaireAlg->Ncompte }}</td>
                    <td width="120">
                        <div class='btn-group'>
                            <a href="{{ route('transitaireAlgs.show', [$transitaireAlg->id]) }}" title="Détails"
                                class='btn btn-secondary p-2'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('transitaireAlgs.edit', [$transitaireAlg->id]) }}" title="Modifier"
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
