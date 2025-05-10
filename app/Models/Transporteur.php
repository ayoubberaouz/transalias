<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Transporteur
 * @package App\Models
 * @version May 13, 2024, 11:59 pm +07
 *
 * @property string $nom
 * @property string $tel
 * @property string $fax
 * @property string $gsm
 * @property string $email
 * @property string $adresse
 * @property string $ville
 * @property string $Ncompte
 */
class Transporteur extends Model
{
    public $table = 'Transporteur';
    
    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'tel' => 'string',
        'fax' => 'string',
        'gsm' => 'string',
        'email' => 'string',
        'adresse' => 'string',
        'ville' => 'string',
        'Ncompte' => 'string'
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
        return $this->hasMany(Dossiers::class);
    }
}
