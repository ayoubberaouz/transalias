<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteDebitDossierTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('NoteDebitDossier', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numnotedebit')->nullable();
            $table->string('datenotationdebit')->nullable();
            $table->string('heurenotedebit')->nullable();
            $table->string('dateinsertion')->nullable();
            $table->string('a_notedebit')->nullable();
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
            $table->string('notedebit1')->nullable();
            $table->string('notedebit2')->nullable();
            $table->string('notedebit3')->nullable();
            $table->string('notedebit4')->nullable();
            $table->string('notedebit5')->nullable();
            $table->string('montantdebit')->nullable();
            $table->timestamps();

            $table->unsignedInteger('iddossier')->nullable();
            $table->foreign('iddossier')->references('id')->on('Dossiers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('NoteDebitDossier');
    }
}
