<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
 */


/* ------------ start orange ------------ */

Route::get('landing_rotana', 'KsaController@landing_rotana');

Route::get('/orange_landing', 'OrangeController@landing_orange');
Route::get('/orange_landing_he', 'OrangeController@landing_orange_he');
Route::get('/Orange_unsub', 'OrangeController@unsub_or');

//sub
Route::post('/AddSubscriptionContractRequest', 'OrangeController@AddSubscriptionContractRequest_orange');

//comfirm pin
Route::post('/ConfirmPinCode', 'OrangeController@ConfirmPinCode_orange');
Route::post('/ReSendPinCode', 'OrangeController@ReSendPinCode');

//unsub
Route::post('/unSubscribe_orange', 'OrangeController@unSubscribe_orange');
Route::get('/ConfirmeDirectPay', 'OrangeController@ConfirmeDirectPay_orange');

// Binarywaves cred
define('operatorCode', '60201');
define('ServiceId', '132');
define('ServiceName', 'RotanaFlatter');
define('ServiceAPIKey', 'TqJYKszALRbLztyZAuo5mzrFtW1yyMMas6gr2lA8RxmfpuJ8zx');
define('ServiceAPIPassword', '4abIRUzE5n0ACzEBT3MHxPuPNpMMPyNtzAhcyjOWrYPMHRvman');

//notification urls
Route::get('/notificationStatuschange', 'OrangeController@notificationStatuschange');
Route::get('/notificationRecurringPayment', 'OrangeController@notificationRecurringPayment');

define('testURL' , 'http://196.219.241.226:9094/DCBAPI');
define('liveURL' , 'http://dc.binarywaves.com:8080/DCBAPI');

//Initialize DirectPay
define('test_InitializeDirectPay_url', '/OneTimePay/InitializeDirectPay');
define('live_InitializeDirectPay_url', '/OneTimePay/InitializeDirectPay');

//Confirm eDirectPay
define('test_ConfirmeDirectPay_url', '/OneTimePay/ConfirmDirectPay');
define('live_ConfirmeDirectPay_url', '/OneTimePay/InitializeDirectPay');

// Initialize Subscribe
define('test_InitializeSubscribe_url', '/Subscribe/InitializeSubscribe');
define('live_InitializeSubscribe_url', '/Subscribe/InitializeDirectPay');

// pin code confirm
define('test_VerifySubscribe_url', '/Subscribe/VerifySubscribePinCode');
define('live_VerifySubscribe_url', '/Subscribe/VerifySubscribePinCode');

// pin code resend
define('test_Resend_url', '/Subscribe/ReSendPinCode');
define('live_Resend_url', '/Subscribe/VerifySubscribePinCode');

//unsubscribe
define('test_UnSubscribe_url', '/Subscribe/UnSubscribe');
define('live_UnSubscribe_url', '/Subscribe/UnSubscribe');
/* ------------ end orange ------------ */



/************* Start config Timwe******************/
define('ooredoo',timwe_op_id());

define('PartnerId', '2534');
define('productId', '10461');
define('partnerRoleId', '2614');
define('TimweServiceId', '2724');
define('largeAccount', '92842');
define('heUser', 'user');
define('hePass', 'pass');

define('MTFreePricepointId', '46742');
define('PricepintId10QAR', '46758');
define('PricepintId5QAR', '46743');
define('PricepintId2QAR', '46759');

define('apikeysendMt', '98c489a1415047c4b19ab30436289de2');
define('presharedkeysendMt', 'SkU0gO1lSHR7wdfP');

define('apikeysubscription', '8086e440d80847a6b534c88a6c33a172');
define('presharedkeysubscription', 'cutfvCPZrlzMo6t8');
/************* end config Timwe******************/

Route::get('/ooredoo_qatar_landing_he', 'TimweController@landing_timwe_he');
Route::get('/msisdnRedirect', 'TimweController@msisdnRedirect');
Route::post('/heRedirect', 'TimweController@heRedirect');
Route::get('ooredoo_qatar_landing', 'TimweController@index');
Route::get('ooredoo_qatar_pin', 'TimweController@pincode');
Route::get('ooredoo_qatar_unsub', 'TimweController@unsubscribe');
Route::get('timwe_test', 'TimweController@timwe_test');

