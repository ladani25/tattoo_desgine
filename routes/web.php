<?php

use App\Http\Controllers\admincontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


route::get('adminlogin',[admincontroller::class,'adminlogin']);
route::post('login-uadmin',[admincontroller::class,'login']);
route::get('admin-dashboard',[admincontroller::class,'dashboard']);

route::get('admin-category',[admincontroller::class,'category']);
route::get('add_categeroy',[AdminController::class,'add_categeroy']);
route::post('get_categeroy',[AdminController::class,'get_categeroy']);
route::get('delete_categeroy/{id}',[AdminController::class,'delete_categeroy']);
route::get('c_edit/{id}',[AdminController::class,'c_edit']);
route::post('edit_c/{id}',[AdminController::class,'edit_c']);

route::get('admin-tattoo',[admincontroller::class,'tattoo']);
route::get('add_tattoo',[AdminController::class,'add_tattoo']);
route::post('get_tattoo',[AdminController::class,'get_tattoo']);
route::get('delete_tattoo/{id}',[AdminController::class,'delete_tattoo']);
route::get('t_edit/{t_id}',[AdminController::class,'t_edit']);
route::post('edit_t',[AdminController::class,'edit_t']);

route::get('serch',[AdminController::class,'serch']);