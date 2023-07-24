<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_cuti', function (Blueprint $table) {
            $table->increments('id'); 
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('jenis_cuti_id');
            $table->string('alasan_cuti', 50);
            $table->date('tgl_mulai');
            $table->date('tgl_akhir');
            $table->string('alamat_cuti', 70);
            $table->tinyInteger('status');
            $table->string('alasan_ditolak', 50)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users'); 
            $table->foreign('jenis_cuti_id')->references('id')->on('jenis_cutis'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permohonan_cuti');
    }
};
