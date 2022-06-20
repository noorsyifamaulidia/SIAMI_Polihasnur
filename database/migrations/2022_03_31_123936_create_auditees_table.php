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
        Schema::create('auditees', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('unit_id');
            $table->foreignId('user_id')->constrained();
            $table->unsignedInteger('audit_id');

            $table->foreign('unit_id')->references('id')->on('units');
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
        Schema::dropIfExists('auditees');
    }
};
