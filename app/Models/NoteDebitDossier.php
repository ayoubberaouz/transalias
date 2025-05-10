<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class NoteDebitDossier
 * @package App\Models
 * @version May 27, 2024, 11:32 pm +07
 *
 * @property string $numnotedebit
 * @property string $datenotationdebit
 * @property string $heurenotedebit
 * @property string $dateinsertion
 * @property string $a_notedebit
 * @property string $mod_paiement
 * @property string $a_paye
 * @property string $etat_paiement
 * @property string $a_estimer
 * @property string $description
 * @property string $designation1
 * @property string $designation2
 * @property string $designation3
 * @property string $designation4
 * @property string $designation5
 * @property string $notedebit1
 * @property string $notedebit2
 * @property string $notedebit3
 * @property string $notedebit4
 * @property string $notedebit5
 * @property string $montantdebit
 */
class NoteDebitDossier extends Model
{
    public $table = 'NoteDebitDossier';

    public $fillable = [
        'numnotedebit',
        'iddossier',
        'datenotationdebit',
        'heurenotedebit',
        'dateinsertion',
        'a_notedebit',
        'mod_paiement',
        'a_paye',
        'etat_paiement',
        'etat_validation',
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'numnotedebit' => 'string',
        'datenotationdebit' => 'string',
        'heurenotedebit' => 'string',
        'dateinsertion' => 'string',
        'a_notedebit' => 'string',
        'mod_paiement' => 'string',
        'a_paye' => 'string',
        'etat_paiement' => 'string',
        'etat_validation' => 'boolean',
        'a_estimer' => 'string',
        'description' => 'string',
        'designation1' => 'string',
        'designation2' => 'string',
        'designation3' => 'string',
        'designation4' => 'string',
        'designation5' => 'string',
        'notedebit1' => 'string',
        'notedebit2' => 'string',
        'notedebit3' => 'string',
        'notedebit4' => 'string',
        'notedebit5' => 'string',
        'montantdebit' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function Dossiers()
    {
        return $this->belongsTo(Dossiers::class, 'iddossier', 'id');
    }
}
