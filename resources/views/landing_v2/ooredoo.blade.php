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
  <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/main-style_ooredoo.css">
  <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
</head>

<style>
  @media only screen and (min-width: 1025px) {
    body {
      background-image: url('assets/front/landing_v2/img/BG_Pattern.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
    }
  }
</style>

<body>
  <div class="main_container">
    <div class="landing_page">

      <div class="start_video" id="video">
        <video width="100%" autoplay muted loop="true">
          <source src="{{ url('assets/front/landing_v2')}}/video/1.mp4" type="video/mp4">
        </video>
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
            <div class="row justify-content-center">
              <!--<div class="col-12">
                                <img src="img/viva.png" id="viva">
                            </div>

                            <div class="col-12">
                                <img src="img/zain.png" id="zain">
                            </div>-->

              <div class="col-12">
                <img src="{{ url('assets/front/landing_v2')}}/img/oredoo.png" id="ooredoo">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="form_content">
          <!--<h5>ادخل رقم الهاتف</h5>-->
          <form method="post" action="subscribeOreedo" id="form_ooredoo">
            {{ csrf_field() }}
            <div class="form-group form-inline">
              <label for="phone"><span>965</span></label>
              <input type="hidden" name="prev_url" value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}">
              <input type="tel" class="form-control" id="phone" value="{{$MSISDN}}" placeholder="ادخل رقم تليفونك" name="number" required pattern="[0-9]{8}">
              <span class="validity"></span>
            </div>
            <!--<button class="btn back">رجوع</button>-->
            <button id="ooredoo_submit" class="btn" type="submit">اشترك</button>
          </form>
          <!--<h5>للاشتراك يرجى الارسال الى <span>965</span></h5>
                <h5>الى <span>965</span><span> STOP1 </span>لالغاء الاشتراك ارسل</h5>-->
        </div>
      </div>
    </div>

    <!-- copyright -->
    <div class="copy">
      <p>copyright @ <span>2019</span> Ivas, all rights reserved.</p>
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
    $(document).ready(function() {
      var msisdn = $("#phone").val();
      if (msisdn != "") {
        $('#form').submit()
      }
    });
  </script>

</body>

</html>
