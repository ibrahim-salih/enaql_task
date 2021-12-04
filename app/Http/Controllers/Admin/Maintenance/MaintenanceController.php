<?php

namespace App\Http\Controllers\Admin\Maintenance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Maintenance\StoreRequest;
use App\Http\Requests\Maintenance\UpdateRequest;
use App\Models\Maintenanace;
use App\Models\MaintenanceData;
use App\Models\MaintenanceType;
use App\Models\User;
use App\Models\Vehicle;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['requisition_type','requisition_for','charge','vehicle','maintenance_type','actions'];
        return view('admin.pages.maintenance.index' , compact('columns'));
    }


    public function datatable(){
        return  datatables()->of(Maintenanace::query())
        ->addColumn('requisition_for' , function(Maintenanace $Maintenanace){
            return $Maintenanace->Employee->name;
        })
        ->addColumn('vehicle' , function(Maintenanace $Maintenanace){
            return $Maintenanace->Vehicle->name;
        })
        ->addColumn('maintenance_type' , function(Maintenanace $Maintenanace){
            return $Maintenanace->Type->name;
        })
        ->addColumn('actions' , function(Maintenanace $Maintenanace){
            $actions = '';
            if(Auth::user()->can('edit_maintenance')){
                $actions .= Icon::Edit(route('admin.maintenance.edit' , $Maintenanace->id));
            }
            if(Auth::user()->can('delete_maintenance')){
                $actions .= Icon::Delete(route('admin.maintenance.destroy' , $Maintenanace->id));
            }
            return $actions;
        })
        ->rawColumns(['actions','requisition_for','vehicle','maintenance_type'])
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
        $employees = User::role('employee')->get();
        $vehicles = Vehicle::select(['name','id'])->get();
        $maintenance_types = MaintenanceType::get();
        $priorities = ['high','medium','low'];
        return view('admin.pages.maintenance.create',[
            'employees' => $employees,
            'vehicles' => $vehicles,
            'maintenance_types' => $maintenance_types,
            'priorities' => $priorities,
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
        $Maintenanace = Maintenanace::create([
            'requisition_type'=> $request->requisition_type,
            'charge'=> $request->charge,
            'charge_bear_by'=> $request->charge_bear,
            'periority'=> $request->priority,
            'service_name'=> $request->service_name,
            'is_add_schedule'=> $request->is_add_schedule == null ? 0 : $request->is_add_schedule,
            'service_date'=> $request->service_date,
            'remarks'=> $request->remarks,
            'grand_total'=> $request->grand_total,
            'employee_id'=> $request->requisition_for,
            'vehicle_id'=> $request->vehicle,
            'type_id'=> $request->maintenance_type,
        ]);
        $grand_total = 0;
        if(count($request->item_type_name) > 0){
            for($i=0;$i<count($request->item_type_name);$i++){
                $grand_total += $request->total_amount[$i];
                MaintenanceData::create([
                    'item_type_name'=> $request->item_type_name[$i],
                    'item_name'=> $request->item_name[$i],
                    'item_unit'=> $request->item_unit[$i],
                    'unit_price'=> $request->unit_price[$i],
                    'total'=> $request->total_amount[$i],
                    'maintenance_id'=> $Maintenanace->id,
                ]);
            }
        }
        if($Maintenanace->grand_total !== $grand_total){
            $Maintenanace->update(['grand_total' => $grand_total]);
        }
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.maintenance.index');
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
        $Maintenanace = Maintenanace::findOrFail($id);
        $MaintenanaceData = $Maintenanace->Data;
        $employees = User::role('employee')->get();
        $vehicles = Vehicle::select(['name','id'])->get();
        $maintenance_types = MaintenanceType::get();
        $priorities = ['high','medium','low'];
        return view('admin.pages.maintenance.edit',[
            'Maintenanace' => $Maintenanace,
            'MaintenanaceData' => $MaintenanaceData,
            'employees' => $employees,
            'vehicles' => $vehicles,
            'maintenance_types' => $maintenance_types,
            'priorities' => $priorities,
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
        $Maintenanace = Maintenanace::findOrFail($id);
        $Maintenanace->update([
            'requisition_type'=> $request->requisition_type,
            'charge'=> $request->charge,
            'charge_bear_by'=> $request->charge_bear,
            'periority'=> $request->priority,
            'service_name'=> $request->service_name,
            'is_add_schedule'=> $request->is_add_schedule,
            'service_date'=> $request->service_date,
            'remarks'=> $request->remarks,
            'grand_total'=> $request->grand_total,
            'employee_id'=> $request->requisition_for,
            'vehicle_id'=> $request->vehicle,
            'type_id'=> $request->maintenance_type,
        ]);
        $grand_total = 0;
        if(count($request->item_type_name) > 0){
            $Maintenanace->Data()->delete();
            for($i=0;$i<count($request->item_type_name);$i++){
                $grand_total += $request->total_amount[$i];
                MaintenanceData::create([
                    'item_type_name'=> $request->item_type_name[$i],
                    'item_name'=> $request->item_name[$i],
                    'item_unit'=> $request->item_unit[$i],
                    'unit_price'=> $request->unit_price[$i],
                    'total'=> $request->total_amount[$i],
                    'maintenance_id'=> $Maintenanace->id,
                ]);
            }
        }
        if($Maintenanace->grand_total !== $grand_total){
            $Maintenanace->update(['grand_total' => $grand_total]);
        }
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.maintenance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Maintenanace = Maintenanace::findOrFail($id);
        $Maintenanace->Data()->delete();
        $Maintenanace->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
