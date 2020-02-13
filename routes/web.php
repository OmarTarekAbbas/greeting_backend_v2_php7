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

Route::get('popularCountInc', 'GreetingimgsController@popular_count_increment');

Route::get('logout_ad', 'HomeController@logoutadmin');

Route::get( 'new_landing', 'FrontEndController@new_landing');
Route::get('unsub', 'FrontEndController@unsub');
Route::get( 'tpay_notification', 'FrontEndController@tpay_notification');




// ====================== ooredoo sequence  ==========================//

// configuration
define('productID',"S-SnaFiEwMY2");
define('pName',"SnapFilters");
define('CpId',"IVAS");
define('CpPwd',"iva@123");
define('CpName',"IVAS");
define('image',url('/')."/uploads/snapchat_logo.png");
define('ismID',"483");
define('our_ooredoo_id',12);

define('serviceId',"S-SnaFiEwMY2");
define('serviceType',"P-IVASzvEwMY2");
define('optParam1',"IVAS");
define('serviceNode',"IVAS");




// routes
Route::get('/', function () {
    return redirect('landing');
});
Route::get('landing', 'HomeController@he_redirect');
Route::get('ooredoo_login', 'HomeController@login'); // login page without any detection
Route::get('login', 'HomeController@login');
Route::get('he_redirect', 'HomeController@he_redirect');  // this redirect to "ooredoo_he"
Route::get('ooredoo_he', 'HomeController@ooredoo_he');
Route::get('notification', 'HomeController@notification');  // notification for all subscribe
Route::get('dBill_callback', 'HomeController@dBill_callback');
Route::get('ooredoo_content_mt', 'HomeController@ooredoo_content_mt');

// Old routes for Ooredoo from OneGlobal
 Route::post('/subscribeOreedo', 'HomeController@subscribeOreedo');
 Route::get('ooredoo_unsub', 'HomeController@ooredoo_unsub');
 Route::post('ooredoo_unsub_action', 'HomeController@ooredoo_unsub_action');
 Route::get('snap_notification', 'HomeController@snap_notification');



 // ====================== ooredoo sequence  ==========================//



Route::get('/', function () {
    return redirect('admin');
});
Route::get('home', function () {
    return redirect('admin');
});
// new pages
Route::get('landing_all','FrontEndController@landing');
Route::get('landing_v1','FrontEndController@landing_v1');
Route::get('landing_viva_v0','FrontEndController@landing_viva');
Route::get('landing_ooredoo_v0','FrontEndController@landing_ooredoo');
Route::get('pincode','FrontEndController@pincode');
Route::get('confirm','FrontEndController@confirm');
Route::get('notificatiobResult','FrontEndController@notificatiobResult');
//new landing route
Route::get('landing_viva','FrontEndController@landing_viva_v2');
Route::get('landing_ooredoo','FrontEndController@landing_ooredoo_v2');
Route::get('landing_zain','FrontEndController@landing_zain_v2');
Route::post('/subscribeZain_v2', 'FrontEndController@subscribeZain_v2');
Route::post('/subscribeZainConfirm_v2', 'FrontEndController@subscribeZainConfirm_v2');
Route::post('subscribeZainPincodeConfirm_v2', 'FrontEndController@subscribeZainPincodeConfirm_v2');
Route::post('/subscribeVivaKuwait_v2', 'FrontEndController@subscribeVivaKuwait_v2');
// viva
Route::get('notification','FrontEndController@notification');
Route::post('vivaCheckSubscribe','FrontEndController@vivaCheckSubscribe');
Route::post('/subscribeVivaKuwait', 'HomeController@subscribeVivaKuwait');
Route::get('/viva_profile/{uid}', 'HomeController@viva_profile');


// Zain KSA
Route::get('landing_zain_ksa','FrontEndController@landing_zain_ksa');

