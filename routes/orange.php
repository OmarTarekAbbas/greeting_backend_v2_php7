<?php

use Illuminate\Support\Facades\Route;

Route::get('omar', 'Orange\OrangeController@landing_orange');
Route::post('/AddSubscriptionContractRequest', 'OrangeController@AddSubscriptionContractRequest_orange');
//comfirm pin
Route::post('/ConfirmPinCode', 'OrangeController@ConfirmPinCode_orange');
//unsub
Route::post('/unSubscribe_orange', 'OrangeController@unSubscribe_orange');
Route::get('/ConfirmeDirectPay', 'OrangeController@ConfirmeDirectPay_orange');
// Binarywaves cred
define('operatorCode', '60201');
define('ServiceId', '120');
define('ServiceAPIKey', '7TkVx0uqbb2FwiLAig1J');
define('ServiceAPIPassword', 'EmsVjLvLjSurmQrXUm9S');

//Initialize DirectPay
define('test_InitializeDirectPay_url', 'http://196.219.241.226:9094/DCBAPI/OneTimePay/InitializeDirectPay');
define('live_InitializeDirectPay_url', 'http://dc.binarywaves.com:8080/DCBAPI/OneTimePay/InitializeDirectPay');

//Confirm eDirectPay
define('test_ConfirmeDirectPay_url', 'http://196.219.241.226:9094/DCBAPI/OneTimePay/ConfirmDirectPay');
define('live_ConfirmeDirectPay_url', 'http://dc.binarywaves.com:8080/DCBAPI/OneTimePay/InitializeDirectPay');

// Initialize Subscribe
define('test_InitializeSubscribe_url', 'http://196.219.241.226:9094/DCBAPI/Subscribe/InitializeSubscribe');
define('live_InitializeSubscribe_url', 'http://dc.binarywaves.com:8080/DCBAPI/Subscribe/InitializeDirectPay');

// pin code confirm
define('test_VerifySubscribe_url', 'http://196.219.241.226:9094/DCBAPI/Subscribe/VerifySubscribePinCode');
define('live_VerifySubscribe_url', 'http://dc.binarywaves.com:8080/DCBAPI/Subscribe/VerifySubscribePinCode');

//unsubscribe
define('test_UnSubscribe_url', 'http://196.219.241.226:9094/DCBAPI/Subscribe/UnSubscribe');
define('live_UnSubscribe_url', 'http://dc.binarywaves.com:8080/DCBAPI/Subscribe/UnSubscribe');
