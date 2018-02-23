<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangans', function (Blueprint $table) {
            $table->string('id_ruangan');
            $table->primary('id_ruangan');

            $table->string('id_gedung');
            $table->string('nama_ruangan')->nullable();

            $table->foreign('id_gedung')->references('id_gedung')->on('gedungs')->onDelete('CASCADE');



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
        Schema::dropIfExists('ruangans');
    }
}
