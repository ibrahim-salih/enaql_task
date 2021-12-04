<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Account\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function index(){
        $user = Auth::user();
        $is_admin = $user->hasRole('admin');
        $is_employee = $user->hasRole('employee ');
        $is_driver = $user->hasRole('admin');
        // $profile_photo = count($user->getMedia('profile_photo')) > 0 ? $user->getMedia('profile_photo')->first()->getUrl('profile_photo') : null;
        return view('admin.pages.account.index' , [
            'user' => $user,
            // 'profile_photo' => $profile_photo,
            'is_admin' => $is_admin,
            'is_employee' => $is_employee,
            'is_driver' => $is_driver,
        ]);
    }

    public function update(UpdateRequest $request){
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->update(['password' => Hash::make($request->password)]);
        }
        // if($request->hasFile('profile_photo')){
        //     $user->clearMediaCollection('profile_photo');
        //     $user->addMedia($request->file('profile_photo'))->toMediaCollection('profile_photo');
        // }
        if ($request->hasFile('profile_photo')) {
               $file = $request->file('profile_photo');
                $getClientOriginalName = $file->getClientOriginalExtension();
                $filename = '/files/profile/' .time() . '-profile.' . $getClientOriginalName;
                $file->move(public_path('/files/profile/'), $filename);
                $user->profile = $filename;
            }
            $user->save();
            toastr()->success(__('admin.update_success_message'));
        return back();
    }
}
