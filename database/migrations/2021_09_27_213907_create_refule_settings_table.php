<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefuleSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refule_settings', function (Blueprint $table) {
            $table->id();
            $table->text('driver_mobile');
            $table->date('refueled_date')->nullable();
            $table->text('refuel_limit_type')->nullable();
            $table->text('max_unit');
            $table->text('budget_given');
            $table->text('consumption_percent')->nullable();
            $table->text('place');
            $table->text('odometer_km')->nullable();
            $table->text('kilometer_per_unit');
            $table->text('odometer_at_time')->nullable();
            $table->text('last_reading')->nullable();
            $table->text('last_unit')->nullable();
            $table->text('unit_taken')->nullable();
            $table->text('strict_consumption')->nullable();
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('fuel_type_id');
            $table->unsignedBigInteger('station_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('driver_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('refule_settings');
    }
}
