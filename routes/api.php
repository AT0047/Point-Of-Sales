<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('branches',[App\Http\Controllers\Api\Maincontroller::class ,'branches']);
Route::get('UserBranches',[App\Http\Controllers\Api\Maincontroller::class ,'UserBranches']);
Route::get('Add_Unit_Details',[App\Http\Controllers\Api\Maincontroller::class ,'Add_Unit_Details']);
Route::get('ItemsGroup',[App\Http\Controllers\Api\Maincontroller::class ,'ItemsGroup']);
Route::get('FItemD',[App\Http\Controllers\Api\Maincontroller::class ,'FItemD']);
Route::get('FItemD_BarCodes',[App\Http\Controllers\Api\Maincontroller::class ,'FItemD_BarCodes']);
Route::get('ItemPriceList',[App\Http\Controllers\Api\Maincontroller::class ,'ItemPriceList']);
Route::get('SalesProposalItems',[App\Http\Controllers\Api\Maincontroller::class ,'SalesProposalItems']);
Route::get('Ne_Cust',[App\Http\Controllers\Api\Maincontroller::class ,'Ne_Cust']);
Route::post('storeNewUser',[\App\Http\Controllers\Api\CustomerController::class,'storeNewUser']);
Route::get('getSettings',[\App\Http\Controllers\Api\CustomerController::class,'getSettings']);
Route::post('saveContactForm',[\App\Http\Controllers\Api\CustomerController::class,'saveContactForm']);
Route::post('login',[App\Http\Controllers\Api\LoginController::class ,'login']);
Route::post('code',[App\Http\Controllers\Api\LoginController::class ,'code']);
Route::get('ItemsGroupWithSubs/{level}',[App\Http\Controllers\Api\Maincontroller::class ,'ItemsGroupWithSubs']);
Route::get('ItemsByCategory/{category}',[App\Http\Controllers\Api\Maincontroller::class ,'FItemDByGroup']);