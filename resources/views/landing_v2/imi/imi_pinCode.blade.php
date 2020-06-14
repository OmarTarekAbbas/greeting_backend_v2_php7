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
                <video width="100%" height="240" poster="{{ url('assets/front/landing_v2')}}/video/snap2.jpg" id="my_audio" controls>
                    <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/mp4">
                    <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/ogg">
                  </video>
                <!-- <video width="100%" autoplay muted loop="true">
                            <source src="{{ url('assets/front/landing_v2')}}/video/1.mp4" type="video/mp4">
                        </video> -->
                <!-- <img width="100%" src="{{ url('assets/front/landing_v2')}}/img/01.jpg" alt="فلاتر"> -->
              </div>
            <div class="strip">
                <h2>ادخل كود التفعيل</h2>
            </div>

            <div class="shbka pt-5">
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

            <div class="container pt-4">
                <div class="form_content">
                    <!--<h5>ادخل رقم الهاتف</h5>-->
                    {!! Form::open(['url'=>'generateOTPValidate' ,'method'=>'post','class'=>'form mt-5']) !!}
                    <div class="form-group">
                          <input style="width: 100% !important" type="tel" style="font-family: cursive" name="pincode" class="form-control" id="pincode" required pattern="[0-9]{4}">
                    </div>
                    <button class="btn" type="submit" >تاكيد</button>
                     {!! Form::close() !!}
                </div>
        </div>
        <div class="cancel text-center">
          {!! Form::open(['url'=>'generateOTP','method'=>'post','class'=>'form']) !!}
              <div class="form-group">
                  <input type="submit" value=" اضغط لارسال رمز التاكيد مرة اخري">
              </div>
          {!! Form::close() !!}
      </div>
    </div>
</div>
<!-- script -->
<!-- script -->
<script src="{{url('front/stc')}}/js/jquery-3.4.0.min.js"></script>
<script src="{{url('front/stc')}}/js/bootstrap.min.js"></script>

<script src="{{ url('front/stc')}}/js/popper.min.js"></script>
<script src="{{ url('front/stc')}}/js/script_viva.js"></script>

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