<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
  <meta charset="utf-8">
  <!--IE Compatibility Meta-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Mobile Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Filetrs page</title>
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

  .landing_page .form_content {
    width: 90%;
}

  .landing_page .form_content form .form-group label {
    background-color: #084f27;
    border-bottom-left-radius: 0.25rem;
    border-top-left-radius: 0.25rem;
  }

  .landing_page .form_content form .form-group input {
    width: 77%;
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
  }

  .landing_page .form_content form .form-group input:focus {
    border-color: #000;
    box-shadow: 0 0 0 0.2rem rgb(8 79 39);
  }

  .landing_page .form_content .validity {
    margin: 0;
    padding-left: 5px;
  }

  .landing_page .form_content form .btn {
    background-color: #FFF;
    color: #000;
    font-size: 1.35rem;
    width: unset;
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
        <video width="100%" poster="{{ url('assets/front/landing_v2')}}/img/01.jpg" id="my_audio" controls>
          <source src="{{ url('assets/front/landing_v2')}}/img/snap_new_landing/New_VID.mp4" type="video/mp4">
          <source src="{{ url('assets/front/landing_v2')}}/img/snap_new_landing/New_VID.mp4" type="video/ogg">
        </video>
        <!-- <video width="100%" autoplay muted loop="true">
                            <source src="{{ url('assets/front/landing_v2')}}/video/1.mp4" type="video/mp4">
                        </video> -->
        <!-- <img width="100%" src="{{ url('assets/front/landing_v2')}}/img/01.jpg" alt="فلاتر"> -->
      </div>

      <div class="strip">
        <h5>@lang('messages.unsubfalater')</h5>
      </div>


      <div class="shbka pt-2">
        <div class="container">
          <h3 style="color: #e8ffe8;">@lang('messages.falater')</h3>
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
                {{-- <img src="{{ url('assets/front/landing_v2')}}/img/mobily.png" id="zain"> --}}
                {{-- <img src="{{ url('assets/front/landing_v2')}}/img/logo.png" id="zain"> --}}
                {{-- <img src="{{ url('assets/front/landing_v2')}}/img/DuLogo.png" id="zain"> --}}
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container pt-2">
        <div class="form_content">
          <form method="post" action="{{url('subscription/optout/'.partnerRoleId)}}" onsubmit="document.getElementById('zain_submit').disabled='true';" id="form_zain">
            {{ csrf_field() }}
            <div class="form-group form-inline">
              <label for="phone"><span>971</span></label>
              <input type="tel" class="form-control" @if(session()->has('userIdentifier'))
              value="{{substr(session()->get('userIdentifier'), 3)}}" @endif id="phone" required=""
              placeholder="@lang('messages.du_enter_mob')" name="number" required pattern="[0-9]{8}">
              <span class="validity"></span>
            </div>
            <button id="zain_submit" class="btn" type="submit">@lang('messages.du_unsub')</button>
          </form>
        </div>
      </div>
    </div>
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
