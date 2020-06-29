<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
  <meta charset="utf-8">
  <!--IE Compatibility Meta-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Mobile Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Du Flatter</title>
  <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/main-style_zain_du.css">
  <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->

</head>
<style type="text/css">
  .landing_page .strip {
    margin-top: 0;
  }

  .main_container {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-image: unset;
  }

  .shbka .zain_viva #du_landing {
    width: 23% !important;
  }

  .landing_page .shbka h3 {
    font-weight: 500;
  }

  .landing_page .form_content form .form-group label,
  .landing_page .form_content form .btn {
    background-color: #084f27;
  }

  .landing_page .cancel {
    text-align: center;
    color: #000;
    padding: 20px 8px 0 8px;
    font-size: 18px;
  }

  @media only screen and (max-width: 1025px) {
    .shbka .zain_viva {
      margin-top: unset;
      margin-bottom: unset;
    }
  }

  @media (min-width: 768px) and (max-width: 1025px) {
    .shbka .zain_viva {
      margin-top: unset !important;
      margin-bottom: unset !important;
    }
  }
</style>

@php
App::setLocale($lang);
@endphp

<body>
  <div class="main_container">
    <div class="landing_page">
      <div class="start_video" id="video">
        <video width="100%" style="height: 300px;" poster="{{ url('assets/front/landing_v2')}}/video/rotana_post.png" id="my_audio" controls>
          <source src="{{ url('assets/front/landing_v2')}}/video/1591283770.mp4" type="video/mp4">
          <source src="{{ url('assets/front/landing_v2')}}/video/1591283770.mp4" type="video/ogg">
        </video>
      </div>

      <div class="strip">
        <h5 style="font-family: sans-serif;font-size: 12px;">@lang('messages.du_enjoy_flu')</h5>
        @if ($lang == 'ar')
        <a href="{{url("du_landing/lang/en")}}" class="mb-0" style="color: #fff;">
          اللغة الانجليزية
        </a>
        @else
        <a href="{{url("du_landing/lang/ar")}}" class="mb-0" style="color: #fff;">
          اللغة العربية
        </a>
        @endif
      </div>

      <div class="shbka">
        <div class="container">
          <h3 style="color: #000;">
            @if ($lang == 'ar' || $peroid == 'daily')
            {{' في خدمة فلاتر سناب اليومية'}}
            @elseif($lang == 'ar' || $peroid == 'weekly')
            {{' في خدمة فلاتر سناب الاسبوعية'}}
            @elseif($lang == 'en' || $peroid == 'daily')
            {{'Daily Flatter Service'}}
            @else
            {{'Weekly Flatter Service'}}
            @endif
          </h3>

          <div class="zain_viva">
            @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color: black;">&times;</a>
              {{ Session::get('success')}}
            </div>
            @elseif(Session::has('failed'))
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close" style="color: black;">&times;</a>
              {{ Session::get('failed')}}
            </div>
            @endif
            <div class="row justify-content-center">
              <!-- <div class="col-12" style="margin-top: 10%;">
                <a class="operator" sms='4971' body='2' href="">
                  <img src="{{ url('assets/front/landing_v2')}}/img/DuLogo.png" id="du_landing">
                </a>
              </div> -->
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="form_content">
          <form method="get" action="{{url('DuSecureRedirect')}}" onsubmit="document.getElementById('zain_submit').disabled='true';" id="form_zain">
            {{ csrf_field() }}
            <div class="form-group form-inline">
              <input type="hidden" name="peroid" value="{{$peroid}}">
              <input type="hidden" name="lang" value="{{$lang}}">
              <input type="hidden" name="type" value="rotana">
              <label for="phone"><span>971</span></label>
              <input type="hidden" name="prev_url" value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}">
              <input type="tel" class="form-control" id="phone" required="" placeholder="@lang('messages.du_enter_mob')" name="number" required pattern="[0-9]{9}">
              <span class="validity"></span>
            </div>
            <button id="zain_submit" class="btn" type="submit">@lang('messages.subscribe')</button>
          </form>
        </div>
      </div>

      @if ($lang == 'ar')
      <div class="cancel">
        <p>لالغاء الاشتراك يرجي الضغط علي هذا <a href="{{url('du_unsubc'."/".$peroid."/".$lang )}}">الرابط</a></p>
      </div>
      @else
      <div class="cancel">
        <p>for unsubscribe please press on this <a href="{{url('du_unsubc'."/".$peroid."/".$lang )}}">link</a></p>
      </div>
      @endif

      <div class="copy">
        <p style="color: black;">copyright @ <span><?php echo date("Y") ?></span> Digizone, all rights reserved.</p>
      </div>
    </div>
  </div>

  <!-- script -->
  <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/script_zain.js"></script>
  <script>
    $(document).ready(function($) {
      var deviceAgent = navigator.userAgent.toLowerCase();
      var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
      var xArr = $('.operator');
      for (var i = 0; i < xArr.length; i++) {
        sms = xArr[i].getAttribute('sms');
        body = xArr[i].getAttribute('body');
        if (agentID) {
          xArr[i].setAttribute('href', 'sms:' + sms + '&body=' + body);
        } else {
          xArr[i].setAttribute('href', 'sms:' + sms + '?body=' + body);
        }
      }
    });
    $('.operator').click(function() {
      var operator = $(this).attr('sms') == '4971' ? 'Du' : '';
      $.ajax({
        url: location.href,
        type: "get",
        data: {
          operator_name: operator

        },
        success: function(response) {
          console.log(response);

        }
      })
    })
    $('#entry').click(function() {
      $.ajax({
        url: location.href,
        type: "get",
        data: {
          enterbtn: 'Enter'
        },
        success: function(response) {
          console.log(response);
        }
      })
    })
  </script>

</body>

</html>