//Timwe Api
Route::post('generateKey', 'TimweController@generateKey');
Route::get('decryptMsisdn', 'TimweController@decryptMsisdn');
Route::post('{channel}/mt/{partnerRoleId}', 'TimweController@sendMt');
Route::post('subscription/optin/{partnerRoleId}', 'TimweController@subscriptionOptIn');
Route::post('subscription/confirm/{partnerRoleId}', 'TimweController@subscriptionConfirm');
Route::post('subscription/optout/{partnerRoleId}', 'TimweController@subscriptionOptOut');
/********************end ******************* */

//notification Api
Route::post('notification/mo/{partnerRole}', 'TimweController@notificationMo');
Route::post('notification/mt/dn/{partnerRole}', 'TimweController@notificationMtDn');
Route::post('notification/user-optin/{partnerRole}', 'TimweController@notificationUserOptin');
Route::post('notification/user-optout/{partnerRole}', 'TimweController@notificationUserOptout');
Route::post('notification/user-renewed/{partnerRole}', 'TimweController@notificationUserRenewed');
/********************end ******************* */

/* ------------ viva rotana routes backend ------------ */
define('SNAP_VIVA_URL', url('rotana_landing_stc'));
define('SNAP_VIVA_CHANNEL_ID', 11289);
define('viva_kuwait_operator_id', viva_id());
Route::get('rotana_landing_stc', 'RotanaController@rotana_viva_login');
Route::get('rotana_viva_profile', 'RotanaController@rotana_viva_profile');
Route::post('rotana_viva_login_action', 'RotanaController@rotana_viva_login_action');
Route::get('rotana_viva_notification', 'RotanaController@rotana_viva_notification');
Route::get('rotana_landing_stc_1', 'RotanaController@rotana_subscribeViva_1');
Route::get('rotana_logout_viva/{opid?}', 'RotanaController@rotana_logout');
Route::get('rotana_subscribe_old', 'RotanaController@rotana_subscribe'); // baher and sayed
Route::get('rotana_subscribe','RotanaController@rotana_country_landing');  // mohamed
Route::get('rotanav2/check/redirect', 'HomeController@check_landing_redirect');
/* ------------ viva rotana routes backend ------------ */


Route::get('popularCountInc', 'GreetingimgsController@popular_count_increment');

Route::get('logout_ad', 'HomeController@logoutadmin');

Route::get('new_landing', 'FrontEndController@new_landing');
Route::get('unsub', 'FrontEndController@unsub');
Route::get('tpay_notification', 'FrontEndController@tpay_notification');

// ====================== ooredoo sequence  ==========================//

// configuration
define('productID', "S-SnaFiEwMY2");
define('pName', "SnapFilters");
define('CpId', "IVAS");
define('CpPwd', "iva@123");
define('CpName', "IVAS");
define('image', url('/') . "/uploads/snapchat_logo.png");
define('ismID', "483");
define('our_ooredoo_id', 12);

define('serviceId', "S-SnaFiEwMY2");
define('serviceType', "P-IVASzvEwMY2");
define('optParam1', "IVAS");
define('serviceNode', "IVAS");

// routes
Route::get('/', function () {
    return redirect('landing');
});
Route::get('landing', 'HomeController@he_redirect');
Route::get('ooredoo_login', 'HomeController@login'); // login page without any detection
Route::get('login', 'HomeController@login');
Route::get('he_redirect', 'HomeController@he_redirect'); // this redirect to "ooredoo_he"
Route::get('ooredoo_he', 'HomeController@ooredoo_he');
Route::get('notification', 'HomeController@notification'); // notification for all subscribe
Route::get('dBill_callback', 'HomeController@dBill_callback');
Route::get('ooredoo_content_mt', 'HomeController@ooredoo_content_mt');

