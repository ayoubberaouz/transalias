@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h4>
                        Ajouter un dossier
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

            <div class="card-footer float-right">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('dossiers.index') }}" class="btn btn-default">
                    <i class="fas fa-undo-alt"></i>
                    Retour
                </a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection