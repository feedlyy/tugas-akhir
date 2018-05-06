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
            $table->text('event_id_google_calendar');
            $table->string('nama_event');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('id_gedung', 30);
            $table->string('nama_ruangan', 50);
            $table->string('penanggung_jawab', 100);

            $table->foreign('id_gedung')->references('id_gedung')->on('gedungs')->onDelete('CASCADE');
            $table->foreign('nama_ruangan')->references('nama_ruangan')->on('ruangans')->onDelete('CASCADE');
            $table->foreign('penanggung_jawab')->references('username')->on('admins')->onDelete('CASCADE');

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
        Schema::dropIfExists('acaras');
    }
}
