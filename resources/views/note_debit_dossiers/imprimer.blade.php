<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTE DE DEBIT</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 15px;
        }

        .invoice-info {
            margin-bottom: 5px;
            display: inline-block
        }

        .invoice-info p {
            margin: 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 3px;
            border: 1px solid #000;
        }

        .invoice-table th {
            text-align: center;
            background-color: #f2f2f2;
            border-bottom: 2px solid #000;
        }

        .invoice-table td {
            text-align: center;
        }

        .table-total th,
        .table-total td {
            border-bottom: 1px solid #000;
            width: 9em !important;
        }
    </style>
</head>

<body>
    <div class="invoice">
        <div>
            <div class="invoice-info">
                @if ($noteDebitDossier->dossiers->clients->societe == 1)
                    {{-- Transalias --}}
                    <img src="{{ public_path('images/transalias.jpg') }}" style="width: 15rem">
                @elseif ($noteDebitDossier->dossiers->clients->societe == 2)
                    {{-- Akbar Service --}}
                    <img src="{{ public_path('images/akbar.png') }}" style="width: 15rem">
                @elseif ($noteDebitDossier->dossiers->clients->societe == 3)
                    {{-- Inter Global Africa --}}
                    <img src="{{ public_path('images/iga.jpg') }}" style="width: 10rem">
                @else
                    -
                @endif
            </div>
        </div>
        <div>
            <div class="invoice-info">
                <table style="padding-top: 2em;">
                    <tr>
                        <td style="text-align: left"><b>N° Note Débit :</b> {{ $noteDebitDossier->numnotedebit }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Date Note de Débit :</b>
                            {{ $noteDebitDossier->datenotationdebit->format('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Référence :</b>
                            {{ $noteDebitDossier->dossiers->reference ? $noteDebitDossier->dossiers->reference : '-' }}
                        </td>
                    </tr>
                </table>
            </div>
            <div class="invoice-info" style="float:right; width: 24rem; margin-top: 30px">
                <table>
                    <tr>
                        <td style="text-align: left"><b>Client :</b>
                            {{ $noteDebitDossier->dossiers ? $noteDebitDossier->dossiers->clients->nom : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left"><b>Adresse :</b>
                            {{ $noteDebitDossier->dossiers->clients->adresse ? $noteDebitDossier->dossiers->clients->adresse : '-' }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <br>
        <div>
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Matricule</th>
                        <th>Désignation</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="height: 400px">
                            <span>{{ $noteDebitDossier->dossiers->date_charg->format('Y-m-d') }}</span>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </td>
                        <td style="height: 400px">
                            <span>{{ $noteDebitDossier->dossiers->mat_remorque }}</span>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                        </td>
                        <td style="height: 400px; text-align: left; width: 380px">
                            <span>TRANSPORT :</span>
                            <br>
                            <span>{{ $noteDebitDossier->dossiers->expediteur }}
                                ({{ $noteDebitDossier->dossiers->lien_chargement }})</span>
                            <br>
                            <span>=> {{ $noteDebitDossier->dossiers->destinsation }}
                                ({{ $noteDebitDossier->dossiers->lieu_livraison }})</span>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <span>{{ $noteDebitDossier->designation1 }}</span>
                            <br>
                            <span>{{ $noteDebitDossier->designation2 }}</span>
                            <br>
                            <span>{{ $noteDebitDossier->designation3 }}</span>
                            <br>
                            <span>{{ $noteDebitDossier->designation4 }}</span>
                            <br>
                            <span>{{ $noteDebitDossier->designation5 }}</span>
                            <br>
                            <br>
                        </td>
                        <td style="height: 400px; text-align: right">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            @if ($noteDebitDossier->notedebit1)
                                <span>{{ $noteDebitDossier->notedebit1 . ' ' . $noteDebitDossier->a_paye }}
                                </span>
                            @endif
                            <br>
                            @if ($noteDebitDossier->notedebit2)
                                <span>{{ $noteDebitDossier->notedebit2 . ' ' . $noteDebitDossier->a_paye }}
                                </span>
                            @endif
                            <br>
                            @if ($noteDebitDossier->notedebit3)
                                <span>{{ $noteDebitDossier->notedebit3 . ' ' . $noteDebitDossier->a_paye }}
                                </span>
                            @endif
                            <br>
                            @if ($noteDebitDossier->notedebit4)
                                <span>{{ $noteDebitDossier->notedebit4 . ' ' . $noteDebitDossier->a_paye }}
                                </span>
                            @endif
                            <br>
                            @if ($noteDebitDossier->notedebit5)
                                <span>{{ $noteDebitDossier->notedebit5 . ' ' . $noteDebitDossier->a_paye }}
                                </span>
                            @endif

                            <br>
                            <br>
                            <br>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="invoice-info" style="display: inline-block; float:right; margin-top: 10px">
            <table class="table-total">
                <tr>
                    <td style="text-align: left">Montant HT</td>
                    <td style="text-align: center">
                        {{ $total_ht . ' ' . $noteDebitDossier->a_paye }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left">TVA</td>
                    <td style="text-align: center">
                        0 {{ $noteDebitDossier->a_paye }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left">Montant TTC</td>
                    <td style="text-align: center; border: 1px solid #000">
                        {{ $total_ht . ' ' . $noteDebitDossier->a_paye }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="invoice-info" style="margin-top: 100px">
            <span>Arrêtée la présente note de débit à la somme de :</span>
            <span>{{ $numberInWords }}</span>
            <br>
            <span>Equivalent en Dirhams :</span>
            @if ($noteDebitDossier->a_estimer)
                <span>{{ $noteDebitDossier->a_estimer }} DH</span>
            @else
                -
            @endif
        </div>

        @if ($noteDebitDossier->dossiers->clients->societe == 1)
            {{-- Transalias --}}
            <div class="invoice-info" style="margin-top: 20px; font-size: 13px">
                <span style="margin-left: 280px">SOCIETE GENERALE</span>
                <br>
                <span style="margin-left: 120px">Agence Tanger Principale RIB: 022 640 0000 18 000 589817321 /
                    SGMBMAMC</span>
            </div>
            <hr>
            <div class="invoice-info" style="font-size: 11px">
                <span style="margin-left: 150px"> Siège social 16/58 Résidence Assedk, sise angle Rue Lahore et
                    sayed
                    kotb
                    Tanger</span>
                <br>
                <span style="margin-left: 147px">Tél 0539 34 19 74 / Fax 0539 32 01 17 / IF 40208444 / RC 45869
                    Patente
                    50412144</span>
                <br>
                <span style="margin-left: 240px">CNSS N° 8677851 / ICE 001541390000029 </span>
            </div>
        @elseif ($noteDebitDossier->dossiers->clients->societe == 2)
            {{-- Akbar Service --}}
            <div class="invoice-info" style="margin-top: 20px; font-size: 13px">
                <span style="margin-left: 280px">SOCIETE GENERALE</span>
                <br>
                <span style="margin-left: 120px">Agence Tanger Principale RIB: 022 640 0000 18 002 799904121 /
                    SGMB</span>
            </div>
            <hr>
            <div class="invoice-info" style="font-size: 11px">
                <span style="margin-left: 150px"> Siège social 16/58 Résidence Assedk, sise angle Rue Lahore et
                    sayed
                    kotb
                    Tanger</span>
                <br>
                <span style="margin-left: 147px">Tél 0539 34 19 74 / Fax 0539 32 01 17 / IF 14450416 / RC 61407
                    Patente
                    50412312</span>
                <br>
                <span style="margin-left: 240px">CNSS N° 9776214 / ICE 000008556000042</span>
            </div>
        @elseif ($noteDebitDossier->dossiers->clients->societe == 3)
            {{-- Inter Global Africa --}}
            <div class="invoice-info" style="margin-top: 20px; font-size: 13px">
                <span style="margin-left: 280px">ATTIJARIWAFA BANK </span>
                <br>
                <span style="margin-left: 120px">AGENCE TANGER SOURYIENNE : 007 640 0000905000015385 61</span>
                <br>
                <span style="margin-left: 267px">SWIFT :BCMAMAMC XXX</span>
            </div>
            <hr>
            <div class="invoice-info" style="font-size: 11px">
                <span style="margin-left: 80px">Adresse Angle Rue Lahore et Sayed Kotb, Résidence Assedk, 1er Etg N°
                    16/58 Tanger, Tél. 0539 94 25 28 </span>
                <br>
                <span style="margin-left: 130px">Fax 0539 32 01 17, IF24921496 / RC 85265/ Patente 50400706 / ICE :
                    001984569000019 </span>
            </div>
        @else
            -
        @endif
    </div>
</body>

</html>