// Old routes for Ooredoo from OneGlobal
Route::post('/subscribeOreedo', 'HomeController@subscribeOreedo');
Route::get('ooredoo_unsub', 'HomeController@ooredoo_unsub');
Route::post('ooredoo_unsub_action', 'HomeController@ooredoo_unsub_action');
Route::get('snap_notification', 'HomeController@snap_notification');

// ====================== ooredoo sequence  ==========================//


//================================= Flatter du ==============================//

/*Route::get('landing_du', function () {
  return redirect('landing_du/lang/en');
});*/
Route::get('landing_du/{peroid?}/{lang?}','FrontEndController@landing_du_sub');

//================================= Flatter Mdu ==============================//


Route::get('/', function () {
    return redirect('admin');
});
Route::get('home', function () {
    return redirect('admin');
});
// new pages
Route::get('landing_all', 'FrontEndController@landing');
Route::get('landing_v1', 'FrontEndController@landing_v1');
Route::get('landing_viva_v0', 'FrontEndController@landing_viva');
Route::get('landing_ooredoo_v0', 'FrontEndController@landing_ooredoo');
Route::get('pincode', 'FrontEndController@pincode');
Route::get('confirm', 'FrontEndController@confirm');
Route::get('notificatiobResult', 'FrontEndController@notificatiobResult');
//new landing route
Route::get('landing_viva', 'FrontEndController@landing_viva_v2');
Route::get('landing_ooredoo', 'FrontEndController@landing_ooredoo_v2');
Route::get('landing_zain', 'FrontEndController@landing_zain_v2');
Route::post('/subscribeZain_v2', 'FrontEndController@subscribeZain_v2');
Route::post('/subscribeZainConfirm_v2', 'FrontEndController@subscribeZainConfirm_v2');
Route::post('subscribeZainPincodeConfirm_v2', 'FrontEndController@subscribeZainPincodeConfirm_v2');
Route::post('/subscribeVivaKuwait_v2', 'FrontEndController@subscribeVivaKuwait_v2');
// viva
Route::get('notification', 'FrontEndController@notification');
Route::post('vivaCheckSubscribe', 'FrontEndController@vivaCheckSubscribe');
Route::post('/subscribeVivaKuwait', 'HomeController@subscribeVivaKuwait');
Route::get('/viva_profile/{uid}', 'HomeController@viva_profile');

// Zain KSA
Route::get('landing_zain_ksa', 'FrontEndController@landing_zain_ksa');

// Route::post('/subscribeZainKsaConfirm', 'FrontEndController@subscribeZainKsaConfirm');
Route::post('/ZainKsaPinCodeSend', 'FrontEndController@ZainKsaPinCodeSend');
Route::post('/zain_ksa_pincode_confirm', 'FrontEndController@zain_ksa_pincode_confirm');
define('zain_ksa_prefix', '966');
Route::get('zain_ksa_unsub', 'FrontEndController@zain_ksa_unsub');
Route::post('zain_ksa_unsub_action', 'FrontEndController@zain_ksa_unsub_action');
Route::get('zain_ksa_test', 'FrontEndController@zain_ksa_test');
Route::get('logout_zain_ksa/{uid}', 'FrontEndController@logout_zain_ksa');

//all kuwait
Route::get('landing_kuwait', 'FrontEndController@landing_kuwait');

// Mobily saudi subscribe
Route::get('landing_ksa', 'FrontEndController@landing_ksa');
Route::get('landing_mobily_ksa', 'FrontEndController@landing_mobily_ksa');
Route::post('/MobilyKsaPinCodeSend', 'FrontEndController@MobilyKsaPinCodeSend');
Route::post('/mobily_ksa_pincode_confirm', 'FrontEndController@mobily_ksa_pincode_confirm');
Route::get('logout_mobily_ksa/{uid}', 'FrontEndController@logout_mobily_ksa');
define('MOBILY_OP_ID', 14);

//================================= Rotana Flatter Mobily KSA ==============================//
Route::get('landing_rotana_mobily_ksa', 'MobilyksaController@landing_rotana_mobily_ksa');
Route::post('/RotanaMobilyKsaSend', 'MobilyksaController@RotanaMobilyKsaSend');
define('MOBILY_KSA_OP_ID', MOBILY_KSA_HE());  // Stc Ksa
//================================= Rotana Flatter Mobily KSA==============================//


