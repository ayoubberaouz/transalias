@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h4>Modifier un rôle</h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch']) !!}

            <div class="card-body">
                <div class="row">
                    @include('roles.fields')
                </div>
            </div>

            <div class="card-footer float-right">
                {!! Form::submit('Enregistrer', ['class' => 'btn btn-success']) !!}
                <a href="{{ route('roles.index') }}" class="btn btn-default">
                    <i class="fas fa-undo-alt"></i>
                    Retour</a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
