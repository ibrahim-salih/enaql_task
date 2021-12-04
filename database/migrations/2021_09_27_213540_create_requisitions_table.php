<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->text('time_to')->nullable();
            $table->text('time_from')->nullable();
            $table->text('tolerance_duration');
            $table->date('delivery_date');
            $table->text('no_of_passengers')->nullable();
            $table->text('pickup')->nullable();
            $table->unsignedBigInteger('purpose_id');
            $table->date('requisition_date')->nullable();
            $table->text('details');
            $table->longText('driver_first_signature')->nullable();
            $table->longText('driver_second_signature')->nullable();
            $table->longText('client_first_signature')->nullable();
            $table->longText('client_second_signature')->nullable();
            $table->integer('status')->nullable()->default(0);
            $table->text('number_of_orders');
            $table->text('client_to');
            $table->text('is_paid')->nullable()->nullable();
            $table->text('total_requisition_price');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('client_id');
            // $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('vehicle_type_id');
            $table->unsignedBigInteger('price_control_id');
            $table->foreign('purpose_id')->references('id')->on('purposes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('driver_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('client_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            // $table->foreign('employee_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('price_control_id')->references('id')->on('price_controls')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('vehicle_type_id')->references('id')->on('vehicle_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('delivered_at')->nullable();
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
        Schema::dropIfExists('requisitions');
    }
}
