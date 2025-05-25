<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToAnneedossierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('anneedossier', function (Blueprint $table) {
            $table->unsignedInteger('iddossier')->nullable();
            $table->foreign('iddossier')->references('id')->on('Dossiers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('anneedossier', function (Blueprint $table) {
            $table->dropForeign('anneedossier_iddossier_foreign');
        });
    }
}
