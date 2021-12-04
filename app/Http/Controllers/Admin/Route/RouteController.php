<?php

namespace App\Http\Controllers\Admin\Route;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Route\StoreRequest;
use App\Http\Requests\Admin\Route\UpdateRequest;
use App\Models\Route;
use App\Services\Icons\Icon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name','start_point','destination','description','is_active','actions'];
        return view('admin.pages.route.index' , compact('columns'));
    }


    public function datatable(){
        return  datatables()->of(Route::query())
        ->addColumn('actions' , function(Route $Route){
            $actions = '';
            if(Auth::user()->can('edit_route')){
                $actions .= Icon::Edit(route('admin.route.edit' , $Route->id));
            }
            if(Auth::user()->can('delete_route')){
                $actions .= Icon::Delete(route('admin.route.destroy' , $Route->id));
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
        return view('admin.pages.route.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Route::create([
           'name'=> $request->name,
           'start_point'=> $request->start_point,
           'destination'=> $request->destination,
           'description'=> $request->description,
           'is_active'=> $request->is_active == null ? 0 : 1,
           'pick_drop_point'=> $request->pick_drop_point == null ? 0 : 1
        ]);
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.route.index');
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
        $route = Route::findOrFail($id);
        return view('admin.pages.route.edit' , compact('route'));
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
        $route = Route::findOrFail($id);
        $route->update([
            'name'=> $request->name,
            'start_point'=> $request->start_point,
            'destination'=> $request->destination,
            'description'=> $request->description,
            'is_active'=> $request->is_active == null ? 0 : 1,
            'pick_drop_point'=> $request->pick_drop_point == null ? 0 : 1
        ]);
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.route.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $route = Route::findOrFail($id);
        $route->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
