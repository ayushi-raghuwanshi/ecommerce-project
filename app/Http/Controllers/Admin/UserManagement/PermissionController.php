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
    public function getPermissionList(Request $request)
    {
        $permission = Permission::latest()->paginate(2);
        return view('admin.user-management.permission')->with('permissionData',$permission);
    }

    /* @author: Ayushi Raghuwanshi
       @desc: add permission view
    */
    public function addPermission()
    {
        return view('admin.user-management.add_permission');
    }

    /* @author: Ayushi Raghuwanshi
       @desc: insert or update permission
    */
    public function storePermission(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);
        $slug = Str::slug($request->name);
        if($request->has('id')){
            $permission = Permission::find($request->get('id'));
            $msg = "Updated";
        }else{
            $permission = new Permission;
            $msg = "Created";
        }
        $permission->name = $request->name;
        $permission->slug = $slug;
        $permission->status = $request->status;
        $permission->save();
        
        return redirect()->route('getPermissionList')->with('success','Permission has been '.$msg.' successfully.');
    }

    /* @author: Ayushi Raghuwanshi
       @desc: edit permission view
    */
    public function editPermission($id)
    {
        $permission = Permission::findorFail($id);
        return view('admin.user-management.add_permission')->with('permission',$permission);
    }

    /* @author: Ayushi Raghuwanshi
       @desc: delete permission view
    */
    public function deletePermission($id)
    {
        $permission = Permission::findorFail($id);
        $permission->deleted_at = date('Y-m-d H:i:s');
        $permission->save();
        return redirect()->route('getPermissionList')->with('success','Permission has been Deleted successfully.');
    }
}
