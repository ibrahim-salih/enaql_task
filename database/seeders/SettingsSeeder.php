<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Company;
use App\Models\Department;
use App\Models\Designation;
use App\Models\FuelType;
use App\Models\LicenseType;
use App\Models\Location;
use App\Models\MaintenanceType;
use App\Models\Office;
use App\Models\PartCategory;
use App\Models\PriceControl;
use App\Models\Purpose;
use App\Models\RequisitionData;
use App\Models\RequisitionType;
use App\Models\Station;
use App\Models\SystemSetting;
use App\Models\TripType;
use App\Models\VehicleDivision;
use App\Models\VehicleType;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Test1','Test2','Test3','Test4','Test5'];
        foreach($names as $name){
            Designation::create(['name' => $name]);
            City::create(['name' => $name]);
            Department::create(['name' => $name]);
            VehicleType::create(['name' => $name]);
            VehicleDivision::create(['name' => $name]);
            Office::create(['name' => $name]);
            Vendor::create(['name' => $name]);
            Company::create(['name' => $name]);
            LicenseType::create(['name' => $name]);
            MaintenanceType::create(['name' => $name]);
            TripType::create(['name' => $name]);
            PartCategory::create(['name' => $name]);
            Location::create(['name' => $name]);
            FuelType::create(['name' => $name]);
            Station::create(['name' => $name]);
            RequisitionType::create(['name' => $name]);
            Purpose::create(['name' => $name]);
        }
        PriceControl::create([
            'from' => 'test1',
            'to' => 'test2',
            'price_per_order' => 30
        ]);

        SystemSetting::create([
            'system_name' => 'Arab Badia',
            'value_added_tax' => 15,
            'tax_number' => 1235655415,
            'address' => 'Egypt, Cairo',
            'bank_account_number' => 123456
        ]);
    }
}
