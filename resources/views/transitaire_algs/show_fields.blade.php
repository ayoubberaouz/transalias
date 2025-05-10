<!-- Nom Field -->
<div class="col-sm-4">
    {!! Form::label('nom', __('models/transitaireAlgs.fields.nom').' :') !!}
    <p>{{ $transitaireAlg->nom }}</p>
</div>

<!-- Tel Field -->
<div class="col-sm-4">
    {!! Form::label('tel', 'Téléphone :') !!}
    <p>{{ $transitaireAlg->tel }}</p>
</div>

<!-- Fax Field -->
<div class="col-sm-4">
    {!! Form::label('fax', __('models/transitaireAlgs.fields.fax').' :') !!}
    <p>{{ $transitaireAlg->fax }}</p>
</div>

<!-- Gsm Field -->
<div class="col-sm-4">
    {!! Form::label('gsm', __('models/transitaireAlgs.fields.gsm').' :') !!}
    <p>{{ $transitaireAlg->gsm }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-4">
    {!! Form::label('email', __('models/transitaireAlgs.fields.email').' :') !!}
    <p>{{ $transitaireAlg->email }}</p>
</div>

<!-- Adresse Field -->
<div class="col-sm-4">
    {!! Form::label('adresse', __('models/transitaireAlgs.fields.adresse').' :') !!}
    <p>{{ $transitaireAlg->adresse }}</p>
</div>

<!-- Ville Field -->
<div class="col-sm-4">
    {!! Form::label('ville', __('models/transitaireAlgs.fields.ville').' :') !!}
    <p>{{ $transitaireAlg->ville }}</p>
</div>

<!-- Ncompte Field -->
<div class="col-sm-4">
    {!! Form::label('Ncompte', 'Numéro de Compte :') !!}
    <p>{{ $transitaireAlg->Ncompte }}</p>
</div>
