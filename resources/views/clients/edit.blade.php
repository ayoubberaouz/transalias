@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-sm-12">
                    <h4>
                        Modifier un client
                    </h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($clients, ['route' => ['clients.update', $clients->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('clients.fields')
                </div>
            </div>

            <div class="card-footer float-right">
                {!! Form::button('<i class="far fa-save"></i> Enregistrer', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('clients.index') }}" class="btn btn-default">
                   <i class="fas fa-undo-alt"></i>
                    Retour
                </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
