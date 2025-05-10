<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToFacturesDossierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('FacturesDossier', function (Blueprint $table) {
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
        Schema::table('FacturesDossier', function (Blueprint $table) {
            $table->dropForeign('facturesdossier_iddossier_foreign');
        });
    }
}
