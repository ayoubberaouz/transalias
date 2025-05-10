@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        Mise à Jour Transporteur
                    </h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($transporteur, ['route' => ['transporteurs.update', $transporteur->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('transporteurs.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Modifier', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('transporteurs.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
