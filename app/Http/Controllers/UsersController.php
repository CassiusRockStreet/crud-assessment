<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UsersController extends Controller
{   
    protected $users;
    protected $roles;
    
    function __construct()
    {
        $this->users = new User();
        $this->roles = new Role();

    }
    
    function index(){
        if(Auth::check() && Auth::user()->userrole->is_admin == 'on'){
            $allUsers = $this->users->all();
            return view('users.view-all-users',['users'=>$allUsers]);
        }else{
            return redirect('/dashboard');
        }   
    }

    function create(){
        if(Auth::check() && Auth::user()->userrole->is_admin !=null){
            $allRoles = $this->roles->all();
            return view('users.create-user',compact('allRoles'));
        }else{
            return redirect('/dashboard');
        }
    }

    function storeUser(Request $request){
        $length = 4;
        if($request->Role !=null){
            $roleData = $this->roles->find($request->Role);
            $length = $roleData->length;
        }
            $validate = $request->validate([
                    "Name"=>"required|alpha|min:4",
                    "Lastname"=>"required|alpha|min:4",
                    "Username"=>"required|min:4|unique:users",
                    "Email"=>"required|email:rfc,dns|unique:users",
                    "Role"=>"required",
                    "Password"=>["required","confirmed",Password::min($length)->mixedCase()
                    ->numbers()]
            ]); 
            
            $user = new User();
            $user->name = $request->Name;
            $user->lastname = $request->Lastname;
            $user->role = $request->Role;
            $user->username = $request->Username;
            $user->email = $request->Email;
            $user->role = $request->Role;
            $user->createdBy = 1;
            $user->password = bcrypt($request->Password);
            $user->save();

        return redirect()
            ->back()
            ->with("success","User successfully added.");
    } 

    function view_user($id){
        if(Auth::check() && Auth::user()->userrole->is_admin !=null){
            $User = $this->users->find($id);
            $allRoles = $this->roles->all();
            $title = "Edit user";
            return view('users.create-user',compact('User','title','allRoles'));
        }else{
            return redirect('/dashboard');
        }
        
    }
    function view_single_user($id){
        if(Auth::check() && Auth::user()->userrole->is_admin !=null){
            $User = $this->users->find($id);
            $allRoles = $this->roles->all();
            return view('users.view-single-user',compact('User','allRoles'));
        }else{
            return redirect('/dashboard');
        }
    }
    
    function updateprofile(Request $request){
        $length = 4;
        if($request->password !=null){
            $roleData = $this->roles->find($request->Role);
            $length = $roleData->length;
        }

        $validate = $request->validate([
            "Name"=>"required|alpha|min:4",
            "Lastname"=>"required|alpha|min:4",
            "Username"=>"required|min:4",
            "Email"=>"required|email:rfc,dns",
            "Password"=>["required","confirmed",Password::min($length)->mixedCase()
            ->numbers()]
        ]);
        $recordUpdate = ["name"=>$request->Name,
                "lastname"=>$request->Lastname,
                "username"=>$request->Username,
                "email"=>$request->Email];
        if($request->Password !=null){
            $recordUpdate += ["password"=>bcrypt($request->Password)];
        }
        if($request->Role != null){ 
            $recordUpdate += ["role"=>$request->Role];
        }
        $user = new User();
        $UpdateUser = $user::where('id',Auth::user()->id)->update($recordUpdate);
        if($UpdateUser){
            return redirect()
                ->back()
                ->with('success','User successfully updated.');
        } 
    }

    function updateUser(Request $request){
        
        if($request->Role !=null){
            $roleData = $this->roles->find($request->Role);
            $length = $roleData->length;   
        }else{
            $length = 4;
        }
        if($request->Password != null){
            $validate = $request->validate([
                "Name"=>"required|alpha|min:4",
                "Lastname"=>"required|alpha|min:4",
                "Username"=>"required|min:4",
                "Email"=>"required|email:rfc,dns",
                "Password"=>["required","confirmed",Password::min($length)->mixedCase()
                ->numbers()]
            ]);
        }else{
            $validate = $request->validate([
                "Name"=>"required|alpha|min:4",
                "Lastname"=>"required|alpha|min:4",
                "Username"=>"required|min:4",
                "Email"=>"required|email:rfc,dns"
            ]);
        }

        $recordUpdate = ["name"=>$request->Name,
                "lastname"=>$request->Lastname,
                "username"=>$request->Username,
                "email"=>$request->Email];
        if($request->Password !=null){
            $recordUpdate += ["password"=>bcrypt($request->Password)];
        }
        if($request->Role != null){ 
            $recordUpdate += ["role"=>$request->Role];
        }
        $user = new User();
        $UpdateUser = $user::where('id',$request->id)->update($recordUpdate);

        if($UpdateUser){
            return redirect()
                ->back()
                ->with('success','User successfully updated.');
        } 
    }
    function deleteUser(Request $request){
        if(Auth::check() && Auth::user()->userrole->is_admin !=null){
            $id = $request->user_id;
            $user = new User();
            $delete = $user::where('id',$id)->delete();
            if($delete){
                return response()->json(['success'=>'User successfully deleted.']);
            }else{
                return response()->json(['Fail'=>'An error occured deleting user']);
            }
        }else{
            return redirect('/dashboard');
        }
    }

    function login(Request $request){
        if(Auth::check()){
            return redirect('/dashboard');
        }else{
            $validate = $request->validate([
                "username"=>"required|min:4",
                "password"=>"required"
            ]);
            if(auth::attempt($validate)){
                return redirect('/dashboard');
            }else{
                return redirect()
                    ->back()
                    ->withErrors("Invalid Username/password.");
            }
        }
    }
    function logout(){
        Auth::logout();        
        return redirect('/');
    }
}

