<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id_admin');
            $table->string('nama_admin');
            $table->string('password');
            $table->integer('id_status')->unsigned();
            /*$table->integer('id_departemen')->unsigned()->nullable();
            $table->integer('id_prodi')->unsigned()->nullable();*/

            $table->foreign('id_status')->references('id_status')->on('statuses')->onDelete('CASCADE');
            /*$table->foreign('id_departemen')->references('id_departemen')->on('departements')->onDelete('CASCADE');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodis')->onDelete('CASCADE');*/
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
