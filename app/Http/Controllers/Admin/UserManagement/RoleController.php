<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{

    public function lists(Request $request)
    {
        $roles = Role::withCount('users')->with(['permissions'])->latest()->paginate();
        return view('admin.user-management.role.list', compact('roles'));
    }


    /* @author: Ayushi Raghuwanshi
       @desc: add role view
    */
    public function create()
    {
        $permissions = Permission::where('status', 'Active')->get();
        return view('admin.user-management.role.create', compact('permissions'));
    }

    /* @author: Ayushi Raghuwanshi
       @desc: insert or update role
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($request->get('id')) {
            $role = Role::find($request->get('id'));
            $msg = "Updated";
        } else {
            $role = new Role;
            $msg = "Created";
        }
        $role->name   = $request->name;
        $role->slug   = Str::slug($request->name);
        $role->status = $request->status;
        $role->save();
        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.role.list')->with('success', 'Roles has been ' . $msg . ' successfully.');
    }

    /* @author: Ayushi Raghuwanshi
       @desc: edit role view
    */
    public function edit($id)
    {
        $role = Role::with('permissions')->findorFail($id);
        $permissions = Permission::where('status', 'Active')->get();
        return view('admin.user-management.role.create', compact('role', 'permissions'));
    }

    /* @author: Ayushi Raghuwanshi
       @desc: delete role view
    */
    public function destroy($id)
    {
        $role = Role::findorFail($id);
        $role->deleted_at = date('Y-m-d H:i:s');
        $role->save();
        return redirect()->route('admin.role.list')->with('success', 'Data has been Deleted successfully.');
    }

    public function permanenetDestroy($id)
    {
        $role = Role::findorFail($id);
        $role->permissions()->detach();
        $role->delete();
        return redirect()->route('admin.role.list')->with('success', 'Data has been Deleted successfully.');
    }
}
