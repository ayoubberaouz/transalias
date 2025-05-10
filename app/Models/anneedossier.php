<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class anneedossier
 * @package App\Models
 * @version May 10, 2024, 12:11 am +07
 *
 * @property integer $iddossier
 * @property integer $annee_dossier
 * @property integer $annee
 */
class anneedossier extends Model
{
    public $table = 'anneedossier';

    public $fillable = [
        'iddossier',
        'annee_dossier',
        'annee'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'iddossier' => 'integer',
        'annee_dossier' => 'string',
        'annee' => 'integer'
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
        return $this->belongsTo(Dossiers::class, 'iddossier');
    }
}
