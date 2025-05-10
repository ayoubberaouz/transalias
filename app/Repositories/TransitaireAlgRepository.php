<?php

namespace App\Repositories;

use App\Models\TransitaireAlg;
use App\Repositories\BaseRepository;

/**
 * Class TransitaireAlgRepository
 * @package App\Repositories
 * @version May 14, 2024, 4:27 pm +07
*/

class TransitaireAlgRepository extends BaseRepository
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
        return TransitaireAlg::class;
    }
}
