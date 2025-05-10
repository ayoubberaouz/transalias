@extends('layouts.app')

@section('content')
    <div class="content-header ml-2">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4 class="m-0">Tableau de bord</h4>
                </div>
            </div>
        </div>
    </div>

    <section class="content m-2">
        <div class="container-fluid">
            <div class="row align-center">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-folder"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text"><h6>Nombre des Dossiers</h6></span>
                            <span class="info-box-number" style="font-size: 30px">
                                {{ $dashboardInfo['dossier_count'] }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1">
                            <i class="fas fa-file" style="color: white"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text"><h6>Nombre des Factures</h6></span>
                            <span class="info-box-number" style="font-size: 30px">
                                {{ $dashboardInfo['facture_count'] }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-file-alt"></i>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text"><h6>Nombre des Notes de débit</h6></span>
                            <span class="info-box-number" style="font-size: 30px">
                                {{ $dashboardInfo['note_count'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">                        
                        <div class="card-body">
                            <h6>Dossiers ({{ date('Y') }})</h6>

                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Factures ({{ date('Y') }})</h6>

                            <canvas id="myChart1"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-md-6">  
                    <div class="card">
                        <div class="card-body">
                            <h6>Notes de débit ({{ date('Y') }})</h6>

                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('third_party_scripts')
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
        integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush

@push('page_scripts')
    <script>
        var userCheckinChart = new Chart(document.getElementById('userCheckinChart').getContext('2d'),
            @json($chartUserCheckin));
    </script>

    <script>
        // Chart Dossiers
        const ctx = document.getElementById('myChart');
        const newDossiers = {!! $dashboardInfo['newDossiers'] !!};
        const closedDossiers = {!! $dashboardInfo['closedDossiers'] !!};

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
                    'Octobre', 'Novembre', 'Décembre'
                ],
                datasets: [{
                        label: 'Nouveau',
                        data: newDossiers,
                        borderWidth: 1,
                        backgroundColor: [
                            '#75b000',
                        ],
                    },
                    {
                        label: 'Clôturé',
                        data: closedDossiers,
                        borderWidth: 1,
                        backgroundColor: [
                            '#9BD0F5',
                        ],
                    },
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Chart Factures
        const ctx1 = document.getElementById('myChart1');
        const paidFactures = {!! $dashboardInfo['paidFactures'] !!};
        const unpaidFactures = {!! $dashboardInfo['unpaidFactures'] !!};

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
                    'Octobre', 'Novembre', 'Décembre'
                ],
                datasets: [{
                        label: 'Payée',
                        data: paidFactures,
                        borderWidth: 1,
                        backgroundColor: [
                            '#75b000',
                        ],
                    },
                    {
                        label: 'Non Payée',
                        data: unpaidFactures,
                        borderWidth: 1,
                        backgroundColor: [
                            '#9BD0F5',
                        ],
                    },
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Chart Notes de débit
        const ctx2 = document.getElementById('myChart2');
        const paidNotesDebit = {!! $dashboardInfo['paidNotesDebit'] !!};
        const unpaidNotesDebit = {!! $dashboardInfo['unpaidNotesDebit'] !!};

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre',
                    'Octobre', 'Novembre', 'Décembre'
                ],
                datasets: [{
                        label: 'Payée',
                        data: paidNotesDebit,
                        borderWidth: 1,
                        backgroundColor: [
                            '#75b000',
                        ],
                    },
                    {
                        label: 'Non Payée',
                        data: unpaidNotesDebit,
                        borderWidth: 1,
                        backgroundColor: [
                            '#9BD0F5',
                        ],
                    },
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
