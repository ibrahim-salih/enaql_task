<?php

namespace App\Http\Controllers\Admin\ManageClientPayment;

use App\Http\Controllers\Controller;
use App\Models\ClientPaymentNotification;
use App\Models\PriceControl;
use App\Models\Requisition;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;

class ManageClientPaymentController extends Controller
{
    public function index()
    {
        $clients = User::role('client')->get();
        $places = PriceControl::get();
        $places_from = $places->pluck('from')->unique()->toArray();
        $places_to = $places->pluck('to')->unique()->toArray();
        return view('admin.pages.manage-client-payment.index',[
            'clients' => $clients,
            'places_from' => $places_from,
            'places_to' => $places_to
        ]);
    }


    public function showClientPayment(Request $request){
        $places = PriceControl::query();
        if(request()->from != "any"){
            $places = $places->where('from',request()->from);
        }
        if(request()->to != "any"){
            $places = $places->where('to',request()->to);
        }
        $places = $places->get()->pluck('id')->toArray();
        $requisitions = Requisition::query();

        if(request()->client != "any"){
            $requisitions = $requisitions->where('client_id',$request->client);
            $client = User::findOrFail($request->client);
        }
        $requisitions = $requisitions->where('status',Requisition::DELIVERED)
        ->where('is_paid',0)
        ->where('delivered_at','>=',request()->start_date)
        ->where('delivered_at','<=',request()->end_date);
        $requisitions = $requisitions->whereIn('price_control_id',$places);
        if(!isset($request->page) || $request->page == 'single'){
            $requisitions = $requisitions->get();
            $total = $requisitions->sum('total_requisition_price') ?? 0;
            $vat = SystemSetting::first()->value_added_tax;
            $vat_amount = ($total * $vat) / 100;
            $total_with_vat = $total + $vat_amount;
            return view('admin.pages.manage-client-payment.show-payment',[
                'requisitions' => $requisitions,
                'total' => $total,
                'vat_amount' => $vat_amount,
                'total_with_vat' => $total_with_vat,
                'vat' => $vat,
                'client' => request()->client != 'any' ? $client : 'any',
            ]);
        }else{
        $requisitions_groups = $requisitions->get()->groupBy('price_control_id');
        $total_of_total = 0;
        $total_of_total_orders = 0;
        $total_of_requistions_num = 0;
        $requisitions_collected =[];
        foreach ($requisitions_groups as $key => $value) {
            $place = PriceControl::find($key);
            $total = 0;
            $total_orders = 0;
            foreach ($requisitions_groups[$key] as $value2) {
               $total += $value2->total_requisition_price;
               $total_orders += $value2->number_of_orders;
               $total_of_total += $total;
               $total_of_total_orders += $total_orders;
            }
            $requistions_num = count($requisitions_groups[$key]);
            $total_of_requistions_num += $requistions_num;

            $requisitions_collected[] = ['place'=>$place,'total'=>$total,'total_orders'=>$total_orders,'requistions_num'=>$requistions_num];
        }

        $vat = SystemSetting::first()->value_added_tax;
        $vat_amount = ($total_of_total * $vat) / 100;
        $total_of_total_with_vat = $total_of_total + $vat_amount;


        return view('admin.pages.manage-client-payment.show-payment-collected',[
            'requisitions_collected' => $requisitions_collected,
            'total' => $total_of_total,
            'vat_amount' => $vat_amount,
            'total_with_vat' => $total_of_total_with_vat,
            'vat' => $vat,
            'total_orders' => $total_of_total_orders,
            'total_of_requistions_num' => $total_of_requistions_num,
            'client' => request()->client != 'any' ? $client : 'any',
        ]);
    }


    }


