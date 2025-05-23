<?php

namespace App\Repositories;

use App\Models\Dossiers;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

/**
 * Class DossiersRepository
 * @package App\Repositories
 * @version May 7, 2024, 10:03 pm +07
*/

class DossiersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'date_charg',
        'lieu_livraison',
        'transporteur',
        'destinsation',
        'lien_chargement',
        'client',
        'reference',
        'navire',
        'observation',
        'date_insertion',
        'mat_tracteur',
        'mat_remorque',
        'nom_chauffeur',
        'tel_chauffeur',
        'etat_cloture',
        'etat_facture',
        'etat_notedebit',
        'date_cloture',
        'montant',
        'devise',
        'expediteur',
        'date_livraison',
        'date_embarquement',
        'date_sortie_port',
        'date_courrier',
        'reception',
        'montant_client',
        'tele',
        'transitaire',
        'transitairealg',
        'devisetransp',
        'recu',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Dossiers::class;
    }

    public function getDateDossierForDashboard()
    {
        $currentDate = Carbon::now();

        return Dossiers::select('date_insertion', 'etat_cloture')->where('date_insertion', 'like', '%' . $currentDate->year . '%');
    }
}
