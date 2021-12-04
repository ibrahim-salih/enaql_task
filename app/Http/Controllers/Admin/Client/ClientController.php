<?php

namespace App\Http\Controllers\Admin\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\StoreRequest;
use App\Http\Requests\Admin\Client\UpdateRequest;
use App\Models\ClientData;
use App\Models\User;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','email','actions'];
        return view('admin.pages.client.index' , compact('columns'));
    }


    public function datatable(){
        return  datatables()->of(User::role('client')->get())
        ->addColumn('actions' , function(User $User){
            $actions = '';
            if(Auth::user()->can('edit_client')){
                $actions .= Icon::Edit(route('admin.client.edit' , $User->id));
            }
            if(Auth::user()->can('delete_client')){
                $actions .= Icon::Delete(route('admin.client.destroy' , $User->id));
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
        return view('admin.pages.client.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email ?? 'client' . rand() . '@enaql.com',
            'password' => Hash::make($request->password) ,
        ]);
        $user->assignRole('client');
        ClientData::create([
            'bank_account_number' => $request->bank_account_number,
            'client_id' => $user->id,
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'commercial_number' => $request->commercial_number,
            'address' => $request->address,
            'has_account' => $request->has_account ?? 0
        ]);
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.client.index');
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
        $user = User::findOrFail($id);
        return view('admin.pages.client.edit',compact('user'));
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
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email ?? 'client' . rand() . '@enaql.com',
        ]);
        if($request->password){
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        $client_data = $user->ClientData;
        $client_data->update([
            'bank_account_number' => $request->bank_account_number,
            'company_name' => $request->company_name,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'commercial_number' => $request->commercial_number,
            'address' => $request->address,
            'has_account' => $request->has_account ?? 0
        ]);
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.client.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = User::findOrFail($id);
        $client->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
