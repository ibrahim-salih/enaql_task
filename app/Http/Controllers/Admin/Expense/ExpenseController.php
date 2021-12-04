<?php

namespace App\Http\Controllers\Admin\Expense;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Expense\StoreRequest;
use App\Models\Expense;
use App\Models\ExpenseData;
use App\Models\TripType;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Vendor;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['expense_category','vehicle','expense_date','trip_type','trip_number','actions'];
        return view('admin.pages.expense.index' , compact('columns'));
    }


    public function datatable(){
        return  datatables()->of(Expense::query())
        ->addColumn('vehicle' , function(Expense $Expense){
            return $Expense->Vehicle->name;
        })
        ->addColumn('trip_type' , function(Expense $Expense){
            return $Expense->trip_type;
        })
        ->addColumn('actions' , function(Expense $Expense){
            $actions = '';
            if(Auth::user()->can('edit_expense')){
                $actions .= Icon::Edit(route('admin.expense.edit' , $Expense->id));
            }
            if(Auth::user()->can('delete_expense')){
                $actions .= Icon::Delete(route('admin.expense.destroy' , $Expense->id));
            }
            return $actions;
        })
        ->rawColumns(['actions','requisition_for','vehicle','maintenance_type'])
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
        $vehicles = Vehicle::select(['name','id'])->get();
        $trip_types = TripType::get();
        $vendors = Vendor::get();
        $employees = User::role('employee')->get();
        return view('admin.pages.expense.create',[
            'vehicles' => $vehicles,
            'trip_types' => $trip_types,
            'vendors' => $vendors,
            'employees' => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $Expense = Expense::create([
            'expense_date'=> $request->expense_date,
            'trip_number'=> $request->trip_number,
            'expense_category'=> $request->expense_category,
            'odometer'=> $request->odometer,
            'invoice'=> $request->invoice,
            'rent_vehicle_cost'=> $request->rent_vehicle_cost,
            'remarks'=> $request->remarks,
            'grand_total'=> $request->grand_total,
            'vehicle_id'=> $request->vehicle,
            'trip_type'=> $request->trip_type,
            'vendor_id'=> $request->vendor,
            'employee'=> $request->by_whom,
        ]);
        $grand_total = 0;
        if(count($request->expense_name) > 0){
            for($i=0;$i<count($request->expense_name);$i++){
                $grand_total += $request->total_amount[$i];
                ExpenseData::create([
                    'name'=> $request->expense_name[$i],
                    'measurement_unit'=> $request->measurement_unit[$i],
                    'unit_price'=> $request->unit_price[$i],
                    'total_amount'=> $request->total_amount[$i],
                    'expense_id'=> $Expense->id,
                ]);
            }
        }
        if($Expense->grand_total !== $grand_total){
            $Expense->update(['grand_total' => $grand_total]);
        }
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.expense.index');
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
        $vehicles = Vehicle::select(['name','id'])->get();
        $trip_types = TripType::get();
        $vendors = Vendor::get();
        $employees = User::role('employee')->get();
        $Expense = Expense::findOrFail($id);
        $ExpenseData = $Expense->Data;
        return view('admin.pages.expense.edit',[
            'Expense' => $Expense,
            'ExpenseData' => $ExpenseData,
            'vehicles' => $vehicles,
            'trip_types' => $trip_types,
            'vendors' => $vendors,
            'employees' => $employees,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Expense = Expense::findOrFail($id);
        $Expense->update([
            'expense_date'=> $request->expense_date,
            'trip_number'=> $request->trip_number,
            'expense_category'=> $request->expense_category,
            'odometer'=> $request->odometer,
            'invoice'=> $request->invoice,
            'rent_vehicle_cost'=> $request->rent_vehicle_cost,
            'remarks'=> $request->remarks,
            'grand_total'=> $request->grand_total,
            'vehicle_id'=> $request->vehicle,
            'trip_type'=> $request->trip_type,
            'vendor_id'=> $request->vendor,
            'employee'=> $request->by_whom,
        ]);
        $grand_total = 0;
        if(count($request->expense_name) > 0){
            $Expense->Data()->delete();
            for($i=0;$i<count($request->expense_name);$i++){
                $grand_total += $request->total_amount[$i];
                ExpenseData::create([
                    'name'=> $request->expense_name[$i],
                    'measurement_unit'=> $request->measurement_unit[$i],
                    'unit_price'=> $request->unit_price[$i],
                    'total_amount'=> $request->total_amount[$i],
                    'expense_id'=> $Expense->id,
                ]);
            }
        }
        if($Expense->grand_total !== $grand_total){
            $Expense->update(['grand_total' => $grand_total]);
        }
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.expense.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Expense = Expense::findOrFail($id);
        $Expense->Data()->delete();
        $Expense->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
