<?php

namespace App\Http\Controllers\Admin\ApprovalAuthority;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApprovalAuthority\StoreRequest;
use App\Models\ApprovelAuthority;
use App\Models\Department;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use App\Models\RequisitionType;
class ApprovalAuthorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['requisition_type','requisition_phase','department','actions'];
        return view('admin.pages.approval-authority.index' , compact('columns'));
    }

    public function datatable(){
        return  datatables()->of(ApprovelAuthority::query())
        ->addColumn('requisition_type' , function(ApprovelAuthority $ApprovelAuthority){
            return $ApprovelAuthority->RequisitionType->name;
        })
        ->addColumn('department' , function(ApprovelAuthority $ApprovelAuthority){
            return $ApprovelAuthority->Department->name;
        })
        ->addColumn('actions' , function(ApprovelAuthority $ApprovelAuthority){
            $actions = Icon::Edit(route('admin.approval-authority.edit' , $ApprovelAuthority->id));
            $actions .= Icon::Delete(route('admin.approval-authority.destroy' , $ApprovelAuthority->id));
            return $actions;
        })
        ->rawColumns(['actions','department','requisition_type'])
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
        $departments = Department::get();
        return view('admin.pages.approval-authority.create',compact('requisition_types','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        ApprovelAuthority::create([
           'requisition_phase'=> $request->requisition_phase,
           'requisition_type_id'=> $request->requisition_type,
           'department_id'=> $request->department,
        ]);
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.approval-authority.index');
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
        $ApprovelAuthority = ApprovelAuthority::findOrFail($id);
        $requisition_types = RequisitionType::get();
        $departments = Department::get();
        return view('admin.pages.approval-authority.edit',compact('requisition_types','departments','ApprovelAuthority'));
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
        $ApprovelAuthority = ApprovelAuthority::findOrFail($id);
        $ApprovelAuthority->update([
            'requisition_phase'=> $request->requisition_phase,
            'requisition_type_id'=> $request->requisition_type,
            'department_id'=> $request->department,
         ]);
         toastr()->success(__('admin.update_success_message'));
         return redirect()->route('admin.approval-authority.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ApprovelAuthority = ApprovelAuthority::findOrFail($id);
        $ApprovelAuthority->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
