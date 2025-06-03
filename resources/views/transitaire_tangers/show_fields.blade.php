<!-- Nom Field -->
<div class="col-sm-3">
    {!! Form::label('nom', __('models/transitaireTangers.fields.nom') . ' :') !!}
    <p>{{ $transitaireTanger->nom }}</p>
</div>

<!-- Tel Field -->
<div class="col-sm-3">
    {!! Form::label('tel', 'Téléphone :') !!}
    <p>{{ $transitaireTanger->tel }}</p>
</div>

<!-- Fax Field -->
<div class="col-sm-3">
    {!! Form::label('fax', __('models/transitaireTangers.fields.fax') . ' :') !!}
    <p>{{ $transitaireTanger->fax ? $transitaireTanger->fax : '-' }}</p>
</div>

<!-- Gsm Field -->
<div class="col-sm-3">
    {!! Form::label('gsm', __('models/transitaireTangers.fields.gsm') . ' :') !!}
    <p>{{ $transitaireTanger->gsm ? $transitaireTanger->gsm : '-' }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-3">
    {!! Form::label('email', __('models/transitaireTangers.fields.email') . ' :') !!}
    <p>{{ $transitaireTanger->email ? $transitaireTanger->email : '-' }}</p>
</div>

<!-- Adresse Field -->
<div class="col-sm-3">
    {!! Form::label('adresse', __('models/transitaireTangers.fields.adresse') . ' :') !!}
    <p>{{ $transitaireTanger->adresse ? $transitaireTanger->adresse : '-' }}</p>
</div>

<!-- Ville Field -->
<div class="col-sm-3">
    {!! Form::label('ville', __('models/transitaireTangers.fields.ville') . ' :') !!}
    <p>{{ $transitaireTanger->ville }}</p>
</div>

<!-- Ncompte Field -->
<div class="col-sm-3">
    {!! Form::label('Ncompte', 'N° Compte :') !!}
    <p>{{ $transitaireTanger->Ncompte ? $transitaireTanger->Ncompte : '-' }}</p>
</div>
