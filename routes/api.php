<?php

use App\Http\Controllers\api\ApiAuthController;
use App\Http\Controllers\api\ApiNoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//auth route
Route::post('user/register', [ApiAuthController::class,'registerUser']);
Route::post('user/login', [ApiAuthController::class,'loginUser']);

Route::group(['middleware'=>'auth:sanctum'],function(){

    //notes
    Route::apiResource('note',ApiNoteController::class);

});