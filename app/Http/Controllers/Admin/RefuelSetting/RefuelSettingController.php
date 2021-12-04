<?php

namespace App\Http\Controllers\Admin\RefuelSetting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RefuelSetting\StoreRequest;
use App\Http\Requests\Admin\RefuelSetting\updateRequest;
use App\Models\FuelType;
use App\Models\RefuleSetting;
use App\Models\Station;
use App\Models\User;
use App\Models\Vehicle;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefuelSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['vehicle','driver','fuel_type','driver_mobile','station','actions'];
        return view('admin.pages.refuel-setting.index',compact('columns'));
    }



    public function datatable(){
        return  datatables()->of(RefuleSetting::query())
        ->addColumn('vehicle' , function(RefuleSetting $RefuleSetting){
            return $RefuleSetting->Vehicle->name;
        })
        ->addColumn('driver' , function(RefuleSetting $RefuleSetting){
            return $RefuleSetting->Driver->name;
        })
        ->addColumn('station' , function(RefuleSetting $RefuleSetting){
            return $RefuleSetting->Station->name;
        })
        ->addColumn('fuel_type' , function(RefuleSetting $RefuleSetting){
            return $RefuleSetting->FuelType->name;
        })
        ->addColumn('actions' , function(RefuleSetting $RefuleSetting){
            $actions = '';
            if(Auth::user()->can('edit_fuel_setting')){
                $actions = Icon::Edit(route('admin.refuel-setting.edit' , $RefuleSetting->id));
            }
            if(Auth::user()->can('delete_fuel_setting')){
                $actions .= Icon::Delete(route('admin.refuel-setting.destroy' , $RefuleSetting->id));
            }
            return $actions;
        })
        ->rawColumns(['actions','vehicle','driver','station','fuel_type'])
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
        $vehicles = Vehicle::select(['name','id'])->get();
        $drivers = User::role('driver')->get();
        $fuel_types = FuelType::get();
        $stations = Station::get();
        return view('admin.pages.refuel-setting.create',[
            'vehicles' => $vehicles,
            'drivers' => $drivers,
            'fuel_types' => $fuel_types,
            'stations' => $stations,
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
        $RefuleSetting = RefuleSetting::create([
           'driver_mobile'=> $request->driver_mobile,
           'refueled_date'=> $request->refueled_date,
           'refuel_limit_type'=> $request->refuel_limit_type,
           'max_unit'=> $request->max_unit,
           'budget_given'=> $request->budget_given,
           'consumption_percent'=> $request->consumption_percent,
           'place'=> $request->place,
           'odometer_km'=> $request->odometer_km,
           'kilometer_per_unit'=> $request->kilometer_per_unit,
           'odometer_at_time'=> $request->odometer_at_time,
           'last_reading'=> $request->last_reading,
           'last_unit'=> $request->last_unit,
           'unit_taken'=> $request->unit_taken,
           'strict_consumption'=> $request->strict_consumption == null ? 0 : 1,
           'vehicle_id'=> $request->vehicle,
           'driver_id'=> $request->driver,
           'fuel_type_id'=> $request->fuel_type,
           'station_id'=> $request->station,
        ]);
        if($request->hasFile('fuel_slip_scan_copy')){
            $RefuleSetting->addMedia($request->file('fuel_slip_scan_copy'))->toMediaCollection();
        }
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.refuel-setting.index');
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
        $RefuleSetting = RefuleSetting::findOrFail($id);
        $vehicles = Vehicle::select(['name','id'])->get();
        $drivers = User::role('driver')->get();
        $fuel_types = FuelType::get();
        $stations = Station::get();
        $file = count($RefuleSetting->getMedia()) > 0 ? $RefuleSetting->getMedia()->first()->getUrl() : null;
        return view('admin.pages.refuel-setting.edit',[
            'RefuleSetting' => $RefuleSetting,
            'vehicles' => $vehicles,
            'drivers' => $drivers,
            'fuel_types' => $fuel_types,
            'stations' => $stations,
            'file' => $file,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateRequest $request, $id)
    {
        $RefuleSetting = RefuleSetting::findOrFail($id);
        $RefuleSetting->update([
            'driver_mobile'=> $request->driver_mobile,
            'refueled_date'=> $request->refueled_date,
            'refuel_limit_type'=> $request->refuel_limit_type,
            'max_unit'=> $request->max_unit,
            'budget_given'=> $request->budget_given,
            'consumption_percent'=> $request->consumption_percent,
            'place'=> $request->place,
            'odometer_km'=> $request->odometer_km,
            'kilometer_per_unit'=> $request->kilometer_per_unit,
            'odometer_at_time'=> $request->odometer_at_time,
            'last_reading'=> $request->last_reading,
            'last_unit'=> $request->last_unit,
            'unit_taken'=> $request->unit_taken,
            'strict_consumption'=> $request->strict_consumption == null ? 0 : 1,
            'vehicle_id'=> $request->vehicle,
            'driver_id'=> $request->driver,
            'fuel_type_id'=> $request->fuel_type,
            'station_id'=> $request->station,
         ]);
         if($request->hasFile('fuel_slip_scan_copy')){
            $RefuleSetting->clearMediaCollection();
            $RefuleSetting->addMedia($request->file('fuel_slip_scan_copy'))->toMediaCollection();
         }
         toastr()->success(__('admin.update_success_message'));
         return redirect()->route('admin.refuel-setting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $RefuleSetting = RefuleSetting::findOrFail($id);
        $RefuleSetting->clearMediaCollection();
        $RefuleSetting->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
