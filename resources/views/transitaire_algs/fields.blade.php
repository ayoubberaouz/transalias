<!-- Nom Field -->
<div class="form-group col-sm-4">
    {!! Form::label('nom', __('models/transitaireAlgs.fields.nom') . ' :') !!}
    {!! Form::text('nom', null, ['class' => 'form-control']) !!}
</div>

<!-- Tel Field -->
<div class="form-group col-sm-4">
    {!! Form::label('tel', 'Téléphone :') !!}
    {!! Form::text('tel', null, ['class' => 'form-control']) !!}
</div>

<!-- Fax Field -->
<div class="form-group col-sm-4">
    {!! Form::label('fax', __('models/transitaireAlgs.fields.fax') . ' :') !!}
    {!! Form::text('fax', null, ['class' => 'form-control']) !!}
</div>

<!-- Gsm Field -->
<div class="form-group col-sm-4">
    {!! Form::label('gsm', __('models/transitaireAlgs.fields.gsm') . ' :') !!}
    {!! Form::text('gsm', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email', __('models/transitaireAlgs.fields.email') . ' :') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Ville Field -->
<div class="form-group col-sm-4">
    {!! Form::label('ville', __('models/transporteurs.fields.ville') . ' :') !!}
    {!! Form::text('ville', null, ['class' => 'form-control']) !!}
</div>

<!-- Adresse Field -->
<div class="form-group col-sm-8">
    {!! Form::label('adresse', __('models/transitaireAlgs.fields.adresse') . ' :') !!}
    {!! Form::text('adresse', null, ['class' => 'form-control']) !!}
</div>

<!-- Ncompte Field -->
<div class="form-group col-sm-4">
    {!! Form::label('Ncompte', 'N° Compte :') !!}
    {!! Form::text('Ncompte', null, ['class' => 'form-control']) !!}
</div>
