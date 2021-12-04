<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Services\Icons\Icon;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Http\Requests\Admin\Role\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
//    function __construct()
//    {
//        $this->middleware('permission:role-list', ['only' => ['index']]);
//        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
//    }
//    public function index(Request $request)
//    {
//        $roles = Role::orderBy('id', 'DESC')->paginate(5);
//        return view('roles.index', compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
//    }
//    public function create()
//    {
//        $permission = Permission::get();
//        return view('roles.create', compact('permission'));
//    }
//    public function store(Request $request)
//    {
//        $this->validate($request, ['name' => 'required|unique:roles,name', 'permission' => 'required',]);
//        $role = Role::create(['name' => $request->input('name')]);
//        $role->syncPermissions($request->input('permission'));
//        return redirect()->route('roles.index')->with('success', 'Role created successfully');
//    }
//    public function show($id)
//    {
//        $role = Role::find($id);
//        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")->where("role_has_permissions.role_id", $id)->get();
//        return view('roles.show', compact('role', 'rolePermissions'));
//    }
//    public function edit($id)
//    {
//        $role = Role::find($id);
//        $permission = Permission::get();
//        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all();
//        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
//    }
//    public function update(Request $request, $id)
//    {
//        $this->validate($request, ['name' => 'required', 'permission' => 'required',]);
//        $role = Role::find($id);
//        $role->name = $request->input('name');
//        $role->save();
//        $role->syncPermissions($request->input('permission'));
//        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
//    }
//    public function destroy($id)
//    {
//        DB::table("roles")->where('id', $id)->delete();
//        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
//    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns = ['name', 'actions'];
        return view('admin.pages.role.index', compact('columns'));
    }


    public function datatable()
    {
        return datatables()->of(Role::query())
            ->addColumn('actions', function (Role $Role) {
                $actions = '';
                if (Auth::user()->can('edit_role')) {
                    $actions .= Icon::Edit(route('admin.role.edit', $Role->id));
                }
                // if(Auth::user()->can('delete_role')){
                //     $actions .= Icon::Delete(route('admin.role.destroy' , $Role->id));
                // }
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
        $Permissions = Permission::all();
        return view('admin.pages.role.create', compact('Permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);
        $role->givePermissionTo($request->permissions);
        toastr()->success(__('admin.store_success_message'));
        return redirect()->route('admin.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Role = Role::findOrFail($id);
        $Permissions = Permission::all();
        return view('admin.pages.role.edit', compact('Role', 'Permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $Role = Role::findOrFail($id);
        $Role->syncPermissions($request->permissions);
        // $Role->update(['name' => $request->name]);
        toastr()->success(__('admin.update_success_message'));
        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Role = Role::findOrFail($id);
        $Role->delete();
        return response()->json(__('admin.destroy_success_message'));
    }
}
