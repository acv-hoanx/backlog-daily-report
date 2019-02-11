<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReportFee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_fee', function (Blueprint $table) {
            $table->increments('id');
            $table->text('remoteAddress')->nullable();
            $table->text('userAgent')->nullable();
            $table->string('thunhapthang')->nullable();
            $table->string('nguoiphuthuoc')->nullable();
            $table->string('thunhaptinhthue')->nullable();
            $table->string('thueTNCN')->nullable();
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
        Schema::dropIfExists('report_fee');
    }
}
