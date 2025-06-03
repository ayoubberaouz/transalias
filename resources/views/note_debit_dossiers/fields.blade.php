<div id="accordion">
    <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            style="cursor: pointer;">
            <span>Infos Voyage</span>
            <span class="toggle-icon float-right"><i class="fas fa-chevron-down"></i></span>
        </div>
        <div id="collapseOne" class="collapse show" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    <!-- Société Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('societe', 'Societe :') !!}
                        <p>
                            @if ($dossiers->clients ? $dossiers->clients->societe == 1 : '-')
                                Transalias
                            @elseif($dossiers->clients ? $dossiers->clients->societe == 2 : '-')
                                Akbar Services
                            @elseif($dossiers->clients ? $dossiers->clients->societe == 3 : '-')
                                Inter Global Africa
                            @else
                                -
                            @endif
                        </p>
                    </div>

                    <!-- Client Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('client', __('models/dossiers.fields.client') . ' :') !!}
                        <p>{{ $dossiers->clients ? $dossiers->clients->nom : '-' }}</p>
                    </div>

                    <!-- Mat Tracteur Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('mat_tracteur', 'Matricule du tracteur :') !!}
                        <p>{{ $dossiers->mat_tracteur ? $dossiers->mat_tracteur : '-' }}</p>
                    </div>

                    <!-- Mat Remorque Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('mat_remorque', 'Matricule du remorque :') !!}
                        <p>{{ $dossiers->mat_remorque }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            style="cursor: pointer;">
            <span class="collapsed card-link"> Trajet Voyage</span>
            <span class="toggle-icon float-right"><i class="fas fa-chevron-down"></i></span>
        </div>
        <div id="collapseTwo" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('date_charg', 'Date de chargement :') !!}
                        <p>{{ $dossiers->date_charg->format('Y-m-d') }}</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('lien_chargement', 'Lieu de chargement :') !!}
                        <p>{{ $dossiers->lien_chargement }}</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('expediteur', 'Expéditeur :') !!}
                        <p>{{ $dossiers->expediteur }}</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('lieu_livraison', 'Lieu de livraison :') !!}
                        <p>{{ $dossiers->lieu_livraison }}</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('destinsation', 'Destinateur :') !!}
                        <p>{{ $dossiers->destinsation }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
            style="cursor: pointer;">
            <span class="collapsed card-link">Infos Complémentaire</span>
            <span class="toggle-icon float-right"><i class="fas fa-chevron-down"></i></span>
        </div>

        <div id="collapseThree" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    <!-- Reference Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('reference', 'Référence :') !!}
                        <p>{{ $dossiers->reference ? $dossiers->reference : '-' }}</p>
                    </div>

                    <!-- Transporteur Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('transporteur', __('models/dossiers.fields.transporteur') . ' :') !!}
                        <p>{{ $dossiers->transporteur ? $dossiers->transporteur : '-' }}</p>
                    </div>

                    <!-- Navire Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('navire', 'Navire :') !!}
                        <p>{{ $dossiers->navire ? $dossiers->navire : '-' }}</p>
                    </div>

                    <!-- Date Embarquement Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('date_embarquement', "Date d'embarquement :") !!}
                        <p>{{ $dossiers->date_embarquement ? $dossiers->date_embarquement->format('Y-m-d') : '-' }}</p>
                    </div>

                    <!-- Date Sortie Port Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('date_sortie_port', 'Date sortie de port :') !!}
                        <p>{{ $dossiers->date_sortie_port ? $dossiers->date_sortie_port->format('Y-m-d') : '-' }}</p>
                    </div>

                    <!-- Date Livraison Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('date_livraison', 'Date de livraison :') !!}
                        <p>{{ $dossiers->date_livraison ? $dossiers->date_livraison->format('Y-m-d') : '-' }}</p>
                    </div>

                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('transitairealg', 'Transitaire Alg :') !!}
                        <p>{{ $dossiers->transitairealg ? $dossiers->transitairealg : '-' }}</p>
                    </div>

                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('transitaire', 'Transitaire Tanger :') !!}
                        <p>{{ $dossiers->transitaire ? $dossiers->transitaire : '-' }}</p>
                    </div>

                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('date_courrier', 'Date de courrier :') !!}
                        <p>{{ $dossiers->date_courrier ? $dossiers->date_courrier->format('Y-m-d') : '-' }}</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('observation', 'Remarque :') !!}
                        <p>{{ $dossiers->observation ? $dossiers->observation : '-'}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#collapseFacturation" aria-expanded="true"
            style="cursor: pointer;">
            <span class="collapsed card-link">Infos Note de Débit</span>
            <span class="toggle-icon float-right"><i class="fas fa-chevron-down"></i></span>
        </div>
        <div id="collapseFacturation" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3 col-lg-3">
                        {!! Form::label('numnotedebit', 'N° Note de Débit :') !!}
                        @if (!$isEditMode)
                            {!! Form::text('numnotedebit', $nd, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                        @else
                            {!! Form::text('numnotedebit', null, ['class' => 'form-control']) !!}
                        @endif
                    </div>

                    <div class="form-group col-md-3 col-lg-3">
                        {!! Form::label('datenotationdebit', 'Date de Note de Débit :', ['class' => 'required']) !!}
                        {!! Form::date('datenotationdebit', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-3 col-lg-3">
                        {!! Form::label('mod_paiement', 'Mode de paiement :', ['class' => 'required']) !!}
                        {!! Form::select('mod_paiement', $modePaiment, null, [
                            'class' => 'form-control custom-select',
                        ]) !!}
                    </div>

                    <div class="form-group col-md-3 col-lg-3">
                        {!! Form::label('montantdebit', 'Montant à payer ( en EURO ) :', ['class' => 'required']) !!}
                        {!! Form::text('montantdebit', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('designation1', 'Désignation 1 :', ['class' => 'required']) !!}
                        {!! Form::text('designation1', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('notedebit1', 'A Noter de Débit 1:', ['class' => 'required']) !!}
                        {!! Form::text('notedebit1', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('designation2', 'Désignation 2 :') !!}
                        {!! Form::text('designation2', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('notedebit2', 'A Noter de Débit 2 :') !!}
                        {!! Form::text('notedebit2', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('designation3', 'Désignation 3 :') !!}
                        {!! Form::text('designation3', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('notedebit3', 'A Noter de Débit 3 :') !!}
                        {!! Form::text('notedebit3', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('designation4', 'Désignation 4 :') !!}
                        {!! Form::text('designation4', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('notedebit4', 'A Noter de Débit 4 :') !!}
                        {!! Form::text('notedebit4', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('designation5', 'Désignation 5 :') !!}
                        {!! Form::text('designation5', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 col-lg-6">
                        {!! Form::label('notedebit5', 'A Noter de Débit 5 :') !!}
                        {!! Form::text('notedebit5', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-4 col-lg-4">
                        {!! Form::label('a_paye', 'Devise sur la Note de débit :', ['class' => 'required']) !!}
                        {!! Form::select('a_paye', $a_payer, null, [
                            'class' => 'form-control custom-select',
                        ]) !!}
                    </div>

                    <div class="form-group col-md-4 col-lg-4">
                        {!! Form::label('description', __('models/noteDebitDossiers.fields.description') . ':') !!}
                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-4 col-lg-4">
                        {!! Form::label('a_estimer', 'Equivalent en Dirhams	:', ['class' => 'required']) !!}
                        {!! Form::text('a_estimer', null, ['class' => 'form-control']) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#accordion .collapse').on('show.bs.collapse', function() {
            $(this).prev('.card-header').find('.toggle-icon i')
                .removeClass('fa-chevron-down')
                .addClass('fa-chevron-up');
        });

        $('#accordion .collapse').on('hide.bs.collapse', function() {
            $(this).prev('.card-header').find('.toggle-icon i')
                .removeClass('fa-chevron-up')
                .addClass('fa-chevron-down');
        });
    });
</script>
