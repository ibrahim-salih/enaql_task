<?php

namespace App\Http\Controllers\Admin\Part;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Part\StoreRequest;
use App\Models\Location;
use App\Models\Part;
use App\Models\PartCategory;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','description','category','stock_limit','location','actions'];
        return view('admin.pages.part.index',compact('columns'));
    }

    public function datatable(){
        return  datatables()->of(Part::query())
        ->addColumn('category' , function(Part $Part){
            return $Part->Category->name;
        })
        ->addColumn('location' , function(Part $Part){
            return $Part->Location->name;
        })
        ->addColumn('actions' , function(Part $Part){
            $actions = '';
            if(Auth::user()->can('edit_part')){
                $actions .= Icon::Edit(route('admin.part.edit' , $Part->id));
            }
            if(Auth::user()->can('delete_part')){
                $actions .= Icon::Delete(route('admin.part.destroy' , $Part->id));
            }
            return $actions;
        })
        ->rawColumns(['actions','category','location'])
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
        $categories = PartCategory::get();
        $locations = Location::get();
        return view('admin.pages.part.create' , compact('categories','locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Part::create([
            'name' => $request->name,
            'description' => $request->description,
            'stock_limit' => $request->stock_limit,
            'remarks' => $request->remarks,
            'is_active' => $request->is_active,
            'category_id' => $request->category,
            'location_id' => $request->location,
        ]);
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.part.index');
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
        $part = Part::findOrFail($id);
        $categories = PartCategory::get();
        $locations = Location::get();
        return view('admin.pages.part.edit' , compact('categories','locations','part'));
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
        $part = Part::findOrFail($id);
        $part->update([
            'name' => $request->name,
            'description' => $request->description,
            'stock_limit' => $request->stock_limit,
            'remarks' => $request->remarks,
            'is_active' => $request->is_active,
            'category_id' => $request->category,
            'location_id' => $request->location,
        ]);
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.part.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $part = Part::findOrFail($id);
        $part->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
