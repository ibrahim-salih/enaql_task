<?php

namespace App\Http\Controllers\Admin\RequisitionData;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RequisitionData\StoreRequest;
use App\Http\Requests\Admin\RequisitionData\UpdateRequest;
use Illuminate\Http\Request;
use App\Services\Icons\Icon;
use Illuminate\Support\Facades\Auth;
use App\Models\RequisitionData;
class RequisitionDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['item_name','actions'];
        return view('admin.pages.requisition-data.index',compact('columns'));
    }

    public function datatable(){
        return  datatables()->of(RequisitionData::query())
        ->addColumn('actions' , function(RequisitionData $RequisitionData){
            $actions = '';
            if(Auth::user()->can('edit_item')){
                $actions .= Icon::Edit(route('admin.requisition-data.edit' , $RequisitionData->id));
            }
            if(Auth::user()->can('delete_item')){
                $actions .= Icon::Delete(route('admin.requisition-data.destroy' , $RequisitionData->id));
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
        return view('admin.pages.requisition-data.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        RequisitionData::create([
            'item_name' => $request->item_name,
            'client_id' => Auth::id(),
        ]);
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.requisition-data.index');
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
        $RequisitionData = RequisitionData::findOrFail($id);
        return view('admin.pages.requisition-data.edit' , compact('RequisitionData'));
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
        $RequisitionData = RequisitionData::findOrFail($id);
        $RequisitionData->update([
            'item_name' => $request->item_name,
            'client_id' => Auth::id(),
        ]);
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.requisition-data.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $RequisitionData = RequisitionData::findOrFail($id);
        $RequisitionData->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
