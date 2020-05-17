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

/*****************Mobily Binary*****************/
define('MobilyServiceId','102');
define('PartnerCode','1852ue');

/************notification************/
Route::post('notification/mo/{PartnerCode}','MobilyController@notificationMO');
Route::post('notification/user-optin/{PartnerCode}','MobilyController@notificationOptIn');
Route::post('notification/user-optout/{PartnerCode}','MobilyController@notificationOptOut');
Route::post('notification/user-renewed/{PartnerCode}','MobilyController@notificationRenewed');
/*****************Mobily Binary*******************/


 // get link for ooredoo Qutar
Route::get('rotana_timwe_get_lastest_url','TimweController@rotana_timwe_get_lastest_url');


