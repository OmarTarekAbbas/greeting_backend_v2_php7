<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
  <meta charset="utf-8">
  <!--IE Compatibility Meta-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Mobile Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Filetrs Login page</title>
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

  .terms {font-size: 0.7rem;}
</style>

<body>
  <div class="main_container">
    <div class="landing_page">

      <div class="start_video" id="video">
        <video width="100%" poster="{{ url('assets/front/landing_v2')}}/video/snap2.jpg" id="my_audio" controls>
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/mp4">
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/ogg">
        </video>
      </div>

      <div class="strip">
        <h2>???????????? ?????????? ???? ??????????</h2>
      </div>

      <div class="shbka">
        <div class="container">

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
          </div>
        </div>
      </div>

      <div class="container pt-2">
        <div class="form_content">
          <!--<h5>???????? ?????? ????????????</h5>-->
          <form method="post" action="{{url('checkstatus')}}" onsubmit="document.getElementById('zain_submit').disabled='true';" id="form_zain">
            {{ csrf_field() }}
            <div class="form-group form-inline">
              <input type="hidden" name="type" value="rotana">
              <label for="phone"><span>974</span></label>
              <input type="hidden" name="prev_url" value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}">
              <input type="tel" class="form-control" id="phone" value="{{$msisdn}}" required="" placeholder="???????? ?????? ?????????? ????????????" name="number" required pattern="[0-9]{8}">
              <span class="validity"></span>
            </div>
            <!--<button class="btn back">????????</button>-->
            <button id="zain_submit" class="btn" type="submit">????????</button>
          </form>
        </div>
      </div>
    </div>

    <!-- copyright -->

    <div class="copy">
      <p>copyright @ <span>{{date('Y')}}</span> Digizone, all rights reserved.</p>
    </div>
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
