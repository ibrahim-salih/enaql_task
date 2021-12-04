<?php

namespace App\Http\Controllers\Admin\ClientPaymentNotification;

use App\Http\Controllers\Controller;
use App\Models\ClientPaymentNotification;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientPaymentNotificationController extends Controller
{
    public function index(){
        $client = Auth::user();
        $notifications = ClientPaymentNotification::where('client_id',$client->id)->get();
        $system = SystemSetting::first();
        $vat = $system->value_added_tax;
        return view('admin.pages.client-payment-notification.index',compact('notifications','vat',));
    }
}
