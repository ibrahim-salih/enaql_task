<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'roles_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_role',
                'guard_name' => 'web'
            ],
            [
                'name' => 'settings_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_settings',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_settings',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_settings',
                'guard_name' => 'web'
            ],
            [
                'name' => 'drivers_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_driver',
                'guard_name' => 'web'
            ],

            [
                'name' => 'edit_driver',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_driver',
                'guard_name' => 'web'
            ],
            [
                'name' => 'clients_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_client',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_client',
                'guard_name' => 'web'
            ],

            [
                'name' => 'delete_client',
                'guard_name' => 'web'
            ],
            [
                'name' => 'vehicles_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_vehicle',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_vehicle',
                'guard_name' => 'web'
            ],

            [
                'name' => 'delete_vehicle',
                'guard_name' => 'web'
            ],
            [
                'name' => 'insurances_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_insurance',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_insurance',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_insurance',
                'guard_name' => 'web'
            ],
            [
                'name' => 'employees_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_employee',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_employee',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_employee',
                'guard_name' => 'web'
            ],
            [
                'name' => 'requisitions_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_requisition',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_requisition',
                'guard_name' => 'web'
            ],
            [
                'name' => 'control_requisition',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_requisition',
                'guard_name' => 'web'
            ],
            [
                'name' => 'routes_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_route',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_route',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_route',
                'guard_name' => 'web'
            ],
            [
                'name' => 'maintenances_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_maintenance',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_maintenance',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_maintenance',
                'guard_name' => 'web'
            ],
            [
                'name' => 'expenses_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_expense',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_expense',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_expense',
                'guard_name' => 'web'
            ],
            [
                'name' => 'parts_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_part',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_part',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_part',
                'guard_name' => 'web'
            ],
            [
                'name' => 'purchases_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_purchase',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_purchase',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_purchase',
                'guard_name' => 'web'
            ],
            [
                'name' => 'fuel_settings_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_fuel_setting',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_fuel_setting',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_fuel_setting',
                'guard_name' => 'web'
            ],
            [
                'name' => 'refueling_requisitions_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_refueling_requisition',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_refueling_requisition',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_refueling_requisition',
                'guard_name' => 'web'
            ],
            [
                'name' => 'items_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_item',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_item',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_item',
                'guard_name' => 'web'
            ],
            [
                'name' => 'manage_payment',
                'guard_name' => 'web'
            ],
            [
                'name' => 'system_settings',
                'guard_name' => 'web'
            ],
            [
                'name' => 'driver_count_order',
                'guard_name' => 'web'
            ],
            [
                'name' => 'manage_client_payment',
                'guard_name' => 'web'
            ],
            [
                'name' => 'income',
                'guard_name' => 'web'
            ],

        ];

        foreach($permissions as $permission){
            Permission::create($permission);
            Role::where('name','admin')->first()->givePermissionTo($permission['name']);
        }

        $clientPermissions = [
            [
                'name' => 'requisitions_page',
            ],
            [
                'name' => 'add_requisition',
            ],
            [
                'name' => 'edit_requisition',
            ],
            [
                'name' => 'delete_requisition',
            ],
            [
                'name' => 'items_page',
                'guard_name' => 'web'
            ],
            [
                'name' => 'add_item',
                'guard_name' => 'web'
            ],
            [
                'name' => 'edit_item',
                'guard_name' => 'web'
            ],
            [
                'name' => 'delete_item',
                'guard_name' => 'web'
            ],
        ];
        foreach($clientPermissions as $permission){
            Role::where('name','client')->first()->givePermissionTo($permission['name']);
            Role::where('name','driver')->first()->givePermissionTo($permission['name']);
        }



    }
}
