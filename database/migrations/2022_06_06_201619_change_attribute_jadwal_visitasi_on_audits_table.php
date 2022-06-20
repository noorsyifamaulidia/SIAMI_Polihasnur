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
        Schema::table('audits', function (Blueprint $table) {
            $table->dropColumn('jadwal_visitasi');
            $table->date('tanggal_visitasi')->nullable();
            $table->longText('keterangan_visitasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audits', function (Blueprint $table) {
            $table->longText('jadwal_visitasi')->nullable();
            $table->dropColumn(['tanggal_visitasi', 'keterangan_visitasi']);
        });
    }
};
