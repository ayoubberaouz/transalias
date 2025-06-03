<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class TransitaireTanger
 * @package App\Models
 * @version May 14, 2024, 4:30 pm +07
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
class TransitaireTanger extends Model
{
    public $table = 'TransitaireTanger';
    
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
        'tel' => 'required',
        'ville' => 'required',
        'nom' => 'required',
    ];
    
    public function Dossiers()
    {
        return $this->hasMany(Dossiers::class);
    }
}