//================================= Rotana Flatter KSA( STC - Zain )==============================//
// STC KSA (Rotana Flatter)
Route::get('landing_rotana_stc_ksa', 'KsaController@landing_stc_ksa');
Route::post('/RotanaStcKsaPinCodeSend', 'KsaController@RotanaStcKsaPinCodeSend');
Route::post('/rotana_stc_ksa_pincode_confirm', 'KsaController@rotana_stc_ksa_pincode_confirm');
Route::get('rotana_stc_ksa_unsub', 'KsaController@RotanaStcKsaUnsub');
Route::post('RotanaStcKsaUnsubAction', 'KsaController@RotanaStcKsaUnsubAction');
Route::get('stc_ksa_login', 'KsaController@stc_ksa_login');

define('STC_OP_ID', 6);  // Stc Ksa

// Zain KSA (Rotana Flatter)
Route::get('landing_rotana_zain_ksa', 'KsaController@landing_rotana_zain_ksa');
Route::post('/RotanaZainKsaPinCodeSend', 'KsaController@RotanaZainKsaPinCodeSend');
Route::post('/rotana_zain_ksa_pincode_confirm', 'KsaController@rotana_zain_ksa_pincode_confirm');
Route::get('rotana_zain_ksa_unsub', 'KsaController@RotanaZainKsaUnsub');
Route::post('RotanaZainKsaUnsubAction', 'KsaController@RotanaZainKsaUnsubAction');
define('ZAIN_OP_ID',7); // zain ksa
//================================= Rotana Flatter KSA( STC - Zain )==============================//

// susbcribe zain kuwait
Route::post('/subscribeZain', 'HomeController@subscribeZain');
Route::post('/subscribeZainConfirm', 'HomeController@subscribeZainConfirm');
Route::post('/subscribeZainConfirm_new', 'HomeController@subscribeZainConfirm_new');
Route::post('subscribeZainPincodeConfirm', 'HomeController@subscribeZainPincodeConfirm');
//Route::get('/subscribeZainWifi', 'HomeController@subscribeZainWifi');
Route::get('pinCode', 'HomeController@pinCode');
// unsusbcribe zain kuwait
Route::get('/unsubZain', 'HomeController@unsubZain');
Route::post('/unsubscribeZain', 'HomeController@unsubscribeZain');
define('zain_user_name', 'httpIVASPIN');
define('zain_password', 'httpIV@SPIN');

define('zain_user_name_alafay', 'httpIVAS');
define('zain_password_alafay', 'httpIV@S');
define('zain_kuwait_operator_id', 8);
define('ooredoo_kuwait_operator_id', 12);

// ooredoo
Route::post('/subscribeOreedo', 'HomeController@subscribeOreedo');
Route::post('/subscribeOreedoConfirm', 'HomeController@subscribeOreedoConfirm');
// unsusbcribe oreedo kuwait
Route::get('/unsubOroodo', 'HomeController@unsubOroodo');
Route::post('/unsubscribeOoredoo', 'HomeController@unsubscribeOoredoo');
Route::post('/unsubscribeOoredoo', 'HomeController@unsubscribeOoredoo');

Route::get('/logout', 'FrontEndController@logout');

// load more
Route::get('loadMoreSnap', 'FrontEndController@loadMoreSnap');
Route::get('loadMoreSnapNew', 'FrontEndController@loadMoreSnapNew');

Route::get('admin/gaudios/del_code', 'GreetingaudiosController@del_code');
Route::get('admin/grbts/del_code', 'GreetingRbtController@del_code');

Route::get('imgs/{UID}', 'FrontEndController@ShowImages');
Route::get('vids/{UID}', 'FrontEndController@ShowVideos');

Route::get('admin', 'CategoriesController@adminindex');

Route::resource('admin/country', 'CountriesController');
Route::get('admin/country/{id}/operator', 'CountriesController@addOperator');

