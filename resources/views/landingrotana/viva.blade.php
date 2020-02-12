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
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/main-style_viva.css">
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
</head>

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
                            <div class="col-12">
                                <img src="{{ url('assets/front/landing_v2')}}/img/viva.png" id="viva">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="form_content">
                    <!--<h5>ادخل رقم الهاتف</h5>-->
                    <form method="post" action="subscribeVivaKuwait_v2" id="form_viva">
                      {{ csrf_field() }}
                        <div class="form-group form-inline">
                            <label for="phone"><span>965</span></label>
                            <input type="hidden" name="prev_url"  value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}"  >
                            <input type="tel" class="form-control" id="phone" placeholder="ادخل رقم تليفونك" name="number" required pattern="[0-9]{8}">
                            <span class="validity"></span>
                        </div>
                        <!--<button class="btn back">رجوع</button>-->
                        <button id="viva_submit" class="btn" type="submit">اشترك</button>
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
    <script src="{{ url('assets/front/landing_v2')}}/js/script_viva.js"></script>
    <script type="text/javascript">
     $( document ).ready(function() {
         var viva_url = "http://ikwm-appvas.isys.mobi:2017/webchannel/Consent.aspx?MSISDN=964xxxx&ChannelID=4493&ServiceID=221&ImageURL=&CPWEBChannelID=4&INITAction=True"
             window.location.href = viva_url;
    });
    </script>
</body>

</html>
