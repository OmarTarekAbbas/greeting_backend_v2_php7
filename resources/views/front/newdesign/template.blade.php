<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!--IE Compatibility Meta-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--Mobile Meta-->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>New Snap WebApp</title>
        <link rel="stylesheet" type="text/css" href="{{ url('assets/front/newdesign')}}/css/all.css">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/front/newdesign')}}/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="{{ url('assets/front/newdesign')}}/css/style.css">
        <!--[if lt IE 9]>
        <script src="{{ url('assets/front/newdesign')}}/js/html5shiv.min.js"></script>
        <script src="{{ url('assets/front/newdesign')}}/js/respond.min.js"></script>
        <![endif]-->

        <style type="text/css">
            .profile img {
                width: 100%;
                border: 0;
                border-radius: 0;
                height: 100px;
            }
            .profile p {
                text-align: center;
                color: #fff;
                margin-top: 10px;
                margin-bottom: -15px;
            }

            .profile span {
                display: block;
                margin: auto;
                width: 100%;
                text-align: center;
                color: #fff;
                font-size: 15px;
            }
        </style>
    </head>
    <body>
        <!--=========== Preloader start =================== -->
        <div id="preloader"></div>
        <!--=========== Preloader End =================== -->
        <!-- =========overlay============= -->
        <div class="overlay" id="overlay"></div>
        <!-- =========overlay============= -->
        <!--=========== header start =================== -->
        <header>
            <div class="row">
                <div class="col-xs-2">
                    <a href="#" class="back_botton link"><i class="fas fa-chevron-left"></i></a></div>
                <div class="col-xs-8">
                    <h1 class="title">{{isset($pageTitle)?$pageTitle:''}}</h1>
                </div>
                <div class="col-xs-2"><a class="menu link" href="#"><i class="fas fa-bars"></i></a></div>
                <aside id="menu">
                    <ul class="list-unstyled">
                        @if(Session::has('MSISDN') && Session::get('MSISDN')!="")
                        <div class="profile">

<!--                            <p>  مرحبا   <span> {{Session::get('MSISDN')}}</span></p>-->
                        </div>
                        @endif
                        <li>
                            <a href="{{url('link2/snapCategory/'.UID())}}">
                                <i class="fas fa-home"></i>
                                <p>الرئيسية</p>
                            </a>
                        </li>
                        <?php $snap_Occasions = snap_Occasions() ?>
                        @foreach($snap_Occasions as $k=> $occasion)
                        <li>
                            <a href="{{url('listSnap/'.$occasion->id.'/'.UID())}}">
                                <img src="{{  url($occasion->image) }}">
                                <p>{{$occasion->title}}</p>
                            </a>
                        </li>
                        @endforeach
                       @if(Session::has('MSISDN') && Session::get('MSISDN')!="")

                       @if(OP() == viva_kuwait_operator_id)
                       <li>
                            <a href="{{url('viva_profile'.'/'.UID())}}">
                                <i class="fas fa-info"></i>
                                <p>بياناتي</p>
                            </a>
                      </li>
                          <li><a href="{{url('logout_viva/'.UID())}}"><i style="font-size: 21px;"  class="fas fa-sign-out-alt"></i> خروج</a></li>
                          @endif
                       @endif


                    </ul>
                </aside>
            </div>
        </header>
        <!--=========== header end=================== -->
        @yield('content')
    </body>
    <script src="{{ url('assets/front/newdesign')}}/js/jquery-3.2.1.min.js"  type="text/javascript"></script>
    <script src="{{ url('assets/front/newdesign')}}/js/bootstrap.min.js"  type="text/javascript"></script>
    <script src="{{ url('assets/front/newdesign')}}/js/main.js"  type="text/javascript"></script>



    @yield('script')
</body>
</html>
