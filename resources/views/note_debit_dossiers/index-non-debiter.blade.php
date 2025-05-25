@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h4>Liste des dossiers non débiter</h4>
                </div>
            </div>

            <form method="GET" action="{{ route('index-non-debiter') }}">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-2 mb-1">
                                <label for="num">N° Dossier : </label>
                                <input type="text" class="form-control" id="num" name="num">
                            </div>
                            <div class="col-sm-2 mb-1">
                                <label for="client">Cilent : </label>
                                {!! Form::select('client', $clientsOptions, null, ['class' => 'form-control custom-select']) !!}
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
                @include('note_debit_dossiers.table-non-debiter')

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
        const matRemorqueParam = urlParams.get('mat_remorque');
        const matTracteurParam = urlParams.get('mat_tracteur');
        const referenceParam = urlParams.get('reference');
        const numFactureParam = urlParams.get('num_facture');
        const yearParam = urlParams.get('year');

        document.getElementById("num").value = numParam || '';
        document.getElementById("mat_remorque").value = matRemorqueParam || '';
        document.getElementById("mat_tracteur").value = matTracteurParam || '';
        document.getElementById("reference").value = referenceParam || '';
        document.getElementById("num_facture").value = numFactureParam || '';
        var yearSelect = document.getElementById("year");
        if (yearParam) {
            yearSelect.value = yearParam;
        }
    };
</script>
