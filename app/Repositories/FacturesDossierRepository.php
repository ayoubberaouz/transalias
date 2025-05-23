<?php

namespace App\Repositories;

use App\Models\FacturesDossier;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

/**
 * Class FacturesDossierRepository
 * @package App\Repositories
 * @version May 14, 2024, 10:06 pm +07
*/

class FacturesDossierRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'numFacturation',
        'dateFacturation',
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
        'facturer1',
        'facturer2',
        'facturer3',
        'facturer4',
        'facturer5'
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
        return FacturesDossier::class;
    }

    public function getDateFactureForDashboard()
    {
        $currentDate = Carbon::now();

        return FacturesDossier::select('dateInsertion', 'etat_paiement')->where('dateInsertion', 'like', '%' . $currentDate->year . '%');
    }
}
