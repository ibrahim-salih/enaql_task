<?php

namespace App\Http\Controllers\Admin\Requisition;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Requisition\StoreRequest;
use App\Models\PriceControl;
use App\Models\Purpose;
use App\Models\Requisition;
use App\Models\RequisitionData;
use App\Models\RequisitionItem;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['client_to','vehicle_type','driven_by','actions'];
        return view('admin.pages.requisition.index' , compact('columns'));
    }


    public function datatable(Request $request){
        if(Auth::user()->hasRole('admin')){
            $requisition = Requisition::query();
        }elseif(Auth::user()->hasRole('client')){
            $requisition = Requisition::where('client_id',Auth::id());
        }
        elseif(Auth::user()->hasRole('driver')){
            $requisition = Requisition::where('driver_id',Auth::id());
        }
        if(!is_null($request->status)){
            $requisition = $requisition->where('status',$request->status);
        }
        return  datatables()->of($requisition)
        ->addColumn('vehicle_type' , function(Requisition $Requisition){
            return $Requisition->VehicleType->name;
        })
        ->addColumn('driven_by' , function(Requisition $Requisition){
            return $Requisition->driver->name;
        })
        ->addColumn('actions' , function(Requisition $Requisition){
            $actions = '';
            if(Auth::user()->can('edit_requisition')){
                $actions = Icon::Edit(route('admin.requisition.edit' , $Requisition->id));
            }
            if(Auth::user()->can('delete_requisition')){
                $actions .= Icon::Delete(route('admin.requisition.destroy' , $Requisition->id));
            }
            if(Auth::user()->can('control_requisition')){
                $actions .= Icon::Show(route('admin.requisition.show' , $Requisition->id));
            }
            if(Auth::user()->hasRole('client')){
                $actions .= Icon::Track(URL::to('requisition-client-track' . '?id=' . $Requisition->id));
            }
            if(Auth::user()->hasRole('driver')){
                $actions .= Icon::Show(route('admin.requisition-driver-show',$Requisition->id));
            }
            return $actions;
        })
        ->rawColumns(['actions','vehicle_type','driven_by'])
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
        $drivers = User::role('driver')->get();
        $vehicle_types = VehicleType::get();
        $vehicles = Vehicle::get();
        $purposes = Purpose::all();
        $places = PriceControl::get();
        $items = RequisitionData::getByAuth();

        return view('admin.pages.requisition.create',[
            'employees' => $employees,
            'drivers' => $drivers,
            'vehicle_types' => $vehicle_types,
            'vehicles' => $vehicles,
            'purposes' => $purposes,
            'places' => $places,
            'items' => $items,
        ]);
    }

    public function receive_requisition($id)
    {
        $requisition = Requisition::find($id);

        return view('admin.pages.requisition.receive_requisition',[
            'requisition' => $requisition,
        ]);
    }
    public function receive_requisition_post($id)
    {
        $requisition = Requisition::find($id);
        $employees = User::role('employee')->get();
        $drivers = User::role('driver')->get();
        $vehicle_types = VehicleType::get();
        $vehicles = Vehicle::get();
        $purposes = Purpose::all();
        $places = PriceControl::get();
        $items = RequisitionData::getByAuth();

        return view('admin.pages.requisition.receive_requisition',[
            'employees' => $employees,
            'drivers' => $drivers,
            'vehicle_types' => $vehicle_types,
            'vehicles' => $vehicles,
            'purposes' => $purposes,
            'places' => $places,
            'items' => $items,
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
        if($request->driver_has_account == 1){
            $status = Auth::user()->hasRole('admin') ? Requisition::ACCEPTED : 0;
        }else{
            $status = Auth::user()->hasRole('admin') ? Requisition::DELIVERED : 0;
        }
        $requisition = Requisition::create([
            'time_to'=> $request->time_to,
            'delivery_date' => $request->delivery_date,
            'time_from'=> $request->time_from,
            'tolerance_duration'=> $request->tolerance_duration,
            'no_of_passengers'=> $request->no_of_passengers,
            'pickup'=> $request->pickup,
            'purpose_id'=> $request->purpose,
            'requisition_date'=> $request->requisition_date,
            'details'=> $request->details,
            'driver_id'=> $request->driven_by,
            'vehicle_type_id'=> $request->vehicle_type,
            'client_id' => $request->client,
            'charge_number'=> $request->charge_number,
            'vehicle_id' => $request->vehicle_id,
            'status' => $status,
            'client_to' => $request->client_to,
            'price_control_id' => $request->place,
            'number_of_orders' => $request->number_of_orders,
            'total_requisition_price' => $request->number_of_orders * PriceControl::findOrFail($request->place)->price_per_order
        ]);
        if($request->driver_has_account !== 1){
            $requisition->update(['delivered_at' => date("Y-m-d")]);
        }
        if(isset($request->client)){
            $requisition->update([
                'client_first_signature' => '0',
                'client_second_signature' => '0',
                'driver_first_signature' => '0',
                'driver_second_signature' => '0',
            ]);
        }
        if(count($request->item_name) > 0){
            for($i=0;$i<count($request->item_name);$i++){
                RequisitionItem::create([
                    'requisition_id' => $requisition->id,
                    'item_name' => $request->item_name[$i],
                    'item_number' => $request->item_number[$i],
                    'notes' => $request->notes[$i],
                ]);
            }
        }
        toastr()->success(__('admin.store_success_message'));
        if(Auth::user()->hasRole('admin')){
            return redirect()->route('admin.requisition.index');
        }else{
            return redirect()->route('admin.requisition-client-track' , ['id' => $requisition->id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees = User::role('employee')->get();
        $drivers = User::role('driver')->get();
        $vehicle_types = VehicleType::get();
        $purposes = Purpose::all();
        $requisition = Requisition::findOrFail($id);
        $places = PriceControl::get();
        $items = RequisitionData::getByAuth();
        return view('admin.pages.requisition.show',[
            'employees' => $employees,
            'drivers' => $drivers,
            'vehicle_types' => $vehicle_types,
            'purposes' => $purposes,
            'requisition' => $requisition,
            'places' => $places,
            'items' => $items,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = User::role('employee')->get();
        $drivers = User::role('driver')->get();
        $vehicle_types = VehicleType::get();
        $purposes = Purpose::all();
        $requisition = Requisition::findOrFail($id);
        $places = PriceControl::get();
        $items = RequisitionData::getByAuth();
        return view('admin.pages.requisition.edit',[
            'employees' => $employees,
            'drivers' => $drivers,
            'vehicle_types' => $vehicle_types,
            'purposes' => $purposes,
            'requisition' => $requisition,
            'places' => $places,
            'items' => $items,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requisition = Requisition::findOrFail($id);
        // dd($request->all());
        $requisition->update([
            'time_to'=> $request->time_to,
            'time_from'=> $request->time_from,
            'tolerance_duration'=> $request->tolerance_duration,
            'no_of_passengers'=> $request->no_of_passengers,
            'pickup'=> $request->pickup,
            'purpose_id'=> $request->purpose,
            'requisition_date'=> $request->requisition_date,
            'delivery_date' => $request->delivery_date,
            'details'=> $request->details,
            'driver_id'=> $request->driven_by,
            'vehicle_type_id'=> $request->vehicle_type,
            // 'client_id' => $request->client,
            'client_to' => $request->client_to,
            'price_control_id' => $request->place,
            'number_of_orders' => $request->number_of_orders,
            'received_from_date' => $request->received_from_date,
            'received_to_date' => $request->received_to_date,
            'late_days' => $request->late_days,
            'late_days_price' => $request->late_days_price,
            'total_requisition_price' => $request->number_of_orders * PriceControl::findOrFail($request->place)->price_per_order
        ]);
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.requisition.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requisition = Requisition::findOrFail($id);
        $requisition->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
