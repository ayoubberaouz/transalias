<!-- Nom Field -->
<div class="form-group col-md-4">
    {!! Form::label('nom', 'Nom :') !!}
    {!! Form::text('nom', null, ['class' => 'form-control']) !!}
</div>

<!-- Raison Social Field -->
<div class="form-group col-md-4">
    {!! Form::label('raison_social', 'Nom du contact :') !!}
    {!! Form::text('raison_social', null, ['class' => 'form-control']) !!}
</div>

<!-- Referenc Field -->
<div class="form-group col-md-4">
    {!! Form::label('referenc', 'Référence :') !!}
    {!! Form::text('referenc', null, ['class' => 'form-control']) !!}
</div>

<!-- Tel Field -->
<div class="form-group col-md-4">
    {!! Form::label('tel', 'Téléphone :') !!}
    {!! Form::text('tel', null, ['class' => 'form-control']) !!}
</div>

<!-- Fax Field -->
<div class="form-group col-md-4">
    {!! Form::label('fax', __('models/clients.fields.fax') . ' :') !!}
    {!! Form::text('fax', null, ['class' => 'form-control']) !!}
</div>

<!-- Gsm Field -->
<div class="form-group col-md-4">
    {!! Form::label('gsm', __('models/clients.fields.gsm') . ' :') !!}
    {!! Form::text('gsm', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-md-4">
    {!! Form::label('email', __('models/clients.fields.email') . ' :') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Adresse Field -->
<div class="form-group col-md-8">
    {!! Form::label('adresse', __('models/clients.fields.adresse') . ' :') !!}
    {!! Form::text('adresse', null, ['class' => 'form-control']) !!}
</div>

<!-- Ville Field -->
<div class="form-group col-md-4">
    {!! Form::label('ville', __('models/clients.fields.ville') . ' :') !!}
    {!! Form::text('ville', null, ['class' => 'form-control']) !!}
</div>

<!-- Ncompte Field -->
<div class="form-group col-md-4">
    {!! Form::label('nCompte', 'N° Compte :') !!}
    {!! Form::text('nCompte', null, ['class' => 'form-control']) !!}
</div>

<!-- Societe Field -->
<div class="form-group col-md-4">
    {!! Form::label('societe', 'Société :') !!}
    {!! Form::select('societe', ['1' => 'Transalias', '2' => 'Akbar Services', '3' => 'Inter Global Africa'], null, [
        'class' => 'form-control custom-select',
    ]) !!}
</div>
