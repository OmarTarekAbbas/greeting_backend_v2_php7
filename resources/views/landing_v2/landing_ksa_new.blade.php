<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
    <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>فلاتر موبيل حصرية</title>
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
        /* background: #fff; */
         background: url("{{url('assets/front/landing_v2/images/3.jpg')}}");
         background-size: 100% 59%;
      background-position: unset;
    background-repeat: unset;
    background-attachment: unset;
      }

</style>

<body>
    <div class="main_container">
        <div class="landing_page">

            <div class="start_video" id="video">
            <video width="100%" poster="{{ url('assets/front/landing_v2')}}/img/01.jpg" id="my_audio" controls>
                <source src="{{ url('assets/front/landing_v2')}}/video/2.mp4" type="video/mp4">
                <source src="{{ url('assets/front/landing_v2')}}/video/2.mp4" type="video/ogg">
            </video>
            </div>

            <div class="strip">
                <h2>استمتع بوقتك مع فلاتر</h2>
            </div>
            <br>

            <div class="shbka">
                <div class="container">
                    <h3 style="color:#000">
                      {{-- <img src="{{url('assets/front/rotanav2/images/Rorana_flater_logo.png')}}" alt="loading_snap"> --}}
                      أختر شبكتك
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
                          <div class="col-12">
                            <a class="operator" sms='798940' body='1' href="">
                                <img class="img-fluid w-75" src="{{ url('assets/front/landing_v2')}}/img/Zain__KSA.png" id="zain1">
                            </a>
                          </div>
                          <br>
                          <div class="col-12">
                            <a class="operator" sms='604090' body='78' href="">
                                <img class="img-fluid w-75" src="{{ url('assets/front/landing_v2')}}/img/Mobily_KSA.png" id="mobily">
                            </a>
                          </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- copyright -->
        <div class="copy" style="font-size: 10px;font-family: sans-serif;">
            <p style="color:#000;margin-top:10px">copyright @ {{date('Y')}} Digizone, all rights reserved.</p>
        </div>
        <!-- copyright -->
    </div>



    <div class="modal" id="myModal">
        <div class="modal-body">
          <h3>خدمة فلاتر</h3>
          <a id="entry" class="btn text-primary bg-warning" onclick=" x()" style="margin: 0 auto">الدخول</a>
        </div>
      </div>


    <!-- script -->
    <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/script_zain.js"></script>
    <script>
     $(document).ready(function($){
          var deviceAgent = navigator.userAgent.toLowerCase();
          var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
          var xArr = $('.operator');
          for(var i = 0; i < xArr.length; i++){
               sms = xArr[i].getAttribute('sms');
               body = xArr[i].getAttribute('body');
               if (agentID){
                    xArr[i].setAttribute('href', 'sms:'+sms+'&body='+body);
               }else{
                    xArr[i].setAttribute('href', 'sms:'+sms+'?body='+body);
               }
          }
     });
     $('.operator').click(function(){
         var operator = $(this).attr('sms') == '798940' ? 'Zain':'Mobily';
         $.ajax({
            url:location.href,
             type:"get",
             data:{
                operator_name : operator

             },
             success:function(response){
                console.log(response);

             }
         })
     })
     $('#entry').click(function(){
         $.ajax({
            url:location.href,
             type:"get",
             data:{
                enterbtn : 'Enter'
             },
             success:function(response){
                console.log(response);
             }
         })
     })

    </script>

<script type="text/javascript">
    $(window).on('load',function(){
      //  $('#myModal').modal('show');
    });
</script>
<script>
    function x() {
        document.getElementById("my_audio").play();
        $('.modal-backdrop').hide();
        $('#myModal').hide();
    }
</script>
</body>

</html>
