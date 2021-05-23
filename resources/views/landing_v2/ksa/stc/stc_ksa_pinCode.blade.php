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
  @media (min-width: 1025px) {
    body {
      background-image: url('{{url("assets/front/landing_v2/img/BG_new.png")}}');
      font-family: sans-serif;
    }
  }

  .confirm_page .confirm {
    background-color: #000000a3;
  }

  .main_container {
    background-image: url('assets/front/landing_v2/img/BG_new.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: unset;
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

  .confirm_page .confirm .btn {
    background-color: white;
    color: #000;
    margin: 15px;
    width: 50%;
  }
</style>

<body>
  <div class="main_container">
    <div class="confirm_page">
      {{-- <img src="{{ url('assets/front/rotanav2')}}/images/Rorana_flater_logo.png" alt="snap"> --}}

      <div class="container">

        <div class="confirm text-white">

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

          <h2>ادخل كود التفعيل</h2>
          <hr>
          {!! Form::open(['url'=>'stc_ksa_pincode_confirm','method'=>'post','class'=>'form','files'=>'true']) !!}
          <div class="form-group">
            <input type="tel" name="pincode" placeholder="ادخل كود التفعيل" class="form-control text-center" id="pincode" required>
          </div>
          <input type="hidden" name="msisdn" value="{{$msisdn}}">

          <button id="zain_submit" class="btn btn-sm font-weight-bold" type="submit">تاكيد</button>
          {!! Form::close() !!}
        </div>
      </div>

      <div id="loginModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-right">
              <div class="alert alert-success" role="alert">تم تاكيد الكود بنجاح</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- script -->
  <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
  <script src="{{ url('assets/front/landing_v2')}}/js/script_viva.js"></script>

  <script>
 $('form').submit(function() {
      $(this).find("button[type='submit']").prop('disabled',true);
    });
</script>
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
