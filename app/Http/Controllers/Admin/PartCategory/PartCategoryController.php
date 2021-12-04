<?php

namespace App\Http\Controllers\Admin\PartCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartCategory\StoreRequest;
use App\Http\Requests\Admin\PartCategory\UpdateRequest;
use App\Models\PartCategory;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','actions'];
        return view('admin.pages.part-category.index',compact('columns'));
    }



    public function datatable(){
        return  datatables()->of(PartCategory::query())
        ->addColumn('actions' , function(PartCategory $PartCategory){
            $actions = '';
            if(Auth::user()->can('edit_settings')){
                $actions .= Icon::EditWithModal(route('admin.part-category.edit' , $PartCategory->id),route('admin.part-category.update' , $PartCategory->id));
            }
            if(Auth::user()->can('delete_settings')){
                $actions .= Icon::Delete(route('admin.part-category.destroy' , $PartCategory->id));
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
        PartCategory::create(['name' => $request->name]);
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
        return PartCategory::findOrFail($id)->name;
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
        $PartCategory = PartCategory::findOrFail($id);
        $PartCategory->update(['name'=>$request->name]);
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
        $PartCategory = PartCategory::findOrFail($id);
        $PartCategory->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
