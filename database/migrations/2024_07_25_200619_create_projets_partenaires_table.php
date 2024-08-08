<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetsPartenairesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projets_partenaires', function (Blueprint $table) {
            $table->unsignedBigInteger('idP');
            $table->unsignedBigInteger('idPa');
            $table->foreign('idP')->references('idP')->on('projets')->onDelete('cascade');
            $table->foreign('idPa')->references('idPa')->on('partenaires')->onDelete('cascade');
            $table->primary(['idP', 'idPa']); // Clé primaire composite
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projets_partenaires');
    }
}