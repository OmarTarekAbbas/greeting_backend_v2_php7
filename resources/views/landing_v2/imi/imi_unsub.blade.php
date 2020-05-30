<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
    <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>snap Pin page</title>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/main-style_zain.css">
</head>
<style>
    @media (min-width: 1025px) {
    body {
        background-image: url('{{url("assets/front/landing_v2/img/stc_BG.png")}}');
    }
  }
    .main_container {
      background-image: url('{{url("assets/front/landing_v2/img/stc_BG.png")}}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }

    .landing_page .strip {
      margin-top: -2.5%;
      background-image: url('{{url("assets/front/landing_v2/img/strip_green.png")}}');
    }

    .landing_page .shbka .zain_viva #zain {
      width: 32%;
    }

    .landing_page .form_content form .form-group label {
      background-color: #141719;
    }

    .landing_page .form_content form .btn {
      background-color: #FFF;
      color: #000;
      font-size: 1.35rem;
      width: 45%;
    }
  </style>
<body>
    <div class="main_container">
        <div class="landing_page">

            <div class="start_video" id="video">
                <video width="100%" height="240" poster="{{ url('assets/front/landing_v2')}}/video/snap2.jpg" id="my_audio" controls>
                    <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/mp4">
                    <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/ogg">
                  </video>
                <!-- <video width="100%" autoplay muted loop="true">
                            <source src="{{ url('assets/front/landing_v2')}}/video/1.mp4" type="video/mp4">
                        </video> -->
                <!-- <img width="100%" src="{{ url('assets/front/landing_v2')}}/img/01.jpg" alt="فلاتر"> -->
              </div>

            <div class="strip">
                <h2>الغاء الاشتراك</h2>
            </div>


            <div class="shbka pt-2">
                <div class="container">
                    <h3 style="color: #e8ffe8;">في خدمة فلاتر روتانا</h3>
                    <div class="zain_viva pt-4">
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
                        <div class="row justify-content-center">
                            <div class="col-12">
                                {{--  <img src="{{ url('assets/front/landing_v2')}}/img/mobily.png" id="zain"> --}}
                                {{-- <img src="{{ url('assets/front/landing_v2')}}/img/logo.png" id="zain"> --}}
                                {{-- <img src="{{ url('assets/front/landing_v2')}}/img/DuLogo.png" id="zain"> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container pt-5">
                <div class="form_content">
                    <form method="post" action="{{url('subscriptions/unsubscription')}}"   onsubmit="document.getElementById('zain_submit').disabled='true';"  id="form_zain">
                        {{ csrf_field() }}
                        <div class="form-group form-inline">
                            <label for="phone"><span>{{phoneKey}}</span></label>
                            <input type="hidden" name="prev_url"
                                value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}">
                            <input type="tel" class="form-control" @if(session()->has('msisdn')) value="{{substr(session()->get('msisdn'), 3)}}" @endif id="phone"
                                placeholder="ادخل رقم تليفونك"
                                oninvalid="setCustomValidity('يجب ان تدخل 9 ارقام')" name="number" required
                                pattern="[0-9]{9}">
                            <span class="validity"></span>
                        </div>

                        <!--<button class="btn back">رجوع</button>-->
                        <button id="zain_submit" class="btn" type="submit">الغاء الاشتراك</button>
                    </form>
                    <!--<h5>للاشتراك يرجى الارسال الى <span>965</span></h5>
                <h5>الى <span>965</span><span> STOP1 </span>لالغاء الاشتراك ارسل</h5>-->
                </div>
            </div>

            <div class="cancel text-center mt-4 font-weight-bold">
                <p class="h4"><a  href="{{url('imi/login')}}">للاشتراك</a></p>
            </div>

        </div>

    </div>
    <!-- script -->
    <script src="{{url('front/stc')}}/js/jquery-3.4.0.min.js"></script>
    <script src="{{url('front/stc')}}/js/bootstrap.min.js"></script>

    <script src="{{ url('front/stc')}}/js/popper.min.js"></script>
    <script src="{{ url('front/stc')}}/js/script_viva.js"></script>


    <script>
        $(document).ready(function(){
           var msisdn =   $("#phone").val() ;
            if(msisdn != "" && msisdn.length == 8 && msisdn!= "@_MSISDN"){
                $("#viva_form").submit();
             }
         });

        $('#zain_submit').focusin(function () {
            $('#viva_form').submit()
        });

    </script>

</body>

</html>
