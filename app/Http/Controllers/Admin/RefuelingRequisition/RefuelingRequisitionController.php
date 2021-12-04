<?php

namespace App\Http\Controllers\Admin\RefuelingRequisition;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RefuelingRequisition\StoreRequest;
use App\Http\Requests\Admin\RefuelingRequisition\UpdateRequest;
use App\Models\FuelType;
use App\Models\RefuelingRequisition;
use App\Models\Station;
use App\Models\Vehicle;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefuelingRequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['vehicle','fuel_type','quantity','station','current_odometer','actions'];
        return view('admin.pages.refueling-requisition.index',compact('columns'));
    }



    public function datatable(){
        return  datatables()->of(RefuelingRequisition::query())
        ->addColumn('vehicle' , function(RefuelingRequisition $RefuelingRequisition){
            return $RefuelingRequisition->Vehicle->name;
        })
        ->addColumn('station' , function(RefuelingRequisition $RefuelingRequisition){
            return $RefuelingRequisition->Station->name;
        })
        ->addColumn('fuel_type' , function(RefuelingRequisition $RefuelingRequisition){
            return $RefuelingRequisition->FuelType->name;
        })
        ->addColumn('actions' , function(RefuelingRequisition $RefuelingRequisition){
            $actions = '';
            if(Auth::user()->can('edit_refueling_requisition')){
                $actions .= Icon::Edit(route('admin.refueling-requisition.edit' , $RefuelingRequisition->id));
            }
            if(Auth::user()->can('delete_refueling_requisition')){
                $actions .= Icon::Delete(route('admin.refueling-requisition.destroy' , $RefuelingRequisition->id));
            }
            return $actions;
        })
        ->rawColumns(['actions','vehicle','station','fuel_type'])
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
        $fuel_types = FuelType::get();
        $stations = Station::get();
        return view('admin.pages.refueling-requisition.create',[
            'vehicles' => $vehicles,
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
        RefuelingRequisition::create([
            'vehicle_id'=> $request->vehicle,
            'fuel_type_id'=> $request->fuel_type,
            'station_id'=> $request->station,
            'quantity' => $request->quantity,
            'current_odometer' => $request->current_odometer,
        ]);
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.refueling-requisition.index');
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
        $RefuelingRequisition = RefuelingRequisition::findOrFail($id);
        $vehicles = Vehicle::select(['name','id'])->get();
        $fuel_types = FuelType::get();
        $stations = Station::get();
        return view('admin.pages.refueling-requisition.edit',[
            'RefuelingRequisition' => $RefuelingRequisition,
            'vehicles' => $vehicles,
            'fuel_types' => $fuel_types,
            'stations' => $stations,
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
        $RefuelingRequisition = RefuelingRequisition::findOrFail($id);
        $RefuelingRequisition->update([
            'vehicle_id'=> $request->vehicle,
            'fuel_type_id'=> $request->fuel_type,
            'station_id'=> $request->station,
            'quantity' => $request->quantity,
            'current_odometer' => $request->current_odometer,
        ]);
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.refueling-requisition.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $RefuelingRequisition = RefuelingRequisition::findOrFail($id);
        $RefuelingRequisition->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
