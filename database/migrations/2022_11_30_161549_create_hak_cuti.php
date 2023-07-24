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
        Schema::create('hak_cuti', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->unsignedInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users'); 
            $table->integer('hak_cuti')->default(0);
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
        Schema::dropIfExists('hak_cuti');
    }
};
