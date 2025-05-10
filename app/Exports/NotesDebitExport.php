<?php

namespace App\Exports;

use App\Models\NoteDebitDossier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class NotesDebitExport implements FromCollection, WithHeadings, WithMapping
{
    protected $hiddenColumns = [
        'id',
        'heurenotedebit',
        'dateinsertion',
        'a_notedebit',
        'montantdebit',
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
        return NoteDebitDossier::join('dossiers', 'NoteDebitDossier.iddossier', '=', 'dossiers.id')
            ->join('Clients', 'dossiers.client', '=', 'Clients.id')
            ->join('anneedossier', 'dossiers.id', '=', 'anneedossier.iddossier')
            ->where('NoteDebitDossier.datenotationdebit', 'like', '%' . $this->year. '%')
            ->where('Clients.societe', $this->societe)
            ->where('dossiers.etat_notedebit', 1)
            ->orderByRaw("CAST(SUBSTRING_INDEX(NoteDebitDossier.numnotedebit, 'T', -1) AS UNSIGNED), NoteDebitDossier.numnotedebit")
            ->get();
    }

    public function headings(): array
    {
        // Define the headers here
        return [
            'N° Note de Débit',
            'Date Note de Débit',
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
            $notedebit1 = (float)($row->notedebit1 ?? 0);
            $notedebit2 = (float)($row->notedebit2 ?? 0);
            $notedebit3 = (float)($row->notedebit3 ?? 0);
            $notedebit4 = (float)($row->notedebit4 ?? 0);
            $notedebit5 = (float)($row->notedebit5 ?? 0);
        
            $rowData['montant_ttc'] = $notedebit1 + $notedebit2 + $notedebit3 + $notedebit4 + $notedebit5;
        } else {
            $rowData['montant_ttc'] = 0; // or handle the null case as needed
        }
        
        // Unset any additional keys if necessary
        unset($rowData['client']);
        unset($rowData['dossiers']);
        unset($rowData['notedebit1']);
        unset($rowData['notedebit2']);
        unset($rowData['notedebit3']);
        unset($rowData['notedebit4']);
        unset($rowData['notedebit5']);
        
        return $rowData;
    }
}
