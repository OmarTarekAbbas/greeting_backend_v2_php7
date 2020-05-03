<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotana</title>
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/rotanav2/css/style.css')}}">
    <base target="_parent">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <?php
      $dateString = date('Y-m-d H:i:s\Z');
      $serviceId = ServiceId;
      $ServiceAPIKey = ServiceAPIKey;
      $ServiceAPIPassword = ServiceAPIPassword;

      $message = $serviceId . $dateString;

      $signature = $ServiceAPIKey . ":" . hash_hmac("sha256", $ServiceAPIPassword, $message);
      $js = "http://bw.ghaneely.com/BWOHETest/HeaderHandler.ashx?service=" . $serviceId . "&date=" . $dateString . "&signature=" . $signature . "&demo=true&msisdn=201223872695";
    ?>

    <script src="<?php echo $js; ?>" type="text/javascript"></script>


    <script>
        function Binary_functions() {
            try {
              //Then to get MSISDN:
              var msisdn = HE.GetMSISDN();
              //For Operator Code:
              var operatorCode= HE.GetOperatorCode();
              //And for Referene number:
              var refNo = HE.GetRefrenceNo();
              return msisdn;
            } catch (e) {
              return false;
            }
        }

        function Binary_functions2() {
            var csrf = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                method: "POST",
                url: "{{url('AddSubscriptionContractRequest')}}",
                data: {
                    "MSISDN": HE.GetMSISDN(),
                    "operatorCode": HE.GetOperatorCode(),
                    "refNo": HE.GetRefrenceNo(),
                    'X-CSRF-TOKEN': csrf
                },

                success: function(result) {
                    data = JSON.parse(result);
                    if (data.val == 1) {
                        alert(data.message);
                    } else if (data.val == 2) {
                      alert(data.message);
                      $('body').html(data.html)
                    } else if (data.val == 4) {
                        alert("تم الاشتراك بنجاح");
                        window.location.href = "{{url('/"+data.message+"')}}";
                    } else {
                        // alert("fail unknow error");
                        alert("يوجد خطأ");
                    }
                },
                error: function() {
                    //  alert("ajax error");
                    alert("يوجد خطأ");
                }
            });

        }
    </script>


</head>

<body>
  <main class="new_rotana">
    <header class="header_head w-100">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="header_logo">
              <a href="{{url('/rotanav2/'.uid())}}">
                <img class="d-block m-auto slide-in-fwd-bottom" src="{{url('assets/front/rotanav2/images/new_rotana.png')}}" alt="Rotana Logo">
              </a>
              {{-- @if(getCode() == 'ar')
              <a style="color:#fff" href="{{url('admin/lang/en')}}">En</a>
              @else
              <a style="color:#fff" href="{{url('admin/lang/ar')}}">Ar</a>
              @endif --}}
            </div>
        </header>
<!-- End Header -->