Route::resource('admin/operator', 'OperatorsController');

Route::resource('admin/categories', 'CategoriesController');

Route::get('admin/categories/{id}/occasion', 'CategoriesController@addOccasion');
Route::resource('admin/occasions', 'OccasionsController');

Route::get('admin/occasions/{id}/gimage', 'OccasionsController@AddImages');
Route::post('admin/occasions/{id}/gimage', 'OccasionsController@UploadImages');

// operator images
Route::get('admin/operatorImg/{id}/{images}', 'GreetingimgsController@showImagesOfOperator');
Route::delete('admin/operator/{OpID}/images/{ImgId}', 'GreetingimgsController@DeAttachImageFromOperator');

// operator audios
Route::get('admin/operatorAudio/{id}/{audios}', 'GreetingaudiosController@showAudiosOfOperator');
Route::delete('admin/operator/{OpID}/audios/{AudId}', 'GreetingaudiosController@DeAttachAudiosFromOperator');

Route::get('admin/insertsnap', 'GenerateurlController@insertsnap');
Route::get('admin/addSnapFromCategoyForm', 'OccasionsController@operatorAddSnapFromCategoypForm');
Route::post('operatorAddSnapFromCategoySave', 'OccasionsController@operatorAddSnapFromCategoySave');

// resource controllers routes
Route::get('admin/gimages/allData', 'GreetingimgsController@allData');
Route::resource('admin/gimages', 'GreetingimgsController');
Route::get('admin/gsnap/allData', 'GreetingSnapController@allData');
Route::resource('admin/gsnap', 'GreetingSnapController');

Route::post('admin/date', 'GreetingSnapController@getDate'); //date ajax

// resource controllers routes ordersnap
//Route::get('admin/ordersnap/allData','OrderSnapController@allData');
Route::get('admin/ordersnap', 'OrderSnapController@index');
Route::get('admin/ordersnaplike', 'OrderSnapController@ordersnaplike');
Route::get('admin/ordersnapdislike', 'OrderSnapController@ordersnapdislike');
// resource controllers routes operatorsnap
Route::get('admin/operatorsnap', 'OperatorSnapController@index');
Route::get('admin/operatorsnaplike', 'OperatorSnapController@operatorsnaplike');
Route::get('admin/operatorsnapdislike', 'OperatorSnapController@operatorsnapdislike');

Route::get('admin/gaudios/allData', 'GreetingaudiosController@allData');
Route::get('admin/grbts/allData', 'GreetingRbtController@allData');
Route::get('admin/gnotifications/allData', 'GreetingNotificationController@allData');
Route::resource('admin/gnotifications', 'GreetingNotificationController');
Route::resource('admin/grbts', 'GreetingRbtController');
Route::resource('admin/gaudios', 'GreetingaudiosController');
Route::resource('admin/cproviders', 'CprovidersController');
Route::resource('admin/generateurls', 'GenerateurlController');
Route::resource('admin/user', 'UsersController');
Route::resource('admin/settings', 'SettingsController');
Route::resource('admin/static_translation', 'StaticTranslationController');
Route::resource('admin/language', 'LanguageController');
Route::get('admin/lang/{lang}', 'LanguageController@switchLang');

/* ------------ viva routes backend ---------------- */
Route::get('landing_stc', 'HomeController@viva_login');
Route::post('viva_login_action', 'HomeController@viva_login_action');
Route::get('viva_notification', 'HomeController@viva_notification');
Route::get('landing_stc_1', 'HomeController@subscribeViva_1');
Route::get('logout_viva/{uid}', 'HomeController@logout');
// define('SNAP_VIVA_URL', 'https://filters.digizone.com.kw/landing_stc');
// define('SNAP_VIVA_CHANNEL_ID', 4493);
// define('viva_kuwait_operator_id', 13);

/* Zain Iraq Landing */
Route::get('zain_iraq_landing', 'FrontEndController@zain_iraq_landing');
Route::get('zain_iraq_success', 'FrontEndController@zain_iraq_success');
Route::get('zain_iraq_faild', 'FrontEndController@zain_iraq_faild');

