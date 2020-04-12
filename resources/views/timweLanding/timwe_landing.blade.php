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
                <h2>استمتع بوقتك مع فلاتر</h2>
            </div>

            <div class="shbka">
                <div class="container">
                    <h3>اشترك الان</h3>
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

            <div class="container pt-3">
                <div class="form_content">
                    <!--<h5>ادخل رقم الهاتف</h5>-->
                    <form method="post" action="{{url('subscription/optin/'.partnerRoleId)}}"    onsubmit="document.getElementById('zain_submit').disabled='true';"  id="form_zain">
                      {{ csrf_field() }}
                        <div class="form-group form-inline">
                            <input type="hidden" name="type" value="rotana">
                            <label for="phone"><span>974</span></label>
                            <input type="hidden" name="prev_url"  value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}"  >
                            <input type="tel" class="form-control" id="phone" required="" placeholder="رقم الهاتف" name="number" required pattern="[0-9]{8}">
                            <span class="validity"></span>
                        </div>
                        <!--<button class="btn back">رجوع</button>-->
                        <button id="zain_submit"  class="btn" type="submit">اشترك</button>
                    </form>
            </div>
        </div>
    </div>
    <div class="cancel text-center mt-4">
        <p>لالغاء الاشتراك يرجي الضغط علي هذا <a href="{{url('ooredoo_qatar_unsub' )}}">الرابط</a></p>
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


<div class="the-frame">
    <iframe class="full-screen-preview__frame" src="{{url()->full()}}" name="preview-frame" frameborder="0" noresize="noresize" data-view="fullScreenPreview" style="height: 570px; width: 370px; border-radius: 10px;">
    </iframe>
  </div>

  <script>
    if (screen.width <= 1025) {
      // document.location.href = "{{url('front.home')}}";
    }
  </script>

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
