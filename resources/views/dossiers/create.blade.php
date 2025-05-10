@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        Nouveau Dossier
                    </h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @include('adminlte-templates::common.errors')

        <div class="card">
            {!! Form::open(['route' => 'dossiers.store', 'id' => 'formStoreDossier']) !!}

            <div class="card-body">
                <div class="row">
                    @include('dossiers.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Créer', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('dossiers.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                </a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection