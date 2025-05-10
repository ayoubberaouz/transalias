<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/anneedossiers.fields.id').':') !!}
    <p>{{ $anneedossier->id }}</p>
</div>

<!-- Iddossier Field -->
<div class="col-sm-12">
    {!! Form::label('iddossier', __('models/anneedossiers.fields.iddossier').':') !!}
    <p>{{ $anneedossier->iddossier }}</p>
</div>

<!-- Annee Dossier Field -->
<div class="col-sm-12">
    {!! Form::label('annee_dossier', __('models/anneedossiers.fields.annee_dossier').':') !!}
    <p>{{ $anneedossier->annee_dossier }}</p>
</div>

<!-- Annee Field -->
<div class="col-sm-12">
    {!! Form::label('annee', __('models/anneedossiers.fields.annee').':') !!}
    <p>{{ $anneedossier->annee }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/anneedossiers.fields.created_at').':') !!}
    <p>{{ $anneedossier->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/anneedossiers.fields.updated_at').':') !!}
    <p>{{ $anneedossier->updated_at }}</p>
</div>

