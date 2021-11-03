<?php

use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    if(Auth()->check()){
        return redirect('/dashboard');
    }else{  
        return view('home');
    }
    });

Route::group(['middleware' => ['auth']], function() {
    Route::get('/users',[UsersController::class,'index']);
    Route::get('/users/view-user/{id}',[UsersController::class,'view_user']);
    Route::get('/create-user',[UsersController::class,'create']);
    Route::post('/users/update-user',[UsersController::class,'updateUser']);
    Route::post('/create-user',[UsersController::class,'storeUser']);
    Route::get('/users/view-single-user/{id}',[UsersController::class,'view_single_user']);
    Route::get('/user/delete-request',[UsersController::class,'deleteUser']);

    Route::get('/manage-roles',[RolesController::class,'index']);
    Route::get('/add-roles',[RolesController::class,'roles']);
    Route::get('/add-roles/{id}',[RolesController::class,'viewRole']);
    Route::post('/edit-role',[RolesController::class,'editRole']);
    Route::post('/add-roles',[RolesController::class,'addroles']);
    Route::get('/view-roles/{id}',[RolesController::class,'view_single_role']);
    Route::get('/role/delete-request',[RolesController::class,'deleteRole']);
    Route::get('/logout',[UsersController::class,'logout']);
    Route::get('/dashboard',function(){return view('dashboard');})->name('dashboard');
    
    Route::get('/view-profile',function(){return view('users.manage-profile');});
    Route::post('/user/update-profile',[UsersController::class,'updateprofile']);
    
});
Route::post('sign-in',[UsersController::class,'login'])->middleware('guest');