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

<body>
    <div class="main_container">
        <div class="landing_page">

            <div class="start_video" id="video">
                <!-- <video width="100%" autoplay muted loop="true">
                    <source src="{{ url('assets/front/landing_v2')}}/video/1.mp4" type="video/mp4">
                </video> -->
                <img width="100%" src="{{ url('assets/front/landing_v2')}}/img/01.jpg" alt="فلاتر">
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
                            </div>-->

                            <div class="col-12">
                                <img src="{{ url('assets/front/landing_v2')}}/img/kw-stc-logo.png" id="zain">
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
                    <!--<h5>ادخل رقم الهاتف</h5>-->
                    <form method="post" action="{{url('/viva_login_action')}}" id="form_zain">
                        {{ csrf_field() }}
                        <div class="form-group form-inline">
                            <label for="phone"><span>+ 965</span></label>
                            <input type="number" class="form-control" id="phone" value=""
                                placeholder="أدخل رقم تليفونك" name="number" required pattern="[0-9]{8}">
                            <i style="display:none" class="ml-2 fa fa-check text-success"></i>
                        </div>
                        <!--<button class="btn back">رجوع</button>-->
                        <button id="zain_submit" class="btn" type="submit">أشترك</button>
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


        <script>
            jQuery(function () {
                $("#phone").keyup(function () {
                    var VAL = this.value;

                    var number = new RegExp('^[0-9]{8}$');

                    if (number.test(VAL)) {
                        $('.form-group i').addClass('fa-check')
                        $('.form-group i').removeClass('fa-times')
                        $('.form-group i').addClass('text-success')
                        $('.form-group i').removeClass('text-danger')
                        $('.form-group i').css('display','inline-block')
                    }else if(number.test(VAL) == false){
                        $('.form-group i').removeClass('fa-check')
                        $('.form-group i').addClass('fa-times')
                        $('.form-group i').removeClass('text-success')
                        $('.form-group i').addClass('text-danger')
                        $('.form-group i').css('display','inline-block')
                    }
                });
            });
            $( "#form_zain" ).submit(function( event ) {
              var inputVal = $('#phone').val();
              var numericReg = /^\d[0-8]*$/;
              if(numericReg.test(inputVal)) {
                  $('#numeric').hide();
              }else{
                  $('#numeric').show();
              }
              var numericReg = /^\d{8}$/;
              if(numericReg.test(inputVal)) {
                  $('#numericnum').hide();
                  return;
              }else{
                  $('#numericnum').show();
              }
              $('#numeric').css('display', 'block ');
              $('#numericnum').css('display', 'block ');
              event.preventDefault();
          });
        </script>

</body>

</html>