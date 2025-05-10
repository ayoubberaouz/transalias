<?php

namespace App\Repositories;

use App\Models\TransitaireTanger;
use App\Repositories\BaseRepository;

/**
 * Class TransitaireTangerRepository
 * @package App\Repositories
 * @version May 14, 2024, 4:30 pm +07
*/

class TransitaireTangerRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nom',
        'tel',
        'fax',
        'gsm',
        'email',
        'adresse',
        'ville',
        'Ncompte'
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
        return TransitaireTanger::class;
    }
}
