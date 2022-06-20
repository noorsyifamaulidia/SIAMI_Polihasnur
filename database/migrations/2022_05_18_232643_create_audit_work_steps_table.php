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
        Schema::create('audit_work_steps', function (Blueprint $table) {
            $table->integerIncrements('id');

            $table->string('tentatif')->nullable();
            $table->string('tujuan')->nullable();

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
        Schema::dropIfExists('audit_work_steps');
    }
};
