@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>
                        Validé Dossier
                    </h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            {!! Form::open(['route' => ['dossiers.update-validation', $dossiers->id], 'method' => 'PUT']) !!}

            <div class="card-body">
                <div class="row">
                    @include('dossiers.show_valide_fields')
                </div>
            </div>

            <div class="card-footer float-right">
                {!! Form::button('<i class="fas fa-check"></i> Valider', ['type' => 'submit', 'class' => 'btn btn-success']) !!}
                <a href="{{ route('index-valide') }}" class="btn btn-default">
                    <i class="fas fa-undo-alt"></i>
                    Retour
                </a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection
