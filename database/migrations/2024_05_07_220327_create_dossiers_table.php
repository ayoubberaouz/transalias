<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDossiersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date_charg')->nullable();
            $table->string('lieu_livraison')->nullable();
            $table->string('transporteur')->nullable();
            $table->string('destinsation')->nullable();
            $table->string('lien_chargement')->nullable();
            $table->string('reference')->nullable();
            $table->string('navire')->nullable();
            $table->string('observation')->nullable();
            $table->date('date_insertion')->nullable();
            $table->string('mat_tracteur')->nullable();
            $table->string('mat_remorque')->nullable();
            $table->string('nom_chauffeur')->nullable();
            $table->string('tel_chauffeur')->nullable();
            $table->boolean('etat_cloture')->nullable();
            $table->boolean('etat_facture')->nullable();
            $table->boolean('etat_notedebit')->nullable();
            $table->date('date_cloture')->nullable();
            $table->string('montant')->nullable();
            $table->string('devise')->nullable();
            $table->string('expediteur')->nullable();
            $table->date('date_livraison')->nullable();
            $table->date('date_embarquement')->nullable();
            $table->date('date_sortie_port')->nullable();
            $table->date('date_courrier')->nullable();
            $table->string('reception')->nullable();
            $table->string('montant_client')->nullable();
            $table->string('tele')->nullable();
            $table->string('transitaire')->nullable();
            $table->string('transitairealg')->nullable();
            $table->string('devisetransp')->nullable();
            $table->string('recu')->nullable();

            $table->string('societe')->nullable();

            $table->boolean('etat_transitaire')->nullable();
            $table->boolean('etat_validation')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dossiers');
    }
}
