<div id="accordion">
    <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            style="cursor: pointer;">
            <span>Infos Voyage</span>
            <span class="toggle-icon float-right"><i class="fas fa-chevron-down"></i></span>
        </div>
        <div id="collapseOne" class="collapse show" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    <!-- Société Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('societe', 'Societe :') !!}
                        <p>
                            @if ($dossiers->clients ? $dossiers->clients->societe == 1 : '-')
                                Transalias
                            @elseif($dossiers->clients ? $dossiers->clients->societe == 2 : '-')
                                Akbar Services
                            @elseif($dossiers->clients ? $dossiers->clients->societe == 3 : '-')
                                Inter Global Africa
                            @else
                                -
                            @endif
                        </p>
                    </div>

                    <!-- Client Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('client', __('models/dossiers.fields.client') . ' :') !!}
                        <p>{{ $dossiers->clients ? $dossiers->clients->nom : '-' }}</p>
                    </div>

                    <!-- Mat Tracteur Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('mat_tracteur', 'Matricule du tracteur :') !!}
                        <p>{{ $dossiers->mat_tracteur ? $dossiers->mat_tracteur : '-' }}</p>
                    </div>

                    <!-- Mat Remorque Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('mat_remorque', 'Matricule du remorque :') !!}
                        <p>{{ $dossiers->mat_remorque }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            style="cursor: pointer;">
            <span class="collapsed card-link"> Trajet Voyage</span>
            <span class="toggle-icon float-right"><i class="fas fa-chevron-down"></i></span>
        </div>
        <div id="collapseTwo" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('date_charg', 'Date de chargement :') !!}
                        <p>{{ $dossiers->date_charg->format('Y-m-d') }}</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('lien_chargement', 'Lieu de chargement :') !!}
                        <p>{{ $dossiers->lien_chargement }}</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('expediteur', 'Expéditeur :') !!}
                        <p>{{ $dossiers->expediteur }}</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('lieu_livraison', 'Lieu de livraison :') !!}
                        <p>{{ $dossiers->lieu_livraison }}</p>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('destinsation', 'Destinateur :') !!}
                        <p>{{ $dossiers->destinsation }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
            style="cursor: pointer;">
            <span class="collapsed card-link">Infos Complémentaire</span>
            <span class="toggle-icon float-right"><i class="fas fa-chevron-down"></i></span>
        </div>
      
        <div id="collapseThree" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    <!-- Reference Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('reference', 'Référence :') !!}
                        <p>{{ $dossiers->reference ? $dossiers->reference : '-' }}</p>
                    </div>

                    <!-- Transporteur Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('transporteur', __('models/dossiers.fields.transporteur') . ' :') !!}
                        <p>{{ $dossiers->transporteur ? $dossiers->transporteur : '-' }}</p>
                    </div>

                    <!-- Navire Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('navire', 'Navire :') !!}
                        <p>{{ $dossiers->navire ? $dossiers->navire : '-' }}</p>
                    </div>

                    <!-- Date Embarquement Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('date_embarquement', "Date d'embarquement :") !!}
                        <p>{{ $dossiers->date_embarquement ? $dossiers->date_embarquement->format('Y-m-d') : '-' }}</p>
                    </div>

                    <!-- Date Sortie Port Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('date_sortie_port', 'Date sortie de port :') !!}
                        <p>{{ $dossiers->date_sortie_port ? $dossiers->date_sortie_port->format('Y-m-d') : '-' }}</p>
                    </div>

                    <!-- Date Livraison Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('date_livraison', 'Date de livraison :') !!}
                        <p>{{ $dossiers->date_livraison ? $dossiers->date_livraison->format('Y-m-d') : '-' }}</p>
                    </div>

                    <!-- Transitaire ALG Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('transitairealg', 'Transitaire Alg :') !!}
                        <p>{{ $dossiers->transitairealg ? $dossiers->transitairealg : '-' }}</p>
                    </div>

                    <!-- Transitaire Tanger Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('transitaire', 'Transitaire Tanger :') !!}
                        <p>{{ $dossiers->transitaire ? $dossiers->transitaire : '-' }}</p>
                    </div>

                    <!-- Date Courrier Field -->
                    <div class="col-md-4 col-lg-3">
                        {!! Form::label('date_courrier', 'Date de courrier :') !!}
                        <p>{{ $dossiers->date_courrier ? $dossiers->date_courrier->format('Y-m-d') : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
           <div class="card-header" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
            style="cursor: pointer;">
            <span class="collapsed card-link">Pièces jointes</span>
            <span class="toggle-icon float-right"><i class="fas fa-chevron-down"></i></span>
        </div>

        <div id="collapseFour" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    @foreach ($files as $file)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <embed src="{{ asset('uploads/' . $file->file_path) }}" height="400px"
                                    width="100%"></embed>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="card">
           <div class="card-header" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
            style="cursor: pointer;">
            <span class="collapsed card-link">Facture et Note de débit</span>
            <span class="toggle-icon float-right"><i class="fas fa-chevron-down"></i></span>
        </div>
        
        <div id="collapseFive" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    @foreach ($factureDossier as $f)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <embed src="{{ route('imprimer-facture', [$f->id]) }}" height="300px"
                                    width="100%"></embed>
                            </div>
                        </div>
                    @endforeach

                    @foreach ($noteDebitDossier as $n)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <embed src="{{ route('imprimer-note-debit', [$n->id]) }}" height="300px"
                                    width="100%"></embed>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('#societe').change(function() {
            var societeId = $(this).val();
            $.ajax({
                url: "{{ route('getClientsBySociete', '') }}/" + societeId,
                type: 'GET',
                success: function(response) {
                    var clients = response;
                    var clientSelect = $('#client');
                    clientSelect.empty();
                    $.each(clients, function(id, nom) {
                        clientSelect.append('<option value="' + id + '">' + nom +
                            '</option>');
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        // Function to update the icon
        function toggleIcon(collapseElement, show) {
            const icon = collapseElement.prev('.card-header').find('.toggle-icon i');
            icon.toggleClass('fa-chevron-down', !show);
            icon.toggleClass('fa-chevron-up', show);
        }

        // Handle show event
        $('#accordion .collapse').on('shown.bs.collapse', function () {
            toggleIcon($(this), true);
        });

        // Handle hide event
        $('#accordion .collapse').on('hidden.bs.collapse', function () {
            toggleIcon($(this), false);
        });

        // Optional: Make the entire header clickable
        $('#accordion .card-header').on('click', function (e) {
            // Avoid conflict if user clicks directly on an element already handling collapse
            if ($(e.target).closest('[data-toggle="collapse"]').length > 0) return;

            const target = $(this).data('target');
            if (target) {
                $(target).collapse('toggle');
            }
        });
    });
</script>

