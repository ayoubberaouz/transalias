<!-- Nom Field -->
<div class="col-sm-4">
    {!! Form::label('nom', __('models/transporteurs.fields.nom') . ' :') !!}
    <p>{{ $transporteur->nom }}</p>
</div>

<!-- Tel Field -->
<div class="col-sm-4">
    {!! Form::label('tel', 'Téléphone :') !!}
    <p>{{ $transporteur->tel }}</p>
</div>

<!-- Fax Field -->
<div class="col-sm-4">
    {!! Form::label('fax', __('models/transporteurs.fields.fax') . ' :') !!}
    <p>{{ $transporteur->fax }}</p>
</div>

<!-- Gsm Field -->
<div class="col-sm-4">
    {!! Form::label('gsm', __('models/transporteurs.fields.gsm') . ' :') !!}
    <p>{{ $transporteur->gsm }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-4">
    {!! Form::label('email', __('models/transporteurs.fields.email') . ' :') !!}
    <p>{{ $transporteur->email }}</p>
</div>

<!-- Adresse Field -->
<div class="col-sm-4">
    {!! Form::label('adresse', __('models/transporteurs.fields.adresse') . ' :') !!}
    <p>{{ $transporteur->adresse }}</p>
</div>

<!-- Ville Field -->
<div class="col-sm-4">
    {!! Form::label('ville', __('models/transporteurs.fields.ville') . ' :') !!}
    <p>{{ $transporteur->ville }}</p>
</div>

<!-- Ncompte Field -->
<div class="col-sm-4">
    {!! Form::label('Ncompte', 'N° Compte :') !!}
    <p>{{ $transporteur->Ncompte }}</p>
</div>
