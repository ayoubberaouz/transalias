@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 mb-1">
                    <h4>Liste des dossiers validé</h4>
                </div>
            </div>

            <form method="GET" action="{{ route('index-valide') }}">
                <div class="row">
                    <div class="col-sm-2 mb-1">
                        <label for="client">Date Dossier : </label>
                        <select class="form-control custom-select" name="year" id="year">
                            @foreach ($years as $year)
                                <option value={{ $year }}>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="col-sm-2 mb-1">
                        <label for="num">N° Dossier : </label>
                        <input type="text" class="form-control" id="num" name="num">
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
                @include('dossiers.table-valide')

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
        const yearParam = urlParams.get('year');

        document.getElementById("num").value = numParam || '';
        var yearSelect = document.getElementById("year");
        if (yearParam) {
            yearSelect.value = yearParam;
        }
    };
</script>