// Route::post('/subscribeZainKsaConfirm', 'FrontEndController@subscribeZainKsaConfirm');
Route::post('/ZainKsaPinCodeSend', 'FrontEndController@ZainKsaPinCodeSend');
Route::post('/zain_ksa_pincode_confirm', 'FrontEndController@zain_ksa_pincode_confirm');
define('zain_ksa_prefix','966');
Route::get('zain_ksa_unsub','FrontEndController@zain_ksa_unsub');
Route::post('zain_ksa_unsub_action','FrontEndController@zain_ksa_unsub_action');
Route::get('zain_ksa_test','FrontEndController@zain_ksa_test');
Route::get('logout_zain_ksa/{uid}', 'FrontEndController@logout_zain_ksa');

//all kuwait
Route::get('landing_kuwait','FrontEndController@landing_kuwait');

// Mobily saudi subscribe
Route::get('landing_ksa','FrontEndController@landing_ksa');
Route::get('landing_mobily_ksa','FrontEndController@landing_mobily_ksa');
Route::post('/MobilyKsaPinCodeSend', 'FrontEndController@MobilyKsaPinCodeSend');
Route::post('/mobily_ksa_pincode_confirm', 'FrontEndController@mobily_ksa_pincode_confirm');
Route::get('logout_mobily_ksa/{uid}', 'FrontEndController@logout_mobily_ksa');
define('MOBILY_OP_ID',14);


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
define('zain_user_name','httpIVASPIN');
define('zain_password','httpIV@SPIN');

define('zain_user_name_alafay','httpIVAS');
define('zain_password_alafay','httpIV@S');
define('zain_kuwait_operator_id',8);
define('ooredoo_kuwait_operator_id',12);


// ooredoo
Route::post('/subscribeOreedo', 'HomeController@subscribeOreedo');
Route::post('/subscribeOreedoConfirm', 'HomeController@subscribeOreedoConfirm');
// unsusbcribe oreedo kuwait
Route::get('/unsubOroodo', 'HomeController@unsubOroodo');
Route::post('/unsubscribeOoredoo', 'HomeController@unsubscribeOoredoo');
Route::post('/unsubscribeOoredoo', 'HomeController@unsubscribeOoredoo');

Route::get('/logout', 'FrontEndController@logout');

// load more
Route::get('loadMoreSnap','FrontEndController@loadMoreSnap');
Route::get('loadMoreSnapNew','FrontEndController@loadMoreSnapNew');

Route::get('admin/gaudios/del_code','GreetingaudiosController@del_code');
Route::get('admin/grbts/del_code','GreetingRbtController@del_code');

Route::get('imgs/{UID}','FrontEndController@ShowImages');
Route::get('vids/{UID}','FrontEndController@ShowVideos');

Route::get('admin','CategoriesController@adminindex');

Route::resource('admin/country','CountriesController');
Route::get('admin/country/{id}/operator','CountriesController@addOperator');

Route::resource('admin/operator','OperatorsController');

Route::resource('admin/categories','CategoriesController');

Route::get('admin/categories/{id}/occasion','CategoriesController@addOccasion');
Route::resource('admin/occasions','OccasionsController');

Route::get('admin/occasions/{id}/gimage','OccasionsController@AddImages');
Route::post('admin/occasions/{id}/gimage','OccasionsController@UploadImages');

// operator images
Route::get('admin/operatorImg/{id}/{images}','GreetingimgsController@showImagesOfOperator');
Route::delete('admin/operator/{OpID}/images/{ImgId}','GreetingimgsController@DeAttachImageFromOperator');

// operator audios
Route::get('admin/operatorAudio/{id}/{audios}','GreetingaudiosController@showAudiosOfOperator');
Route::delete('admin/operator/{OpID}/audios/{AudId}','GreetingaudiosController@DeAttachAudiosFromOperator');


Route::get('admin/insertsnap','GenerateurlController@insertsnap');
Route::get('admin/addSnapFromCategoyForm','OccasionsController@operatorAddSnapFromCategoypForm');
Route::post('operatorAddSnapFromCategoySave','OccasionsController@operatorAddSnapFromCategoySave');

