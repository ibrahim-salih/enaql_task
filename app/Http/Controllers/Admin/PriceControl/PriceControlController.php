<?php

namespace App\Http\Controllers\Admin\PriceControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PriceControl\StoreRequest;
use App\Http\Requests\Admin\PriceControl\UpdateRequest;
use App\Models\PriceControl;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PriceControlController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['from','to','price_per_order','actions'];
        return view('admin.pages.price-control.index',compact('columns'));
    }



    public function datatable(){
        return  datatables()->of(PriceControl::query())
        ->addColumn('actions' , function(PriceControl $PriceControl){
            $actions = '';
            if(Auth::user()->can('edit_settings')){
                $actions .= Icon::EditWithModal(route('admin.price-control.edit' , $PriceControl->id),route('admin.price-control.update' , $PriceControl->id));
            }
            if(Auth::user()->can('delete_settings')){
                $actions .= Icon::Delete(route('admin.price-control.destroy' , $PriceControl->id));
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
        PriceControl::create([
            'from' => $request->from,
            'to' => $request->to,
            'price_per_order' => $request->price_per_order,
        ]);
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
        return PriceControl::findOrFail($id);
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
        $PriceControl = PriceControl::findOrFail($id);
        $PriceControl->update([
            'from' => $request->from,
            'to' => $request->to,
            'price_per_order' => $request->price_per_order,
        ]);
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
        $PriceControl = PriceControl::findOrFail($id);
        $PriceControl->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
