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
        <video width="100%" height="240" poster="{{ url('assets/front/landing_v2')}}/video/snap2.jpg" id="my_audio"
          controls>
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/mp4">
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/ogg">
        </video>
        <!-- <video width="100%" autoplay muted loop="true">
                            <source src="{{ url('assets/front/landing_v2')}}/video/1.mp4" type="video/mp4">
                        </video> -->
        <!-- <img width="100%" src="{{ url('assets/front/landing_v2')}}/img/01.jpg" alt="فلاتر"> -->
      </div>

      <div class="strip">
        <h5>@lang('messages.unsub')</h5>
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
                {{--  <img src="{{ url('assets/front/landing_v2')}}/img/mobily.png" id="zain"> --}}
                {{-- <img src="{{ url('assets/front/landing_v2')}}/img/logo.png" id="zain"> --}}
                {{-- <img src="{{ url('assets/front/landing_v2')}}/img/DuLogo.png" id="zain"> --}}
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container pt-2">
        <div class="form_content">
          <form method="post" action="{{url('subscription/optout/'.partnerRoleId)}}"
            onsubmit="document.getElementById('zain_submit').disabled='true';" id="form_zain">
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
    @php
        $lang = session('applocale') == 'ar' ? 'en' : 'ar';
        $lang2 = session('applocale') == 'ar' ? 'EN' : 'AR';
    @endphp
    @if ($lang == 'en')
    <a class="btn btn-sm btn-success" style="position: fixed; top: 10px; right: 10px; padding: 10px;" href="{{url('admin/lang/'.$lang)}}">{{$lang2}}</a>
    @else
    <a class="btn btn-sm btn-success" style="position: fixed; top: 10px; left: 10px; padding: 10px;" href="{{url('admin/lang/'.$lang)}}">{{$lang2}}</a>
    @endif

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
    $(document).ready(function(){
       var msisdn = $("#phone").val() ;
       if(msisdn != ""){
           $('#form').submit()
       }
});
  </script>

</body>

</html>
