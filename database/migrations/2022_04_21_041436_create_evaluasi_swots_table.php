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
        Schema::create('evaluasi_swots', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->longText('strenght')->nullable();
            $table->longText('weakness')->nullable();
            $table->longText('opportunity')->nullable();
            $table->longText('strategi_so')->nullable();
            $table->longText('strategi_wo')->nullable();
            $table->longText('strategi_st')->nullable();
            $table->longText('strategi_wt')->nullable();
            $table->longText('threat')->nullable();
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
        Schema::dropIfExists('evaluasi_swots');
    }
};