//=======================du  Integration ==========================================//
Route::get('du_landing_dcb/{peroid?}/{lang?}', 'HomeController@du_landing_dcb');
Route::get('du_landing_success', 'HomeController@du_landing_success');
Route::get('DuSecureRedirect', 'HomeController@DuSecureRedirect');
Route::get('du_unsubc/{peroid?}/{lang?}', 'HomeController@du_unsubc');
Route::post('du_unsubcr/{peroid?}/{lang?}', 'HomeController@du_unsubcr');
/* Du LandingRotana */
Route::get('du_landing_rotana/{peroid?}/{lang?}', 'HomeController@du_landingrotana');
Route::get('du_unsubc_rotana/{peroid?}/{lang?}', 'HomeController@du_unsubcrotana');
Route::post('du_unsubcrrotana/{peroid?}/{lang?}', 'HomeController@du_unsubcrrotana');
/* Design4 purple  */
Route::get('du_landing_v2/{peroid?}/{lang?}', 'HomeController@du_landing_v2');
Route::get('du_unsubc_v4/{peroid?}/{lang?}', 'HomeController@du_unsubc_v4');
Route::post('du_unsubcr_v4/{peroid?}/{lang?}', 'HomeController@du_unsubcr_v4');
define('DU_UNSUB_SYSTEM',"https://du.notifications.digizone.com.kw/api/unsub");
define('DU_CHECKSUB',"https://du.notifications.digizone.com.kw/api/checkSub");
define('du_operator_id',4);
//=======================du  Integration ==========================================//

//langing kuwait rotana
Route::get('landing_kuwait_rotana','FrontEndController@landing_kuwait_rotana');

//Mobily Notification
Route::get('mobily_notification', 'HomeController@mobily_notification');

//Route::get('admin/ajax','OccasionsController@ajax');

// to make processing on images
Route::get('testar/{ImageID}/{Text}', 'GprocessorController@ArabicGreetingProcessor');
// ex:   http://localhost:8000/testar/7/%D8%B9%D9%85%D8%A7%D8%AF
// to write arabic text {Text} on specfic image {ImageID}   and the result store in "processedimgs" table

Route::get('testvid/{ImageID}/{AudioId}/{lang}/{Text}', 'GprocessorController@VideoProcessor');
// http://localhost:8000/testvid/9/8/ar/%D8%A7%D9%8A%D9%85%D9%86
// to write text on specific image and make a new video from that image and specific audio

//Route::get('{id}','GenerateurlController@show');
///////

/*Front end routes */
Route::get('choose', 'FrontEndController@chooseImgVid');

/*images*/
Route::get('images', 'FrontEndController@getImagesForOccasion');
Route::get('processImg', 'FrontEndController@processImage'); // make processing to an image by write text on it
Route::get('processImageEtislate', 'FrontEndController@processImageEtislate');
Route::get('img/{FID}', 'FrontEndController@viewImg'); // downlaod processed image

/*videos*/
Route::get('vidoes', 'FrontEndController@getAudiosForProvider');
Route::get('processVid', 'FrontEndController@processVideo');
Route::get('vid/{FID}', 'FrontEndController@viewVid');

/*get providers ajax*/
Route::get('providers', 'FrontEndController@getProvidersForOccasion');

/*error page*/
Route::get('error', 'FrontEndController@error');

Route::get('{UID}', 'FrontEndController@getMediaType');

Route::get('custom/{UID}', 'FrontEndController@getMediaType2');

Route::get('imgs/custom/{UID}', 'FrontEndController@ShowImages2');
Route::get('vids/custom/{UID}', 'FrontEndController@ShowVideos2');

