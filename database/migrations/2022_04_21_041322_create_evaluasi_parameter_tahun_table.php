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
        Schema::create('evaluasi_parameter_tahun', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('tahun');
            $table->integer('persen');
            $table->unsignedInteger('evaluasi_parameter_id');

            $table->foreign('evaluasi_parameter_id')->references('id')->on('evaluasi_parameters');
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
        Schema::dropIfExists('evaluasi_parameter_tahun');
    }
};