// resource controllers routes
Route::get('admin/gimages/allData','GreetingimgsController@allData');
Route::resource('admin/gimages','GreetingimgsController');
Route::get('admin/gsnap/allData','GreetingSnapController@allData');
Route::resource('admin/gsnap','GreetingSnapController');

Route::post('admin/date', 'GreetingSnapController@getDate');//date ajax

// resource controllers routes ordersnap
//Route::get('admin/ordersnap/allData','OrderSnapController@allData');
Route::get('admin/ordersnap','OrderSnapController@index');
Route::get('admin/ordersnaplike','OrderSnapController@ordersnaplike');
Route::get('admin/ordersnapdislike','OrderSnapController@ordersnapdislike');
// resource controllers routes operatorsnap
Route::get('admin/operatorsnap','OperatorSnapController@index');
Route::get('admin/operatorsnaplike','OperatorSnapController@operatorsnaplike');
Route::get('admin/operatorsnapdislike','OperatorSnapController@operatorsnapdislike');

Route::get('admin/gaudios/allData','GreetingaudiosController@allData');
Route::get('admin/grbts/allData','GreetingRbtController@allData');
Route::get('admin/gnotifications/allData','GreetingNotificationController@allData');
Route::resource('admin/gnotifications','GreetingNotificationController');
Route::resource('admin/grbts','GreetingRbtController');
Route::resource('admin/gaudios','GreetingaudiosController');
Route::resource('admin/cproviders','CprovidersController');
Route::resource('admin/generateurls','GenerateurlController');
Route::resource('admin/user','UsersController');
Route::resource('admin/settings','SettingsController');
Route::resource('admin/static_translation','StaticTranslationController');
Route::resource('admin/language','LanguageController');
Route::get('admin/lang/{lang}','LanguageController@switchLang');

/* ------------ viva routes backend ---------------- */
Route::get('landing_stc', 'HomeController@viva_login');
Route::post('viva_login_action', 'HomeController@viva_login_action');
Route::get('viva_notification', 'HomeController@viva_notification');
Route::get('landing_stc_1', 'HomeController@subscribeViva_1');
Route::get('logout_viva/{uid}', 'HomeController@logout');
define('SNAP_VIVA_URL','https://filters.digizone.com.kw/landing_stc');
define('SNAP_VIVA_CHANNEL_ID',4493);
define('viva_kuwait_operator_id',13);

/* Zain Iraq Landing */
Route::get('zain_iraq_landing', 'FrontEndController@zain_iraq_landing');
Route::get('zain_iraq_success', 'FrontEndController@zain_iraq_success');
Route::get('zain_iraq_faild', 'FrontEndController@zain_iraq_faild');

/* Du Landing = SecureD */
Route::get('du_landing/{peroid?}/{lang?}', 'HomeController@du_landing');
Route::get('du_landing_success', 'HomeController@du_landing_success');
Route::get('DuSecureRedirect', 'HomeController@DuSecureRedirect');
/* Du LandingRotana */
Route::get('du_landingrotana/{peroid?}/{lang?}', 'HomeController@du_landingrotana');
Route::get('du_landingrotana', 'HomeController@du_landing_successrotana');
Route::get('du_landingrotana', 'HomeController@DuSecureRedirectrotana');
/* Du LandingRotana */
Route::get('du_landing_v2/{peroid?}/{lang?}', 'HomeController@du_landing_v2');
Route::get('du_landing_v2', 'HomeController@du_landing_success_v2');
Route::get('du_landing_v2', 'HomeController@DuSecureRedirect_v2');

Route::get('du_pinCode', 'FrontEndController@du_pinCode');
Route::get('du_unsub', 'FrontEndController@du_unsub');


//Mobily Notification
Route::get('mobily_notification', 'HomeController@mobily_notification');



//Route::get('admin/ajax','OccasionsController@ajax');

