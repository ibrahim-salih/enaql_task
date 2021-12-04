<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_data', function (Blueprint $table) {
            $table->id();
            $table->text('pay_roll_type');
            $table->unsignedBigInteger('designation_id');
            $table->text('NID');
            $table->text('roles_name');
            $table->string('status',10);
            $table->text('mobile');
            $table->text('email_optional')->nullable();
            $table->text('mobile_optional')->nullable();
            $table->date('join_date');
            $table->text('blood_group')->nullable();
            $table->date('date_of_birth');
            $table->text('working_slot_from')->nullable();
            $table->text('working_slot_to')->nullable();
            $table->text('father_name')->nullable();
            $table->text('mother_name')->nullable();
            $table->text('present_contact_number')->nullable();
            $table->text('permanent_contact_number')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->text('reference_name')->nullable();
            $table->text('reference_email')->nullable();
            $table->text('reference_mobile')->nullable();
            $table->text('reference_address')->nullable();
            $table->text('bank_account_number');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('present_city_id');
            $table->unsignedBigInteger('permanent_city_id');
            $table->foreign('employee_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('department_id')->references('id')->on('departments')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('present_city_id')->references('id')->on('cities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('permanent_city_id')->references('id')->on('cities')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('designation_id')->references('id')->on('designations')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('employee_data');
    }
}
