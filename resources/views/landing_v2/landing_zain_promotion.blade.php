<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
  <meta charset="utf-8">
  <!--IE Compatibility Meta-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Mobile Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flatters Kuwait Landing page</title>
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
        <!-- <h5>استمتع بوقتك مع فلاتر</h5> -->

        <h5 class="font-weight-bold">احصل علي فلاتر متجددة يومياً</h5>
        <h5 style="font-size: 1.10rem;">اكثر من 3000 فلتر حصري</h5>
      </div>

      <div class="shbka">
        <div class="container">
          <h5 style="font-size: 1.10rem; margin-top: 20%;">سجل رقمك واضغط اشتراك</h5>
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
      <?php
      if (app('request')->input('clickid')) {
        $clickid = 'clickid='.app('request')->input('clickid');
      } else {
        $clickid = false;
      }
      ?>
      <div class="container">
      <div class="row justify-content-center pt-3 ml-0">
              <div class="col-4 pl-0">
              <!--  -->
                <a class="operator" sms='oredoo' href="{{ 'https://filters.digizone.com.kw/ooredoo_landing' }}@if($clickid)?@endif{{$clickid}}">
                  <img class="img-fluid w-100" src="{{ url('assets/front/landing_v2')}}/img/snap_new_landing/landing_kuwait/02.png" id="oredoo">
                </a>
              </div>

              <div class="col-4 pl-0">
                <a class="operator" sms='stc' href="{{ 'http://cg.mobi-mind.net/?ID=370,458bc531,661,8061,3,IVAS,https%3A%2F%2Ffiltersnew.digizone.com.kw%2Flanding_stc' }}@if($clickid)&@endif{{$clickid}}">
                  <img class="img-fluid w-100" src="{{ url('assets/front/landing_v2')}}/img/snap_new_landing/landing_kuwait/01.png" id="stc">
                </a>
              </div>

              <!--<div class="col-12">
                                <img src="img/oredoo.png" id="ooredoo">
                            </div>-->
            </div>
      </div>
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
  <script>
    // $(document).ready(function($) {
    //   var deviceAgent = navigator.userAgent.toLowerCase();
    //   var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
    //   var xArr = $('.operator');
    //   for (var i = 0; i < xArr.length; i++) {
    //     sms = xArr[i].getAttribute('sms');
    //     body = xArr[i].getAttribute('body');
    //     if (agentID) {
    //       xArr[i].setAttribute('href', 'sms:' + sms + '&body=' + body);
    //     } else {
    //       xArr[i].setAttribute('href', 'sms:' + sms + '?body=' + body);
    //     }
    //   }
    // });
    $('.operator').click(function() {
      var operator = $(this).attr('sms') == 'stc' ? 'Stc' : $(this).attr('sms') == 'oredoo' ? 'Oredoo' : '';
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
