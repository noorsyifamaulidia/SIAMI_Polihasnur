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
        Schema::create('jadwal_pelaksana', function (Blueprint $table) {
            $table->unsignedInteger('jadwal_id');
            $table->unsignedInteger('pelaksana_id');

            $table->foreign('jadwal_id')->references('id')->on('jadwal')->onDelete('cascade');
            $table->foreign('pelaksana_id')->references('id')->on('pelaksana')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_pelaksana');
    }
};
