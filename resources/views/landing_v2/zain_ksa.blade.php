<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-1D1F2FQ4G5"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-1D1F2FQ4G5');
  </script>
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
  .landing_page .strip {
    margin-top: 0;
  }

  @media (min-width: 1025px) {
  body {
    background-image: url('{{url("assets/front/landing_v2/img/stc_BG.png")}}');
  }
}
  .main_container {
    background-image: url('assets/front/landing_v2/img/stc_BG.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }


  .landing_page .strip {
    background-image: url('assets/front/landing_v2/img/strip_green.png');
  }

  @media only screen and (max-width: 1025px) {
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
          <h3>?????????? ????????</h3>
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
              <!--<div class="col-12">
                                <img src="img/viva.png" id="viva">
                            </div>-->

              <div class="col-12">
                {{-- <img src="{{ url('assets/front/landing_v2')}}/img/mobily.png" id="zain"> --}}
                <img src="{{ url('assets/front/landing_v2')}}/img/zain_ksa.png" id="zain">
              </div>

              <!--<div class="col-12">
                                <img src="img/oredoo.png" id="ooredoo">
                            </div>-->
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="form_content">
          <!--<h5>???????? ?????? ????????????</h5>-->
          <form method="post" action="ZainKsaPinCodeSend" id="form_zain">
            {{ csrf_field() }}
            <div class="form-group form-inline justify-content-center">
              <label for="phone"><span>{{zain_ksa_prefix}}</span></label>
              <input type="hidden" name="prev_url" value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}">
              <input type="tel" class="form-control" id="phone" value="{{$MSISDN}}" placeholder="???????? ?????? ??????????????" name="number" required pattern="[0-9]{9}">
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
        <p>?????????? ???? ???????????? ?????????? 5 ???????? ?????????????? </p>
      </div>

      {{-- <div class="cancel">
                <p>???????????? ???????????????? ???????? ?????????? ?????? ?????? <a href="{{url('zain_ksa_unsub')}}">????????????</a></p>
    </div> --}}


  </div>

  <div class="copy" >
    <p>copyright @ <span><?php echo date("Y") ?></span> Digizone, all rights reserved.</p>
  </div>
  </div>

  <!-- script -->
  <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/script_zain.js"></script>
  <script>
    $('form').submit(function() {
      $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
</body>

</html>
