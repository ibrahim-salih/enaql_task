<?php

namespace App\Http\Controllers\Admin\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Vehicle\StoreRequest;
use App\Http\Requests\Admin\Vehicle\UpdateRequest;
use App\Models\Department;
use App\Models\Office;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleDivision;
use App\Models\VehicleType;
use App\Models\Vendor;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','vehicle_type','department','driver','registration_date','actions'];
        return view('admin.pages.vehicle.index' , compact('columns'));
    }


    public function datatable(){
        return  datatables()->of(Vehicle::get())
        ->addColumn('vehicle_type' , function(Vehicle $Vehicle){
            return $Vehicle->type->name ?? '';
        })
        ->addColumn('department' , function(Vehicle $Vehicle){
            return $Vehicle->department->name ?? '';
        })
        ->addColumn('driver' , function(Vehicle $Vehicle){
            return $Vehicle->driver->name ?? '';
        })
        ->addColumn('actions' , function(Vehicle $Vehicle){
            $actions = '';
            if(Auth::user()->can('edit_vehicle')){
                $actions .= Icon::Edit(route('admin.vehicle.edit' , $Vehicle->id));
            }
            if(Auth::user()->can('delete_vehicle')){
                $actions .= Icon::Delete(route('admin.vehicle.destroy' , $Vehicle->id));
            }
            return $actions;
        })
        ->rawColumns(['actions','vehicle_type','department','driver'])
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
        $vehicle_types = VehicleType::all();
        $departments = Department::all();
        $vehicle_divisions = VehicleDivision::all();
        $drivers = User::role('driver')->get();
        $vendors = Vendor::all();
        $offices = Office::all();
        return view('admin.pages.vehicle.create' , [
            'vehicle_types' => $vehicle_types,
            'departments' => $departments,
            'vehicle_divisions' => $vehicle_divisions,
            'drivers' => $drivers,
            'vendors' => $vendors,
            'offices' => $offices,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Vehicle::create([
            'name' => $request->name,
            'type_id' => $request->vehicle_type,
            'department_id' => $request->department,
            'division_id' => $request->vehicle_division,
            'registration_date' => $request->registration_date,
            'office_id' => $request->office,
            'license_plate' => $request->license_plate,
            'driver_id' => $request->driver,
            'purchase_date' => $request->purchase_date,
            'alert_email' => $request->alert_email,
            'seat_capacity' => $request->seat_capacity,
            'ownership' => $request->ownership,
            'insurance_type' => $request->insurance_type,
            'insurance_company' => $request->insurance_company,
            'insurance_start_date' => $request->insurance_start_date,
            'rent_from' => $request->rent_from,
            'rent_price' => $request->rent_price,
        ]);
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.vehicle.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle_types = VehicleType::all();
        $departments = Department::all();
        $vehicle_divisions = VehicleDivision::all();
        $drivers = User::role('driver')->get();
        $vendors = Vendor::all();
        $offices = Office::all();
        return view('admin.pages.vehicle.edit',[
            'vehicle' => $vehicle,
            'vehicle_types' => $vehicle_types,
            'departments' => $departments,
            'vehicle_divisions' => $vehicle_divisions,
            'drivers' => $drivers,
            'vendors' => $vendors,
            'offices' => $offices,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $vehicel = Vehicle::findOrFail($id);
        $vehicel->update([
            'name' => $request->name,
            'type_id' => $request->vehicle_type,
            'department_id' => $request->department,
            'division_id' => $request->vehicle_division,
            'registration_date' => $request->registration_date,
            'office_id' => $request->office,
            'license_plate' => $request->license_plate,
            'driver_id' => $request->driver,
            'purchase_date' => $request->purchase_date,
            'alert_email' => $request->alert_email,
            'seat_capacity' => $request->seat_capacity,
            'ownership' => $request->ownership,
            'insurance_type' => $request->insurance_type,
            'insurance_company' => $request->insurance_company,
            'insurance_start_date' => $request->insurance_start_date,
            'rent_from' => $request->rent_from,
            'rent_price' => $request->rent_price,
        ]);
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.vehicle.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicel = Vehicle::findOrFail($id);
        $vehicel->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
