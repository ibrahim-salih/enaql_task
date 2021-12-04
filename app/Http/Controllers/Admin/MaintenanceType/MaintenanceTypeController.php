<?php

namespace App\Http\Controllers\Admin\MaintenanceType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MaintenanceType\StoreRequest;
use App\Http\Requests\Admin\MaintenanceType\UpdateRequest;
use App\Models\MaintenanceType;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceTypeController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','actions'];
        return view('admin.pages.maintenance-type.index',compact('columns'));
    }



    public function datatable(){
        return  datatables()->of(MaintenanceType::query())
        ->addColumn('actions' , function(MaintenanceType $MaintenanceType){
            $actions = '';
            if(Auth::user()->can('edit_settings')){
                $actions .= Icon::EditWithModal(route('admin.maintenance-type.edit' , $MaintenanceType->id),route('admin.maintenance-type.update' , $MaintenanceType->id));
            }
            if(Auth::user()->can('delete_settings')){
                $actions .= Icon::Delete(route('admin.maintenance-type.destroy' , $MaintenanceType->id));
            }
            return $actions;
        })
        ->rawColumns(['actions'])
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        MaintenanceType::create(['name' => $request->name]);
        return response()->json(__('admin.store_success_message'));
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
        return MaintenanceType::findOrFail($id)->name;
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
        $MaintenanceType = MaintenanceType::findOrFail($id);
        $MaintenanceType->update(['name'=>$request->name]);
        return response()->json(__('admin.update_success_message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $MaintenanceType = MaintenanceType::findOrFail($id);
        $MaintenanceType->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
