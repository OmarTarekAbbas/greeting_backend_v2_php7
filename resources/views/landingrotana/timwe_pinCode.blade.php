<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
    <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Du Snap Landing Page</title>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/main-style_zain.css">
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
</head>

<style type="text/css">
    .landing_page .strip {
        margin-top: 0;
    }
    .modal{
        text-align: center;
        position: fixed;
        width: 80%;
        height: 150px;
        top: 50%;
        transform: translateY(-50%);
        margin: 0 auto;
        background-color: white;
        opacity: 0.9;
        padding: 10px;
        border-radius: 7px;
        color: black;
    }
    @media (min-width: 320px) and (max-width: 359px) {
      .operator img
      {
        width: 58%;
      }
    }
    .hero-bkg-animated {

        height: 100vh;
        background-position: fixed;
        background-repeat: no-repeat;
        background-size: 200% 100%;
        transform: translate3d(0px, 0px, 0px);
        transform-style: preserve-3d;
        box-sizing: border-box;
        -webkit-animation: slide 20s linear infinite;
    }
    .hero-bkg-animated h1 {
        font-family: sans-serif;
    }
    @-webkit-keyframes slide {
        from {
            background-position: 0 0;
        }
        to {
            background-position: -300px 0;
        }
    }
    .main_container{
      background: #161414;
      /* background: url("{{url('assets/front/newdesignv4/images/BG.png')}}") */
    }
    .confirm_page img{
        top: 20%;
    }

    .confirm_page .confirm{
        /* background-color: #8b4b25; */
    }
</style>

<body class="main_container">
    
  <div class="confirm_page">
    <img src="{{url('assets/front/rotanav2/images/Rorana_flater_logo.png')}}" alt="snap">

    <div class="container">

        <div class="confirm">

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
           {!! Form::open(['url'=>'subscription/confirm/'.partnerRoleId,'method'=>'post','class'=>'form']) !!}
                <div class="form-group">
                      <input type="tel" name="pincode" class="form-control" id="pincode" required pattern="[0-9]{6}">
                </div>
                <button class="btn" type="submit" >تاكيد</button>
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



        <!-- loading -->
        <div class="loading-overlay" style="background-color:#000">
            <div class="spinner">
                <img src="{{url('assets/front/rotanav2/images/Rorana_flater_logo.png')}}" alt="loading_snap">
            </div>
        </div>
        <!-- end loading -->
    </div>
    <!-- script -->
    <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/script_zain.js"></script>

</body>

</html>
