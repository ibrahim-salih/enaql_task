<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitionModificationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_modification_requests', function (Blueprint $table) {
            $table->id();
            $table->text('new_time_from');
            $table->text('new_time_to');
            $table->integer('status')->nullable()->default(0);
            $table->unsignedBigInteger('requisition_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('requisition_id')->references('id')->on('requisitions')->cascadeOnDelete()->cascadeOnDelete();
            $table->foreign('client_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnDelete();
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
        Schema::dropIfExists('requisition_modification_requests');
    }
}
