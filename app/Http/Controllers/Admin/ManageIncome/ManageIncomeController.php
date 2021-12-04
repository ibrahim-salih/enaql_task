<?php

namespace App\Http\Controllers\Admin\ManageIncome;

use App\Http\Controllers\Controller;
use App\Models\Requisition;
use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;

class ManageIncomeController extends Controller
{
    public function index(){
        $clients = User::role('client')->get();
        return view('admin.pages.manage-income.index',compact('clients'));
    }

    public function showIncome(Request $request){
        $requisitions = Requisition::where('status',Requisition::DELIVERED)
        ->where('is_paid',1);
        if(!is_null($request->from)){
            $requisitions = $requisitions->whereDate('delivered_at','>=',$request->from);
        }
        if(!is_null($request->to)){
            $requisitions = $requisitions->whereDate('delivered_at','<=',$request->to);
        }
        if($request->client != 'all'){
            $requisitions = $requisitions->where('client_id',$request->client);
        }
        $requisitions = $requisitions->get();
        $total = $requisitions->sum('total_requisition_price');
        $vat = SystemSetting::first()->value_added_tax;
        $vat_amount = ($total * $vat) / 100;
        $total_with_vat = $total + $vat_amount;
        return view('admin.pages.manage-income.show-income',compact('requisitions','total','vat','vat_amount','total_with_vat'));
    }

    public function printIncome(Request $request){
        $requisitions = Requisition::where('status',Requisition::DELIVERED)
        ->where('is_paid',1);
        if(!is_null($request->from)){
            $requisitions = $requisitions->whereDate('delivered_at','>=',$request->from);
        }
        if(!is_null($request->to)){
            $requisitions = $requisitions->whereDate('delivered_at','<=',$request->to);
        }
        if($request->client != 'all'){
            $requisitions = $requisitions->where('client_id',$request->client);
        }
        $requisitions = $requisitions->get();
        $total = $requisitions->sum('total_requisition_price');
        $system = SystemSetting::first();
        $vat = $system->value_added_tax;
        $vat_amount = ($total * $vat) / 100;
        $total_with_vat = $total + $vat_amount;
        $system_name = $system->system_name;
        $invoice_header = count($system->getMedia('invoice_header')) > 0 ? $system->getMedia('invoice_header')->first()->getUrl() : null;
        $invoice_footer = count($system->getMedia('invoice_footer')) > 0 ? $system->getMedia('invoice_footer')->first()->getUrl() : null;
        $system_address = $system->address;
        $system_tax_number = $system->tax_number;
        $logo = count($system->getMedia()) > 0 ? $system->getMedia()->first()->getUrl() : null;

        return view('admin.pages.manage-income.print',[
            'requisitions' => $requisitions,
            'total' => $total,
            'vat_amount' => $vat_amount,
            'total_with_vat' => $total_with_vat,
            'system_name' => $system_name,
            'system_address' => $system_address,
            'system_tax_number' => $system_tax_number,
            'logo' => $logo,
            'vat' => $vat,
            'invoice_header' => $invoice_header,
            'invoice_footer' => $invoice_footer,
        ]);
    }



}
