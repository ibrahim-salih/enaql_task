<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('license_plate');
            $table->date('purchase_date');
            $table->text('alert_email');
            $table->text('seat_capacity');
            $table->text('ownership');
            $table->text('insurance_type');
            $table->text('insurance_company');
            $table->date('insurance_start_date');
            $table->text('rent_from')->nullable();
            $table->text('rent_price')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('office_id');
            $table->unsignedBigInteger('driver_id');
            $table->date('registration_date');
            $table->foreign('type_id')->references('id')->on('vehicle_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('department_id')->references('id')->on('departments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('division_id')->references('id')->on('vehicle_divisions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('office_id')->references('id')->on('offices')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('vehicles');
    }
}
