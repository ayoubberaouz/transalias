<?php

namespace App\Repositories;

use App\Models\Historique;
use App\Repositories\BaseRepository;

/**
 * Class HistoriqueRepository
 * @package App\Repositories
 * @version June 11, 2024, 6:50 pm +07
*/

class HistoriqueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'taches',
        'date',
        'ref',
        'user'
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
        return Historique::class;
    }
}
