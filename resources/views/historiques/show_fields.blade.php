<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/historiques.fields.id').':') !!}
    <p>{{ $historique->id }}</p>
</div>

<!-- Taches Field -->
<div class="col-sm-12">
    {!! Form::label('taches', __('models/historiques.fields.taches').':') !!}
    <p>{{ $historique->taches }}</p>
</div>

<!-- Date Field -->
<div class="col-sm-12">
    {!! Form::label('date', __('models/historiques.fields.date').':') !!}
    <p>{{ $historique->date }}</p>
</div>

<!-- Ref Field -->
<div class="col-sm-12">
    {!! Form::label('ref', __('models/historiques.fields.ref').':') !!}
    <p>{{ $historique->ref }}</p>
</div>

<!-- User Field -->
<div class="col-sm-12">
    {!! Form::label('user', __('models/historiques.fields.user').':') !!}
    <p>{{ $historique->user }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/historiques.fields.created_at').':') !!}
    <p>{{ $historique->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/historiques.fields.updated_at').':') !!}
    <p>{{ $historique->updated_at }}</p>
</div>

