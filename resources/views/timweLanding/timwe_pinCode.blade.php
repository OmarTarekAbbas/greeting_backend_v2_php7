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
    .landing_page .start_video video{
        object-fit: cover;
        height: 13.875rem;
    }

    .landing_page .strip {
        margin-top: 0;
    }

    .main_container {
        background-image: url('{{url("assets/front/landing_v2/img/BG_Pattern_v2.png")}}');
    }

    .landing_page .strip {
        background-image: url('{{url("assets/front/landing_v2/img/strip_v2.png")}}');
    }
</style>

<body>
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
                    {!! Form::open(['url'=>'subscription/confirm/'.partnerRoleId,'method'=>'post','class'=>'form']) !!}
                    <div class="form-group">
                          <input style="width: 100% !important" type="tel" style="font-family: cursive" name="pincode" class="form-control" id="pincode" required pattern="[0-9]{4}">
                    </div>
                    <button class="btn" type="submit" >تاكيد</button>
                     {!! Form::close() !!}
                </div>
        </div>
    </div>
    <div class="cancel text-center mt-4">
        {!! Form::open(['url'=>'subscription/optin/'.partnerRoleId,'method'=>'post','class'=>'form']) !!}
            <div class="form-group">
                <input type="submit" value=" اضغط لارسال رمز التاكيد مرة اخري">
            </div>
        {!! Form::close() !!}
    </div>
    <!-- copyright -->
    <div class="copy">
        <p>copyright @ <span>{{date('Y')}}</span> Digizone, all rights reserved.</p>
    </div>
    <!-- copyright -->

    <!-- loading -->
    <div class="loading-overlay">
        <div class="spinner">
            <img src="{{ url('assets/front/landing_v2')}}/img/logo.jpg" alt="loading_snap"> 
        </div>
    </div>
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
