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
            $table->increments('id');
            $table->string('id_ruangan', 30);
            $table->string('id_gedung', 30);
            $table->string('nama_ruangan', 50)->index();
            $table->string('created_by', 100);
            $table->foreign('id_gedung')->references('id_gedung')->on('gedungs')->onDelete('CASCADE');
            $table->foreign('created_by')->references('username')->on('admins')->onDelete('CASCADE');

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
