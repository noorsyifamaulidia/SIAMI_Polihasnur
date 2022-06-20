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
        Schema::table('temuan', function (Blueprint $table) {
            $table->renameColumn('approval_pimpinan_audit', 'approval_pimpinan_auditi');
            $table->unsignedInteger('reviewed_by_pj')->nullable()->after('reviewed_by');
            $table->renameColumn('reviewed_by', 'reviewed_by_upm');
        });

        Schema::table('ringkasan', function (Blueprint $table) {
            $table->renameColumn('approval_pimpinan_audit', 'approval_pimpinan_auditi');
            $table->unsignedInteger('reviewed_by_pj')->nullable()->after('reviewed_by');
            $table->renameColumn('reviewed_by', 'reviewed_by_upm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temuan', function (Blueprint $table) {
            $table->renameColumn('approval_pimpinan_auditi', 'approval_pimpinan_audit');
            $table->dropColumn('reviewed_by_pj');
            $table->renameColumn('reviewed_by_upm', 'reviewed_by');
        });

        Schema::table('ringkasan', function (Blueprint $table) {
            $table->renameColumn('approval_pimpinan_auditi', 'approval_pimpinan_audit');
            $table->dropColumn('reviewed_by_pj');
            $table->renameColumn('reviewed_by_upm', 'reviewed_by');
        });
    }
};
