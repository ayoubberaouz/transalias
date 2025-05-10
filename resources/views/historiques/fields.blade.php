<!-- Taches Field -->
<div class="form-group col-sm-6">
    {!! Form::label('taches', __('models/historiques.fields.taches').':') !!}
    {!! Form::text('taches', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', __('models/historiques.fields.date').':') !!}
    {!! Form::text('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Ref Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ref', __('models/historiques.fields.ref').':') !!}
    {!! Form::text('ref', null, ['class' => 'form-control']) !!}
</div>

<!-- User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user', __('models/historiques.fields.user').':') !!}
    {!! Form::text('user', null, ['class' => 'form-control']) !!}
</div>