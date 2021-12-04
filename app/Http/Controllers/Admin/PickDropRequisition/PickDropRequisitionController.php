<?php

namespace App\Http\Controllers\Admin\PickDropRequisition;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PickDropRequisition\StoreRequest;
use App\Http\Requests\Admin\PickDropRequisition\UpdateRequest;
use App\Models\PickDropRequisition;
use App\Models\RequisitionType;
use App\Models\Route;
use App\Models\User;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;

class PickDropRequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['route','start_point','end_point','requisition_for','request_type','requisition_type','actions'];
        return view('admin.pages.pick-drop-requisition.index' , compact('columns'));
    }


    public function datatable(){
        return  datatables()->of(PickDropRequisition::query())
        ->addColumn('route' , function(PickDropRequisition $PickDropRequisition){
            return $PickDropRequisition->Route->name;
        })
        ->addColumn('requisition_for' , function(PickDropRequisition $PickDropRequisition){
            return $PickDropRequisition->Employee->name;
        })
        ->addColumn('requisition_type' , function(PickDropRequisition $PickDropRequisition){
            return $PickDropRequisition->RequisitionType->name;
        })
        ->addColumn('actions' , function(PickDropRequisition $PickDropRequisition){
            $actions = Icon::Edit(route('admin.pick-drop-requisition.edit' , $PickDropRequisition->id));
            $actions .= Icon::Delete(route('admin.pick-drop-requisition.destroy' , $PickDropRequisition->id));
            return $actions;
        })
        ->rawColumns(['actions','route','requisition_for','requisition_type'])
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
        $requisition_types = RequisitionType::get();
        $employees = User::role('employee')->get();
        $routes = Route::get();
        return view('admin.pages.pick-drop-requisition.create',[
            'requisition_types' => $requisition_types,
            'employees' => $employees,
            'routes' => $routes,
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
        PickDropRequisition::create([
            'start_point'=> $request->start_point,
            'end_point'=> $request->end_point,
            'request_type'=> $request->request_type,
            'requisition_type_id'=> $request->requisition_type,
            'effective_date' => $request->effective_date,
            'route_id'=> $request->route,
            'empolyee_id'=> $request->requisition_for,
        ]);
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.pick-drop-requisition.index');
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
        $PickDropRequisition = PickDropRequisition::findOrFail($id);
        $requisition_types = RequisitionType::get();
        $employees = User::role('employee')->get();
        $routes = Route::get();
        return view('admin.pages.pick-drop-requisition.edit',[
            'PickDropRequisition' => $PickDropRequisition,
            'requisition_types' => $requisition_types,
            'employees' => $employees,
            'routes' => $routes,
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
        $PickDropRequisition = PickDropRequisition::findOrFail($id);
        $PickDropRequisition->update([
            'start_point'=> $request->start_point,
            'end_point'=> $request->end_point,
            'request_type'=> $request->request_type,
            'requisition_type_id'=> $request->requisition_type,
            'effective_date' => $request->effective_date,
            'route_id'=> $request->route,
            'empolyee_id'=> $request->requisition_for,
        ]);
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.pick-drop-requisition.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $PickDropRequisition = PickDropRequisition::findOrFail($id);
        $PickDropRequisition->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
