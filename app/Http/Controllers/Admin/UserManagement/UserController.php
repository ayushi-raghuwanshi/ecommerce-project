<?php

namespace App\Http\Controllers\admin\userManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->latest()->paginate();
        return view('admin.user-management.user.list', compact('users'));
    }

    /* @author: Ayushi Raghuwanshi
       @desc: add user view
    */
    public function create()
    {
        $roles = Role::where('status','Active')->get();
        return view('admin.user-management.user.create',compact('roles'));
    }

    /* @author: Ayushi Raghuwanshi
       @desc: insert or update user
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'password' =>  ['required|confirmed|min:6',Rule::excludeIf($request->id != null),],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($request->id)],
        ]);
        if ($request->get('id')) {
            $permission = User::find($request->get('id'));
            $msg = "Updated";
        } else {
            $permission = new User;
            $permission->password = Hash::make($request->password);
            $msg = "Created";
        }
        $permission->name   = $request->name;
        $permission->email   = $request->email;
        $permission->status = $request->status;
        $permission->role_id   = $request->role_id;
        $permission->save();

        return redirect()->route('admin.user.list')
        ->with('success', 'User has been ' . $msg . ' successfully.');
    }

    /* @author: Ayushi Raghuwanshi
       @desc: edit user view
    */
    public function edit($id)
    {
        $roles = Role::where('status','Active')->get();
        $user = User::findorFail($id);
        return view('admin.user-management.user.create', compact('user','roles'));
    }

    /* @author: Ayushi Raghuwanshi
       @desc: delete user view
    */
    public function destroy($id)
    {
        $permission = User::findorFail($id);
        $permission->deleted_at = date('Y-m-d H:i:s');
        $permission->save();
        return redirect()->route('admin.user.list')->with('success', 'User has been Deleted successfully.');
    }
}
