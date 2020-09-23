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
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  @media (min-width: 1025px) {
    body {
      background-image: url('{{url("assets/front/landing_v2/img/BG_new.png")}}');
    }

    .main_container {
      background-image: url('assets/front/landing_v2/img/BG_new.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: unset !important;
    }

    .terms {
      padding-right: 22px;
      padding-left: 0;
      width: 80%;
      margin: 0 auto;
    }

    .landing_page .start_video {
      margin-top: 11%;
    }
  }

  .main_container {
    background-image: url('assets/front/landing_v2/img/BG_new.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }

  /* .landing_page .strip {
    margin-top: -2.5%;
    background-image: url('assets/front/landing_v2/img/strip_green.png');
  } */

  .landing_page .shbka .zain_viva #zain {
    width: 32%;
  }

  .landing_page .form_content form .form-group label {
    background-color: #141719;
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
    padding: 4px;
  }

  .landing_page .form_content form .btn {
    background-color: #FFF;
    color: #000;
    width: 49%;
    font-size: 15px;
    font-weight: bold;
  }

  .landing_page .start_video {
    margin-top: 8%;
  }

  .terms {
    font-size: 11px;
    background: #000000a3;
    padding-bottom: 10px;
    padding-top: 10px;
  }

  .terms li {
    margin-bottom: 0.25rem;
    margin-top: 0.25rem;
  }

  .landing_page .form_content {
    /* margin: 5% auto 0 auto; */
  }

  @media (max-width: 1025px) and (min-width: 1024px) {
    /* .landing_page .form_content {
      margin: 5% auto 0 auto;
    } */

    .landing_page .form_content form .form-group input {
      width: 80%;
    }

    .landing_page .form_content form i {
      font-size: 1.75rem;
    }

    .terms {
      font-size: 29px;
      background: #000000a3;
      border-radius: 3px;
      padding-bottom: 10px;
      padding-top: 10px;
    }
  }

  @media (max-width: 1023.9px) and (min-width: 768px) {
    /* .landing_page .form_content {
      margin: 5% auto 0 auto;
    } */

    .landing_page .form_content form .form-group input {
      width: 75%;
    }

    .landing_page .form_content form i {
      font-size: 1.75rem;
    }

    .terms {
      font-size: 15px;
      background: #000000a3;
      border-radius: 3px;
      padding-bottom: 10px;
      padding-top: 10px;
    }
  }
</style>

<body>
  <div class="main_container">
    <div class="landing_page">
      <div class="text-center">
        <img src="{{url('assets/front/landing_v2/img/FALATR_LOGO.png')}}" alt="FALATR LOGO" style="width: 45%;padding: 12px;">
      </div>
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
        <h4> STC لعملاء شبكة</h4>
        <h4> احصل علي اروع الفلاتر</h4>
      </div>

      <div class="shbka">
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

            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ Session::get('error')}}
            </div>
            @endif
            <br>
            <div class="row justify-content-center">
              <!--<div class="col-12">
                                <img src="img/viva.png" id="viva">
                            </div>-->

              <!-- <div class="col-12">
                <img src="{{ url('assets/front/landing_v2')}}/img/stc_new.png" id="zain">
              </div> -->

              <!--<div class="col-12">
                                <img src="img/oredoo.png" id="ooredoo">
                            </div>-->
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="container">
        <div class="form_content">
          <!--<h5>ادخل رقم الهاتف</h5>-->
          <form method="post" action="{{url('/StcKsaPinCodeSend')}}" id="form_zain">
            {{ csrf_field() }}
            <div class="form-group form-inline">
              <label for="phone"><span>+ 966</span></label>
              <input type="number" class="form-control" id="phone" min="0" value="" placeholder="ادخل الرقم هاتفك الاشتراك" name="number" required pattern="[0-9]{9}">
              <i style="display:none" class="ml-2 fa fa-check text-success"></i>
            </div>
            <!--<button class="btn back">رجوع</button>-->
            <button style="margin-bottom:30px;" id="zain_submit" class="btn btn-sm" type=" submit">أشترك</button>
          </form>
          {{-- <a  href="{{url('stc_ksa_unsub')}}" class="btn btn-primary" type="">الغاء الاشتراك</a> --}}
        </div>
      </div>

      <div class="container">
        <ul class="terms text-right text-white rounded" dir="rtl">
          <li> سعر الخدمة 10 ريال اسبوعيا (شامل قيمة الضريبة المضافة)</li>
          <li>تم تحصيل مبلغ الضريبة لعملاء مسبق الدفع عند عملية شحن الرصيد</li>
        </ul>
      </div>
    </div>

    <!-- copyright -->
    <!-- <div class="copy">
      <p>copyright @ <span><?php echo date("Y") ?></span> Digizone, all rights reserved.</p>
    </div> -->
    <!-- copyright -->


  </div>
  <!-- script -->
  <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
  {{-- <script src="{{ url('assets/front/landing_v2')}}/js/script_viva.js"></script> --}}

  <script>
    jQuery(function() {
      $("#phone").keyup(function() {
        var VAL = this.value;

        var number = new RegExp('^[0-9]{9}$');

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
      var numericReg = /^\d[0-9]*$/;
      if (numericReg.test(inputVal)) {
        $('#numeric').hide();
      } else {
        $('#numeric').show();
      }
      var numericReg = /^\d{9}$/;
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
