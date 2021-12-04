<?php

namespace App\Http\Controllers\Admin\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Purchase\StoreRequest;
use App\Http\Requests\Admin\Purchase\UpdateRequest;
use App\Models\Purchase;
use App\Models\PurchaseData;
use App\Models\Vendor;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['vendor','date','invoice','actions'];
        return view('admin.pages.purchase.index' , compact('columns'));
    }


    public function datatable(){
        return  datatables()->of(Purchase::query())
        ->addColumn('vendor' , function(Purchase $Purchase){
            return $Purchase->Vendor->name;
        })
        ->addColumn('actions' , function(Purchase $Purchase){
            $actions = '';
            if(Auth::user()->can('edit_purchase')){
                $actions .= Icon::Edit(route('admin.purchase.edit' , $Purchase->id));
            }
            if(Auth::user()->can('delete_purchase')){
                $actions .= Icon::Delete(route('admin.purchase.destroy' , $Purchase->id));
            }
            return $actions;
        })
        ->rawColumns(['actions','vendor'])
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
        $vendors = Vendor::get();
        return view('admin.pages.purchase.create',compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $Purchase = Purchase::create([
            'date' => $request->date,
            'invoice' => $request->invoice,
            'grand_total' => $request->grand_total,
            'vendor_id' => $request->vendor
        ]);
        $grand_total = 0;
        if(count($request->category_name) > 0){
            for($i=0;$i<count($request->category_name);$i++){
                $grand_total += $request->total_amount[$i];
                PurchaseData::create([
                    'category_name'=> $request->category_name[$i],
                    'item_name'=> $request->item_name[$i],
                    'item_unit'=> $request->item_unit[$i],
                    'unit_price'=> $request->unit_price[$i],
                    'total_amount'=> $request->total_amount[$i],
                    'purchase_id'=> $Purchase->id,
                ]);
            }
        }
        if($Purchase->grand_total !== $grand_total){
            $Purchase->update(['grand_total' => $grand_total]);
        }
        if($request->hasFile('manual_requisition_image')){
            $Purchase->addMedia($request->file('manual_requisition_image'))
            ->toMediaCollection('manual_requisition_image');
        }
        if($request->hasFile('work_order_image')){
            $Purchase->addMedia($request->file('work_order_image'))
            ->toMediaCollection('work_order_image');
        }
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.purchase.index');
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
        $vendors = Vendor::get();
        $purchase = Purchase::findOrFail($id);
        $purchase_data = $purchase->Data;
        $work_order_image = $purchase->getMedia('work_order_image')->first()->getUrl();
        $manual_requisition_image = $purchase->getMedia('manual_requisition_image')->first()->getUrl();
        return view('admin.pages.purchase.edit',compact('vendors','purchase','purchase_data','work_order_image','manual_requisition_image'));
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
        $Purchase = Purchase::findOrFail($id);
        $Purchase->update([
            'date' => $request->date,
            'invoice' => $request->invoice,
            'grand_total' => $request->grand_total,
            'vendor_id' => $request->vendor
        ]);
        $grand_total = 0;
        if(count($request->category_name) > 0){
            $Purchase->Data()->delete();
            for($i=0;$i<count($request->category_name);$i++){
                $grand_total += $request->total_amount[$i];
                PurchaseData::create([
                    'category_name'=> $request->category_name[$i],
                    'item_name'=> $request->item_name[$i],
                    'item_unit'=> $request->item_unit[$i],
                    'unit_price'=> $request->unit_price[$i],
                    'total_amount'=> $request->total_amount[$i],
                    'purchase_id'=> $Purchase->id,
                ]);
            }
        }
        if($Purchase->grand_total !== $grand_total){
            $Purchase->update(['grand_total' => $grand_total]);
        }
        if($request->hasFile('manual_requisition_image')){
            $Purchase->clearMediaCollection('manual_requisition_image');
            $Purchase->addMedia($request->file('manual_requisition_image'))
            ->toMediaCollection('manual_requisition_image');
        }
        if($request->hasFile('work_order_image')){
            $Purchase->clearMediaCollection('work_order_image');
            $Purchase->addMedia($request->file('work_order_image'))
            ->toMediaCollection('work_order_image');
        }
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.purchase.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Purchase = Purchase::findOrFail($id);
        $Purchase->Data()->delete();
        $Purchase->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
