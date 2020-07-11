<!-- Start Header -->
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
  <main class="akhbar_now">
    <header class="header_head w-100">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="header_logo">
              <a href="{{url('/rotanav2/'.uid())}}">
                <img class="d-block m-auto slide-in-fwd-bottom" src="{{url('assets/front/rotanav2/images/akhbar_now.png')}}" alt="Rotana Logo">
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
    .hemodal{
        display: none;
        text-align: center;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: #d0be9d85;
        padding: 20px;
    }
    .hemodal div{
        margin-top: 12%;
    }
    @media (min-width: 320px) and (max-width: 1023.9px) {
      .hemodal div{
        margin-top: 50%;
    }
    }
</style>
    <body>

    <div id="new_subscriber" class="modal" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="new_sub">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">أنت غير مشترك في الخدمة</h5>

                    </div>
                    <div class="modal-body">
                        للإشتراك اضغط على اشتراك
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-success" style="margin-right: 40%;"
                                onclick="TPay_functions()">إشتراك</button>
                    </div>

                    <div class="dis">
                        <ul>
                            <p class="pag_color">يمكنك الغاء الاشتراك عن طريق هذا <a  href="{{url('Orange_unsub')}}" style="color: #007bff;"> الرابط </a> </p>
                            <li>برجاء إرسال اى أسئلة أو شكاوى عن الخدمة إلى support@flatter.ivascloud.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="loading_image" style="text-align: center;display: none;">
        <img src="{{asset('landing_page/img')}}/loading.gif" alt="" width="200" height="200" />
    </div>


    <div class="content">
        <center>
            <div class="container">
                <h4 style='margin-top: 0; color: #ffffff; font-weight: 400'>خدمه روتانا فلاتر</h4>
                <div class="pd_page" id="div_wifi_box">
                    <div class="clearfix"></div>
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
                    {{-- @include('partial.landing_flash')--}}

                    {!! Form::open(['url'=>"AddSubscriptionContractRequest",'method'=>'post']) !!}
                    <div class="form-group" id="wifi_login_subscribe_form">
                        <p>أدخل رقم هاتفك:</p>

                        <input name="MSISDN" type="number" placeholder="XXXXXXXXXXX" onKeyPress="if (this.value.length == 12)
                                            return false;" required class="form-control center-block margb"
                               style="direction: ltr; width: 200px">

                        <input type="submit" value="إشترك" class="btn"
                               style=" background-color: #b8881d; color: white; width: 100px; font-size: 25px; margin-bottom: 0;" />

                    </div>
                    {!! Form::close() !!}


                    <div class="dis">
                        <ul>
                           <li><p class="pag_color">يمكنك الغاء الاشتراك عن طريق هذا <a href="{{url('Orange_unsub')}}" style="color: #007bff;"> الرابط </a> </p></li>
                            {{--  <li class="pag_color">برجاء إرسال اى أسئلة أو شكاوى عن الخدمة إلى support@flatter.ivascloud.com</li>  --}}
                        </ul>
                    </div>


                </div>
            </div>
        </center>

    </div>

    <div class="hemodal text-light">
        <div class="text-center bg-dark p-3 rounded shadow">
            <h4>مرحبا في خدمة روتانا فلاتر</h4>
            <h6>هل تريد المتابعة برقم </h6>
            <p id="hemsisdn"></p>
            <a class="btn btn-success" onclick="Binary_functions2()">اشتراك</a>
        </div>
    </div>

<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->

