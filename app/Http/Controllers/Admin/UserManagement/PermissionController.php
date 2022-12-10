<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{

    /* @author: Ayushi Raghuwanshi
       @desc: get permission listing
    */
    public function getLists(Request $request)
    {
        $permissions = Permission::latest()->paginate();
        return view('admin.user-management.permission.list', compact('permissions'));
    }

    /* @author: Ayushi Raghuwanshi
       @desc: add permission view
    */
    public function create()
    {
        return view('admin.user-management.permission.create');
    }

    /* @author: Ayushi Raghuwanshi
       @desc: insert or update permission
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        if ($request->get('id')) {
            $permission = Permission::find($request->get('id'));
            $msg = "Updated";
        } else {
            $permission = new Permission;
            $msg = "Created";
        }
        $permission->name   = $request->name;
        $permission->slug   = Str::slug($request->name);
        $permission->status = $request->status;
        $permission->save();

        return redirect()->route('admin.permission.list')->with('success', 'Permission has been ' . $msg . ' successfully.');
    }

    /* @author: Ayushi Raghuwanshi
       @desc: edit permission view
    */
    public function edit($id)
    {
        $permission = Permission::findorFail($id);
        return view('admin.user-management.permission.create', compact('permission'));
    }

    /* @author: Ayushi Raghuwanshi
       @desc: delete permission view
    */
    public function destroy($id)
    {
        $permission = Permission::findorFail($id);
        $permission->deleted_at = date('Y-m-d H:i:s');
        $permission->save();
        return redirect()->route('admin.permission.list')->with('success', 'Permission has been Deleted successfully.');
    }
}
