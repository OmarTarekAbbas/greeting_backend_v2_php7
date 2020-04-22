<?php

use Illuminate\Http\Request;

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

/*****************start*****************/



/************notification************/
Route::post('notification/mo/{PartnerCode}','MobilyController@notificationMO');
Route::post('notification/user-optin/{PartnerCode}','MobilyController@notificationOptIn');
Route::post('notification/user-optout/{PartnerCode}','MobilyController@notificationOptOut');
Route::post('notification/user-renewed/{PartnerCode}','MobilyController@notificationRenewed');
/*****************end*******************/