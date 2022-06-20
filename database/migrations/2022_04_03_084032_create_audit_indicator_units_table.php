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
        Schema::create('audit_indicator_units', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('audit_indicator_id');
            $table->unsignedInteger('unit_id');

            $table->foreign('audit_indicator_id')->references('id')->on('audit_indicators')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');

            $table->timestamps();

            // unique
            $table->unique(['audit_indicator_id', 'unit_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audit_indicator_units');
    }
};