    public function printClientPayment(Request $request){
        $places = PriceControl::query();
        if(request()->from != "any"){
            $places = $places->where('from',request()->from);
        }
        if(request()->to != "any"){
            $places = $places->where('to',request()->to);
        }
        $places = $places->get()->pluck('id')->toArray();
        $requisitions = Requisition::query();

        if(request()->client != "any"){
            $requisitions = $requisitions->where('client_id',$request->client);
            $client = User::findOrFail($request->client);
        }
        $requisitions = $requisitions->where('status',Requisition::DELIVERED)
        ->where('is_paid',0)
        ->where('delivered_at','>=',request()->start_date)
        ->where('delivered_at','<=',request()->end_date);
        $requisitions = $requisitions->whereIn('price_control_id',$places);

        if(!isset($request->page) || $request->page == 'single'){
        $requisitions = $requisitions->get();
        $total = $requisitions->sum('total_requisition_price') ?? 0;
        $system = SystemSetting::first();
        $vat = $system->value_added_tax;
        $vat_amount = ($total * $vat) / 100;
        $total_with_vat = $total + $vat_amount;


        return view('admin.pages.manage-client-payment.print',[
            'requisitions' => $requisitions,
            'total' => $total,
            'vat_amount' => $vat_amount,
            'total_with_vat' => $total_with_vat,
            'system' => $system,
            'vat' => $vat,
            'client' => request()->client != 'any' ? $client : 'any',
        ]);
        }else{
            $system = SystemSetting::first();
            $vat = $system->value_added_tax;
            $requisitions_groups = $requisitions->get()->groupBy('price_control_id');
            $total_of_total = 0;
            $total_of_total_orders = 0;
            $total_of_requistions_num = 0;
            $requisitions_collected =[];
            foreach ($requisitions_groups as $key => $value) {
                $place = PriceControl::find($key);
                $total = 0;
                $total_orders = 0;
                foreach ($requisitions_groups[$key] as $value2) {
                   $total += $value2->total_requisition_price;
                   $total_orders += $value2->number_of_orders;
                }
                $total_of_total += $total;
                $total_of_total_orders += $total_orders;
                $requistions_num = count($requisitions_groups[$key]);
                $total_of_requistions_num += $requistions_num;
                $vat_value = ($total * $vat / 100);
                $total_and_vat = $total + $vat_value;

                $requisitions_collected[] = ['place'=>$place,'total'=>$total,'vat_value'=>$vat_value,'total_and_vat'=>$total_and_vat,'total_orders'=>$total_orders,'requistions_num'=>$requistions_num];
            }

            $vat_amount = ($total * $vat) / 100;
            $total_with_vat = $total + $vat_amount;
            $vat_amount = ($total_of_total * $vat) / 100;
            $total_of_total_with_vat = $total_of_total + $vat_amount;

            $logo = count($system->getMedia()) > 0 ? $system->getMedia()->first()->getUrl() : null;
            return view('admin.pages.manage-client-payment.print-collected',[
                'requisitions_collected' => $requisitions_collected,
                'total' => $total_of_total,
                'vat_amount' => $vat_amount,
                'total_with_vat' => $total_of_total_with_vat,
                'vat' => $vat,
                'total_orders' => $total_of_total_orders,
                'total_of_requistions_num' => $total_of_requistions_num,
                'system' => $system,
                'client' => request()->client != 'any' ? $client : 'any',
            ]);

        }
    }

    public function ClientPay(Request $request){
        $requisitions = Requisition::where('client_id',$request->client)
        ->where('status',Requisition::DELIVERED)
        ->whereMonth('delivered_at',$request->month)
        ->get();
        foreach($requisitions as $requisition){
            $requisition->update(['is_paid' => 1]);
        }
        foreach(ClientPaymentNotification::where('client_id',$request->client)->get() as $notification){
            $notification->delete();
        }
        toastr()->success(__('admin.update_success_message'));
        return back();
    }


    public function Notify(Request $request){
        $requisitions = Requisition::where('client_id',$request->client)
        ->where('status',Requisition::DELIVERED)
        ->whereMonth('delivered_at',$request->month)
        ->get();
        foreach($requisitions as $requisition){
            ClientPaymentNotification::firstOrCreate([
                'requisition_id' => $requisition->id,
                'client_id' => $requisition->client_id,
            ]);
        }
        toastr()->success(__('admin.update_success_message'));
        return back();
    }

}
