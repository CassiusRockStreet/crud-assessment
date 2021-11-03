<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    function index(){
        if(Auth::check() && Auth::user()->userrole->is_admin !=null){
            $Roles = new Role();
            $allRoles = $Roles->all();
            return view('users.user-roles', compact('allRoles'));
        }else{
            return redirect('/dashboard');
        }
    }

    function addroles(Request $request){
        
        $validate = $request->validate([
            "role"=>"required|unique:role|alpha|min:4",
            "length"=>"required"
        ]);

        $role = new Role();
        $role->role = $request->role;
        $role->numbers = $request->numbers ? : Null;
        $role->length = $request->length;
        $role->is_admin =$request->is_admin ? : Null;
        $saveData = $role->save();
        if($saveData){return redirect()->back()->with("message", "Role Successfully added.");}
    }

    function viewRole($roleId){
        if(Auth::check() && Auth::user()->userrole->is_admin !=null){
            $role = new Role(); 
            $viewRole = $role->find($roleId);
            $caption ="Edit Role";
            return view('users.add-user-role',compact('viewRole','caption'));
        }else{
            return redirect('/dashboard');
        }
    }
    function view_single_role($roleId){
        if(Auth::check() && Auth::user()->userrole->is_admin !=null){
            $role = new Role(); 
            $viewRole = $role->find($roleId);
            return view('users.view-single-role',compact('viewRole'));
        }else{
            return redirect('/dashboard');
        }
    }
    function editRole(Request $request){

        $validate = $request->validate([
            "role"=>"required|alpha|min:4",
            "length"=>"required"
        ]);
        $role = new Role();
        $attr = [ "role"=>$request->role, 
            "length"=>$request->length,
            "is_admin"=>$request->is_admin ? : Null]; 

        $updateData = $role::where('id',$request->id)->update($attr); 
        if($updateData){return redirect()->back()->with("message", "Role Successfully Updated.");}

    }

    function deleteRole(Request $request){
        if(Auth::check() && Auth::user()->userrole->is_admin !=null){
            $id = $request->role_id;
            $Role = new Role();
            $delete = $Role::where('id',$id)->delete();
            if($delete){
                return response()->json(['success'=>'Role successfully deleted.']);
            }else{
                return response()->json(['Fail'=>'An error occured deleting role']);
            }
        }else{
            return redirect('/dashboard');
        }
    }

    function roles(){
        if(Auth::check() && Auth::user()->userrole->is_admin !=null){
            return view('users.add-user-role',);
        }else{
            return redirect('/dashboard');
        }
    }

}
