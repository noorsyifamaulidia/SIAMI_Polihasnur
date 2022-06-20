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
        Schema::create('audit_indicators', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('link_referensi')->nullable();
            $table->unsignedInteger('audit_id');
            $table->unsignedInteger('indicator_id');

            $table->foreign('audit_id')->references('id')->on('audits')->onDelete('cascade');
            $table->foreign('indicator_id')->references('id')->on('indicators')->onDelete('cascade');
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
        Schema::dropIfExists('audit_indicators');
    }
};
