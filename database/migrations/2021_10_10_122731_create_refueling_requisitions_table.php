<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefuelingRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refueling_requisitions', function (Blueprint $table) {
            $table->id();
            $table->text('quantity');
            $table->text('current_odometer');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('fuel_type_id');
            $table->unsignedBigInteger('station_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('fuel_type_id')->references('id')->on('fuel_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('station_id')->references('id')->on('stations')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('refueling_requisitions');
    }
}
