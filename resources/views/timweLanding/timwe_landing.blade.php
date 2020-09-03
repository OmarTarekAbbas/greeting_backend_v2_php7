<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
  <meta charset="utf-8">
  <!--IE Compatibility Meta-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Mobile Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Filetrs landing page</title>
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

  .landing_page .strip h2 {
    font-size: 1.5rem;
  }

  .landing_page .shbka h3 {
    font-size: 1rem;
  }

  .landing_page .shbka h4 {
    font-size: 17px;
  }

  .landing_page .shbka .zain_viva #zain {
    width: 32%;
  }

  .landing_page .form_content {
    margin: 0% auto 0 auto;
    width: 90%;
  }

  .landing_page .form_content form .form-group label {
    background-color: #084f27;
    border-bottom-left-radius: 0.25rem;
    border-top-left-radius: 0.25rem;
  }

  .landing_page .form_content form .form-group input {
    width: 80%;
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
  }

  .landing_page .form_content form .form-group input:focus {
    border-color: #000;
    box-shadow: 0 0 0 0.2rem rgb(8 79 39);
  }

  .landing_page .form_content form .btn {
    background-color: #FFF;
    color: #000;
    font-size: 1.35rem;
    width: 45%;
  }

  .terms {
    font-size: 0.7rem;
  }

  .copy {
    margin-top: 2%;
  }

  .cancel {
    font-size: 10px;
  }

  .landing_page .form_content .validity {
    margin: 0;
    padding-left: 1px;
  }


  .switch-input {
    display: none;
  }

  .switch-label {
    position: relative;
    display: inline-block;
    /* min-width: 112px; */
    cursor: pointer;
    color: #727272;
    font-weight: 500;
    text-align: left;
    margin: 8px 16px;
    padding: 0px 0 0px 44px;
  }

  .switch-label:before,
  .switch-label:after {
    content: "";
    position: absolute;
    margin: 0;
    outline: 0;
    top: 50%;
    -webkit-transform: translate(0, -50%);
    transform: translate(0, -50%);
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
  }

  .switch-label:before {
    left: 1px;
    width: 34px;
    height: 14px;
    background-color: #b6b6b6;
    border-radius: 8px;
  }

  .switch-label:after {
    left: 0;
    width: 20px;
    height: 20px;
    background-color: #FAFAFA;
    border-radius: 50%;
    box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.14), 0 2px 2px 0 rgba(0, 0, 0, 0.098), 0 1px 5px 0 rgba(0, 0, 0, 0.084);
  }

  .switch-label .toggle--on {
    display: none;
  }

  .switch-label .toggle--off {
    display: inline-block;
    color: #fff;
  }

  .switch-input:checked+.switch-label:before {
    background: #084f27;
  }

  .switch-input:checked+.switch-label:after {
    background: #084f27;
    -webkit-transform: translate(80%, -50%);
    transform: translate(80%, -50%);
  }

  .switch-input:checked+.switch-label .toggle--on {
    display: inline-block;
  }

  .switch-input:checked+.switch-label .toggle--off {
    display: none;
  }

  .switch-input:checked+.switch-label .toggle--option {
    color: #fff;
  }
</style>


@php
$lang = App::getLocale();
@endphp
<?php
if ($lang == 'ar') {
  $float = "float-left";
} else {
  $float = "float-right";
}
?>

<body>
  <div class="main_container">
    <div class="{{$float}}">
      <input type="checkbox" id="on-off" name="on-off" onclick="toggle_lang()" class="switch-input" {{ $lang == 'ar' ? 'checked' : '' }}>
      <label for="on-off" class="switch-label">
        <span class="toggle--on toggle--option">EN</span>
        <span class="toggle--off toggle--option">AR</span>
      </label>
    </div>

    <div class="landing_page">
      <div class="start_video" id="video">
        <video width="100%" poster="{{ url('assets/front/landing_v2')}}/video/snap2.jpg" id="my_audio" controls>
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/mp4">
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/ogg">
        </video>
      </div>

      <div class="strip">
        <h5>@lang('messages.enjoy') @lang('messages.falater')</h5>
      </div>

      <div class="shbka">
        <div class="container">
          <h3>@lang('messages.newfalater')</h3>

          <div class="zain_viva w-75" style="margin: 0 auto">
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
          </div>
        </div>
      </div>

      <div class="container pt-2">
        <div class="form_content">
          <!--<h5>ادخل رقم الهاتف</h5>-->
          <form method="post" action="{{url('subscription/optin/'.partnerRoleId)}}" onsubmit="document.getElementById('zain_submit').disabled='true';" id="form_zain">
            {{ csrf_field() }}
            <div class="form-group form-inline text-center">
              <input type="hidden" name="type" value="rotana">
              <label for="phone"><span>974</span></label>
              <input type="hidden" name="prev_url" value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}">
              @if (session()->has('landing_msisdn'))
              {{-- {{dd('asd')}} --}}
              <input type="tel" class="form-control" id="phone" required="" value="{{session()->get('landing_msisdn')}}" placeholder="@lang('messages.enterphone')" name="number" required pattern="[0-9]{8}">
              @else
              {{-- {{dd('asd')}} --}}
              <input type="tel" class="form-control" id="phone" required="" placeholder="@lang('messages.enterphone')" name="number" required pattern="[0-9]{8}" style="">
              @endif
              <span class="validity"></span>
            </div>
            <!--<button class="btn back">رجوع</button>-->
            <p class="text-white" style="font-size:22px; font-weight:bolder">@lang('messages.subweek')</p>
            <button id="zain_submit" class="btn" type="submit" style="width: 90%">@lang('messages.subscribe')</button>
          </form>
        </div>
      </div>
    </div>

    <!-- copyright -->
    @if ($lang == 'ar')
    <ul class="terms text-right text-white mt-3" dir="rtl">
      @else
      <ul class="terms text-left text-white mt-3" dir="ltr">
        @endif
        @lang('messages.terms')
      </ul>
    </ul>

    <div class="cancel text-center mt-3 text-white">
      <p class="mb-0">@lang('messages.unsub') <a href="{{url('ooredoo_q_unsub' )}}">@lang('messages.link')</a></p>
    </div>

    <div class="copy">
      <p>copyright @ <span>{{date('Y')}}</span> Digizone, all rights reserved.</p>
    </div>

    <!-- copyright -->

  </div>

  <!-- script -->
  <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/script_ooredoo.js"></script>

  <script type="text/javascript">
    function toggle_lang() {
      const checkbox = document.getElementById("on-off");
      checkbox.addEventListener('change', (event) => {
        if (event.target.checked) {
          location.href = "{{url('admin/lang/ar')}}";
        } else {
          location.href = "{{url('admin/lang/en')}}";
        }
      });
    }

    $(document).ready(function() {
      var msisdn = $("#phone").val();
      if (msisdn != "") {
        $('#form').submit()
      }
    });
  </script>

</body>

</html>
