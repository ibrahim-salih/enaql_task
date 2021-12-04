<?php

namespace App\Http\Controllers\Admin\Insurance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Insurance\StoreRequest;
use App\Http\Requests\Admin\Insurance\UpdateRequest;
use App\Models\Company;
use App\Models\Insurance;
use App\Models\Vehicle;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['company','vehicle','policy_number','charge_payable','actions'];
        return view('admin.pages.insurance.index' , compact('columns'));
    }


    public function datatable(){
        return  datatables()->of(Insurance::query())
        ->addColumn('company' , function(Insurance $Insurance){
            return $Insurance->company->name;
        })
        ->addColumn('vehicle' , function(Insurance $Insurance){
            return $Insurance->vehicle->name;
        })
        ->addColumn('actions' , function(Insurance $Insurance){
            $actions = '';
            if(Auth::user()->can('edit_insurance')){
                $actions .= Icon::Edit(route('admin.insurance.edit' , $Insurance->id));
            }
            if(Auth::user()->can('delete_insurance')){
                $actions .= Icon::Delete(route('admin.insurance.destroy' , $Insurance->id));
            }
            return $actions;
        })
        ->rawColumns(['actions','company','vehicle'])
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
        $companies = Company::all();
        $vehicles = Vehicle::select(['id','name'])->get();
        return view('admin.pages.insurance.create',[
            'companies' => $companies,
            'vehicles' => $vehicles,
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
        $Insurance = Insurance::create([
            'policy_number' => $request->policy_number,
            'charge_payable' => $request->charge_payable,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'recurring_period' => $request->recurring_period,
            'recurring_date' => $request->recurring_date,
            'reminder' => $request->reminder == 'on' ? 1 : 0,
            'status' => $request->status == 'on' ? 1 : 0,
            'deductible'=> $request->deductible,
            'remarks'=> $request->remarks,
            'company_id'=> $request->company,
            'vehicle_id'=> $request->vehicle,
        ]);
        if($request->hasFile('policy_document')){
            $Insurance->addMedia($request->file('policy_document'))
            ->toMediaCollection();
        }
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.insurance.index');
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
        $insurance = Insurance::findOrFail($id);
        $companies = Company::all();
        $vehicles = Vehicle::select(['id','name'])->get();
        count($insurance->getMedia()) > 0 ? $document = $insurance->getMedia()[0]->getUrl() : $document = null;
        return view('admin.pages.insurance.edit',[
            'insurance' => $insurance,
            'companies' => $companies,
            'vehicles' => $vehicles,
            'document' => $document
        ]);

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
        $Insurance = Insurance::findOrFail($id);
        $Insurance->update([
            'policy_number' => $request->policy_number,
            'charge_payable' => $request->charge_payable,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'recurring_period' => $request->recurring_period,
            'recurring_date' => $request->recurring_date,
            'reminder' => $request->reminder == 'on' ? 1 : 0,
            'status' => $request->status == 'on' ? 1 : 0,
            'deductible'=> $request->deductible,
            'remarks'=> $request->remarks,
            'company_id'=> $request->company,
            'vehicle_id'=> $request->vehicle,
        ]);
        if($request->hasFile('policy_document')){
            $Insurance->clearMediaCollection();
            $Insurance->addMedia($request->file('policy_document'))
            ->toMediaCollection();
        }
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.insurance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Insurance = Insurance::findOrFail($id);
        $Insurance->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
