<?php

namespace App\Http\Controllers\Admin\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\StoreRequest;
use App\Http\Requests\Admin\City\UpdateRequest;
use App\Models\City;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','actions'];
        return view('admin.pages.city.index',compact('columns'));
    }



    public function datatable(){
        return  datatables()->of(City::query())
        ->addColumn('actions' , function(City $City){
            $actions = '';
            if(Auth::user()->can('edit_settings')){
                $actions .= Icon::EditWithModal(route('admin.city.edit' , $City->id),route('admin.city.update' , $City->id));
            }
            if(Auth::user()->can('delete_settings')){
                $actions .= Icon::Delete(route('admin.city.destroy' , $City->id));
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
        City::create(['name' => $request->name]);
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
        return City::findOrFail($id)->name;
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
        $City = City::findOrFail($id);
        $City->update(['name'=>$request->name]);
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
        $City = City::findOrFail($id);
        $City->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
