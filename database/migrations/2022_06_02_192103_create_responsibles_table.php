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
        Schema::create('responsibles', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->foreignId('user_id')->constrained();
            $table->unsignedInteger('pelaksana_id');
            $table->unsignedInteger('audit_id');

            $table->foreign('pelaksana_id')->references('id')->on('pelaksana');
            $table->foreign('audit_id')->references('id')->on('audits');
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
        Schema::dropIfExists('responsibles');
    }
};
