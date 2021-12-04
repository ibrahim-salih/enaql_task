<?php

namespace App\Http\Controllers\Admin\Remainder;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Remainder\StoreRequest;
use App\Http\Requests\Admin\Remainder\UpdateRequest;
use App\Models\Department;
use App\Models\Office;
use App\Models\User;
use App\Models\Remainder;
use App\Models\RemainderDivision;
use App\Models\RemainderType;
use App\Models\Vehicle;
use App\Models\Vendor;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;

class RemainderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['vehicle','document_type','alert_type','expire_date','mobile','email','remaining_days','actions'];
        return view('admin.pages.remainder.index' , compact('columns'));
    }


    public function datatable(){
        return  datatables()->of(Remainder::get())
        ->addColumn('vehicle' , function(Remainder $Remainder){
            return $Remainder->vehicle->name;
        })
        ->addColumn('alert_type' , function(Remainder $Remainder){
            $alert = '';
            if(!is_null($Remainder->email)){
                $alert .= 'Email';
            }
            if(!is_null($Remainder->sms)){
                $alert .= '+SMS';
            }
        })
        ->addColumn('driver' , function(Remainder $Remainder){
            return $Remainder->driver->name;
        })
        ->addColumn('actions' , function(Remainder $Remainder){
            $actions = Icon::Edit(route('admin.remainder.edit' , $Remainder->id));
            $actions .= Icon::Delete(route('admin.remainder.destroy' , $Remainder->id));
            return $actions;
        })
        ->rawColumns(['actions','Remainder_type','department','driver'])
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
        $vehicles = Vehicle::all();
        return view('admin.pages.remainder.create' , [
            'vehicles' => $vehicles,
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
        Remainder::create([
            'name' => $request->name,
            'type_id' => $request->Remainder_type,
            'department_id' => $request->department,
            'division_id' => $request->Remainder_division,
            'registration_date' => $request->registration_date,
            'office_id' => $request->office,
            'license_plate' => $request->license_plate,
            'driver_id' => $request->driver,
            'alert_cell_no' => $request->alert_cell_no,
            'vendor_id' => $request->vendor,
            'alert_email' => $request->alert_email,
            'seat_capacity' => $request->seat_capacity,
            'ownership' => $request->ownership,
        ]);
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.remainder.index');
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
        $Remainder = Remainder::findOrFail($id);
        $departments = Department::all();
        $drivers = User::role('driver')->get();
        $vendors = Vendor::all();
        $offices = Office::all();
        return view('admin.pages.remainder.edit',[
            'Remainder' => $Remainder,
            'departments' => $departments,
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
        $vehicel = Remainder::findOrFail($id);
        $vehicel->update([
            'name' => $request->name,
            'type_id' => $request->Remainder_type,
            'department_id' => $request->department,
            'division_id' => $request->Remainder_division,
            'registration_date' => $request->registration_date,
            'office_id' => $request->office,
            'license_plate' => $request->license_plate,
            'driver_id' => $request->driver,
            'alert_cell_no' => $request->alert_cell_no,
            'vendor_id' => $request->vendor,
            'alert_email' => $request->alert_email,
            'seat_capacity' => $request->seat_capacity,
            'ownership' => $request->ownership,
        ]);
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.remainder.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicel = Remainder::findOrFail($id);
        $vehicel->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
