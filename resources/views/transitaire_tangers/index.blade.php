@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Liste des transitaires tanger</h4>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-success float-right"
                       href="{{ route('transitaireTangers.create') }}">
                       <i class="fas fa-plus"></i>
                        Ajouter un transitaire tanger 
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form method="GET" action="{{ route('transitaireTangers.index') }}">
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
                @include('transitaire_tangers.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $transitaireTangers])
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
