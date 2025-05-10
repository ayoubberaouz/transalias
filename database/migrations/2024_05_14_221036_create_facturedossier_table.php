<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactureDossierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FacturesDossier', function (Blueprint $table) {
            $table->id();
            $table->string('numFacturation')->nullable();
            $table->string('dateFacturation')->nullable();
            $table->string('heureFacturation')->nullable();
            $table->string('dateInsertion')->nullable();
            $table->string('a_facture')->nullable();
            $table->string('mod_paiement')->nullable();
            $table->string('a_paye')->nullable();
            $table->string('etat_paiement')->nullable();
            $table->boolean('etat_validation')->nullable();
            $table->string('a_estimer')->nullable();
            $table->string('description')->nullable();
            $table->string('designation1')->nullable();
            $table->string('designation2')->nullable();
            $table->string('designation3')->nullable();
            $table->string('designation4')->nullable();
            $table->string('designation5')->nullable();
            $table->string('facturer1')->nullable();
            $table->string('facturer2')->nullable();
            $table->string('facturer3')->nullable();
            $table->string('facturer4')->nullable();
            $table->string('facturer5')->nullable();
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
        Schema::dropIfExists('FacturesDossier');
    }
}
