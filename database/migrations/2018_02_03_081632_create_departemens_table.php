<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartemensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departemens', function (Blueprint $table) {
            $table->string('id_departemen');
            $table->primary('id_departemen');
            $table->string('nama_departemen');
            $table->string('id_fakultas');
           /* $table->integer('id_admin')->unsigned();*/

            $table->foreign('id_fakultas')->references('id_fakultas')->on('fakultas')->onDelete('CASCADE');
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
        Schema::dropIfExists('departemens');
    }
}
