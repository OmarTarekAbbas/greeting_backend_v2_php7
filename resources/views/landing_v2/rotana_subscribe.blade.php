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
    width: 100%;
    margin-bottom: 1rem;
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
          <h3 class="mb-3 mt-3">       اشترك الان بالضغط علي شبكتك
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
              <div class="col-4">
                <a href="#0">
                  <img src="{{ url('assets/front/landing_v2')}}/img/stc_new.png" id="zain">
                </a>
              </div>

              <div class="col-4">
                <a href="#0">
                  <img src="{{ url('assets/front/landing_v2')}}/img/stc_new.png" id="zain">
                </a>
              </div>

              <div class="col-4">
                <a href="#0">
                  <img src="{{ url('assets/front/landing_v2')}}/img/stc_new.png" id="zain">
                </a>
              </div>

              <div class="col-4">
                <a href="#0">
                  <img src="{{ url('assets/front/landing_v2')}}/img/stc_new.png" id="zain">
                </a>
              </div>

              <div class="col-4">
                <a href="#0">
                  <img src="{{ url('assets/front/landing_v2')}}/img/stc_new.png" id="zain">
                </a>
              </div>

              <div class="col-4">
                <a href="#0">
                  <img src="{{ url('assets/front/landing_v2')}}/img/stc_new.png" id="zain">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container">

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
    jQuery(function() {
      $("#phone").keyup(function() {
        var VAL = this.value;

        var number = new RegExp('^[0-9]{8}$');

        if (number.test(VAL)) {
          $('.form-group i').addClass('fa-check')
          $('.form-group i').removeClass('fa-times')
          $('.form-group i').addClass('text-success')
          $('.form-group i').removeClass('text-danger')
          $('.form-group i').css('display', 'inline-block')
        } else if (number.test(VAL) == false) {
          $('.form-group i').removeClass('fa-check')
          $('.form-group i').addClass('fa-times')
          $('.form-group i').removeClass('text-success')
          $('.form-group i').addClass('text-danger')
          $('.form-group i').css('display', 'inline-block')
        }
      });
    });
    $("#form_zain").submit(function(event) {
      var inputVal = $('#phone').val();
      var numericReg = /^\d[0-8]*$/;
      if (numericReg.test(inputVal)) {
        $('#numeric').hide();
      } else {
        $('#numeric').show();
      }
      var numericReg = /^\d{8}$/;
      if (numericReg.test(inputVal)) {
        $('#numericnum').hide();
        return;
      } else {
        $('#numericnum').show();
      }
      $('#numeric').css('display', 'block ');
      $('#numericnum').css('display', 'block ');
      event.preventDefault();
    });
  </script>

</body>

</html>
