<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenanaces', function (Blueprint $table) {
            $table->id();
            $table->text('requisition_type');
            $table->text('charge')->nullable();
            $table->text('charge_bear_by')->nullable();
            $table->text('periority');
            $table->text('service_name');
            $table->text('is_add_schedule')->nullable();
            $table->date('service_date');
            $table->text('remarks')->nullable();
            $table->text('grand_total')->nullable();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('type_id');
            $table->foreign('employee_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('type_id')->references('id')->on('maintenance_types')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('mainenanaces');
    }
}
