<?php

namespace App\Repositories;

use App\Models\NoteDebitDossier;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

/**
 * Class NoteDebitDossierRepository
 * @package App\Repositories
 * @version May 27, 2024, 11:32 pm +07
*/

class NoteDebitDossierRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'numnotedebit',
        'datenotationdebit',
        'heurenotedebit',
        'dateinsertion',
        'a_notedebit',
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
        'notedebit1',
        'notedebit2',
        'notedebit3',
        'notedebit4',
        'notedebit5',
        'montantdebit'
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
        return NoteDebitDossier::class;
    }

    public function getDateNoteDebitForDashboard()
    {
        $currentDate = Carbon::now();

        return NoteDebitDossier::select('dateinsertion', 'etat_paiement')->where('dateinsertion', 'like', '%' . $currentDate->year . '%');
    }
}
