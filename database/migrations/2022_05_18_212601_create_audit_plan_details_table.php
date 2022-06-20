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
        Schema::create('audit_plan_details', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->date('tanggal')->nullable();
            $table->string('organisasi')->nullable();
            $table->string('auditor_kode');
            $table->longText('standar');
            $table->unsignedInteger('audit_plan_id');

            $table->foreign('audit_plan_id')->references('id')->on('audit_plans')->onDelete('cascade');
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
        Schema::dropIfExists('audit_plan_details');
    }
};
