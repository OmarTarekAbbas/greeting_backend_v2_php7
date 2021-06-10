<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
  <meta charset="utf-8">
  <!--IE Compatibility Meta-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Mobile Meta-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mobily KSA Flatter</title>
  <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/main-style_zain.css">
  <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->

</head>
<style type="text/css">
  .landing_page .form_content form .form-group label {
    padding: 7px;
  }

  .services_form {
    display: none;
  }

  .card {
    height: 11em;
    background-color: unset;
    border: unset;
  }

  .landing_page .strip {
    margin-top: 0;
  }

  @media (min-width: 1025px) {
    body {
      background-image: url('{{url("assets/front/landing_v2/img/stc_BG.png")}}');
    }
  }

  .main_container {
    background-image: url('assets/front/landing_v2/img/stc_BG.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }


  .landing_page .strip {
    background-image: url('assets/front/landing_v2/img/strip_green.png');
  }

  @media only screen and (max-width: 1025px) {
    .shbka .zain_viva {
      margin-top: unset;
      margin-bottom: unset;
    }

    .shbka .zain_viva #zain {
      width: 40% !important;
    }
  }

  @media (min-width: 768px) and (max-width: 1025px) {
    .shbka .zain_viva {
      margin-top: unset !important;
      margin-bottom: unset !important;
    }
  }

  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }

  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>


<body>
  <div class="main_container">
    <div class="landing_page">
      <div class="shbka">
        <div class="container">
          <h3 style="text-decoration: underline; margin-top:1em">اشترك معنا الان</h3>
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
            <div class="row justify-content-center" style="margin-top: 2em;">
              <div class="col-4 card">
                <a href="javascript:void(0);" class="service" data-service="service_mobily" data-operator="mobily" id="mobily">
                  <img src="{{ url('assets/front/landing_v2')}}/img/mobily.png" style="height: 9em; margin-top: -1em;" class="card-img-top" alt="...">
                </a>
              </div>
              <div class="col-4 card">
                <a href="javascript:void(0);" class="service" data-service="service_zain" data-operator="zain" id="zain" style="width: 100% !important;">
                  <img src="{{ url('assets/front/landing_v2')}}/operators2/ZAIN_KSA.png" style="height: 6em; margin-top: 1em; margin-bottom:1em;" class="card-img-top" alt="...">
                </a>
              </div>
              <div class="col-4 card">
                <a href="javascript:void(0);" class="service" data-service="service_stc" data-operator="stc" id="stc">
                  <img src="{{ url('assets/front/landing_v2')}}/operators2/STC.png" style="height: 8em;" class="card-img-top" alt="...">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="form_content">
          <!---------------------- Start Mobily Form -------------------------->
          <div class="services_form" id="service_mobily">
            <form method="post" action="MobilyKsaPinCodeSend">
              {{ csrf_field() }}
              <div class="form-group form-inline justify-content-center">
                <label for="phone"><span>+{{zain_ksa_prefix}}</span></label>
                <input type="hidden" name="prev_url" value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}">
                <input type="number" class="form-control" min="0" id="phone" value="{{$MSISDN}}" placeholder="ادخل رقم تليفونك" name="number" required pattern="[0-9]{9}">
              </div>
              <button class="btn" type="submit">اشترك</button>
            </form>

            <div class="cancel">
              <p>اشترك في الخدمة مقابل 0,66  ريال يوميا </p>
            </div>
          </div>
          <!---------------------- End Mobily Form ---------------------------->
          <!---------------------- Start Zain Form -------------------------->
          <div class="services_form" id="service_zain">
            <form method="post" action="ZainKsaPinCodeSend">
              {{ csrf_field() }}
              <div class="form-group form-inline justify-content-center">
                <label for="phone"><span>+{{zain_ksa_prefix}}</span></label>
                <input type="hidden" name="prev_url" value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}">
                <input type="number" class="form-control" min="0" value="{{$MSISDN}}" placeholder="ادخل رقم تليفونك" name="number" required pattern="[0-9]{9}">
              </div>
              <button class="btn" type="submit">اشترك</button>
            </form>

            <div class="cancel">
              <p>اشترك في الخدمة مقابل 5 ريال اسبوعيا </p>
            </div>
          </div>
          <!---------------------- End Zain Form ---------------------------->
          <!---------------------- Start STC Form -------------------------->
          <div class="services_form" id="service_stc">
            <form method="post" action="{{url('/StcKsaPinCodeSend')}}">
              {{ csrf_field() }}
              <div class="form-group form-inline justify-content-center">
                <label for="phone"><span>+{{zain_ksa_prefix}}</span></label>
                <input type="number" class="form-control" min="0" value="{{$MSISDN}}" placeholder="ادخل الرقم هاتفك" name="number" required pattern="[0-9]{9}">
                <i style="display:none" class="ml-2 fa fa-check text-success"></i>
              </div>
              <button class="btn btn-sm" type="submit">اشترك</button>
            </form>

            <div class="cancel">
              <p style="margin-bottom: 0px;"> سعر الخدمة 1.15 ريال يوميا (شامل قيمة الضريبة المضافة)</p>
              <p>تم تحصيل مبلغ الضريبة لعملاء مسبق الدفع عند عملية شحن الرصيد</p>
            </div>
          </div>
          <!---------------------- End STC Form ---------------------------->
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
    $('form').submit(function() {
      $(this).find("button[type='submit']").prop('disabled', true);
    });


    services = ['mobily', 'zain', 'stc'];
    $('.service').click(function() {
      var operator = $(this).attr("data-operator");
      var service = $(this).attr("data-service");
      initalizeForms();
      serActiveForm(operator);
    });

    // make initalize
    function initalizeForms() {
      services.forEach(function(service) {
        document.getElementById(service).style.borderBottom = 'none';
        $('#service_' + service).hide();
      });
    }

    function serActiveForm(clicked_service) {
      $('#service_' + clicked_service).slideToggle(500);
      document.getElementById(clicked_service).style.borderBottom = '3px solid #495057';
    }
  </script>
</body>

</html>
