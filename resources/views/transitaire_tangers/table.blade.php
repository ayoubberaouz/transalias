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
                <th>Numéro de Compte</th>
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
                    <td width="120">
                        <div class=''>
                            <a href="{{ route('transitaireTangers.show', [$transitaireTanger->id]) }}" title="Détails"
                                class='btn btn-outline-secondary p-2'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('transitaireTangers.edit', [$transitaireTanger->id]) }}" title="Modifier"
                                class='btn btn-outline-warning p-2'>
                                <i class="fas fa-edit"></i>
                            </a>
                            {!! Form::open(['route' => ['transitaireTangers.destroy', $transitaireTanger->id], 'method' => 'delete']) !!}
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
