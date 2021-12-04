<?php

namespace App\Http\Controllers\Admin\DriverPerformance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DriverPerformance\StoreRequest;
use App\Http\Requests\Admin\DriverPerformance\UpdateRequest;
use App\Models\DriverPerformance;
use App\Models\User;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;

class DriverPerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['driver_name','penalty_amount','overtime_payment','performance_bonus','actions'];
        return view('admin.pages.driver-performance.index' , compact('columns'));
    }

    public function datatable(){
        return  datatables()->of(DriverPerformance::query())
        ->addColumn('driver_name' , function(DriverPerformance $DriverPerformance){
            return $DriverPerformance->driver->name;
        })
        ->addColumn('actions' , function(DriverPerformance $DriverPerformance){
            $actions = Icon::Edit(route('admin.driver-performance.edit' , $DriverPerformance->id));
            $actions .= Icon::Delete(route('admin.driver-performance.destroy' , $DriverPerformance->id));
            return $actions;
        })
        ->rawColumns(['actions','driver_name'])
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
        $drivers = User::role('driver')->get();
        return view('admin.pages.driver-performance.create',compact('drivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        DriverPerformance::create([
            'penalty_amount'=> $request->penalty_amount,
            'over_time_status'=> $request->over_time_status,
            'salary_status'=> $request->salary_status,
            'overtime_payment'=> $request->overtime_payment,
            'penalty_date'=> $request->penalty_date,
            'performance_bonus'=> $request->performance_bonus,
            'driver_id'=> $request->driver,
            'penalty_reason' => $request->penalty_reason
        ]);
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.driver-performance.index');
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
        $performance = DriverPerformance::findOrFail($id);
        $drivers = User::role('driver')->get();
        return view('admin.pages.driver-performance.edit',compact('performance','drivers'));
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
        $performance = DriverPerformance::findOrFail($id);
        $performance->update([
            'penalty_amount'=> $request->penalty_amount,
            'over_time_status'=> $request->over_time_status,
            'salary_status'=> $request->salary_status,
            'overtime_payment'=> $request->overtime_payment,
            'penalty_date'=> $request->penalty_date,
            'performance_bonus'=> $request->performance_bonus,
            'driver_id'=> $request->driver,
            'penalty_reason' => $request->penalty_reason
        ]);
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.driver-performance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $performance = DriverPerformance::findOrFail($id);
        $performance->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
