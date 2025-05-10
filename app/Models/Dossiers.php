<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Dossiers
 * @package App\Models
 * @version May 7, 2024, 10:03 pm +07
 *
 * @property string $date_charg
 * @property string $heure_chargement
 * @property string $lieu_livraison
 * @property string $transporteur
 * @property string $destination
 * @property string $lien_chargement
 * @property string $client
 * @property string $reference
 * @property string $navire
 * @property string $observation
 * @property string $date_insertion
 * @property string $mat_tracteur
 * @property string $mat_remorque
 * @property string $nom_chauffeur
 * @property string $tel_chauffeur
 * @property boolean $etat_cloture
 * @property boolean $etat_facture
 * @property boolean $etat_notedebit
 * @property string $date_cloture
 * @property string $montant
 * @property string $devise
 * @property string $expediteur
 * @property string $date_livraison
 * @property string $date_embarquement
 * @property string $date_sortie_port
 * @property string $date_courrier
 * @property string $reception
 * @property string $montant_client
 * @property string $tele
 * @property string $transitaire
 * @property string $transitairealg
 * @property string $devisetransp
 * @property string $recu
 */
class Dossiers extends Model
{
    public $table = 'dossiers';

    public $fillable = [
        'date_charg',
        'heure_chargement',
        'lieu_livraison',
        'transporteur',
        'destinsation',
        'lien_chargement',
        'client',
        'reference',
        'navire',
        'observation',
        'date_insertion',
        'mat_tracteur',
        'mat_remorque',
        'nom_chauffeur',
        'tel_chauffeur',
        'etat_cloture',
        'etat_facture',
        'etat_notedebit',
        'date_cloture',
        'montant',
        'devise',
        'expediteur',
        'date_livraison',
        'date_embarquement',
        'date_sortie_port',
        'date_courrier',
        'reception',
        'montant_client',
        'tele',
        'transitaire',
        'transitairealg',
        'devisetransp',
        'recu',
        'societe',
        'etat_transitaire',
        'etat_validation',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'date_charg' => 'string',
        'heure_chargement' => 'string',
        'lieu_livraison' => 'string',
        'transporteur' => 'string',
        'destinsation' => 'string',
        'lien_chargement' => 'string',
        'client' => 'integer',
        'reference' => 'string',
        'navire' => 'string',
        'observation' => 'string',
        'date_insertion' => 'string',
        'mat_tracteur' => 'string',
        'mat_remorque' => 'string',
        'nom_chauffeur' => 'string',
        'tel_chauffeur' => 'string',
        'etat_cloture' => 'boolean',
        'etat_facture' => 'boolean',
        'etat_notedebit' => 'boolean',
        'date_cloture' => 'string',
        'montant' => 'string',
        'devise' => 'string',
        'expediteur' => 'string',
        'date_livraison' => 'string',
        'date_embarquement' => 'string',
        'date_sortie_port' => 'string',
        'date_courrier' => 'string',
        'reception' => 'string',
        'montant_client' => 'string',
        'tele' => 'string',
        'transitaire' => 'string',
        'transitairealg' => 'string',
        'devisetransp' => 'string',
        'recu' => 'string',
        'societe' => 'string',
        'etat_transitaire' => 'boolean',
        'etat_validation' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function Clients()
    {
        return $this->belongsTo(Clients::class, 'client', 'id');
    }

    public function TransitaireAlg()
    {
        return $this->belongsTo(TransitaireAlg::class, 'transitaireAlg', 'id');
    }

    public function TransitaireTanger()
    {
        return $this->belongsTo(TransitaireTanger::class, 'transitaireTanger', 'id');
    }

    public function Transporteur()
    {
        return $this->belongsTo(Transporteur::class, 'transporteur', 'id');
    }

    public function FacturesDossier()
    {
        return $this->hasOne(FacturesDossier::class, 'iddossier', 'id');
    }

    public function NoteDebitDossier()
    {
        return $this->hasOne(NoteDebitDossier::class, 'iddossier', 'id');
    }

    public function anneedossier()
    {
        return $this->hasOne(anneedossier::class, 'iddossier', 'id');
    }
}
