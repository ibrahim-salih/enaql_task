<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverPerformancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_performances', function (Blueprint $table) {
            $table->id();
            $table->text('penalty_amount');
            $table->longText('penalty_reason');
            $table->text('over_time_status');
            $table->text('salary_status');
            $table->text('overtime_payment');
            $table->date('penalty_date')->nullable();
            $table->text('performance_bonus');
            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('driver_performances');
    }
}
