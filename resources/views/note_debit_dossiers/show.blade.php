@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Détails Note Débit</h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @include('note_debit_dossiers.show_fields')
                </div>
                <div class="card-footer float-right">
                    <a class="btn btn-default " href="{{ route('noteDebitDossiers.index') }}">
                        <i class="fas fa-undo-alt"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
