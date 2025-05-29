<!-- Nom Field -->
<div class="col-md-4">
    {!! Form::label('nom', 'Nom :') !!}
    <p>{{ $clients->nom }}</p>
</div>

<!-- Raison Social Field -->
<div class="col-md-4">
    {!! Form::label('raison_social', 'Nom du contact :') !!}
    <p>{{ $clients->raison_social }}</p>
</div>

<!-- Referenc Field -->
<div class="col-md-4">
    {!! Form::label('referenc', 'Référence :') !!}
    <p>{{ $clients->referenc }}</p>
</div>

<!-- Tel Field -->
<div class="col-md-4">
    {!! Form::label('tel', 'Téléphone :') !!}
    <p>{{ $clients->tel }}</p>
</div>

<!-- Fax Field -->
<div class="col-md-4">
    {!! Form::label('fax', __('models/clients.fields.fax') . ' :') !!}
    <p>{{ $clients->fax }}</p>
</div>

<!-- Gsm Field -->
<div class="col-md-4">
    {!! Form::label('gsm', __('models/clients.fields.gsm') . ' :') !!}
    <p>{{ $clients->gsm }}</p>
</div>

<!-- Email Field -->
<div class="col-md-4">
    {!! Form::label('email', __('models/clients.fields.email') . ' :') !!}
    <p>{{ $clients->email }}</p>
</div>

<!-- Adresse Field -->
<div class="col-md-8">
    {!! Form::label('adresse', __('models/clients.fields.adresse') . ' :') !!}
    <p>{{ $clients->adresse }}</p>
</div>

<!-- Ville Field -->
<div class="col-md-4">
    {!! Form::label('ville', __('models/clients.fields.ville') . ' :') !!}
    <p>{{ $clients->ville }}</p>
</div>

<!-- Ncompte Field -->
<div class="col-md-4">
    {!! Form::label('nCompte', 'N° Compte :') !!}
    <p>{{ $clients->nCompte }}</p>
</div>

<!-- Societe Field -->
<div class="col-md-4">
    {!! Form::label('societe', 'Société :') !!}
    <p>
        @if ($clients->societe == 1)
            Transalias
        @elseif($clients->societe == 2)
            Akbar Services
        @elseif($clients->societe == 3)
            Inter Global Africa
        @else
            -
        @endif
    </p>
</div>
