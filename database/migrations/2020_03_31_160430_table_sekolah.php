<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableSekolah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sekolah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_sekolah'); 
            $table->text('alamat');
            $table->string('email_sekolah')->unique();
            $table->string('no_telepon')->unique();
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
        Schema::table('sekolah', function (Blueprint $table) {
            Schema::dropIfExists('sekolah');
        });
    }
}
