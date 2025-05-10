<?php

namespace App\Exports;

use App\Models\Dossiers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class DossiersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $hiddenColumns = [
        'id', 
        'heure_chargement', 
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
            ->where('anneedossier.annee', $this->year)
            ->orderBy('dossiers.id', 'desc')
            ->get();

        return $dossiers;
    }

    public function headings(): array
    {
        // Define the headers here
        return [
            'N° Dossier',
            'Client',
            'Référence',
            'Transporteur',
            'Date Chargement',
            'Matricule Remorque',
            'Matricule Tracteur',
            'Expéditeur',
            'Destinateur',
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
            $row->transporteur,
            $row->date_charg,
            $row->mat_remorque,
            $row->mat_tracteur,
            $row->expediteur,
            $row->destinsation,
        ];
                        
        return $rowData;
    }
}
