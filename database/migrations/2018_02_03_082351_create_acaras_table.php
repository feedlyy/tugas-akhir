<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acaras', function (Blueprint $table) {
            $table->increments('id_acara');
            $table->string('nama_event');
            $table->date('tanggal_acara');
            $table->timestamp('waktu_mulai');
            $table->timestamp('waktu_selesai');
            $table->timestamp('alarm');
            $table->integer('id_ruangan')->unsigned();
            $table->string('tamu_undangan');
            $table->integer('id_admin')->unsigned();

            $table->foreign('id_ruangan')->references('id_ruangan')->on('ruangans')->onDelete('CASCADE');
            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acaras');
    }
}
