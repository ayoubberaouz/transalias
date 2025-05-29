@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-5">
                    <h4>Liste des factures</h4>
                </div>
                <div class="col-md-7">
                    <form method="GET" action="{{ route('export-factures') }}">
                        <div class="row">
                            <div class="col-md-2 mt-2 text-right">
                                <label for="client">Société : </label>
                            </div>
                            <div class="col-md-3 mb-2">
                                <select class="form-control custom-select" name="societe-export" id="societe-export">
                                    <option value="1">Transalias</option>
                                    <option value="2">Akbar Services</option>
                                    <option value="3">Inter Global Africa</option>
                                </select>
                            </div>
                            <div class="col-md-2 mt-2 text-right">
                                <label for="year-export">Date Factures : </label>
                            </div>
                            <div class="col-md-2 mb-2">
                                <select class="form-control custom-select" name="year-export" id="year-export">
                                    @foreach ($years as $year)
                                        <option value={{ $year }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class='btn btn-success text-white float-right'>
                                    <i class="far fa-file-excel"></i> Exporter
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <form method="GET" action="{{ route('facturesDossiers.index') }}">
                <div class="row mb-2">
                    <div class="col-md-2">
                        <label for="societe">Société : </label>
                        <select class="form-control custom-select" name="societe" id="societe">
                            <option value="1">Transalias</option>
                            <option value="2">Akbar Services</option>
                            <option value="3">Inter Global Africa</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="year">Date Facture : </label>
                        <select class="form-control custom-select" name="year" id="year">
                            @foreach ($years as $year)
                                <option value={{ $year }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2" style="margin-top: 2rem">
                        <button type="submit" class="btn btn-default" style="height: 38px"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 m-3">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1">Recherche Avancé</label>
                        </div>
                    </div>
                </div>

                <div class="row" id="advancedSearch" style="display: none;">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-2 mb-1">
                                <label for="num_facture">N° Facture : </label>
                                <input type="text" class="form-control" id="num_facture" name="num_facture">
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="num">N° Dossier : </label>
                                <input type="text" class="form-control" id="num" name="num">
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="client">Cilent : </label>
                                {!! Form::select('client', $clientsOptions, null, ['class' => 'form-control custom-select']) !!}
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="mat_remorque">Matricule Remorque : </label>
                                <input type="text" class="form-control" id="mat_remorque" name="mat_remorque">
                            </div>
                            <div class="col-md-2 mb-1">
                                <label for="mat_tracteur">Matricule Tracteur : </label>
                                <input type="text" class="form-control" id="mat_tracteur" name="mat_tracteur">
                            </div>
                        </div>
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
                @include('factures_dossiers.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">
                        @include('adminlte-templates::common.paginate', ['records' => $facturesDossiers])
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
        const numFactureParam = urlParams.get('num_facture');
        const matRemorqueParam = urlParams.get('mat_remorque');
        const matTracteurParam = urlParams.get('mat_tracteur');
        
        const yearParam = urlParams.get('year');
        const societeParam = urlParams.get('societe');

        document.getElementById("num").value = numParam || '';
        document.getElementById("num_facture").value = numFactureParam || '';
        document.getElementById("mat_remorque").value = matRemorqueParam || '';
        document.getElementById("mat_tracteur").value = matTracteurParam || '';

        if (yearParam) {
            document.getElementById("year").value = yearParam;
        }
        if (societeParam) {
            document.getElementById("societe").value = societeParam;
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('customSwitch1');
        const advancedSearchDiv = document.getElementById('advancedSearch');

        toggle.addEventListener('change', function() {
            advancedSearchDiv.style.display = this.checked ? 'block' : 'none';
        });
    });
</script>
