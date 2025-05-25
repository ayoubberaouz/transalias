<div class="table-responsive table-striped">
    <table class="table" id="transporteurs-table">
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
                        <div class=''>
                            <a href="{{ route('transporteurs.show', [$transporteur->id]) }}" title="Détails"
                                class='btn btn-outline-secondary px-2 py-1'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('transporteurs.edit', [$transporteur->id]) }}" title="Modifier"
                                class='btn btn-outline-warning px-2 py-1'>
                                <i class="fas fa-edit"></i>
                            </a>
                            {!! Form::open(['route' => ['transporteurs.destroy', $transporteur->id], 'method' => 'delete']) !!}
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
