@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Liste des transitaires algs</h4>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
                       href="{{ route('transitaireAlgs.create') }}">
                         @lang('crud.add_new')
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form method="GET" action="{{ route('transitaireAlgs.index') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="nom">Nom : </label>
                                <input type="text" class="form-control" id="nom" name="nom">
                            </div>
                            <div class="col-md-1" style="margin-top: 2rem">
                                <button type="submit" class="btn btn-default" style="height: 38px"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('transitaire_algs.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $transitaireAlgs])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const nomParam = urlParams.get('nom');
        document.getElementById("nom").value = nomParam || '';
    };
</script>
