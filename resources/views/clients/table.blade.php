<div class="table-responsive table-striped">
    <table class="table" id="clients-table">
        <thead>
            <tr class="table-user">
                <th>Nom</th>
                <th>Nom du contact</th>
                <th>Référence</th>
                <th>Téléphone</th>
                <th>@lang('models/clients.fields.email')</th>
                <th>@lang('models/clients.fields.ville')</th>
                <th>Société</th>
                <th>Numéro de Compte</th>
                <th colspan="3">@lang('crud.action')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $clients)
                <tr>
                    <td>{{ $clients->nom }}</td>
                    <td>{{ $clients->raison_social }}</td>
                    <td>{{ $clients->referenc }}</td>
                    <td>{{ $clients->tel }}</td>
                    <td>{{ $clients->email }}</td>
                    <td>{{ $clients->ville }}</td>
                    <td>
                        @if ($clients->societe == 1)
                            Transalias
                        @elseif($clients->societe == 2)
                            Akbar Services
                        @elseif($clients->societe == 3)
                            Inter Global Africa
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $clients->nCompte }}</td>
                    <td>
                        <a href="{{ route('clients.show', [$clients->id]) }}" class='btn btn-outline-secondary p-2'
                            title="Détails">
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('clients.edit', [$clients->id]) }}" class='btn btn-outline-warning p-2'
                            title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        {!! Form::open(['route' => ['clients.destroy', $clients->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="far fa-trash-alt"></i>', [
                            'type' => 'submit',
                            'class' => 'btn btn-outline-danger px-3 py-2',
                            'onclick' => "return confirm('Vous êtes sur ?')",
                            'title' => 'Supprimer',
                        ]) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
