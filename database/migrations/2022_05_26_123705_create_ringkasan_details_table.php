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
        Schema::create('ringkasan_details', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->longText('temuan');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('ringkasan_id');

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('ringkasan_id')->references('id')->on('ringkasan');

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
        Schema::dropIfExists('ringkasan_details');
    }
};
