<?php

namespace App\Http\Controllers\Admin\RequisitionType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequisitionType\StoreRequest;
use App\Http\Requests\Admin\RequisitionType\UpdateRequest;
use App\Models\RequisitionType;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequisitionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','actions'];
        return view('admin.pages.requisition-type.index',compact('columns'));
    }



    public function datatable(){
        return  datatables()->of(RequisitionType::query())
        ->addColumn('actions' , function(RequisitionType $RequisitionType){
            $actions = '';
            if(Auth::user()->can('edit_settings')){
                $actions .= Icon::EditWithModal(route('admin.requisition-type.edit' , $RequisitionType->id),route('admin.requisition-type.update' , $RequisitionType->id));
            }
            if(Auth::user()->can('delete_settings')){
                $actions .= Icon::Delete(route('admin.requisition-type.destroy' , $RequisitionType->id));
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
        RequisitionType::create(['name' => $request->name]);
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
        return RequisitionType::findOrFail($id)->name;
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
        $RequisitionType = RequisitionType::findOrFail($id);
        $RequisitionType->update(['name'=>$request->name]);
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
        $RequisitionType = RequisitionType::findOrFail($id);
        $RequisitionType->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
