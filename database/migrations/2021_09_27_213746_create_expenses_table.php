<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->date('expense_date');
            $table->text('trip_number');
            $table->text('expense_category');
            $table->text('odometer');
            $table->text('invoice');
            $table->text('rent_vehicle_cost');
            $table->text('remarks')->nullable();
            $table->text('grand_total')->nullable();
            $table->unsignedBigInteger('vehicle_id');
            $table->text('trip_type');
            $table->unsignedBigInteger('vendor_id');
            $table->text('employee');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('vendor_id')->references('id')->on('vendors')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('expenses');
    }
}
