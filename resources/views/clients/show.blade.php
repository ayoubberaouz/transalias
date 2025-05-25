@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Détails d'un client </h4>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right" href="{{ route('clients.index') }}">
                        <i class="fas fa-undo-alt"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('clients.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
