<?php

namespace App\Http\Controllers\Admin\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Department\StoreRequest;
use App\Http\Requests\Admin\Department\UpdateRequest;
use App\Models\Department;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','actions'];
        return view('admin.pages.department.index',compact('columns'));
    }



    public function datatable(){
        return  datatables()->of(Department::query())
        ->addColumn('actions' , function(Department $Department){
            $actions = '';
            if(Auth::user()->can('edit_settings')){
                $actions .= Icon::EditWithModal(route('admin.department.edit' , $Department->id),route('admin.department.update' , $Department->id));
            }
            if(Auth::user()->can('delete_settings')){
                $actions .= Icon::Delete(route('admin.department.destroy' , $Department->id));
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
        Department::create(['name' => $request->name]);
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
        return Department::findOrFail($id)->name;
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
        $Department = Department::findOrFail($id);
        $Department->update(['name'=>$request->name]);
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
        $Department = Department::findOrFail($id);
        $Department->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
