<!-- Iddossier Field -->
<div class="form-group col-sm-6">
    {!! Form::label('iddossier', __('models/anneedossiers.fields.iddossier').':') !!}
    {!! Form::text('iddossier', null, ['class' => 'form-control']) !!}
</div>

<!-- Annee Dossier Field -->
<div class="form-group col-sm-6">
    {!! Form::label('annee_dossier', __('models/anneedossiers.fields.annee_dossier').':') !!}
    {!! Form::text('annee_dossier', null, ['class' => 'form-control']) !!}
</div>

<!-- Annee Field -->
<div class="form-group col-sm-6">
    {!! Form::label('annee', __('models/anneedossiers.fields.annee').':') !!}
    {!! Form::text('annee', null, ['class' => 'form-control']) !!}
</div>