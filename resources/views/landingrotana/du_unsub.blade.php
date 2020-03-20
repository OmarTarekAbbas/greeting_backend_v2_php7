<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
    <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Du Snap Rotana Page</title>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/main-style_zain.css">
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
</head>

<style type="text/css">
    .landing_page .strip {
        margin-top: 0;
    }
    .modal{
        text-align: center;
        position: fixed;
        width: 80%;
        height: 150px;
        top: 50%;
        transform: translateY(-50%);
        margin: 0 auto;
        background-color: white;
        opacity: 0.9;
        padding: 10px;
        border-radius: 7px;
        color: black;
    }
    @media (min-width: 320px) and (max-width: 359px) {
      .operator img
      {
          width: 58%;
      }
    }
    .hero-bkg-animated {

        height: 100vh;
        background-position: fixed;
        background-repeat: no-repeat;
        background-size: 200% 100%;
        transform: translate3d(0px, 0px, 0px);
        transform-style: preserve-3d;
        box-sizing: border-box;
        -webkit-animation: slide 20s linear infinite;
    }
    .hero-bkg-animated h1 {
        font-family: sans-serif;
    }
    @-webkit-keyframes slide {
        from {
            background-position: 0 0;
        }
        to {
            background-position: -300px 0;
        }
    }
    .main_container{
      background: #161414;
      /* background: url("{{url('assets/front/newdesignv4/images/BG.png')}}") */
    }
</style>
<style type="text/css">
    .landing_page .strip {
        margin-top: 0;
    }
</style>

@php
App::setLocale($lang);
@endphp

<body>
    <div class="main_container">
        <div class="landing_page">

            <div class="start_video" id="video">
                <!-- <video width="100%" autoplay muted loop="true">
                    <source src="{{ url('assets/front/landing_v2')}}/video/1.mp4" type="video/mp4">
                </video> -->
                <img width="100%" src="{{ url('assets/front/landing_v2')}}/img/download.jfif" alt="فلاتر">
            </div>

            <div class="strip">
                <h2>@lang('messages.du_unsub')</h2>
            </div>

            <div class="shbka">
                <div class="container">
                    <h3 style="color: #e8ffe8;">@if ($lang == 'ar' && $peroid == 'daily') {{' في خدمة روتانا '}}
                        @elseif($lang == 'ar' && $peroid == 'weekly') {{' في خدمة روتانا '}} @elseif($lang == 'en'
                        && $peroid == 'daily') {{' Rotana Service'}} @else {{' Rotana Service'}} @endif</h3>
                    <div class="zain_viva">
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

            <div class="container">
                <div class="form_content">
                    <form method="post" action="{{url('du_unsubcr')}}"   onsubmit="document.getElementById('zain_submit').disabled='true';"  id="form_zain">
                        {{ csrf_field() }}
                        <div class="form-group form-inline">
                            <input type="hidden" name="peroid"  value="{{$peroid}}"  >
                            <input type="hidden" name="lang"  value="{{$lang}}"  >
                            <label for="phone"><span>971</span></label>
                            <input type="tel" class="form-control" id="phone" required=""
                                placeholder="@lang('messages.du_enter_mob')" name="number" required pattern="[0-9]{9}">
                            <span class="validity"></span>
                        </div>
                        <button id="zain_submit" class="btn" type="submit">@lang('messages.du_unsub')</button>
                    </form>
                </div>
            </div>
        </div>




         <!-- loading -->
         <div class="loading-overlay" style="background-color:#000">
            <div class="spinner">
                <img src="{{url('assets/front/rotanav2/images/Rorana_flater_logo.png')}}" alt="loading_snap">
            </div>
        </div>
        <!-- end loading -->
    </div>
    <!-- script -->
    <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/script_zain.js"></script>

</body>

</html>
