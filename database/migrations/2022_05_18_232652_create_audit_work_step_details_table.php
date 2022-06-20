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
        Schema::create('audit_work_step_details', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->longText('langkah_kerja');
            $table->longText('keterangan');

            $table->integer('audit_work_step_id')->unsigned();
            $table->foreign('audit_work_step_id')->references('id')->on('audit_work_steps')->onDelete('cascade');
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
        Schema::dropIfExists('audit_work_step_details');
    }
};
