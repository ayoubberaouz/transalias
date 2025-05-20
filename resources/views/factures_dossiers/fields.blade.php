<div class="col-md-12" style="text-align: center;">
    <div class="alert" role="alert" style="background-color: #92c546; color: white">
        <h4>Infos Voyage</h4>
    </div>
</div>

<!-- Société Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('societe', 'Societe :') !!}
    <p>
        @if ($dossiers->clients->societe == 1)
            Transalias
        @elseif($dossiers->clients->societe == 2)
            Akbar Services
        @elseif($dossiers->clients->societe == 3)
            Inter Global Africa
        @else
            -
        @endif
    </p>
</div>

<!-- Client Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('client', __('models/dossiers.fields.client') . ' :') !!}
    <p>{{ $dossiers->clients->nom }}</p>
</div>

<!-- Mat Tracteur Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('mat_tracteur', 'Matricule du tracteur :') !!}
    <p>{{ $dossiers->mat_tracteur }}</p>
</div>

<!-- Mat Remorque Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('mat_remorque', 'Matricule du remorque :') !!}
    <p>{{ $dossiers->mat_remorque }}</p>
</div>

<div class="col-md-12" style="text-align: center;">
    <div class="alert" role="alert" style="background-color: #92c546; color: white">
        <h4>Trajet Voyage</h4>
    </div>
</div>

<!-- Date Charg Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('date_charg', 'Date de chargement :') !!}
    <p>{{ $dossiers->date_charg }}</p>
</div>

<!-- Lien Chargement Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('lien_chargement', 'Lieu de chargement :') !!}
    <p>{{ $dossiers->lien_chargement }}</p>
</div>

<!-- Expediteur Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('expediteur', 'Expéditeur :') !!}
    <p>{{ $dossiers->expediteur }}</p>
</div>

<!-- Lieu Livraison Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('lieu_livraison', 'Lieu de livraison :') !!}
    <p>{{ $dossiers->lieu_livraison }}</p>
</div>

<!-- Destination Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('destinsation', 'Destinateur :') !!}
    <p>{{ $dossiers->destinsation }}</p>
</div>

<div class="col-md-12" style="text-align: center;">
    <div class="alert" role="alert" style="background-color: #92c546; color: white">
        <h4>Infos Complémentaire</h4>
    </div>
</div>

<!-- Reference Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('reference', 'Référence :') !!}
    <p>{{ $dossiers->reference }}</p>
</div>

<!-- Navire Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('navire', 'Navire :') !!}
    <p>{{ $dossiers->navire }}</p>
</div>

<!-- Transporteur Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('transporteur', __('models/dossiers.fields.transporteur') . ' :') !!}
    <p>{{ $dossiers->transporteur }}</p>
</div>

<!-- Transitaire Tanger Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('transitaire', 'Transitaire Tanger :') !!}
    <p>{{ $dossiers->transitaire }}</p>
</div>

<!-- Transitaire ALG Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('transitairealg', 'Transitaire Alg :') !!}
    <p>{{ $dossiers->transitairealg }}</p>
</div>

<!-- Date Embarquement Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('date_embarquement', "Date d'embarquement :") !!}
    <p>{{ $dossiers->date_embarquement }}</p>
</div>

<!-- Date Sortie Port Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('date_sortie_port', 'Date sortie de port :') !!}
    <p>{{ $dossiers->date_sortie_port }}</p>
</div>

<!-- Date Livraison Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('date_livraison', 'Date de livraison :') !!}
    <p>{{ $dossiers->date_livraison }}</p>
</div>

<!-- Date Courrier Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('date_courrier', 'Date de courrier :') !!}
    <p>{{ $dossiers->date_courrier }}</p>
</div>

<!-- Remarque Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('observation', 'Remarque :') !!}
    <p>{{ $dossiers->observation }}</p>
</div>

<div class="form-group col-md-12" style="text-align: center;">
    <div class="alert" role="alert" style="background-color: #92c546; color: white">
        <h4>Infos Facturation</h4>
    </div>
</div>

<!-- Numfacturation Field -->
<div class="form-group col-md-4 col-lg-4">
    {!! Form::label('numFacturation', 'N° Facture :') !!}
    @if(!$isEditMode)
        {!! Form::text('numFacturation', null, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
    @else
        {!! Form::text('numFacturation', null, ['class' => 'form-control']) !!}
    @endif
</div>

<!-- Datefacturation Field -->
<div class="form-group col-md-4 col-lg-4">
    {!! Form::label('dateFacturation', 'Date de la facture :') !!}
    {!! Form::date('dateFacturation', null, ['class' => 'form-control']) !!}
</div>

<!-- Mod Paiement Field -->
<div class="form-group col-md-4 col-lg-4">
    {!! Form::label('mod_paiement', 'Mode de paiement :') !!}
    {!! Form::select('mod_paiement', $modePaiment, null, [
        'class' => 'form-control custom-select',
    ]) !!}
</div>

<!-- Designation1 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('designation1', 'Designation 1 :') !!}
    {!! Form::text('designation1', null, ['class' => 'form-control']) !!}
</div>

<!-- Facturer1 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('facturer1', 'A Facturer 1 :') !!}
    {!! Form::text('facturer1', null, ['class' => 'form-control']) !!}
</div>

<!-- Designation2 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('designation2', 'Designation 2 :') !!}
    {!! Form::text('designation2', null, ['class' => 'form-control']) !!}
</div>

<!-- Facturer2 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('facturer2', 'A Facturer 2 :') !!}
    {!! Form::text('facturer2', null, ['class' => 'form-control']) !!}
</div>

<!-- Designation3 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('designation3', 'Designation 3 :') !!}
    {!! Form::text('designation3', null, ['class' => 'form-control']) !!}
</div>

<!-- Facturer3 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('facturer3', 'A Facturer 3 :') !!}
    {!! Form::text('facturer3', null, ['class' => 'form-control']) !!}
</div>

<!-- Designation4 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('designation4', 'Designation 4 :') !!}
    {!! Form::text('designation4', null, ['class' => 'form-control']) !!}
</div>

<!-- Facturer4 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('facturer4', 'A Facturer 4 :') !!}
    {!! Form::text('facturer4', null, ['class' => 'form-control']) !!}
</div>

<!-- Designation5 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('designation5', 'Designation 5 :') !!}
    {!! Form::text('designation5', null, ['class' => 'form-control']) !!}
</div>

<!-- Facturer5 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('facturer5', 'A Facturer 5 :') !!}
    {!! Form::text('facturer5', null, ['class' => 'form-control']) !!}
</div>

<!-- A Paye Field -->
<div class="form-group col-md-4 col-lg-4">
    {!! Form::label('a_paye', 'Devise sur la facture :') !!}
    {!! Form::select('a_paye', $a_payer, null, [
        'class' => 'form-control custom-select',
    ]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-md-4 col-lg-4">
    {!! Form::label('description', __('models/facturesDossiers.fields.description') . ' :') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- A Estimer Field -->
<div class="form-group col-md-4 col-lg-4">
    {!! Form::label('a_estimer', 'Equivalent en Dirhams	 :') !!}
    {!! Form::text('a_estimer', null, ['class' => 'form-control']) !!}
</div>
