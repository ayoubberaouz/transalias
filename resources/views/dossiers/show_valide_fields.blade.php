<div class="col-md-12" style="text-align: center;">
    <div class="alert" role="alert" style="background-color: #92c546; color: white">
        <h4>Infos Voyage</h4>
    </div>
</div>

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
    <p>{{ $dossiers->mat_tracteur }}</p>
</div>

<!-- Mat Remorque Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('mat_remorque', 'Matricule du remorque :') !!}
    <p>{{ $dossiers->mat_remorque }}</p>
</div>

<div class="col-md-12" style="text-align: center;">
    <div class="alert" role="alert" style="background-color: #92c546; color: white">
        <h4>Trajet Voyage</h4>
    </div>
</div>

<!-- Date Charg Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('date_charg', 'Date de chargement :') !!}
    <p>{{ $dossiers->date_charg }}</p>
</div>

<!-- Lien Chargement Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('lien_chargement', 'Lieu de chargement :') !!}
    <p>{{ $dossiers->lien_chargement }}</p>
</div>

<!-- Expediteur Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('expediteur', 'Expéditeur :') !!}
    <p>{{ $dossiers->expediteur }}</p>
</div>

<!-- Lieu Livraison Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('lieu_livraison', 'Lieu de livraison :') !!}
    <p>{{ $dossiers->lieu_livraison }}</p>
</div>

<!-- Destination Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('destinsation', 'Destinateur :') !!}
    <p>{{ $dossiers->destinsation }}</p>
</div>

<div class="col-md-12" style="text-align: center;">
    <div class="alert" role="alert" style="background-color: #92c546; color: white">
        <h4>Infos Complémentaire</h4>
    </div>
</div>

<!-- Reference Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('reference', 'Référence :') !!}
    <p>{{ $dossiers->reference }}</p>
</div>

<!-- Transporteur Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('transporteur', __('models/dossiers.fields.transporteur') . ' :') !!}
    <p>{{ $dossiers->transporteur }}</p>
</div>

<!-- Navire Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('navire', 'Navire :') !!}
    <p>{{ $dossiers->navire }}</p>
</div>

<!-- Date Embarquement Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('date_embarquement', "Date d'embarquement :") !!}
    <p>{{ $dossiers->date_embarquement }}</p>
</div>

<!-- Date Sortie Port Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('date_sortie_port', 'Date sortie de port :') !!}
    <p>{{ $dossiers->date_sortie_port }}</p>
</div>

<!-- Date Livraison Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('date_livraison', 'Date de livraison :') !!}
    <p>{{ $dossiers->date_livraison }}</p>
</div>

<!-- Transitaire ALG Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('transitairealg', 'Transitaire Alg :') !!}
    <p>{{ $dossiers->transitairealg }}</p>
</div>

<!-- Transitaire Tanger Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('transitaire', 'Transitaire Tanger :') !!}
    <p>{{ $dossiers->transitaire }}</p>
</div>

<!-- Date Courrier Field -->
<div class="col-md-4 col-lg-3">
    {!! Form::label('date_courrier', 'Date de courrier :') !!}
    <p>{{ $dossiers->date_courrier }}</p>
</div>

<div class="form-group col-md-12" style="text-align: center;">
    <div class="alert" role="alert" style="background-color: #92c546; color: white">
        <h4>Pièces jointes</h4>
    </div>
</div>

@foreach ($files as $file)
    <div class="col-md-3 mb-3">
        <div class="card">
            <embed src="{{ asset('uploads/' . $file->file_path) }}" height="400px" width="100%"></embed>
        </div>
    </div>
@endforeach

<div class="form-group col-md-12" style="text-align: center;">
    <div class="alert" role="alert" style="background-color: #92c546; color: white">
        <h4>Facture et Note de débit</h4>
    </div>
</div>

@foreach ($factureDossier as $f)
    <div class="col-md-3 mb-3">
        <div class="card">
            <embed src="{{ route('imprimer-facture', [$f->id]) }}" height="300px" width="100%"></embed>
        </div>
    </div>
@endforeach

@foreach ($noteDebitDossier as $n)
    <div class="col-md-3 mb-3">
        <div class="card">
            <embed src="{{ route('imprimer-note-debit', [$n->id]) }}" height="300px" width="100%"></embed>
        </div>
    </div>
@endforeach
