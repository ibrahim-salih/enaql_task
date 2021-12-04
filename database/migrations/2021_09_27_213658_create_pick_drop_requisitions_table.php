<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickDropRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pick_drop_requisitions', function (Blueprint $table) {
            $table->id();
            $table->text('start_point');
            $table->text('end_point');
            $table->text('request_type');
            $table->unsignedBigInteger('requisition_type_id');
            $table->date('effective_date')->nullable();
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('empolyee_id');
            $table->foreign('route_id')->references('id')->on('routes')->cascadeOnDelete()->cascadeOnUpdate();;
            $table->foreign('empolyee_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('requisition_type_id')->references('id')->on('requisition_types')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('pick_drop_requisitions');
    }
}
