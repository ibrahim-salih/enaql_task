<?php

namespace App\Http\Controllers\Admin\VehicleDivision;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VehicleDivision\StoreRequest;
use App\Http\Requests\Admin\VehicleDivision\UpdateRequest;
use App\Models\VehicleDivision;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleDivisionController extends Controller
{
          /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','actions'];
        return view('admin.pages.vehicle-division.index',compact('columns'));
    }



    public function datatable(){
        return  datatables()->of(VehicleDivision::query())
        ->addColumn('actions' , function(VehicleDivision $VehicleDivision){
            $actions = '';
            if(Auth::user()->can('edit_settings')){
                $actions .= Icon::EditWithModal(route('admin.vehicle-division.edit' , $VehicleDivision->id),route('admin.vehicle-division.update' , $VehicleDivision->id));
            }
            if(Auth::user()->can('delete_settings')){
                $actions .= Icon::Delete(route('admin.vehicle-division.destroy' , $VehicleDivision->id));
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
        VehicleDivision::create(['name' => $request->name]);
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
        return VehicleDivision::findOrFail($id)->name;
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
        $VehicleDivision = VehicleDivision::findOrFail($id);
        $VehicleDivision->update(['name'=>$request->name]);
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
        $VehicleDivision = VehicleDivision::findOrFail($id);
        $VehicleDivision->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