Route::get('InputImage/{image}/{UID}', 'FrontEndController@InputImage');
Route::get('InputVideo/{image}/{UID}', 'FrontEndController@InputVideo');
Route::post('processImg/{UID}', 'FrontEndController@processImage');
Route::post('processVideo/{UID}', 'FrontEndController@processVideo');
Route::get('notifications/{UID}', 'FrontEndController@PublishedNotification');
Route::get('rbts/{UID}', 'FrontEndController@PublishedRbt');
Route::get('downloadAudio/{ID}', 'FrontEndController@downloadAudio'); // downlaod Audio
Route::get('Audio/{ID}/{UID}', 'FrontEndController@Audio');
Route::get('Search/{UID}', 'FrontEndController@Search');
Route::get('snap/{UID}', 'FrontEndController@snap');
Route::get('list_snap_v1/{id}/{UID}', 'FrontEndController@list_snap_v1');
Route::get('search_v1/{UID}', 'FrontEndController@search_v1');
Route::get('list_occasion/{UID}', 'FrontEndController@list_occasion');
Route::get('viewSnap/{ID}/{UID}', 'FrontEndController@inner_snap');
Route::get('viewSnap2/{ID}/{UID}', 'FrontEndController@inner_snap2');
Route::get('link2/snapCategory/{UID}', 'FrontEndController@snapCategory');
Route::get('listSnap/{id}/{UID}', 'FrontEndController@listSnap');
Route::get('cuurentSnap/{UID}', 'FrontEndController@cuurentSnap');
Route::get('home_v2/{UID}', 'FrontEndController@home_v2');
Route::get('like_dislike/{UID}', 'FrontEndController@like_dislike');
Route::get('Search_v3/{UID}', 'FrontEndController@Search_v3');
// new dersign snap
Route::get('cuurentSnap_v2/{UID}', 'FrontEndController@cuurentSnap_v2');
Route::get('all_occasion/{UID}', 'FrontEndController@all_occasions');
Route::get('all_favourite/{UID}', 'FrontEndController@all_favourite');
Route::get('main_occasion/{UID}', 'FrontEndController@main_occasions');
Route::get('occasion/{UID}/{greetingimg}', 'FrontEndController@get_occasion');
Route::get('inner_snap_v2/{UID}/{id}', 'FrontEndController@inner_snap_v2');
Route::get('Search_v2/{UID}', 'FrontEndController@Search_v2');
Route::get('add/favourite/{UID}/{number}/{greeting_id}', 'FrontEndController@add_favourite');
Route::get('delete/favourite/{UID}/{number}/{greeting_id}', 'FrontEndController@delete_favourite');
Route::get('loadsnap/{UID}', 'FrontEndController@loadMoreSnapNew_v2');
Route::get('logout_v2/{uid}', 'FrontEndController@logout_v2');
Route::post('unsusbcribe_zain_ksa', 'FrontEndController@unsusbcribe_zain_ksa');
//Route::get('{etislate}/{UID}','FrontEndController@getMediaTypeEtislate');
// Route::get('admin/rand_view','FrontEndController@random_view');

///////////////////////////////////////
////////////*new design v4*///////////////
///////////////////////////////////////

Route::get('newdesignv4/{UID}', 'FrontEndController@newdesignv4');
Route::get('favourites/{UID}', 'FrontEndController@favouritesv4');
Route::get('newdesignv4/occasion/{UID}', 'FrontEndController@occasions_v4');
Route::get('newdesignv4/suboccasion/{OID}/{UID}', 'FrontEndController@suboccasions_v4');
Route::get('newdesignv4/filter/{OID}/{UID}', 'FrontEndController@filter_v4');
Route::get('Search_v4/{UID}', 'FrontEndController@Search_v4');

///////////////////////////////////////
////////////*new design v4*////////////
///////////////////////////////////////

//////////////////////////////////////
///////////////*rotana*///////////////
//////////////////////////////////////

Route::get('rotanav2/{UID}', 'FrontEndController@rotana');
Route::get('rotanav2/{CID}/occasion/{UID}', 'FrontEndController@occasions_rotana');
Route::get('rotanav2/{OID}/filter/{UID}', 'FrontEndController@filter_rotana');
Route::get('rotanav2/favorites/{UID}', 'FrontEndController@favorites_rotana');
Route::get('rotanav2/favorites_rotana_load/{UID}', 'FrontEndController@favorites_rotana_load');
Route::get('rotanav2/today/{UID}', 'FrontEndController@rotanav2_today');
Route::get('Search_v6/{UID}', 'FrontEndController@Search_v6');
Route::get('rotanav2/inner/{FID}/{UID}', 'FrontEndController@filter_inner');



