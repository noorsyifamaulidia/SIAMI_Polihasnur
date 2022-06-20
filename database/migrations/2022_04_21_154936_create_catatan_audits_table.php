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
        Schema::create('catatan_audits', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->text('catatan');
            $table->text('dokumen');
            $table->string('tanggal_rev')->nullable();
            $table->date('tanggal');
            $table->date('lokasi');
            $table->unsignedInteger('auditee_id');
            $table->unsignedInteger('indicator_id');
            $table->unsignedInteger('auditor_id');

            $table->foreign('auditee_id')->references('id')->on('auditees');
            $table->foreign('indicator_id')->references('id')->on('indicators');
            $table->foreign('auditor_id')->references('id')->on('auditors');
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
        Schema::dropIfExists('catatan_audits');
    }
};
