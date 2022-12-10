<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{

    public function lists(Request $request)
    {
        $roles = Role::latest()->paginate(2);
        return view('admin.user-management.role.list', compact('roles'));
    }


    /* @author: Ayushi Raghuwanshi
       @desc: add role view
    */
    public function create()
    {
        return view('admin.user-management.role.create');
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

        return redirect()->route('admin.role.list')->with('success', 'Roles has been ' . $msg . ' successfully.');
    }

    /* @author: Ayushi Raghuwanshi
       @desc: edit role view
    */
    public function edit($id)
    {
        $role = Role::findorFail($id);
        return view('admin.user-management.role.create', compact('role'));
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
}
