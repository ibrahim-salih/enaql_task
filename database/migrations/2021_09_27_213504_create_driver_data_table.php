<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_data', function (Blueprint $table) {
            $table->id();
            $table->text('mobile');
            $table->text('residency_number');
            $table->date('license_expiration_date');
            $table->date('residency_expiration_date');
            $table->date('passport_expiration_date');
            $table->date('health_insurance_date');
            $table->text('passport_number');
            $table->text('license_number');
            $table->text('email');
            $table->date('license_issue_date')->nullable();
            $table->text('join_date')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('leave_status')->nullable();
            $table->text('bank_account_number');
            $table->text('is_active')->nullable();
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('license_type_id');
            $table->foreign('driver_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('license_type_id')->references('id')->on('license_types')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('driver_data');
    }
}
