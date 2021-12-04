<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Empolyee\StoreRequest;
use App\Http\Requests\Admin\Empolyee\UpdateRequest;
use App\Models\City;
use App\Models\Department;
use App\Models\Designation;
use App\Models\EmployeeData;
use App\Models\User;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name', 'NID', 'pay_roll_type', 'department', 'mobile', 'email', 'roles', 'actions'];
        return view('admin.pages.employee.index', compact('columns'));
    }


    public function datatable()
    {
        return datatables()->of(User::role('employee')->get())
            ->addColumn('NID', function (User $User) {
                return $User->EmployeeData->NID;
            })
            ->addColumn('pay_roll_type', function (User $User) {
                return $User->EmployeeData->pay_roll_type;
            })
            ->addColumn('department', function (User $User) {
                return $User->EmployeeData->department->name;
            })
            ->addColumn('mobile', function (User $User) {
                return $User->EmployeeData->mobile;
            })
            ->addColumn('email', function (User $User) {
                return $User->email;
            })
            ->addColumn('roles', function (User $User) {
                return $User->EmployeeData->roles_name;
            })
            ->addColumn('actions', function (User $User) {
                $actions = '';
                if (Auth::user()->can('edit_employee')) {
                    $actions .= Icon::Edit(route('admin.employee.edit', $User->id));
                }
                if (Auth::user()->can('delete_employee')) {
                    $actions .= Icon::Delete(route('admin.employee.destroy', $User->id));
                }
                return $actions;
            })
            ->rawColumns(['actions', 'NID', 'pay_roll_type', 'department', 'mobile', 'email', 'roles'])
            ->addIndexColumn()
            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        //return $roles;
        $designations = Designation::all();
        $departments = Department::all();
        $pay_roll_types = ['internal', 'external'];
        $blood_groups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        $cities = City::all();
        return view('admin.pages.employee.create', [
            'designations' => $designations,
            'departments' => $departments,
            'pay_roll_types' => $pay_roll_types,
            'blood_groups' => $blood_groups,
            'cities' => $cities,
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $employee = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('123456789'),
        ]);
        $employee->assignRole('employee');
        EmployeeData::create([
            'pay_roll_type' => $request->pay_roll_type,
            'designation_id' => $request->designation,
            'NID' => $request->employee_nid,
            'roles_name' => $request->roles_name,
            'status' => 1,
            'mobile' => $request->mobile,
            'email_optional' => $request->email_optional,
            'mobile_optional' => $request->mobile_optional,
            'join_date' => $request->join_date,
            'blood_group' => $request->blood_group,
            'date_of_birth' => $request->date_of_birth,
            'working_slot_from' => $request->working_slot_from,
            'working_slot_to' => $request->working_slot_to,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'present_contact_number' => $request->present_contact_number,
            'permanent_contact_number' => $request->permanent_contact_number,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'reference_name' => $request->reference_name,
            'reference_email' => $request->reference_email,
            'reference_mobile' => $request->reference_mobile,
            'reference_address' => $request->reference_address,
            'employee_id' => $employee->id,
            'department_id' => $request->department,
            'present_city_id' => $request->present_city,
            'permanent_city_id' => $request->permanent_city,
            'bank_account_number' => $request->bank_account_number

        ]);
        if ($request->hasFile('employee_photograph')) {
            $employee->addMedia($request->file('employee_photograph'))
                ->toMediaCollection('employee_photograph');
        }
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = User::findOrFail($id);
        $employee_data = $employee->EmployeeData;
        $roles = Role::pluck('name', 'name')->all();
        //return $employee_data->roles_name;
        //$employeeRole = $employee_data->roles->pluck('name','name')->all();
//        return $employeeRole;
        $designations = Designation::all();
        $departments = Department::all();
        $pay_roll_types = ['internal', 'external'];
        $blood_groups = ['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'];
        $cities = City::all();
        count($employee->getMedia('employee_photograph')) > 0 ? $employee_photograph = $employee->getMedia('employee_photograph')[0]->getUrl('employee_photograph') : $employee_photograph = null;
        return view('admin.pages.employee.edit', [
            'employee' => $employee,
            'employee_data' => $employee_data,
            'employee_photograph' => $employee_photograph,
            'designations' => $designations,
            'departments' => $departments,
            'pay_roll_types' => $pay_roll_types,
            'blood_groups' => $blood_groups,
            'cities' => $cities,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $employee = User::findOrFail($id);
        $employee_data = $employee->EmployeeData;
        $employee->update(['name' => $request->name, 'email' => $request->email]);
        $employee_data->update([
            'pay_roll_type' => $request->pay_roll_type,
            'designation_id' => $request->designation,
            'NID' => $request->employee_nid,
            'roles_name' => $request->roles_name,
            'status' => 1,
            'mobile' => $request->mobile,
            'email_optional' => $request->email_optional,
            'mobile_optional' => $request->mobile_optional,
            'join_date' => $request->join_date,
            'blood_group' => $request->blood_group,
            'date_of_birth' => $request->date_of_birth,
            'working_slot_from' => $request->working_slot_from,
            'working_slot_to' => $request->working_slot_to,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'present_contact_number' => $request->present_contact_number,
            'permanent_contact_number' => $request->permanent_contact_number,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'reference_name' => $request->reference_name,
            'reference_email' => $request->reference_email,
            'reference_mobile' => $request->reference_mobile,
            'reference_address' => $request->reference_address,
            'employee_id' => $employee->id,
            'department_id' => $request->department,
            'present_city_id' => $request->present_city,
            'permanent_city_id' => $request->permanent_city,
            'bank_account_number' => $request->bank_account_number
        ]);
        if ($request->hasFile('employee_photograph')) {
            $employee->clearMediaCollection('employee_photograph');
            $employee->addMedia($request->file('employee_photograph'))
                ->toMediaCollection('employee_photograph');
        }
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
