<?php

namespace App\Exports;

use App\Models\FacturesDossier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class FacturesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $hiddenColumns = [
        'id',
        'heureFacturation',
        'dateInsertion',
        'a_facture',
        'mod_paiement',
        'a_paye',
        'etat_paiement',
        'a_estimer',
        'description',
        'designation1',
        'designation2',
        'designation3',
        'designation4',
        'designation5',
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
        'transitaire',
        'transitairealg',
        'annee',
        'destinsation',
        'mat_tracteur',
        'transporteur',
        'expediteur',
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
        'created_at', 
        'updated_at',
    ];

    protected $year;

    public function __construct($year = null, $societe = null)
    {
        $this->year = $year ?: Carbon::now()->year;
        $this->societe = $societe;
    }

    public function collection()
    {
        $factures = FacturesDossier::join('dossiers', 'FacturesDossier.iddossier', '=', 'dossiers.id')
            ->join('Clients', 'dossiers.client', '=', 'Clients.id')
            ->join('anneedossier', 'dossiers.id', '=', 'anneedossier.iddossier')
            ->where('FacturesDossier.dateFacturation', 'like', '%' . $this->year. '%')
            ->where('Clients.societe', $this->societe)
            ->where('dossiers.etat_facture', 1)
            ->orderByRaw("CAST(SUBSTRING_INDEX(FacturesDossier.numFacturation, '/', -1) AS UNSIGNED), FacturesDossier.numFacturation")
            ->get();

        return $factures;
    }

    public function headings(): array
    {
        // Define the headers here
        return [
            'N° Facture',
            'Date Facture',
            'Date Voyage',
            'Référence',
            'Matricule Remorque',
            'Société',
            'Client',
            'N° Dossier',
            'Montant TTC',
        ];
    }

    public function map($row): array
    {
        // Exclude hidden columns
        foreach ($this->hiddenColumns as $column) {
            unset($row[$column]);
        }
        
        // Include data from the related table
        $rowData = $row->toArray();
        
        if($rowData['societe'] == 1){
            $rowData['societe'] = 'Transalias';
        }
        else if($rowData['societe'] == 2){
            $rowData['societe'] = 'Akbar Service';
        }
        else if($rowData['societe'] == 3){
            $rowData['societe'] = 'Inter Global Africa';
        }
        else{
            $rowData['societe'] == '-';
        }

        if ($row !== null) {
            $facturer1 = (float)($row->facturer1 ?? 0);
            $facturer2 = (float)($row->facturer2 ?? 0);
            $facturer3 = (float)($row->facturer3 ?? 0);
            $facturer4 = (float)($row->facturer4 ?? 0);
            $facturer5 = (float)($row->facturer5 ?? 0);
        
            $rowData['montant_ttc'] = $facturer1 + $facturer2 + $facturer3 + $facturer4 + $facturer5;
        } else {
            $rowData['montant_ttc'] = 0; // or handle the null case as needed
        }
        
        // Unset any additional keys if necessary
        unset($rowData['facturer1']);
        unset($rowData['facturer2']);
        unset($rowData['facturer3']);
        unset($rowData['facturer4']);
        unset($rowData['facturer5']);
        
        return $rowData;
    }
}
