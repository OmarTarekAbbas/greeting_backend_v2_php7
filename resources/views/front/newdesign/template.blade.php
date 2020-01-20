<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{url('assets/new_snap_v2/')}}/img/Snapchat-logo.png" type="image/x-icon"> <!-- Favicon-->
    <meta name="keywords" content="خدمه فلاتر">
    <meta name="description" content="استمتع بمجموعه من الفلاتر الحصرية">
    <meta name="title" content="خدمه فلاتر"/> 
    <meta property="og:title" content="خدمه فلاتر">
    <meta property="og:description" content="استمتع بمجموعه من الفلاتر الحصرية">
    <meta property="og:image" content="{{url('assets/new_snap_v2/')}}/img/Snapchat-logo.png">
    <meta property="og:url" content="https://filters.digizone.com.kw/viewSnap2/1578/4167166">
    <title>New Snap WebApp</title>
    <link rel="stylesheet" href="{{url('assets/new_snap_v2/')}}/css/animate.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/newdesign')}}/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/newdesign')}}/css/bootstrap.css">
    <link rel="stylesheet" href="{{url('assets/new_snap_v2/')}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{url('assets/new_snap_v2/')}}/css/owl.theme.default.css">
    {{-- <link rel="stylesheet" type="text/css" href="{{url('assets/new_snap_v2/')}}/css/main-style.css"> --}}
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
                <a href="#" class="back_botton link">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>

            <div class="col-xs-8" style="padding-right: 0; padding-left: 0;">
                <h1 class="title">{{isset($pageTitle)?$pageTitle:'فلاتر'}}</h1>
            </div>

            <div class="col-xs-2">
                <a class="menu link" href="#">
                    <i class="fas fa-bars"></i>
                </a>

                <!-- <div class="translate_wrapper">
                    <div class="current_lang">
                        <div class="lang">
                            @if(App::getLocale() == 'en')
                            <img src="https://image.flaticon.com/icons/svg/299/299722.svg">
                            <span class="lang-txt">EN</span>
                            @elseif(App::getLocale() == 'ar')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Flag_of_the_Arab_League.svg">
                            <span class="lang-txt">Ar</span>
                            @elseif(App::getLocale() == 'or')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/32/Flag_of_Pakistan.svg/125px-Flag_of_Pakistan.svg.png">
                            <span class="lang-txt">Ur</span>
                            @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Flag_of_the_Philippines.svg/1920px-Flag_of_the_Philippines.svg.png">
                            <span class="lang-txt">Fe</span>
                            @endif
                            <span class="fa fa-chevron-down chevron"></span>
                        </div>
                    </div>

                    <div class="more_lang">
                        <div class="lang {{(App::getLocale() == 'en')?'selected':''}}" data-value='en'>
                            <a href="{{url('admin/lang/en')}}">
                                <img src="https://image.flaticon.com/icons/svg/299/299722.svg">
                                <span class="lang-txt">English</span>
                            </a>
                        </div>

                        <div class="lang {{(App::getLocale() == 'ar')?'selected':''}}" data-value="ar">
                            <a href="{{url('admin/lang/ar')}}">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Flag_of_the_Arab_League.svg">
                                <span class="lang-txt">العربية</span>
                            </a>
                        </div>
                    </div>

                </div> -->
            </div>
            <aside id="menu">
                {{-- <div class="translate_wrapper">
                    <div class="current_lang">
                        <div class="lang">
                            @if(App::getLocale() == 'en')
                            <img src="https://image.flaticon.com/icons/svg/299/299722.svg">
                            <span class="lang-txt">EN</span>
                            @elseif(App::getLocale() == 'ar')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Flag_of_the_Arab_League.svg">
                            <span class="lang-txt">Ar</span>
                            @elseif(App::getLocale() == 'or')
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/32/Flag_of_Pakistan.svg/125px-Flag_of_Pakistan.svg.png">
                            <span class="lang-txt">Ur</span>
                            @else
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/99/Flag_of_the_Philippines.svg/1920px-Flag_of_the_Philippines.svg.png">
                            <span class="lang-txt">Fe</span>
                            @endif
                            <span class="fa fa-chevron-down chevron"></span>
                        </div>
                    </div>

                    <div class="more_lang">
                        <div class="lang {{(App::getLocale() == 'en')?'selected':''}}" data-value='en'>
                            <a href="{{url('admin/lang/en')}}">
                                <img src="https://image.flaticon.com/icons/svg/299/299722.svg">
                                <span class="lang-txt">English</span>
                            </a>
                        </div>

                        <div class="lang {{(App::getLocale() == 'ar')?'selected':''}}" data-value="ar">
                            <a href="{{url('admin/lang/ar')}}">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2b/Flag_of_the_Arab_League.svg">
                                <span class="lang-txt">العربية</span>
                            </a>
                        </div>
                    </div>

                </div> --}}
                <ul class="list-unstyled">
                    @if(Session::has('MSISDN') && Session::get('MSISDN')!="")
                    <div class="profile">

                        <!--                            <p>  مرحبا   <span> {{Session::get('MSISDN')}}</span></p>-->
                    </div>
                    @endif

                    <li>
                        <a href="{{url('home_v2/'.UID())}}">
                            <i class="fas fa-home"></i>
                            <p>{!! static_lang('home')?static_lang('home') : 'الرثيسية'  !!}</p>
                        </a>
                    </li>
                    <?php $snap_Occasions = snap_Occasions() ?>
                    @foreach($snap_Occasions as $k=> $occasion)
                    <li>
                        <a href="{{url('listSnap/'.$occasion->id.'/'.UID())}}">
                            <img src="{{  url($occasion->image) }}">
                            <p>{{$occasion->getTranslation('title',getCode())}}</p>
                        </a>
                    </li>
                    @endforeach
                    @if(Session::has('MSISDN') && Session::get('MSISDN')!="")

                    @if(OP() == viva_kuwait_operator_id)
                    <li>
                        <a href="{{url('viva_profile'.'/'.UID())}}">
                            <i class="fas fa-info"></i>
                            <p>{!! static_lang('info')?static_lang('info') : ''  !!}</p>
                        </a>
                    </li>
                    <li><a href="{{url('logout_viva/'.UID())}}"><i style="font-size: 21px;"
                                class="fas fa-sign-out-alt"></i> خروج</a></li>
                    @elseif(  OP() == 16  )

                    <li><a href="{{url('logout_zain_ksa/'.UID())}}"><i style="font-size: 21px;"
                        class="fas fa-sign-out-alt"></i> خروج</a></li>


                        @elseif(  OP() == MOBILY_OP_ID  )

                        <li><a href="{{url('logout_mobily_ksa/'.UID())}}"><i style="font-size: 21px;"
                            class="fas fa-sign-out-alt"></i> خروج</a></li>

                    @endif
                    @endif


                </ul>
            </aside>
        </div>
    </header>
    <!--=========== header end=================== -->
    @yield('content')
</body>
<script src="{{ url('assets/front/newdesign')}}/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="{{ url('assets/front/newdesign')}}/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{ url('assets/front/newdesign')}}/js/main.js" type="text/javascript"></script>
<script src="{{url('assets/new_snap_v2/')}}/js/popper.min.js"></script>
<script src="{{url('assets/new_snap_v2/')}}/js/wow.min.js"></script>
<script src="{{url('assets/new_snap_v2/')}}/js/isotope.js"></script>
<script src="{{url('assets/new_snap_v2/')}}/js/owl.carousel.min.js"></script>
<script src="{{url('assets/new_snap_v2/')}}/js/script.js"></script>


@yield('script')
</body>

</html>