<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Historique
 * @package App\Models
 * @version June 11, 2024, 6:50 pm +07
 *
 * @property string $taches
 * @property string $date
 * @property string $ref
 * @property string $user
 */
class Historique extends Model
{
    public $table = 'Historique';
    
    public $fillable = [
        'taches',
        'date',
        'ref',
        'user'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'taches' => 'string',
        'date' => 'string',
        'ref' => 'string',
        'user' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    
}
