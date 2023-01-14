<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authcontroller;
use App\Http\Controllers\dashboardcontroller;

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

Route::get('/', [authcontroller::class,'login']);
Route::get('/forgetpassword', [authcontroller::class,'forgetpassword']);
Route::post('auth', [authcontroller::class,'auth']);
Route::get('/dashboard', [dashboardcontroller::class,'index']);
Route::get('logout', [authcontroller::class,'logout']);
Route::get('profile', [dashboardcontroller::class,'profile']);
Route::post('changeprofile', [dashboardcontroller::class,'changeprofile']);
Route::get('chdriskform',[dashboardcontroller::class,'chdriskform']);
Route::get('/listpatient',[dashboardcontroller::class,'listpatient']);