<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Clients
 * @package App\Models
 * @version May 10, 2024, 4:01 pm +07
 *
 * @property string $raison_social
 * @property string $referenc
 * @property string $tel
 * @property string $fax
 * @property string $gsm
 * @property string $email
 * @property string $adresse
 * @property string $ville
 * @property string $nCompte
 * @property integer $societe
 */
class Clients extends Model
{
    public $table = 'Clients';

    public $fillable = [
        'nom',
        'raison_social',
        'referenc',
        'tel',
        'fax',
        'gsm',
        'email',
        'adresse',
        'ville',
        'nCompte',
        'societe'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'raison_social' => 'string',
        'referenc' => 'string',
        'tel' => 'string',
        'fax' => 'string',
        'gsm' => 'string',
        'email' => 'string',
        'adresse' => 'string',
        'ville' => 'string',
        'nCompte' => 'string',
        'societe' => 'integer'
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
