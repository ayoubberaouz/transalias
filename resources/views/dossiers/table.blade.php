<div class="table-responsive table-striped">
    <table class="table" id="dossiers-table" style="font-size: 13px;">
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
                    <td width="200">
                        <div class="action-buttons d-flex flex-wrap gap-2">
                            {{-- <a href="{{ route('dossiers.show', [$dossiers->id]) }}" class='btn btn-secondary p-2'
                                title="Détails">
                                <i class="far fa-eye"></i>
                            </a> --}}
                            {!! Form::open(['route' => ['dossiers.update-etat', $dossiers->id], 'method' => 'PUT']) !!}
                            <a href="{{ route('dossiers.edit', [$dossiers->id]) }}" class='btn btn-outline-warning px-2 py-1'
                                title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if ($dossiers->etat_cloture == 0)
                                {!! Form::button('<i class="fas fa-lock"></i>', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-outline-danger px-2 py-1',
                                    'title' => 'Clôturé',
                                    'onclick' => "return confirm('Etes-vous sûr de vouloir clôturer cette opération avec facturation ?')",
                                ]) !!}
                            @elseif ($dossiers->etat_cloture == 1)
                                {!! Form::button('<i class="fas fa-lock"></i>', [
                                    'class' => 'btn btn-outline-success px-2 py-1',
                                    'title' => 'Déja Clôturé',
                                ]) !!}
                            @endif
                            {!! Form::close() !!}
                            <a href="{{ route('dossiers.show-uploads', [$dossiers->id]) }}"
                                class='btn btn-outline-secondary px-2 py-1' title="Joindre des fichiers">
                                <i class="fas fa-paperclip"></i>
                            </a>
                            {!! Form::open(['route' => ['dossiers.destroy', $dossiers->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="far fa-trash-alt"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-outline-danger px-2 py-1',
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
