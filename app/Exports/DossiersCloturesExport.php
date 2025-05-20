<?php

namespace App\Exports;

use App\Models\Dossiers;
use App\Models\FacturesDossier;
use App\Models\NoteDebitDossier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class DossiersCloturesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $hiddenColumns = [
        'id', 
        'lieu_livraison', 
        'lien_chargement', 
        'navire',
        'observation',
        'date_insertion',
        'nom_chauffeur',
        'tel_chauffeur',
        'etat_cloture',
        'etat_facture',
        'etat_notedebit',
        'date_cloture',
        'montant',
        'devise',
        'date_livraison', 
        'date_embarquement',
        'date_sortie_port',
        'date_courrier',
        'reception',
        'montant_client',
        'tele',
        'devisetransp',
        'recu',
        'societe',
        'transitaire',
        'transitairealg',
        'annee',
        'iddossier',
        'nCompte',
        'ville',
        'adresse',
        'email',
        'gsm',
        'fax',
        'tel',
        'referenc',
        'raison_social',
        'client',
        'transporteur',
        'destinsation',
        'expediteur',
        'etat_transitaire',
        'etat_validation',
        'user_id',
        'created_at', 
        'updated_at',
    ];

    protected $year;

    public function __construct($year = null)
    {
        $this->year = $year ?: Carbon::now()->year;
    }

    public function collection()
    {
        $dossiers = Dossiers::join('anneedossier', 'dossiers.id', '=', 'anneedossier.iddossier')
            ->join('Clients', 'dossiers.client', '=', 'Clients.id')
            ->where('dossiers.etat_cloture', 1)
            ->where('anneedossier.annee', $this->year)
            ->orderBy('dossiers.id', 'desc')
            ->get();

        // Create associative arrays (hash maps) for factures and notes
        $facturesDossierMap = FacturesDossier::orderBy('id', 'desc')
            ->select('iddossier', 'numFacturation')
            ->get()
            ->keyBy('iddossier')
            ->toArray();

        $noteDebitDossierMap = NoteDebitDossier::orderBy('id', 'desc')
            ->select('iddossier', 'numnotedebit')
            ->get()
            ->keyBy('iddossier')
            ->toArray();

        // Loop through dossiers once to set num_facture and num_note_debit
        foreach ($dossiers as $d) {
            $d->num_facture = isset($facturesDossierMap[$d->iddossier]) ? $facturesDossierMap[$d->iddossier]['numFacturation'] : '-';
            $d->num_note_debit = isset($noteDebitDossierMap[$d->iddossier]) ? $noteDebitDossierMap[$d->iddossier]['numnotedebit'] : '-';
        }

        return $dossiers;
    }

    public function headings(): array
    {
        // Define the headers here
        return [
            'N° Dossier',
            'Client',
            'Référence',
            'Date Chargement',
            'Matricule Remorque',
            'Matricule Tracteur',
            'N° Facture',
            'N° Note de Débit',
        ];
    }

    public function map($row): array
    {
        // Exclude hidden columns
        foreach ($this->hiddenColumns as $column) {
            unset($row[$column]);
        }
        
        // Include data from the related table
        $rowData = [
            $row->annee_dossier,
            $row->nom,
            $row->reference,
            $row->date_charg,
            $row->mat_remorque,
            $row->mat_tracteur,
            $row->num_facture,
            $row->num_note_debit,
        ];

        return $rowData;
    }
}
