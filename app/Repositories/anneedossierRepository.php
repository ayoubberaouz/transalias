<?php

namespace App\Repositories;

use App\Models\anneedossier;
use App\Repositories\BaseRepository;

/**
 * Class anneedossierRepository
 * @package App\Repositories
 * @version May 10, 2024, 12:11 am +07
*/

class anneedossierRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'iddossier',
        'annee_dossier',
        'annee'
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
        return anneedossier::class;
    }
}
