<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRequisitions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requisitions', function (Blueprint $table) {
            $table->string('charge_number')->nullable();
            $table->date('received_from_date')->nullable();
            $table->date('received_to_date')->nullable();
            $table->unsignedInteger('vehicle_id')->nullable();
            $table->string('late_days')->nullable();
            $table->string('late_days_price')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requisitions', function (Blueprint $table) {
            //
        });
    }
}
