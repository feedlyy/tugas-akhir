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
            $table->integer('nip')->unsigned();
            $table->string('nama_staff');
            $table->string('email');
            $table->string('alamat');
            $table->char('no_hp', 20);

            $table->foreign('id_status')->references('id_status')->on('statuses')->onDelete('CASCADE');


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
