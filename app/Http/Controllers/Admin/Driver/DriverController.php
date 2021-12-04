<?php

namespace App\Http\Controllers\Admin\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Driver\StoreRequest;
use App\Http\Requests\Admin\Driver\UpdateRequest;
use App\Models\DriverData;
use App\Models\LicenseType;
use App\Models\User;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Driver\Driver;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','mobile','license_number','residency_number','health_insurance_date','actions'];
        return view('admin.pages.driver.index' , compact('columns'));
    }


    public function datatable(){
        return  datatables()->of(User::role('driver')->get())
        ->addColumn('mobile' , function(User $User){
            return $User->DriverData->mobile ?? '';
        })
        ->addColumn('license_number' , function(User $User){
            return $User->DriverData->license_number ?? '';
        })
        ->addColumn('residency_number' , function(User $User){
            return $User->DriverData->residency_number ?? '';
        })
        ->addColumn('health_insurance_date' , function(User $User){
            return $User->DriverData->health_insurance_date ?? '';
        })
        ->addColumn('actions' , function(User $User){
            $actions = '';
            if(Auth::user()->can('edit_driver')){
                $actions .= Icon::Edit(route('admin.driver.edit' , $User->id));
            }
            if(Auth::user()->can('delete_driver')){
                $actions .= Icon::Delete(route('admin.driver.destroy' , $User->id));
            }
            return $actions;
        })
        ->rawColumns(['actions','license_number','residency_number','health_insurance_date','mobile'])
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
        $license_types = LicenseType::all();
        return view('admin.pages.driver.create' , compact('license_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $Driver = User::create([
            'name' => $request->name,
            'email' => $request->email ?? 'driver' . rand() . '@enaql.com',
            'password' => Hash::make('123456789'),
        ]);
        $Driver->assignRole('driver');
        DriverData::create([
            'mobile'=> $request->mobile,
            'health_insurance_date'=> $request->health_insurance_date,
            'residency_number'=> $request->residency_number,
            'residency_expiration_date' => $request->residency_expiration_date,
            'license_expiration_date' => $request->license_expiration_date,
            'passport_expiration_date' => $request->passport_expiration_date,
            'passport_number' => $request->passport_number,
            'date_of_birth'=> $request->date_of_birth,
            'leave_status'=> $request->leave_status,
            'is_active'=> $request->is_active == 'on' ? 1 : 0,
            'email' => $request->email,
            'driver_id'=> $Driver->id,
            'bank_account_number' => $request->bank_account_number,
            'license_number' => $request->license_number,
            'license_type_id' => $request->license_type_id,
        ]);
        if($request->hasFile('driver_photograph')){
            $Driver->addMedia($request->file('driver_photograph'))
            ->toMediaCollection('driver_photograph');
        }
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.driver.index');
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
        $driver = User::findOrFail($id);
        $driver_data = $driver->DriverData;
        count($driver->getMedia('driver_photograph')) > 0 ? $driver_photograph = $driver->getMedia('driver_photograph')[0]->getUrl('driver_photograph') : $driver_photograph = null;
        $license_types = LicenseType::all();
        return view('admin.pages.driver.edit' , compact('driver' , 'license_types','driver_data','driver_photograph'));
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
        $driver = User::findOrFail($id);
        $driver_data = $driver->DriverData;
        $driver->update([
            'name' => $request->name,
            'email' => $request->email ?? 'driver' . rand() . '@enaql.com'
        ]);
        $driver_data->update([
            'mobile'=> $request->mobile,
            'health_insurance_date'=> $request->health_insurance_date,
            'residency_number'=> $request->residency_number,
            'residency_expiration_date' => $request->residency_expiration_date,
            'license_expiration_date' => $request->license_expiration_date,
            'passport_expiration_date' => $request->passport_expiration_date,
            'passport_number' => $request->passport_number,
            'date_of_birth'=> $request->date_of_birth,
            'leave_status'=> $request->leave_status,
            'is_active'=> $request->is_active == 'on' ? 1 : 0,
            'email' => $request->email,
            'bank_account_number' => $request->bank_account_number,
            'license_number' => $request->license_number,
            'license_type_id' => $request->license_type_id,
        ]);
        if($request->hasFile('driver_photograph')){
            $driver->clearMediaCollection('driver_photograph');
            $driver->addMedia($request->file('driver_photograph'))
            ->toMediaCollection('driver_photograph');
        }
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.driver.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Driver = User::findOrFail($id);
        $Driver->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
