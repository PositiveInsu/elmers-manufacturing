<?php

use App\Http\Controllers\Api\PublicFunctionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'api'], function(){
    Route::get('/public-function/digit-to-word/{locale}/{digit}', [PublicFunctionController::class, 'digitToWord']);
    Route::get('/public-function/hexadecimal-to-property/{hexadecimal}', [PublicFunctionController::class, 'hexadecimalToProperty']);
});
