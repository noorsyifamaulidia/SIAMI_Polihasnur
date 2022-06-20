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
        Schema::create('evaluasi_rasionals', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->text('rasionale_standar')->nullable();
            $table->text('laporan_kinerja')->nullable();
            $table->text('hambatan')->nullable();
            $table->text('upaya_perbaikan')->nullable();
            $table->text('lainnya')->nullable();
            $table->unsignedInteger('indicator_id');
            $table->unsignedInteger('auditee_id');

            $table->foreign('indicator_id')->references('id')->on('indicators');
            $table->foreign('auditee_id')->references('id')->on('auditees');
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
        Schema::dropIfExists('evaluasi_rasionals');
    }
};
