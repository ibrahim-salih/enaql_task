<?php

namespace App\Http\Controllers\Admin\SystemSetting;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SystemSettingController extends Controller
{
    public function index(){
        $system_setting = SystemSetting::first();
        // $logo = count($system_setting->getMedia('logo')) > 0 ? $system_setting->getMedia('logo')->first()->getUrl() : null;
        // $invoice_header = count($system_setting->getMedia('invoice_header')) > 0 ? $system_setting->getMedia('invoice_header')->first()->getUrl() : null;
        // $invoice_footer = count($system_setting->getMedia('invoice_footer')) > 0 ? $system_setting->getMedia('invoice_footer')->first()->getUrl() : null;
        return view('admin.pages.system-setting.index',compact('system_setting'));
    }

    public function update(Request $request){
        $system_setting = SystemSetting::first();

        $arr = [
            'system_name' => $request->system_name,
            'value_added_tax' => $request->value_added_tax,
            'address' => $request->address,
            'tax_number' => $request->tax_number,
            'bank_account_number' => $request->bank_account_number
        ];


        if ($request->hasFile('logo')) {
            $file = $request->logo;
            $getClientOriginalName = $file->getClientOriginalName();
            $filename = '/public/logo/' . time() . '.' . $getClientOriginalName;
            $file->move(public_path('/public/logo/'), $filename);
            $arr['logo'] = $filename;

        }
        if ($request->hasFile('banner_login')) {
            $file = $request->banner_login;
            $getClientOriginalName = $file->getClientOriginalName();
            $filename = '/public/banner_login/' . time() . '.' . $getClientOriginalName;
            $file->move(public_path('/public/banner_login/'), $filename);
            $arr['banner_login'] = $filename;

        }
        if ($request->hasFile('invoice_header')) {
            $file = $request->invoice_header;
            $getClientOriginalName = $file->getClientOriginalName();
            $filename = '/public/headers/' .time() . '.'.  $getClientOriginalName;
            $file->move(public_path('/public/headers/'), $filename);
            $arr['invoice_header'] = $filename;

        }
        if ($request->hasFile('invoice_footer')) {
            $file = $request->invoice_footer;
            $getClientOriginalName = $file->getClientOriginalName();
            $filename = '/public/footer/' .time() . '.' . $getClientOriginalName;
            $file->move(public_path('/public/footer/'), $filename);
            $arr['invoice_footer'] = $filename;

        }
        $system_setting->update($arr);
        // if($request->hasFile('logo')){
        //     $system_setting->clearMediaCollection('logo');
        //     $system_setting->addMedia($request->file('logo'))->toMediaCollection('logo');
        // }
        // if($request->hasFile('invoice_header')){
        //     $system_setting->clearMediaCollection('invoice_header');
        //     $system_setting->addMedia($request->file('invoice_header'))->toMediaCollection('invoice_header');
        // }
        // if($request->hasFile('invoice_footer')){
        //     $system_setting->clearMediaCollection('invoice_footer');
        //     $system_setting->addMedia($request->file('invoice_footer'))->toMediaCollection('invoice_footer');
        // }
        toastr()->success(__('admin.update_success_message'));
        return back();
    }
}
