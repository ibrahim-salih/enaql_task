<?php

namespace Database\Seeders;

use App\Models\ClientData;
use App\Models\DriverData;
use App\Models\EmployeeData;
use App\Models\RequisitionData;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = User::create([
            'name' => 'Employee',
            'email' => 'employee@badia.com',
            'password' => Hash::make('123456789')
        ]);
        $employee ->assignRole('employee');
        EmployeeData::create([
            'pay_roll_type'=> 'Test',
            'designation_id'=> 1,
            'NID'=> 123456,
            'mobile'=> 123456,
            'email_optional'=> 'test@optional.com',
            'mobile_optional'=> 456789,
            'join_date'=> now(),
            'blood_group'=> "A+",
            'date_of_birth'=> now(),
            'working_slot_from'=> time(),
            'working_slot_to'=> time(),
            'father_name'=> "Test",
            'mother_name'=> "Test",
            'present_contact_number'=> 123456,
            'permanent_contact_number'=> 123456,
            'present_address'=> 'Test',
            'permanent_address'=> 'Test',
            'reference_name'=> 'Test',
            'reference_email'=> 'email@refernce.com',
            'reference_mobile'=> 123456,
            'reference_address'=> 'test',
            'employee_id'=> $employee->id,
            'department_id'=> 1,
            'present_city_id'=> 1,
            'permanent_city_id'=> 1,
            'bank_account_number' => '1234567899'
        ]);

        $driver = User::create([
            'name' => 'Driver',
            'email' => 'driver@badia.com',
            'password' => Hash::make('123456789')
        ]);
        $driver ->assignRole('driver');
        DriverData::create([
            'mobile'=> 123456,
            'residency_number'=> 123456,
            'license_number'=> 123456,
            'license_expiration_date'=> now(),
            'residency_expiration_date'=> now(),
            'passport_expiration_date'=> now(),
            'health_insurance_date'=> now(),
            'date_of_birth'=> now(),
            'email'=> 'test@test.com',
            'passport_number'=> '123456789',
            'leave_status'=> 1,
            'is_active'=> 1,
            'license_type_id'=> 1,
            'driver_id'=> $driver->id,
            'bank_account_number' => '1234567899'
        ]);

        $client = User::create([
            'name' => 'Client',
            'email' => 'client@badia.com',
            'password' => Hash::make('123456789')
        ]);
        $client ->assignRole('client');
        ClientData::create([
            'client_id' => $client->id,
            'bank_account_number' => '1234567899',
            'company_name' => 'test',
            'mobile' => '1234567899',
            'commercial_number' => '1234567899',
            'phone' => '1234567899',
            'address' => 'test',
        ]);

        Vehicle::create([
            'name' => 'test',
            'type_id' => 1,
            'department_id' => 1,
            'division_id' => 1,
            'registration_date' =>now(),
            'office_id' => 1,
            'license_plate' => 'test',
            'driver_id' => User::role('driver')->first()->id,
            'purchase_date' => now(),
            'alert_email' => 'email@alert.com',
            'seat_capacity' => 10,
            'insurance_type' =>'test',
            'insurance_company' =>'test',
            'insurance_start_date' => now(),
            'ownership' =>'test',
        ]);
        RequisitionData::create([
            'item_name' => 'Item Name',
            'client_id' => $client->id
        ]);
        RequisitionData::create([
            'item_name' => 'Item Name',
            'client_id' => User::role('admin')->first()->id
        ]);

    }
}
