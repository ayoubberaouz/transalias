<div class="table-responsive">
    <table class="table" id="anneedossiers-table">
        <thead>
            <tr>
                <th>@lang('models/anneedossiers.fields.iddossier')</th>
                <th>@lang('models/anneedossiers.fields.annee_dossier')</th>
                <th>@lang('models/anneedossiers.fields.annee')</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anneedossiers as $anneedossier)
                <tr>
                    <td>{{ $anneedossier->iddossier }}</td>
                    <td>{{ $anneedossier->annee_dossier }}</td>
                    <td>{{ $anneedossier->annee }}</td>
                    <td width="120">
                        {!! Form::open(['route' => ['anneedossiers.destroy', $anneedossier->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('anneedossiers.show', [$anneedossier->id]) }}"
                                class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('anneedossiers.edit', [$anneedossier->id]) }}"
                                class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => "return confirm('Are you sure?')",
                            ]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
