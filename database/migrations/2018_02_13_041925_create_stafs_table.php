<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStafsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stafs', function (Blueprint $table) {
            $table->increments('id_staff');
            $table->integer('id_status')->unsigned();
            $table->integer('id_fakultas')->unsigned();
            $table->integer('id_departemen')->unsigned();
            $table->integer('id_prodi')->unsigned();
            $table->integer('nip')->unsigned();
            $table->string('nama_staff');
            $table->string('email');
            $table->string('alamat');
            $table->integer('no_hp')->unsigned();

            $table->foreign('id_status')->references('id_status')->on('statuses')->onDelete('CASCADE');
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
        Schema::dropIfExists('stafs');
    }
}
