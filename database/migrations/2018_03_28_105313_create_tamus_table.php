<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTamusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamus', function (Blueprint $table) {
            $table->increments('id_tamu');
            $table->integer('id_acara')->unsigned();
            $table->string('id_fakultas')->nullable();
            $table->string('id_departemen')->nullable();
            $table->string('id_prodi')->nullable();
            $table->string('email');

            $table->foreign('id_acara')->references('id_acara')->on('acaras')->onDelete('CASCADE');
            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('CASCADE');
            $table->foreign('id_departemen')->references('id_departemen')->on('departemens')->onDelete('CASCADE');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodis')->onDelete('CASCADE');
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
        Schema::dropIfExists('tamus');
    }
}
