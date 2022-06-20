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
        Schema::create('temuan', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->date('tanggal');

            $table->longText('deskripsi_temuan')->nullable();
            $table->longText('kriteria')->nullable();
            $table->longText('akar_penyebab')->nullable();
            $table->longText('akibat')->nullable();
            $table->longText('rekomendasi_temuan')->nullable();
            $table->longText('tanggapan_auditi')->nullable();
            $table->longText('rencana_perbaikan')->nullable();
            $table->string('jadwal_perbaikan')->nullable();
            $table->string('pj_perbaikan')->nullable();
            $table->string('jadwal_pencegahan')->nullable();
            $table->string('pj_pencegahan')->nullable();

            $table->unsignedInteger('approval_pimpinan_audit')->nullable();
            $table->unsignedInteger('approval_ketua_auditor')->nullable();
            $table->unsignedInteger('reviewed_by')->nullable();

            // REKOMENDASI RAPAT TINJAUAN MANAJEMEN
            $table->text('rekomendasi')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('penanggung_jawab')->nullable();
            $table->text('hasil_tindak_lanjut')->nullable();

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
        Schema::dropIfExists('temuan');
    }
};
