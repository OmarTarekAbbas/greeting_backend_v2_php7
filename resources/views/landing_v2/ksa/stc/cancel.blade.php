<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
    <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zain KSA Snap Landing Page</title>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/main-style_zain.css">
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
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
      </style>
</head>

<body>
    <div class="main_container">
        <div class="landing_page">


            <div class="strip" style="margin-top:50px;">
              <h2>الغاء اشتراك فلاتر   </h2>
          </div>

            <br><br><br><br>
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
                      <br>
                        <div class="row justify-content-center">
                            <!--<div class="col-12">
                                <img src="img/viva.png" id="viva">
                            </div>-->

                            <div class="col-12">
                                <img src="{{ url('assets/front/landing_v2')}}/img/stc_new.png" id="zain">
                            </div>

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
                    <form method="post" action="{{url('StcKsaUnsubAction')}}" id="form_zain">
                      {{ csrf_field() }}
                        <div class="form-group form-inline">
                            <label for="phone"><span>{{zain_ksa_prefix}}</span></label>
                            <input type="hidden" name="prev_url"  value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}"  >
                            <input type="tel" class="form-control" id="phone" value="" placeholder="ادخل رقم تليفونك" name="number" required pattern="[0-9]{9}">
                            <span class="validity"></span>
                        </div>
                        <!--<button class="btn back">رجوع</button>-->
                        <button id="zain_submit" class="btn" type="submit" data-toggle="modal" data-target="#loginModal">تأكيد</button>
                    </form>
                    <!--<h5>للاشتراك يرجى الارسال الى <span>965</span></h5>
                <h5>الى <span>965</span><span> STOP1 </span>لالغاء الاشتراك ارسل</h5>-->
                </div>
            </div>


        </div>

        <div class="copy">
            <p>copyright @ <span><?php  echo date("Y")?></span> Digizone, all rights reserved.</p>
        </div>

        <!-- <div id="loginModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-right">
                    <div class="alert alert-success" role="alert">تم تاكيد الكود بنجاح</div>
                </div>
            </div>
        </div>
    </div> -->

    </div>
    <!-- script -->
    <script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
    <script src="{{ url('assets/front/landing_v2')}}/js/script_zain.js"></script>

</body>

</html>