// to make processing on images
Route::get('testar/{ImageID}/{Text}','GprocessorController@ArabicGreetingProcessor');
 // ex:   http://localhost:8000/testar/7/%D8%B9%D9%85%D8%A7%D8%AF
// to write arabic text {Text} on specfic image {ImageID}   and the result store in "processedimgs" table

Route::get('testvid/{ImageID}/{AudioId}/{lang}/{Text}','GprocessorController@VideoProcessor');
// http://localhost:8000/testvid/9/8/ar/%D8%A7%D9%8A%D9%85%D9%86
// to write text on specific image and make a new video from that image and specific audio

//Route::get('{id}','GenerateurlController@show');
///////


/*Front end routes */
Route::get('choose','FrontEndController@chooseImgVid');

/*images*/
Route::get('images','FrontEndController@getImagesForOccasion');
Route::get('processImg','FrontEndController@processImage');  // make processing to an image by write text on it
Route::get('processImageEtislate','FrontEndController@processImageEtislate');
Route::get('img/{FID}','FrontEndController@viewImg'); // downlaod processed image

/*videos*/
Route::get('vidoes','FrontEndController@getAudiosForProvider');
Route::get('processVid','FrontEndController@processVideo');
Route::get('vid/{FID}','FrontEndController@viewVid');

/*get providers ajax*/
Route::get('providers','FrontEndController@getProvidersForOccasion');

/*error page*/
Route::get('error','FrontEndController@error');


Route::get('{UID}','FrontEndController@getMediaType');


Route::get('custom/{UID}','FrontEndController@getMediaType2');

Route::get('imgs/custom/{UID}','FrontEndController@ShowImages2');
Route::get('vids/custom/{UID}','FrontEndController@ShowVideos2');

Route::get('InputImage/{image}/{UID}','FrontEndController@InputImage');
Route::get('InputVideo/{image}/{UID}','FrontEndController@InputVideo');
Route::post('processImg/{UID}','FrontEndController@processImage');
Route::post('processVideo/{UID}','FrontEndController@processVideo');
Route::get('notifications/{UID}','FrontEndController@PublishedNotification');
Route::get('rbts/{UID}','FrontEndController@PublishedRbt');
Route::get('downloadAudio/{ID}','FrontEndController@downloadAudio'); // downlaod Audio
Route::get('Audio/{ID}/{UID}','FrontEndController@Audio');
Route::get('Search/{UID}','FrontEndController@Search');
Route::get('snap/{UID}','FrontEndController@snap');
Route::get('list_snap_v1/{id}/{UID}','FrontEndController@list_snap_v1');
Route::get('search_v1/{UID}','FrontEndController@search_v1');
Route::get('list_occasion/{UID}','FrontEndController@list_occasion');
Route::get('viewSnap/{ID}/{UID}','FrontEndController@inner_snap');
Route::get('viewSnap2/{ID}/{UID}','FrontEndController@inner_snap2');
Route::get('link2/snapCategory/{UID}','FrontEndController@snapCategory');
Route::get('listSnap/{id}/{UID}','FrontEndController@listSnap');
Route::get('cuurentSnap/{UID}','FrontEndController@cuurentSnap');
Route::get('home_v2/{UID}','FrontEndController@home_v2');
Route::get('like_dislike/{UID}','FrontEndController@like_dislike');
Route::get('Search_v3/{UID}','FrontEndController@Search_v3');
// new dersign snap
Route::get('cuurentSnap_v2/{UID}','FrontEndController@cuurentSnap_v2');
Route::get('all_occasion/{UID}','FrontEndController@all_occasions');
Route::get('all_favourite/{UID}','FrontEndController@all_favourite');
Route::get('main_occasion/{UID}','FrontEndController@main_occasions');
Route::get('occasion/{UID}/{greetingimg}','FrontEndController@get_occasion');
Route::get('inner_snap_v2/{UID}/{id}','FrontEndController@inner_snap_v2');
Route::get('Search_v2/{UID}','FrontEndController@Search_v2');
Route::get('add/favourite/{UID}/{number}/{greeting_id}','FrontEndController@add_favourite');
Route::get('delete/favourite/{UID}/{number}/{greeting_id}','FrontEndController@delete_favourite');
Route::get('loadsnap/{UID}','FrontEndController@loadMoreSnapNew_v2');
Route::get('logout_v2/{uid}','FrontEndController@logout_v2');
Route::post('unsusbcribe_zain_ksa','FrontEndController@unsusbcribe_zain_ksa');
//Route::get('{etislate}/{UID}','FrontEndController@getMediaTypeEtislate');
 // Route::get('admin/rand_view','FrontEndController@random_view');

 ///////////////////////////////////////
 ////////////*new design v4*///////////////
 ///////////////////////////////////////

 Route::get('newdesignv4/{UID}','FrontEndController@newdesignv4');
 Route::get('favourites/{UID}','FrontEndController@favouritesv4');
 Route::get('newdesignv4/occasion/{UID}', 'FrontEndController@occasions_v4');
 Route::get('newdesignv4/suboccasion/{OID}/{UID}', 'FrontEndController@suboccasions_v4');
 Route::get('newdesignv4/filter/{OID}/{UID}', 'FrontEndController@filter_v4');
 Route::get('Search_v4/{UID}','FrontEndController@Search_v4');



 ///////////////////////////////////////
 ////////////*new design v4*///////////////
 ///////////////////////////////////////

 ///////////////////////////////////////
 ////////////*rotana*///////////////
 ///////////////////////////////////////

 Route::get('rotana/{UID}','FrontEndController@rotana');
 Route::get('favourites_v5/{UID}','FrontEndController@favouritesv5');
 Route::get('rotana/occasion/{UID}', 'FrontEndController@occasions_v5');
 Route::get('rotana/suboccasion/{OID}/{UID}', 'FrontEndController@suboccasions_v5');
