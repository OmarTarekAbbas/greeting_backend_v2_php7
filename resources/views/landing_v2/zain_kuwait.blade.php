<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
  <meta charset="utf-8">
  <!--IE Compatibility Meta-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Mobile Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zain KSA Snap Landing Page</title>
  <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/main-style_zain.css">
  <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->

</head>

<style type="text/css">
  @font-face {
    font-family: myFont;
    src: url('{{url("assets/front/landing_v2/font/HelveticaNeueLTArabic-Bold.ttf")}}');
  }

  body {
    font-family: myFont;
  }

  .landing_page .strip {
    margin-top: 0;
  }

  @media (min-width: 1025px) and (max-width: 2000px) {
    .main_container {
      width: 100% !important;
      margin: 0 auto;
      display: block;
      position: unset;
      background-attachment: unset !important;
    }
  }

  .main_container {
    background-image: url('assets/front/landing_v2/img/snap_new_landing/zain_kuwait.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }

  .landing_page .form_content form .btn {
    background-color: #000;
    color: #fff;
    width: 50%;
  }

  .copy p {
    color: #000;
  }

  .copy p span {
    font-family: 'myFont';
  }

  .landing_page .form_content form .form-group label {
    background-color: #000;
    color: #fff;
    padding: 6px 12px;
    border-bottom-left-radius: 10px;
    border-top-left-radius: 10px;
  }

  .landing_page .strip {
    background-image: url('assets/front/landing_v2/img/strip_green.png');
  }

  @media only screen and (min-width: 1025px) {
    .shbka .zain_viva {
      margin-top: unset;
      margin-bottom: unset;
    }

    .shbka .zain_viva #zain {
      width: 20% !important;
    }
  }

  @media (min-width: 768px) and (max-width: 1025px) {
    .shbka .zain_viva {
      margin-top: unset !important;
      margin-bottom: unset !important;
    }
  }
</style>

<body>
  <div class="main_container">
    <div class="landing_page">

      <div class="start_video" id="video">
        <!-- <video width="100%" poster="{{ url('assets/front/landing_v2')}}/video/snap2.jpg" id="my_audio" controls>
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/mp4">
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/ogg">
        </video> -->

        <video width="100%" poster="{{ url('assets/front/landing_v2')}}/img/06.jpg" id="my_audio" controls>
          <source src="{{ url('assets/front/landing_v2')}}/img/snap_new_landing/New_VID.mp4" type="video/mp4">
          <source src="{{ url('assets/front/landing_v2')}}/img/snap_new_landing/New_VID.mp4" type="video/ogg">
        </video>
      </div>

      <div class="text-center mt-2">
        <!-- <h5>???????????? ?????????? ???? ??????????</h5> -->

        <h5 class="font-weight-bold">???????? ?????? ?????????? ???????????? ????????????</h5>
        <h5 style="font-size: 1.10rem;">???????? ???? 3000 ???????? ????????</h5>
      </div>

      <div class="shbka">
        <div class="container">
          <h5 style="font-size: 1.10rem; margin-top: 20%;">?????? ???????? ?????????? ????????????</h5>
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
            <!-- <div class="row justify-content-center">
              <div class="col-12">
                <img src="{{ url('assets/front/landing_v2')}}/operators2/zain_kw_2.png" id="zain">
              </div>
            </div> -->
          </div>
        </div>
      </div>

      <div class="container">
        <div class="form_content">
          <!--<h5>???????? ?????? ????????????</h5>-->
          <form method="post" action="ZainKuwaitPinCodeSend" id="form_zain">
            {{ csrf_field() }}
            <div class="form-group form-inline justify-content-center">
              <label for="phone"><span>965</span></label>
              <input type="hidden" name="prev_url" value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}">
              <input type="tel" class="form-control" id="phone" value="{{$MSISDN}}" placeholder="???????? ?????? ??????????????" name="number" required pattern="[0-8]{8}">
              <span class="validity"></span>
            </div>
            <!--<button class="btn back">????????</button>-->
            <button id="zain_submit" class="btn" type="submit">??????????</button>
          </form>
          <!--<h5>???????????????? ???????? ?????????????? ?????? <span>965</span></h5>
                <h5>?????? <span>965</span><span> STOP1 </span>???????????? ???????????????? ????????</h5>-->
        </div>
      </div>

      <div class="cancel">
        {{-- <p>?????????? ???? ???????????? ?????????? 5 ???????? ?????????????? </p> --}}
      </div>

      {{-- <div class="cancel">
                <p>???????????? ???????????????? ???????? ?????????? ?????? ?????? <a href="{{url('zain_ksa_unsub')}} ">????????????</a></p>
    </div> --}}


  </div>

  <div class="copy">
    <p>copyright @ <span><?php echo date("Y") ?></span> Digizone, all rights reserved.</p>
  </div>
  </div>

  <!-- script -->
  <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/script_zain.js"></script>

</body>

</html>
