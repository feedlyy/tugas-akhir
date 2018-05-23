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
            $table->string('id_fakultas', 30)->nullable();
            $table->string('id_departemen', 30)->nullable();
            $table->string('id_prodi', 30)->nullable();
            $table->string('nip',30);
            $table->string('nama_staff', 100);
            $table->string('email');
            $table->string('alamat');
            $table->char('no_hp', 20);
            $table->integer('id_status')->unsigned();

            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('CASCADE');
            $table->foreign('id_departemen')->references('id_departemen')->on('departemens')->onDelete('CASCADE');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodis')->onDelete('CASCADE');
            $table->foreign('id_status')->references('id')->on('statuses')->onDelete('CASCADE');

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