<style>
    .footer_head{
        display: none;
    }

    .pd_page form p {
        font-size: 25px;
        margin-bottom: 0px;
        font-weight: bold;
        color: #bf9434;
        direction: rtl;
    }
    .pd_page form input {
        margin-top: 15px;
    }
    .dis ul li {
        margin-bottom: 10px;
        color: white;
    }
    .pag_color{
        color: white;
    }
    .btn-large {
        background-color: #b8881d;
        color: white;
        width: 100px;
        font-size: 25px;
        margin-bottom: 0;
        margin-top: 20px;
    }
    .maleo-card_title {
        color: #bf9434;
    }
    .app-desc {
        font-family: 'Reem Kufi', sans-serif;
        font-size: 15px;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .app-desc {
        font-family: 'Reem Kufi', sans-serif;
        font-size: 15px;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    a {
        color: #337ab7;
        text-decoration: none;
    }
</style>
<div id="page" class="text-center">

    <div class="content-container">

        <!-- HERE IS CONTENTS -->
        {!! Form::open(['url'=>"unSubscribe_orange",'method'=>'post', 'id'=>'directUnsubsHEDiv']) !!}
        <div class="pages login-page">
            <div class="maleo-card signup animated fadeInUp">
                <img class="logo" src="{{asset('landing_page/img')}}/logo.png" alt="">
                <h4 style='margin-top: 0; color: #ffffff; font-weight: 400'>  خدمة روتانا فلاتر</h4>

                <div  style="margin: auto ; width: 80%">
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{ Session::get('success')}}
                    </div>
                    @elseif(Session::has('failed'))
                    <div class="alert alert-danger alert-dismissible">
                        {{ Session::get('failed')}}
                    </div>
                    @endif

                </div>



                <h2 class="maleo-card_title big-title text-center">الغاء الاشتراك</h2>
                <div class="form-content">
                    <p class="app-desc pag_color">من فضلك! أدخل رقم التليفون, ثم أضغط تأكيد</p>
                    <div class="input-field with-icon"><!--<span class="icon"><i class="fa fa-phone"></i>--></span>
                        <input  id="MSISDN" @if(Session::has('phone_number')) value ="{{Session::get('phone_number')}}"  @endif type="number" class='form-control' style='direction: ltr; width: 200px; margin: auto;'  required="" pattern="[0-9]{11}" name="MSISDN" placeholder="رقم التليفون"></div>
                    <button class="btn-large btn block margin-bottom" type="submit">تأكيد</button>

                     <div class="app-desc pag_color">ليس لديك حساب؟ <a class="primary-text" href="{{url('orange_landing')}}">تسجيل جديد</a></div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <!-- //HERE IS CONTENTS -->


        <div class="ptb--200 showw" style="display: none;">

            <div class="maleo-card signup animated fadeInUp">
                <img class="logo" src="{{asset('landing_page/img')}}/3adasat_Logo.png" alt="">
                <h4 style='margin-top: -18px; color: #992d15;'>خدمة عدسات</h4>

            </div>




            <div class="modal-footer">

                <button type="button" class="btn btn-success" style="margin-right: 40%" onclick="TPay_unsub()">الغاء الاشتراك</button>
            </div>


        </div>


        <div id="loading_image" style="text-align: center;display: none;">
            <image src="{{asset('landing_page/img')}}/loading.gif" alt="" width="200" height="200" />
        </div>

    </div>
</div>

<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->


@section('check_HE')
<script>
    $(document).ready(function () {
        $("#new_subscriber").css("display", "none");
    });</script>

</script>
<script>
    $(document).ready(function () {

        // $("#new_subscriber").css("display","block");
        // $('#login_form').css("display",'none') ;


        if (window.TPay && TPay.HeaderEnrichment && TPay.HeaderEnrichment.enriched()) { // 1- TPay.HeaderEnrichment.enriched
            TPay.HeaderEnrichment.hasSubscription("", function (hasSub, subId) { // 2 -TPay.HeaderEnrichment.hasSubscription
                document.getElementById("directUnsubsHEDiv").remove();
                $(".showw").show();
                if (!hasSub) { // not subscriber  so redirect to subscribe page
                    window.location.href = "/landing";
                } else { // already subscriber ... so make unsub
                    // $("#directUnsubsHEDiv").hide();


                    /*
                     var conf = confirm("أنت علي وشك الغاء الاشتراك");
                     if (conf == true) {
                     login_data = {
                     "contract_id": subId,
                     "_token": "{{csrf_token()}}"
                     };
                     //   alert(subId) ;
                     $.ajax({
                     method: "POST",
                     url: "{{url('/directUnsubscribeWithHE')}}",
                     data: login_data,
                     success: function (result) {
                     data = JSON.parse(result);
                     if (data.val == 2 || data.val == 3) { // error messages
                     alert(data.message);
                     } else if (data.val == 1) {
                     alert(data.message);
                     window.location.href = "{{url('/landing')}}";
                     } else {
                     alert("حدث خطأ");
                     }

                     }
                     });
                     } else {
                     alert("لم يتم الغاء الاشتراك");
                     window.location.href = "{{url('/landing')}}";
                     }

                     */

                }
            });
        }
    });

</script>

<script>
    function TPay_unsub() {
        if (window.TPay && TPay.HeaderEnrichment && TPay.HeaderEnrichment.enriched()) { // 1- TPay.HeaderEnrichment.enriched
            TPay.HeaderEnrichment.hasSubscription("", function (hasSub, subId) { // 2 -TPay.HeaderEnrichment.hasSubscription

                if (!hasSub) { // not subscriber  so redirect to subscribe page
                    window.location.href = "/landing";
                } else { // already subscriber ... so make unsub
                    // $("#directUnsubsHEDiv").hide();

                    login_data = {
                        "contract_id": subId,
                        "_token": "{{csrf_token()}}"
                    };
                    //   alert(subId) ;
                    $('#loading_image').css("display", 'block');
                    $.ajax({
                        method: "POST",
                        url: "{{url('/directUnsubscribeWithHE')}}",
                        data: login_data,
                        success: function (result) {
                            $('#loading_image').css("display", 'none');
                            data = JSON.parse(result);
                            if (data.val == 2 || data.val == 3) { // error messages
                                alert(data.message);
                            } else if (data.val == 1) {
                                alert(data.message);
                                window.location.href = "{{url('/landing?')}}" + data.url_redirect+"&HE=1";
                            } else {
                                alert("حدث خطأ");
                            }

                        }
                    });




                }
            });
        }
    }
</script>

@stop



@section('unsub_js')
<script>
    $('#directUnsubsHEDiv').submit(function (evt) {

        var length = $("#MSISDN").val().length;
        if (length != 11) {
            evt.preventDefault();
            alert("Wrong phone number");
        } else {
            $("#directUnsubsHEDiv").submit();
        }


    });

</script>
@stop
