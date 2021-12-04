<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Services\Icons\Icon;
use App\Http\Requests\Admin\Permission\StoreRequest;
use App\Http\Requests\Admin\Permission\UpdateRequest;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.permission.index');
    }


    public function datatable(){
        return  datatables()->of(Permission::query())
        ->addColumn('actions' , function(Permission $Permission){
            $actions = Icon::Edit(route('admin.permission.edit' , $Permission->id));
            $actions .= Icon::Delete(route('admin.permission.destroy' , $Permission->id));
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
        return view('admin.pages.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        toastr()->success('تم اضافة الصلاحية بنجاح');
        return redirect()->route('admin.permission.index');
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
        $Permission = Permission::findOrFail($id);
        return view('admin.pages.permission.edit' , compact('Permission'));
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
        $Permission = Permission::findOrFail($id);
        $Permission->update(['name' => $request->name]);
        toastr()->success('تم تعديل الصلاحية بنجاح');
        return redirect()->route('admin.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Permission = Permission::findOrFail($id);
        $Permission->delete();
        toastr()->success('تم حذف الصلاحية بنجاح');
        return back();
    }
}
