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
        Schema::create('audit_notes', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->date('tanggal');

            $table->text('catatan');
            $table->text('dokumen');
            $table->longText('tanggal_rev')->nullable();

            $table->unsignedInteger('auditor_id');
            $table->unsignedInteger('auditee_id');
            $table->unsignedInteger('indicator_id');
            $table->unsignedInteger('audit_id');

            $table->foreign('auditor_id')->references('id')->on('auditors');
            $table->foreign('auditee_id')->references('id')->on('auditees');
            $table->foreign('indicator_id')->references('id')->on('indicators');
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
        Schema::dropIfExists('audit_notes');
    }
};
