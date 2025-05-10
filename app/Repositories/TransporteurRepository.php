<?php

namespace App\Repositories;

use App\Models\Transporteur;
use App\Repositories\BaseRepository;

/**
 * Class TransporteurRepository
 * @package App\Repositories
 * @version May 13, 2024, 11:59 pm +07
*/

class TransporteurRepository extends BaseRepository
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
        return Transporteur::class;
    }
}