Route::get('rotana/suboccasiontesty/{OID}/{UID}', 'FrontEndController@suboccasions_v6');
 Route::get('rotana/filter/{OID}/{UID}', 'FrontEndController@filter_v5');
 Route::get('Search_v5/{UID}','FrontEndController@Search_v5');


 ///////////////////////////////////////
 ////////////*rotana*///////////////
 ///////////////////////////////////////



Route::get('oocasion', function () {
    return view('front.new_snap_v2.oocasion');
});

Route::get('/categories/123456','FrontEndController@cat');

// Route::get('test/dir/{uid}',function(){
//   $snap_Occasions = snap_Occasions();
//   //return $snap_Occasions;
//   $arr = [];
//   foreach ($snap_Occasions as $key => $value) {
//     //return $snap_Occasions[$key];
//     echo $key.'--';
//     // if($key%2 == 0){
//     //   array_push($arr,'left');
//     // }
//     // else{
//     //   array_push($arr,'right');
//     // }
//   }
//   //return $arr;
// });


/* =================== new landing ================== */
Route::post('AddSubscriptionContractRequest', 'FrontEndController@AddSubscriptionContractRequest');
Route::post('admin/delete_multiselect',function (Illuminate\Http\Request $request){
    if (strlen($request['selected_list'])==0)
    {
        \Session::flash('failed','no_selected_item');
        return back();
    }
    $selected_list =  explode(",",$request['selected_list']);
    foreach ($selected_list as $item)
    {
        DB::table($request['table_name'])->where('id',$item)->delete() ;
    }
    \Session::flash('success', 'Delete All Successfully');

    //delete_multiselect($request) ;
    return back();
});
Route::get('admin/get_table_ids',function(Illuminate\Http\Request $request){
    $table_name = $request['table_name'] ;
    if(isset($table_name) && ! empty($table_name))
    {
        $query = "SELECT id FROM ".$table_name ;
        $run = \DB::select($query)  ;
        return $run ;
    }
    return $table_name;
});

Auth::routes(['register' => false]);

