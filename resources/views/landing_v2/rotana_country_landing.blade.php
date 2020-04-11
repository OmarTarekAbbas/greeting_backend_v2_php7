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
  <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
</head>

<style>
  .main_container {
    background-image: url('assets/front/landing_v2/img/stc_BG.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }

  .landing_page .strip {
    margin-top: -2.5%;
    background-image: url('assets/front/landing_v2/img/strip_green.png');
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

  .country p{
    text-align: center;
    color:#fff;
  }
</style>

<?php
preg_match("/iPhone|iPad|iPod/", $_SERVER['HTTP_USER_AGENT'], $matches);
$os = current($matches);

switch ($os) {
    case 'iPhone':
        if (preg_match('/OS 8/', $_SERVER['HTTP_USER_AGENT']) || preg_match('/OS 9/', $_SERVER['HTTP_USER_AGENT'])) {
            $Att = '&body=';
        } else {
            $Att = ';';
        }
        break;
    case 'iPad': $Att = '&body=';
        break;
    case 'iPod': $Att = '&body=';
        break;
    default : $Att = '?body=';
        break;
}?>

<body>
  <div class="main_container">
    <div class="landing_page">

      <div class="start_video" id="video">
        <video width="100%" poster="{{ url('assets/front/landing_v2')}}/video/snap2.jpg" id="my_audio" controls>
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/mp4">
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/ogg">
        </video>
        <!-- <video width="100%" autoplay muted loop="true">
                    <source src="{{ url('assets/front/landing_v2')}}/video/1.mp4" type="video/mp4">
                </video> -->
        <!-- <img width="100%" src="{{ url('assets/front/landing_v2')}}/img/01.jpg" alt="فلاتر"> -->
      </div>

      <div class="strip">
        <h3>استمتع بوقتك مع فلاتر روتانا</h3>
      </div>

      <div class="shbka">
        <div class="container">
          <h3 class="mb-3 mt-3">
            اشترك الان يالضغط علي شيكتك
          </h3>
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

            </div>
          </div>
        </div>
      </div>

      <div class="container country">
        <div class="row">
          @if($country == 'KSA')
          <div class="col-4">
            <a href="sms:606068{{$Att}}37" class="click_op" data-country = "{{$country}}" data-operator="Mobily">
              <img   width="100px" height="100px"  src="{{ url('assets/front/landing_v2')}}/operators2/MOBILE.png" alt="">
              <p>Mobily</p>
            </a>

          </div>
          <div class="col-4">
            <a href="sms:798940{{$Att}}10" class="click_op" data-country = "{{$country}}" data-operator="Zain">
              <img  width="100px" height="100px"  src="{{ url('assets/front/landing_v2')}}/operators2/ZAIN_KSA.png" alt="">
              <p>Zain</p>
            </a>

          </div>
          <div class="col-4">
            <a href="sms:801267{{$Att}}6" class="click_op" data-country = "{{$country}}" data-operator="STC">
              <img   width="100px" height="100px" src="{{ url('assets/front/landing_v2')}}/operators2/STC.png" alt="">
              <p>STC</p>
            </a>

          </div>
          @endif

          @if($country == 'Egypt')
          <div class="col-12">
            <a  href="sms:9999{{$Att}}10083" class="click_op" data-country = "{{$country}}" data-operator="Vodafone">
              <img style="margin-left: 20%"   width="200px" height="200px"  src="{{ url('assets/front/landing_v2')}}/operators2/VODAFONE.png" alt="">
              <p>Vodafone</p>
            </a>

          </div>
          {{--  <div class="col-6">
            <a href="sms:8719{{$Att}}10" class="click_op" data-country = "{{$country}}" data-operator="Orange">
              <img src="{{ url('assets/front/landing_v2')}}/operators/snap2.jpg" alt="">
              <p>Orange </p>
            </a>

          </div>  --}}
          @endif

          @if($country == 'Kuwait')
          <div class="col-6">
            <a href="sms:50662{{$Att}}1" class="click_op" data-country = "{{$country}}" data-operator="STC">
              <img width="100px" height="100px" src="{{ url('assets/front/landing_v2')}}/operators2/STC.png" alt="">
              <p>STC</p>
            </a>

          </div>
          <div class="col-6">
            <a href="sms:90355{{$Att}}1" class="click_op" data-country = "{{$country}}" data-operator="Zain">
              <img width="100px" height="100px" src="{{ url('assets/front/landing_v2')}}/operators2/ZAIN_KW.png" alt="">
              <p>Zain </p>
            </a>

          </div>
          @endif

          @if($country == 'United Arab Emirates')
          <div class="col-6">
            <a href="sms:4971{{$Att}}10" class="click_op" data-country = "{{$country}}" data-operator="DU">
              <img src="{{ url('assets/front/landing_v2')}}/operators2/DU.png" alt="">
              <p>DU </p>
            </a>

          </div>
          @endif
        </div>
      </div>

    </div>

    <!-- copyright -->
    <div class="copy">
      <p>copyright @ <span><?php echo date("Y") ?></span> Digizone, all rights reserved.</p>
    </div>
    <!-- copyright -->


  </div>
  <!-- script -->
  <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/script_viva.js"></script>

  <script>
    $('.click_op').click(function(){
      var co = $(this).data('country')
      var op = $(this).data('operator')
      $.ajax({
        method : 'get',
        actions : '{{url("rotana_country_landing")}}',
        data:{
          country:co ,
          operator_name : op
        },
        success:function(res){
          console.log(res);

        }
      })
      // $.get('{{url("rotana_country_landing")}}',{data:{}},function(res){
      //   console.log(res);
      // })
    })
  </script>


</body>

</html>
