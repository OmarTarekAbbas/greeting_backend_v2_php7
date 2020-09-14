<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
  <meta charset="utf-8">
  <!--IE Compatibility Meta-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Mobile Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>snap landing page</title>
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

  .terms {
    font-size: 0.7rem;
  }
</style>

<body>
  <div class="main_container">
    <div class="landing_page">

      <div class="start_video" id="video">
        <video width="100%" style="height: 250px;" poster="{{ url('assets/front/landing_v2')}}/video/rotana_post.png"
          id="my_audio" controls>
          <source src="{{ url('assets/front/landing_v2')}}/video/1591283770.mp4" type="video/mp4">
          <source src="{{ url('assets/front/landing_v2')}}/video/1591283770.mp4" type="video/ogg">
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
          <form method="post" action="{{url('subscription/optin/'.partnerRoleId)}}"
            onsubmit="document.getElementById('zain_submit').disabled='true';" id="form_zain">
            {{ csrf_field() }}
            <div class="form-group form-inline text-center">
              <input type="hidden" name="type" value="rotana">
              <label for="phone"><span>974</span></label>
              <input type="hidden" name="prev_url" value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}">
              @if (session()->has('landing_msisdn'))
              {{-- {{dd('asd')}} --}}
              <input type="tel" class="form-control" id="phone" required="" value="{{session()->get('landing_msisdn')}}"
                placeholder="@lang('messages.enterphone')" name="number" required pattern="[0-9]{8}">
              @else
              {{-- {{dd('asd')}} --}}
              <input type="tel" class="form-control" id="phone" required="" placeholder="@lang('messages.enterphone')"
                name="number" required pattern="[0-9]{8}" style="">
              @endif
              <span class="validity"></span>
            </div>
            <!--<button class="btn back">رجوع</button>-->
            <p class="text-white" style="font-size:22px; font-weight:bolder">@lang('messages.subweek')</p>
            <p class="text-white" style="font-size:16px; font-weight:bolder">@lang('messages.renew')</p>
            <button id="zain_submit" class="btn" type="submit" style="width: 100%">@lang('messages.subscribe')</button>
          </form>
        </div>
      </div>
    </div>
    <div class="cancel text-center mt-3 text-white">
      <p>@lang('messages.unsub') <a href="{{url('ooredoo_q_unsub' )}}">@lang('messages.link')</a></p>
    </div>
    <!-- copyright -->
    @if (App::getLocale()  == 'ar')
    <ul class="terms text-right text-white" dir="rtl">
      @else
      <ul class="terms text-left text-white" dir="">
        @endif
        @lang('messages.terms')
      </ul>
      <div class="copy">
        <p>copyright @ <span>{{date('Y')}}</span> Digizone, all rights reserved.</p>
      </div>
      @php
      $lang = App::getLocale() == 'ar' ? 'en' : 'ar';
      $lang2 = App::getLocale() == 'ar' ? 'EN' : 'AR';
      @endphp
      @if ($lang == 'en')
      <a class="btn btn-sm btn-success" style="position: fixed; top: 10px; right: 10px; padding: 10px;"
        href="{{url('admin/lang/'.$lang)}}">{{$lang2}}</a>
      @else
      <a class="btn btn-sm btn-success" style="position: fixed; top: 10px; left: 10px; padding: 10px;"
        href="{{url('admin/lang/'.$lang)}}">{{$lang2}}</a>
      @endif
      <!-- copyright -->

      <!-- loading -->
      {{-- <div class="loading-overlay">
        <div class="spinner">
            <img src="{{ url('assets/front/landing_v2')}}/img/logo.jpg" alt="loading_snap">
  </div>
  </div> --}}
  <!-- end loading -->
  </div>

  <!-- script -->
  <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/script_ooredoo.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      var msisdn = $("#phone").val();
      if (msisdn != "") {
        $('#form').submit()
      }
    });
  </script>

</body>

</html>
