<?php

namespace App\Http\Controllers\Admin\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Location\StoreRequest;
use App\Http\Requests\Admin\Location\UpdateRequest;
use App\Models\Location;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','actions'];
        return view('admin.pages.location.index',compact('columns'));
    }



    public function datatable(){
        return  datatables()->of(Location::query())
        ->addColumn('actions' , function(Location $Location){
            $actions = '';
            if(Auth::user()->can('edit_settings')){
                $actions .= Icon::EditWithModal(route('admin.location.edit' , $Location->id),route('admin.location.update' , $Location->id));
            }
            if(Auth::user()->can('delete_settings')){
                $actions .= Icon::Delete(route('admin.location.destroy' , $Location->id));
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
        Location::create(['name' => $request->name]);
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
        return Location::findOrFail($id)->name;
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
        $Location = Location::findOrFail($id);
        $Location->update(['name'=>$request->name]);
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
        $Location = Location::findOrFail($id);
        $Location->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
