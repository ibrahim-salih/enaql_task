<?php

namespace App\Http\Controllers\Admin\DriverCountOrder;

use App\Http\Controllers\Controller;
use App\Models\Requisition;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;

class DriverCountOrderController extends Controller
{
    public function index(){
        $drivers = User::role('driver')->get();
        return view('admin.pages.driver-count-order.index',compact('drivers'));
    }

    public function getDriverOrders(Request $request){
        $requisitions = Requisition::where('driver_id',$request->driver_id)
        ->where('delivered_at','>=',$request->start_date)
        ->where('delivered_at','<=',$request->end_date)
        ->get();
        return view('admin.pages.driver-count-order.show-orders',compact('requisitions'));
    }

    public function print(Request $request){
        $requisitions = Requisition::where('driver_id',$request->driver_id)
        ->where('delivered_at','>=',$request->start_date)
        ->where('delivered_at','<=',$request->end_date)
        ->get();
        $system = SystemSetting::first();
        $invoice_header = count($system->getMedia('invoice_header')) > 0 ? $system->getMedia('invoice_header')->first()->getUrl() : null;
        $invoice_footer = count($system->getMedia('invoice_footer')) > 0 ? $system->getMedia('invoice_footer')->first()->getUrl() : null;
        return view('admin.pages.driver-count-order.print',compact('requisitions','invoice_header','invoice_footer'));
    }
}
