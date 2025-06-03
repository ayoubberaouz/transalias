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
    <p>{{ $dossiers->date_charg->format('Y-m-d') }}</p>
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

<!-- Date Courrier Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('date_courrier', 'Date de courrier :') !!}
    <p>{{ $dossiers->date_courrier ? $dossiers->date_courrier->format('Y-m-d') : '-' }}</p>
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

@if (isset($facturesDossier->id))
    <!-- Numfacturation Field -->
    <div class="form-group col-md-4 col-lg-4">
        {!! Form::label('numFacturation', 'N° Facture :') !!}
        <p>{{ $facturesDossier->numFacturation }}</p>
    </div>
@endif

<!-- Datefacturation Field -->
<div class="form-group col-md-4 col-lg-4">
    {!! Form::label('dateFacturation', 'Date de la facture :') !!}
    <p>{{ $facturesDossier->dateFacturation->format('Y-m-d') }}</p>
</div>

<!-- Mod Paiement Field -->
<div class="form-group col-md-4 col-lg-4">
    {!! Form::label('mod_paiement', 'Mode de paiement :') !!}
    <p>{{ $facturesDossier->mod_paiement }}</p>
</div>

<!-- Designation1 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('designation1', 'Désignation 1 :') !!}
    <p>{{ $facturesDossier->designation1 }}</p>
</div>

<!-- Facturer1 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('facturer1', 'A Facturer 1 :') !!}
    <p>{{ $facturesDossier->facturer1 }}</p>
</div>

<!-- Designation2 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('designation2', 'Désignation 2 :') !!}
    <p>{{ $facturesDossier->designation2 }}</p>
</div>

<!-- Facturer2 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('facturer2', 'A Facturer 2 :') !!}
    <p>{{ $facturesDossier->facturer2 }}</p>
</div>

<!-- Designation3 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('designation3', 'Désignation 3 :') !!}
    <p>{{ $facturesDossier->designation3 }}</p>
</div>

<!-- Facturer3 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('facturer3', 'A Facturer 3 :') !!}
    <p>{{ $facturesDossier->facturer3 }}</p>
</div>

<!-- Designation4 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('designation4', 'Désignation 4 :') !!}
    <p>{{ $facturesDossier->designation4 }}</p>
</div>

<!-- Facturer4 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('facturer4', 'A Facturer 4 :') !!}
    <p>{{ $facturesDossier->facturer4 }}</p>
</div>

<!-- Designation5 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('designation5', 'Désignation 5 :') !!}
    <p>{{ $facturesDossier->designation5 }}</p>
</div>

<!-- Facturer5 Field -->
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('facturer5', 'A Facturer 5 :') !!}
    <p>{{ $facturesDossier->facturer5 }}</p>
</div>

<!-- A Paye Field -->
<div class="form-group col-md-4 col-lg-4">
    {!! Form::label('a_paye', 'Devise sur la facture :') !!}
    <p>{{ $facturesDossier->a_paye }}</p>
</div>

<!-- Description Field -->
<div class="form-group col-md-4 col-lg-4">
    {!! Form::label('description', __('models/facturesDossiers.fields.description') . ' :') !!}
    <p>{{ $facturesDossier->description }}</p>
</div>

<!-- A Estimer Field -->
<div class="form-group col-md-4 col-lg-4">
    {!! Form::label('a_estimer', 'Equivalent en Dirhams	 :') !!}
    <p>{{ $facturesDossier->a_estimer }}</p>
</div>
