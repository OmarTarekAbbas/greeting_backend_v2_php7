<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Greetings | <?php echo $title ?></title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="{{ url('assets/front/css/bootstrap.min.css')}}" >
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ url('assets/front/css/all.css')}}">
        <!-- Fancybox -->
        <link rel="stylesheet" href="{{ url('assets/front/css/jquery.fancybox.min.css')}}">
        <!-- Owl Carousel -->
        <link rel="stylesheet" href="{{ url('assets/front/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{ url('assets/front/css/owl.theme.default.min.css')}}">
        <?php if (isset($_REQUEST['lang']) && $_REQUEST['lang'] == "en") { ?>
            <link rel='stylesheet' href="{{ url('assets/front/css/style_en.css')}}" type='text/css' media='all'/>
        <?php } else { ?>
            <link rel='stylesheet' href="{{ url('assets/front/css/new_style.css')}}" type='text/css' media='all'/>
        <?php } ?>
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Small Modal</button> -->
        <!--=================================================== Preloader start============================================== -->
<!--       <div id="preloader_222222"></div>-->
        <!-- =================================================== Preloader End=============================================== -->
        <!-- Header -->
        <header>
            <!-- <a class="any_icon" data-toggle="modal" data-target="#myModal"><img src="{{ url('assets/front/images/Analytics-black.png')}}"></a>
            <div class="logo"><a href="index.php"><img src="{{ url('assets/front/images/logo.png')}}" alt=""></a></div>
            <i class="icons fa fa-angle-left" onclick="goBack()"></i>
            <a class="any_icon" data-toggle="modal" data-target="#myModal"><i class="fa fa-align-right"></i></a>-->
            <div class="row">
            <div class="col-4"><a href="#" class="icon"><i class="fa fa-bars"></i></a></div>
            <div class="col-4 title"><p><?php echo $title ?></p></div>
            <div class="col-4"><a class="icons header-button" id="toggle-search"><i class="fa fa-search"></i></a></div>
            </div>



                <form id="search-form" action="{{url('search_v1/'.UID())}}" method="get">
                <fieldset>
                    <input name="SearchKey" type="search" placeholder="??????????" />
                </fieldset>
                <input type="submit" value="??????" />
                </form>



        </header>
        <!-- Sidebar -->
        <aside id="menu">
<!--            <div class="aside_img">
                <img src="{{ url('img/Snapchat-logo2.webp')}}">
            </div>-->
            <ul class="list-unstyled">

                <?php  $count = menu() ?>
               <?php $snap_Occasions = snap_Occasions() ;
               ?>
<!--                @if($count['Snap'] >= 1)
                <li><a href="{{url('snap/'.UID())}}"><i class="fa fa-picture-o"></i>Snaps</a></li>
                @endif
                @if($count['Rbt'] >= 1)
                <li><a href="{{url('rbts/'.UID())}}"><i class="fa fa-headphones"></i>?????? ??????</a></li>
                @endif
                @if($count['Not'] >= 1)
                <li><a href="{{url('notifications/'.UID())}}"><i class="fa fa-bell"></i>?????????? ??????????</a></li>
                @endif
                @if($count['Imgs'] >= 1)
                <li><a href="{{url('imgs/'.UID())}}"><i class="fa fa-picture-o"></i>??????????</a></li>
                @endif
                @if($count['Vid'] >= 1)
                <li><a href="{{url('vids/'.UID())}}"><i class="fa fa-file-video-o"></i>????????????????????</a></li>
                @endif-->


<!--             <li><a href="{{url('snap/'.UID())}}"><i class="far fa-image"></i>Snap</a></li>

                <li><a href="{{url('rbts/'.UID())}}"><i class="far fa-headphones"></i>?????? ??????</a></li>-->

<!--                <li><a href="{{url('notifications/'.UID())}}"><i class="far fa-bell"></i>?????????? ??????????</a></li>-->

<!--                <li><a href="{{url('imgs/'.UID())}}"><i class="far fa-image"></i>??????????</a></li>

                <li><a href="{{url('vids/'.UID())}}"><i class="far fa-file-video"></i>????????????????????</a></li>-->


<li><a href="{{url('snap/'.UID())}}"><i class="far fa-home fa-lg"></i><p>??????????????</p></a></li>
                @foreach($snap_Occasions as $k=> $occasion)

                        <li @if(isset($ID) && $ID==$occasion->id) class="active2" @endif>
                            <div class="cat-item">
                                <a onclick="window.location.replace('{{url('/list_snap_v1/'.$occasion->id.'/'.UID())}}')"  href="javascript:void(0);" >
                                    <img src="{{  url($occasion->image) }}"  alt="category">
                                    <h6 class="cat-title">{{$occasion->title}}</h6>
                                </a>
                            </div>
                        </li>

             @endforeach


<li><a href="{{url('logout_v2/'.UID())}}"><i class="fas fa-sign-out-alt"></i><p>Exit</p></a></li>

 <!--<li><a href="?lang=en"><i class="fa fa-language"></i>EN</a></li>-->
            </ul>
        </aside>

        @yield('content')
        <div class="overlay" id="overlay"></div>
        <div style="padding: 100px;"></div>
        <div class="buttom_menu" id="buttom_menu">


               <a class="far fa-home" href="{{url('snap/'.UID())}}">
                   <span>????????????????</span>
               </a>

               <a class="fas fa-list-ul" href="{{url('/list_occasion/'.UID())}}">
                   <span>??????????????</span>
               </a>


<!--               <a class="far fa-bell" href="{{url('notifications/'.UID())}}"></a>-->

               <!--<a class="far fa-file-video" href="{{url('vids/'.UID())}}"></a>-->

               <!--<a class="far fa-image" href="{{url('imgs/'.UID())}}"></a>-->

      </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Filter by</h4>
                    </div>
                    <div class="modal-body">
                        <a href="{{url('Search/'.UID().'?featured=1')}}">Featured</a>
                        <a href="{{url('Search/'.UID().'?recent=1')}}">Recent</a>
                        <a href="{{url('Search/'.UID().'?popular=1')}}">Popular</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========================= Scripts Files ========================= -->
        <!-- jQuery -->
        <script src="{{ url('assets/front/js/jquery-3.2.1.min.js')}}"></script>
        <!-- tether -->
        <script src="{{ url('assets/front/js/tether.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{ url('assets/front/js/bootstrap.min.js')}}"></script>
        <!-- fancybox -->
        <script src="{{ url('assets/front/js/jquery.fancybox.min.js')}}"></script>
        <!-- Player js  -->
        <script src="{{ url('assets/front/js/player.js')}}"></script>
        <!-- owl -->
        <script src="{{ url('assets/front/js/owl.carousel.min.js')}}"></script>
        <!-- custom js -->
        <script src="{{ url('assets/front/js/script.js')}}"></script>
        <!-- ========================= Scripts Files ========================= -->
        @yield('script')
        <script>
            function snapLink(link) {
                var w = window.location.href;
                if (w.includes("snap")) {
                    if (link.includes("#occasion")) {
                        var x = link.substr(link.indexOf("#") + 1)
                        $(".item").each(function () {
                            $(this).removeClass('active1');
                        });
                        $(".owl-item").each(function () {
                            $(this).removeClass('active1');
                        });
                        $(".sounds li").each(function () {
                            $(this).addClass('sound_hide');
                        });
                        $("a[href='#" + x + "']").parent().addClass("active1");
                        $("." + x).removeClass("sound_hide");
                    }
                }
                else{
                     location.replace(link);
                }
                $(".icon").trigger('click');
            }
        </script>
    </body>
</html>
