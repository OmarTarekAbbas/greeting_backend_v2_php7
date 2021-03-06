<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
  <meta charset="utf-8">
  <!--IE Compatibility Meta-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Mobile Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>فلاتر موبيل حصرية</title>
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
    /* margin-top: 0; */
  }

  @media (min-width: 1025px) {
  body {
    background-image: url('{{url("assets/front/landing_v2/img/snap_new_landing/BG.jpg")}}');
  }
}

  .modal {
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

    .operator img {
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

  .main_container {
    /* background: url("{{url('assets/front/landing_v2/img/snap_new_landing/BG.jpg')}}");
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; */
  }
</style>

<body>

  <!-- <audio id="my_audio" controls autoplay hidden>
        <source src="{{url('landing/falater_background_music.mp3')}}" type="audio/ogg">
        <source src="{{url('landing/falater_background_music.mp3')}}" type="audio/mpeg">
    </audio> -->

  <div class="main_container">
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

      <div class="strip" style="color:#000">
        <h2 style="font-size: 2.5rem">للحصول على فلاتر خاصة ومميزة</h2>
      </div>

      <div class="shbka">
        <div class="container">

          <h3 style="color:#000;font-weight:normal">
            أختر شبكتك
          </h3>

          <div class="zain_viva pt-3">
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
            <div class="row justify-content-center pt-3 ml-0">
              <!--<div class="col-12">
                                <img src="img/viva.png" id="viva">
                            </div>-->

              <div class="col-4 pl-0">
                {{-- <img src="{{ url('assets/front/landing_v2')}}/img/mobily.png" id="zain"> --}}
                <a class="operator" sms='96946' body='1' href="">
                  <img class="img-fluid w-100" src="{{ url('assets/front/landing_v2')}}/img/snap_new_landing/landing_kuwait/03.png" id="zain1">
                </a>
              </div>

              <div class="col-4 pl-0">
                {{-- <img src="{{ url('assets/front/landing_v2')}}/img/mobily.png" id="zain"> --}}
                <a class="operator" sms='1368' body='1' href="">
                  <img class="img-fluid w-100" src="{{ url('assets/front/landing_v2')}}/img/snap_new_landing/landing_kuwait/02.png" id="oredoo">
                </a>
              </div>

              <div class="col-4 pl-0">
                {{-- <img src="{{ url('assets/front/landing_v2')}}/img/mobily.png" id="zain"> --}}
                <a class="operator" sms='50663' body='1' href="">
                  <img class="img-fluid w-100" src="{{ url('assets/front/landing_v2')}}/img/snap_new_landing/landing_kuwait/01.png" id="stc">
                </a>
              </div>

              <!--<div class="col-12">
                                <img src="img/oredoo.png" id="ooredoo">
                            </div>-->
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- copyright -->
    <div class="copy" style="font-size:10px;font-family:sans-serif">
      <p style="color:#000;margin-top:5px">copyright @ {{date('Y')}} Digizone, all rights reserved.</p>
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



  <div class="modal" id="myModal">
    <div class="modal-body">
      <h3>خدمة فلاتر</h3>
      <a id="entry" class="btn text-primary bg-warning" onclick=" x()" style="margin: 0 auto">الدخول</a>
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
      var operator = $(this).attr('sms') == '96946' ? 'Zain' : $(this).attr('sms') == '1368' ? 'Oredoo' : 'Stc';
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

  <script type="text/javascript">
    $(window).on('load', function() {
      //  $('#myModal').modal('show');
    });
  </script>
  <script>
    function x() {
      document.getElementById("my_audio").play();
      $('.modal-backdrop').hide();
      $('#myModal').hide();
    }
  </script>

</body>

</html>