//////////////////////////////////////
/////////////*end rotana*/////////////
//////////////////////////////////////

///////////////////////////////////////
////////////*Mbc*///////////////
///////////////////////////////////////

Route::get('mbc/{UID}', 'FrontEndController@mbc');
Route::get('favourites_mbc/{UID}', 'FrontEndController@favouritesmbc');
Route::get('mbc/occasion/{UID}', 'FrontEndController@occasions_mbc');
Route::get('mbc/suboccasion/{OID}/{UID}', 'FrontEndController@suboccasions_mbc');
Route::get('mbc/suboccasiontesty/{OID}/{UID}', 'FrontEndController@suboccasions_mbc');
Route::get('mbc/filter/{OID}/{UID}', 'FrontEndController@filter_mbc');
Route::get('Search_v5/{UID}', 'FrontEndController@Search_mbc');

///////////////////////////////////////
////////////*Mbc*///////////////
///////////////////////////////////////

/*******************start IMI digital *****************/

define('UserID','Ziyadat');
define('Password','6874');
define('authorization','Basic aW1pbW9iaWxlOmltaW1vYmlsZTEyMw==');
define('vendor','Afasi');
define('imi_serviceId','4');
define('shortCode','6876');
define('phoneKey','972');

Route::get('imi/login', 'ImiController@landing');
Route::get('imi/pincode', 'ImiController@pinCode');
Route::get('imi/unsubscribe', 'ImiController@unsub');
Route::get('imi/logout', 'ImiController@logout');

Route::get('authorization', 'ImiController@authorization'); // auth used in header

$url = 'https://mazajak-c.ooredoo.ps/TPAPI'; // base URL

//msisdn check status
define('subscriptionsCheckUrl', $url.'/payment/CheckStatus');
Route::post('subscriptions/check', 'ImiController@subscriptionsCheck');

// send pincode
define('generateOTPUrl', $url.'/payment/GenerateOTP');
Route::post('generateOTP', 'ImiController@generateOTP');

// validate pincode
define('generateOTPValidateUrl', $url.'/payment/ValidateOTP');
Route::post('generateOTPValidate', 'ImiController@generateOTPValidate');

// subscribe
define('subscriptionsRequestUrl', $url.'/payment/SUBUSER');
Route::post('subscriptions/request', 'ImiController@subscriptionsRequest');

//unsubscribe
define('unsubscriptionUrl', $url.'/payment/UnSubUser');
Route::post('subscriptions/unsubscription', 'ImiController@unsubscription');

//charge user
define('chargingUrl', $url.'/charging/chargeuser');
Route::get('charging', 'ImiController@charging');

//msisdn subscribed services
define('getServicesUrl', $url.'/GetServiceDetails/GetSerDetails');
Route::get('subscriptions/getservices', 'ImiController@getServices');

//notification
Route::get('imi/notification', 'ImiController@imi_notification');

/*******************end IMI digital *****************/

Route::get('oocasion', function () {
    return view('front.new_snap_v2.oocasion');
});

Route::post('admin/delete_multiselect', function (Illuminate\Http\Request $request) {
    if (strlen($request['selected_list']) == 0) {
        \Session::flash('failed', 'no_selected_item');
        return back();
    }
    $selected_list = explode(",", $request['selected_list']);
    foreach ($selected_list as $item) {
        DB::table($request['table_name'])->where('id', $item)->delete();
    }
    \Session::flash('success', 'Delete All Successfully');

    //delete_multiselect($request) ;
    return back();
});
Route::get('admin/get_table_ids', function (Illuminate\Http\Request $request) {
    $table_name = $request['table_name'];
    if (isset($table_name) && !empty($table_name)) {
        $query = "SELECT id FROM " . $table_name;
        $run = \DB::select($query);
        return $run;
    }
    return $table_name;
});

Auth::routes(['register' => false]);
