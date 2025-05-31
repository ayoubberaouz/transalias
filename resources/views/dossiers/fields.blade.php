<div id="accordion">

    <div class="card">
        <div class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            style="cursor: pointer;">
            <span>Infos Voyage</span>
            <span class="toggle-icon float-right"><i class="fas fa-chevron-down"></i></span>
        </div>
        {{-- <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#collapseOne">
                Infos Voyage
            </a>
        </div> --}}
        <div id="collapseOne" class="collapse show" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    <!-- Société Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('societe', 'Société :', ['class' => 'required']) !!}
                        {!! Form::select(
                            'societe',
                            ['' => '', '1' => 'Transalias', '2' => 'Akbar Services', '3' => 'Inter Global Africa'],
                            null,
                            [
                                'class' => 'form-control custom-select',
                            ],
                        ) !!}
                    </div>

                    <!-- Client Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('client', __('models/dossiers.fields.client') . ' :', ['class' => 'required']) !!}
                        {!! Form::select('client', isset($dossiers->clients) ? $dossiers->clients->pluck('nom', 'id') : [], null, [
                            'class' => 'form-control custom-select',
                        ]) !!}
                    </div>

                    <!-- Mat Tracteur Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('mat_tracteur', 'Matricule du tracteur :') !!}
                        {!! Form::text('mat_tracteur', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Mat Remorque Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('mat_remorque', 'Matricule du remorque :', ['class' => 'required']) !!}
                        {!! Form::text('mat_remorque', null, ['class' => 'form-control']) !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="card">
        {{-- <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
               
            </a>
        </div> --}}

        <div class="card-header" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            style="cursor: pointer;">
            <span class="collapsed card-link"> Trajet Voyage</span>
            <span class="toggle-icon float-right"><i class="fas fa-chevron-down"></i></span>
        </div>
        <div id="collapseTwo" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    <!-- Date Charg Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('date_charg', 'Date de chargement :', ['class' => 'required']) !!}
                        {!! Form::date('date_charg', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Lieu Chargement Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('lien_chargement', 'Lieu de chargement :', ['class' => 'required']) !!}
                        {!! Form::text('lien_chargement', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Expediteur Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('expediteur', 'Expéditeur :', ['class' => 'required']) !!}
                        {!! Form::text('expediteur', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Lieu Livraison Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('lieu_livraison', 'Lieu de livraison :', ['class' => 'required']) !!}
                        {!! Form::text('lieu_livraison', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Destination Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('destinsation', 'Destinateur :', ['class' => 'required']) !!}
                        {!! Form::text('destinsation', null, ['class' => 'form-control']) !!}
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


        {{-- <div class="card-header">
            <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                Infos Complémentaire
            </a>
        </div> --}}
        <div id="collapseThree" class="collapse" data-parent="#accordion">
            <div class="card-body">
                <div class="row">
                    <!-- Reference Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('reference', 'Référence :') !!}
                        {!! Form::text('reference', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Transporteur Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('transporteur', __('models/dossiers.fields.transporteur') . ' :') !!}
                        {!! Form::select('transporteur', $transporteursOptions, null, [
                            'class' => 'form-control custom-select',
                        ]) !!}
                    </div>

                    <!-- Navire Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('navire', 'Navire :') !!}
                        {!! Form::text('navire', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Date Embarquement Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('date_embarquement', "Date d'embarquement :") !!}
                        {!! Form::date('date_embarquement', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Date Sortie Port Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('date_sortie_port', 'Date sortie de port :') !!}
                        {!! Form::date('date_sortie_port', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Date Livraison Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('date_livraison', 'Date de livraison :') !!}
                        {!! Form::date('date_livraison', null, ['class' => 'form-control']) !!}
                    </div>

                    <!-- Transitaire ALG Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('transitairealg', 'Transitaire Alg :') !!}
                        {!! Form::select('transitairealg', $transitairesAlgOptions, null, [
                            'class' => 'form-control custom-select',
                        ]) !!}
                    </div>

                    <!-- Transitaire Tanger Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('transitaire', 'Transitaire Tanger :') !!}
                        {!! Form::select('transitaire', $transitairesTangerOptions, null, [
                            'class' => 'form-control custom-select',
                        ]) !!}
                    </div>

                    <!-- Date Courrier Field -->
                    <div class="form-group col-md-4 col-lg-3">
                        {!! Form::label('date_courrier', 'Date de courrier :') !!}
                        {!! Form::date('date_courrier', null, ['class' => 'form-control']) !!}
                    </div>
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
    $(document).ready(function() {
        // Change icon when shown/hidden
        $('#accordion .collapse').on('shown.bs.collapse', function() {
            $(this).prev('.card-header').find('.toggle-icon i').removeClass('fa-chevron-down').addClass(
                'fa-chevron-up');
        });

        $('#accordion .collapse').on('hidden.bs.collapse', function() {
            $(this).prev('.card-header').find('.toggle-icon i').removeClass('fa-chevron-up').addClass(
                'fa-chevron-down');
        });

        // Optional: Make the whole header clickable even without data-toggle on the text
        $('#accordion .card-header').on('click', function() {
            const target = $(this).data('target');
            $(target).collapse('toggle');
        });
    });
</script>
