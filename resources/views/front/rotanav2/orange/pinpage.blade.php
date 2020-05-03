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
</style>
<div class="confirm_page">

        <div class="content">
                <center>
                    <div class="container">
                        <h4 style='margin-top: 0; color: #ffffff; font-weight: 400'>خدمه روتانا</h4>
                        <div class="pd_page" id="div_wifi_box">
                            <div class="clearfix"></div>

                            {{-- @include('partial.landing_flash')--}}

                            @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('success')}}
                            </div>
                            @elseif(Session::has('failed'))
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('failed')}}
                            </div>
                            @endif


                            {!! Form::open(['url'=>'ConfirmPinCode','method'=>'post','class'=>'form','files'=>'true']) !!}
                            <div class="form-group" id="wifi_login_subscribe_form">
                                <p>ادخل كود التفعيل:</p>

                                <input type="hidden"  name="msisdn" value="{{$msisdn}}">

                                <input type="number" name="pincode" id="pincode" required pattern="[0-9]{5}" class="form-control center-block margb" style="direction: ltr; width: 200px">

                                <input type="submit" value="تاكيد" class="btn"
                                    style=" background-color: #b8881d; color: white; width: 100px; font-size: 25px; margin-bottom: 0;" />

                            </div>
                            {!! Form::close() !!}

                            <div class="dis">
                                <ul>
                                    <li><p class="pag_color">يمكنك الغاء الاشتراك عن طريق هذا <a href="{{url('Orange_unsub')}}" style="color: #007bff;"> الرابط </a> </p></li>
                                    <li>
                                        <p class="pag_color">
                                            <form action="{{url('ReSendPinCode')}}" method="post">
                                                @csrf
                                                <input style="color: #007bff;" type="submit" value="اضغط هنا لاعادة ارسال الرمز">
                                            </form>
                                        </p>
                                    </li>
                                    {{-- <li>برجاء إرسال اى أسئلة أو شكاوى عن الخدمة إلى support@flatter.ivascloud.com</li> --}}
                                </ul>
                            </div>


                        </div>
                    </div>
                </center>

            </div>



    <div id="loading_image" style="text-align: center;display: none;">
        <img class="logo" src="{{asset('landing_page/img')}}/logo.png" alt="">
    </div>

    <div id="loginModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-right">
                    <div class="alert alert-success" role="alert">تم تاكيد الكود بنجاح</div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->
