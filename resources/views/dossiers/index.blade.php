@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mb-1">
                    <h4>Liste des dossiers</h4>
                </div>
                <div class="col-md-4 mb-1">
                    <a class="btn btn-success float-right" href="{{ route('dossiers.create') }}">
                        <i class="fas fa-plus"></i>
                        Ajouter un dossier
                    </a>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('export-dossiers') }}">
                        <div class="row">
                            <div class="col-md-4 mt-2 text-right">
                                <label for="client">Date Dossiers : </label>
                            </div>
                            <div class="col-md-4 mb-2">
                                <select class="form-control custom-select" name="year-export" id="year-export">
                                    @foreach ($years as $year)
                                        <option value={{ $year }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class='btn btn-success text-white float-right'>
                                    <i class="far fa-file-excel"></i> Exporter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <form method="GET" action="{{ route('dossiers.index') }}">
                <div class="row">
                    <div class="col-sm-2 mb-1">
                        <label for="client">Date Dossier : </label>
                        <select class="form-control custom-select" name="year" id="year">
                            @foreach ($years as $year)
                                <option value={{ $year }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2 mb-1">
                        <label for="client">Cilent : </label>
                        {!! Form::select('client', $clientsOptions, null, ['class' => 'form-control custom-select']) !!}
                    </div>
                    <div class="col-sm-1 mb-1">
                        <label for="num">N° Dossier : </label>
                        <input type="text" class="form-control" id="num" name="num">
                    </div>
                    <div class="col-sm-2 mb-1">
                        <label for="reference">Référence : </label>
                        <input type="text" class="form-control" id="reference" name="reference">
                    </div>
                    <div class="col-sm-2 mb-1">
                        <label for="transporteur">Transporteur : </label>
                        <input type="text" class="form-control" id="transporteur" name="transporteur">
                    </div>
                    <div class="col-sm-2 mb-1">
                        <label for="mat_remorque">Matricule Remorque : </label>
                        <input type="text" class="form-control" id="mat_remorque" name="mat_remorque">
                    </div>
                    <div class="col-sm-2 mb-1">
                        <label for="mat_tracteur">Matricule Tracteur : </label>
                        <input type="text" class="form-control" id="mat_tracteur" name="mat_tracteur">
                    </div>
                    <div class="col-sm-1 mb-1" style="margin-top: 2rem">
                        <button type="submit" class="btn btn-default" style="height: 38px"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('dossiers.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $dossiers])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const numParam = urlParams.get('num');
        const referenceParam = urlParams.get('reference');
        const transporteurParam = urlParams.get('transporteur');
        const matRemorqueParam = urlParams.get('mat_remorque');
        const matTracteurParam = urlParams.get('mat_tracteur');

        const yearParam = urlParams.get('year');

        document.getElementById("num").value = numParam || '';
        document.getElementById("reference").value = referenceParam || '';
        document.getElementById("transporteur").value = transporteurParam || '';
        document.getElementById("mat_remorque").value = matRemorqueParam || '';
        document.getElementById("mat_tracteur").value = matTracteurParam || '';

        var yearSelect = document.getElementById("year");
        if (yearParam) {
            yearSelect.value = yearParam;
        }
    };
</script>
