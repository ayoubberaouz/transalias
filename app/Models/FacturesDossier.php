<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class FacturesDossier
 * @package App\Models
 * @version May 14, 2024, 10:06 pm +07
 *
 * @property string $numFacturation
 * @property string $dateFacturation
 * @property string $heureFacturation
 * @property string $dateInsertion
 * @property string $a_facture
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
 * @property string $facturer1
 * @property string $facturer2
 * @property string $facturer3
 * @property string $facturer4
 * @property string $facturer5
 */
class FacturesDossier extends Model
{
    public $table = 'FacturesDossier';

    public $fillable = [
        'numFacturation',
        'iddossier',
        'dateFacturation',
        'heureFacturation',
        'dateInsertion',
        'a_facture',
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
        'facturer1',
        'facturer2',
        'facturer3',
        'facturer4',
        'facturer5',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'numFacturation' => 'string',
        'dateFacturation' => 'string',
        'heureFacturation' => 'string',
        'dateInsertion' => 'string',
        'a_facture' => 'string',
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
        'facturer1' => 'string',
        'facturer2' => 'string',
        'facturer3' => 'string',
        'facturer4' => 'string',
        'facturer5' => 'string',
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
