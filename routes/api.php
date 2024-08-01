<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiControllers;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('about', [ApiControllers::class,'about']);
route::get('privecypolice', [ApiControllers::class,'privecypolice']);

route::get('categeroy', [ApiControllers::class,'categeroy']);
route::post('add_categeroy', [ApiControllers::class,'add_categeroy']);
route::post('edit_categeroy/{id}', [ApiControllers::class,'edit_categeroy']);
route::get('delete_categeroy/{id}', [ApiControllers::class,'delete_categeroy']);

route::get('tattoo', [ApiControllers::class,'tattoo']);
route::post('add_tattoo', [ApiControllers::class,'add_tattoo']);

route::post('edit_tattoo/{id}', [ApiControllers::class,'edit_tattoo']);
route::get('delete_tattoo/{id}', [ApiControllers::class,'delete_tattoo']);

Route::post('category', [ApiControllers::class,'categoryList']);
Route::get('latest-tattoo', [ApiControllers::class, 'lastetatoo']);
route::get('traddingtatoo',[ApiControllers::class,'traddingtatoo']);