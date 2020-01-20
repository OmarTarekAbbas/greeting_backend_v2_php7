<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
    @include('head')
    <style type="text/css" id="holderjs-style"></style>
</head>
<body class="fixed-leftside">
<!-- BEGIN HEADER -->
<header>
    <a href="{{ url('admin') }}" class="logo"><i class="ion-ios-bolt"></i> <span>IVAS</span></a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="navbar-btn sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        {{--
          // Extra buttons for more functions

        <div class="navbar-header">
            <ul class="nav navbar-nav pull-left">
                <li><a href="#"><i class="ion-arrow-expand"></i></a></li>
                <li><a href="#"><i class="ion-image"></i></a></li>
                <li class="dropdown dropdown-inverse">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="ion-plus-round"></i></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="ion-compose"></i> New Post </a>
                        </li>
                        <li>
                            <a href="#"><i class="ion-person-add"></i> New User </a>
                        </li>
                        <li>
                            <a href="#"><i class="ion-chatbox"></i> New Comment </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#" class="clearfix"><span class="pull-left">Comments</span> <span class="label bg-teal-500 pull-right">3</span></a>
                        </li>
                        <li>
                            <a href="#" class="clearfix"><span class="pull-left">Articles</span> <span class="label bg-red-500 pull-right">2</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        --}}

        {{--
                // Right side Navbar with (Search, Messages, Notifications and Tasks).

        <div class="navbar-right">
            <form role="search" class="navbar-form pull-left" method="post" action="#">
                <div class="btn-inline">
                    <input type="text" class="form-control padding-right-35" placeholder="Search..."/>
                    <button class="btn btn-link no-shadow bg-transparent no-padding-top padding-right-10" type="button"><i class="ion-search"></i></button>
                </div>
            </form>
            <ul class="nav navbar-nav">
                <li class="dropdown dropdown-box">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="ion-chatbox"></i>
                        <span class="label bg-green-500 label-rounded">&nbsp;</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><i class="ion-chatbox"></i> You have 6 messages</li>
                        <li>
                            <ul class="media-list media-content scroll">
                                <li class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle width-40 height-40" src="assets/img/avatar.jpg" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <div class="clearfix">
                                            <a href="#" class="media-heading">Randolph Kit</a>
                                            <span class="media-item">now</span>
                                        </div>
                                        <p class="box">If a client calls and asks for a quote you need to be able to respond quickly. This example quotation letter can be...</p>
                                    </div>
                                    <div class="media-footer">
                                        <div class="pull-right media-tools">
                                            <a href="#"><i class="ion-reply"></i> reply</a>
                                            <a href="#"><i class="ion-compose"></i> edit</a>
                                            <a href="#"><i class="ion-trash-b"></i> trash</a>
                                        </div>
                                    </div>
                                </li><!-- /.media -->

                                <li class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle width-40 height-40" src="assets/img/avatar_3.jpg" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <div class="clearfix">
                                            <a href="#" class="media-heading">Barry Allen</a>
                                            <span class="media-item">6 hours ago</span>
                                        </div>
                                        <p class="box unread">I do love email. Wherever possible I try to communicate asynchronously.</p>
                                    </div>
                                    <div class="media-footer">
                                        <div class="pull-right media-tools">
                                            <a href="#"><i class="ion-reply"></i> reply</a>
                                            <a href="#"><i class="ion-compose"></i> edit</a>
                                            <a href="#"><i class="ion-trash-b"></i> trash</a>
                                        </div>
                                    </div>
                                </li><!-- /.media -->

                                <li class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle width-40 height-40" src="assets/img/avatar_2.jpg" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <div class="clearfix">
                                            <a href="#" class="media-heading">Andrina Trisha</a>
                                            <span class="media-item">1 week ago</span>
                                        </div>
                                        <p class="box">Which would explain the naquadah in your blood that lets you use Goa'uld technology. </p>
                                    </div>
                                    <div class="media-footer">
                                        <div class="pull-right media-tools">
                                            <a href="#"><i class="ion-reply"></i> reply</a>
                                            <a href="#"><i class="ion-compose"></i> edit</a>
                                            <a href="#"><i class="ion-trash-b"></i> trash</a>
                                        </div>
                                    </div>
                                </li><!-- /.media -->

                                <li class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-circle width-40 height-40" src="assets/img/avatar_4.jpg" alt="image">
                                    </a>
                                    <div class="media-body">
                                        <div class="clearfix">
                                            <a href="#" class="media-heading">Jean Grey</a>
                                            <span class="media-item">2 weeks ago</span>
                                        </div>
                                        <p class="box">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam consectetur magna vel elit tristique, a vehicula enim finibus.</p>
                                    </div>
                                    <div class="media-footer">
                                        <div class="pull-right media-tools">
                                            <a href="#"><i class="ion-reply"></i> reply</a>
                                            <a href="#"><i class="ion-compose"></i> edit</a>
                                            <a href="#"><i class="ion-trash-b"></i> trash</a>
                                        </div>
                                    </div>
                                </li><!-- /.media -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all messages</a></li>
                    </ul>
                </li>

                <li class="dropdown dropdown-box dropdown-notifications">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="ion-earth"></i><span class="label bg-orange-500 label-rounded">&nbsp;</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><i class="ion-earth"></i>  You have 5 new notifications</li>
                        <li>
                            <ul>
                                <li><a href="#"><i class="ion-person-add color-green-500"></i> New user registered</a></li>
                                <li><a href="#"><i class="ion-heart color-red-500"></i> Jean <span class="bold">liked</span> your post</a></li>
                                <li><a href="#"><i class="ion-chatbox-working color-orange-500"></i> You got a message from Jean</a></li>
                                <li><a href="#" class="bg-yellow-50 color-brown-700"><i class="ion-ios-information color-light-blue-500"></i> <span class="bold">Privacy policy</span> have been changed</a></li>
                                <li><a href="#"><i class="ion-chatbubble-working color-teal-500"></i> New comments <span class="bold">waiting</span> approval</a></li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all notification</a></li>
                    </ul>
                </li>

                <li class="dropdown dropdown-box dropdown-tasks">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="ion-android-list"></i><span class="label bg-red-500 label-rounded">&nbsp;</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header"><i class="ion-android-list"></i>  You have 1 new task</li>
                        <li>
                            <ul>
                                <li>
                                    <a href="#">
                                        <h3>PHP Developing<small class="pull-right">32%</small></h3>
                                        <div class="progress progress-animated progress-xs">
                                            <div class="progress-bar bg-green-500" role="progressbar" aria-valuenow="32" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h3>Database Repair<small class="pull-right">14%</small></h3>
                                        <div class="progress progress-animated progress-xs">
                                            <div class="progress-bar bg-orange-500" role="progressbar" aria-valuenow="14" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h3>Sql Backup<small class="pull-right">65%</small></h3>
                                        <div class="progress progress-animated progress-xs">
                                            <div class="progress-bar bg-green-700" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <h3>Create New Modules<small class="pull-right">80%</small></h3>
                                        <div class="progress progress-animated progress-xs">
                                            <div class="progress-bar bg-red-500" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        --}}
    </nav>
</header>
<!-- END HEADER -->

<div class="wrapper">
    <!-- BEGIN LEFTSIDE -->
    <div class="leftside">
        <div class="sidebar">
            <!-- BEGIN RPOFILE -->
            <div class="nav-profile">
                {{--
                    //Thumbnail for user profile


                <div class="thumb">
                    <img src="assets/img/avatar.jpg" class="img-circle" alt="" />
                    <span class="label label-danger label-rounded">3</span>
                </div>
                --}}
                <div class="info">
                    <a href="#">{{ \Auth::user()->name }}</a>
                    {{--<ul class="tools list-inline">
                        <li><a href="#" data-toggle="tooltip" title="Settings"><i class="ion-gear-a"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Events"><i class="ion-earth"></i></a></li>
                        <li><a href="#" data-toggle="tooltip" title="Downloads"><i class="ion-archive"></i></a></li>
                    </ul>--}}
                </div>
                <a href="{{ url('logout') }}" class="button"><i class="ion-log-out"></i></a>
            </div>
            <!-- END RPOFILE -->
            <!-- BEGIN NAV -->
            <div class="title">Navigation</div>
            <ul class="nav-sidebar">


                <li>
                    <a href="{{ url('admin') }}">
                        <i class="ion-home"></i> <span>Dashboard</span>
                    </a>
                </li>


                @if(\Auth::user()->admin == true)

                <li class="{{(preg_match('/\badmin\/static_translation/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/static_translation') }}">
                        <i class="ion-link"></i> <span>Static Translation</span>

                    </a>
                </li>
                <li class="{{(preg_match('/\badmin\/language/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/language') }}">
                        <i class="ion-code-working"></i> <span>Language</span>

                    </a>
                </li>

                <li class="{{(preg_match('/\badmin\/country/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/country') }}">
                        <i class="ion-earth"></i> <span>Countries</span>
                        <span class="label pull-right">{{ \App\Country::all()->count() }}</span>
                    </a>
                </li>

                <li class="{{(preg_match('/\badmin\/operator/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/operator') }}">
                        <i class="ion-android-phone-portrait"></i> <span>Operators</span>
                        <span class="label pull-right">{{ \App\Operator::all()->count() }}</span>
                    </a>
                </li>

                <li class="{{(preg_match('/\badmin\/categories/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/categories') }}">
                        <i class="ion-folder"></i> <span>Categories</span>
                        <span class="label pull-right">{{ \App\Category::all()->count() }}</span>
                    </a>
                </li>
                @endif

                <li class="{{(preg_match('/\badmin\/occasions/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/occasions') }}">
                        <i class="ion-ios-bookmarks"></i> <span>Occasions</span>
                        <span class="label pull-right">{{ \App\Occasion::all()->count() }}</span>
                    </a>
                </li>


                      <li class="{{(preg_match('/\badmin\/addSnapFromCategoyForm/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/addSnapFromCategoyForm') }}">
                        <i class="ion-ios-bookmarks"></i> <span>Occasion operator</span>
                    </a>

                      </li>

                {{--  <li class="{{(preg_match('/\badmin\/gimages/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/gimages') }}">
                        <i class="ion-images"></i> <span>Greeting Images</span>
                        <span class="label pull-right">{{ \App\Greetingimg::where("snap",0)->count() }}</span>
                    </a>
                </li>  --}}
                <li class="{{(preg_match('/\badmin\/gsnap/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/gsnap') }}">
                        <i class="ion-images"></i> <span>Snap Images</span>
                        <span class="label pull-right"></span>
                    </a>
                </li>
                <li class="{{(preg_match('/\badmin\/ordersnap/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/ordersnap') }}">
                        <i class="ion-images"></i> <span>SnapChat Ordering</span>
                        <span class="label pull-right"></span>
                    </a>
                </li>
                <li class="{{(preg_match('/\badmin\/ordersnaplike/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/ordersnaplike') }}">
                        <i class="ion-images"></i> <span>SnapChat Ordering Like</span>
                        <span class="label pull-right"></span>
                    </a>
                </li>
                <li class="{{(preg_match('/\badmin\/ordersnapdislike/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/ordersnapdislike') }}">
                        <i class="ion-images"></i> <span>SnapChat Ordering DisLike</span>
                        <span class="label pull-right">{{--{{ \App\Greetingimg::where("snap",1)->count() }}--}}</span>
                    </a>
                </li>
                <li class="{{(preg_match('/\badmin\/operatorsnap/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/operatorsnap') }}">
                        <i class="ion-images"></i> <span>Operator SnapChat</span>
                        <span class="label pull-right">{{--{{ \App\Greetingimg::where("snap",1)->count() }}--}}</span>
                    </a>
                </li>
                <li class="{{(preg_match('/\badmin\/operatorsnaplike/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/operatorsnaplike') }}">
                        <i class="ion-images"></i> <span>Operator SnapChat Like</span>
                        <span class="label pull-right">{{--{{ \App\Greetingimg::where("snap",1)->count() }}--}}</span>
                    </a>
                </li>

                <li class="{{(preg_match('/\badmin\/operatorsnapdislike/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/operatorsnapdislike') }}">
                        <i class="ion-images"></i> <span>Operator SnapChat DisLike</span>
                        <span class="label pull-right">{{--{{ \App\Greetingimg::where("snap",1)->count() }}--}}</span>
                    </a>
                </li>

                @if(\Auth::user()->admin == true)
                <li class="{{(preg_match('/\badmin\/cproviders/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/cproviders') }}">
                        <i class="ion-person-stalker"></i> <span>Content providers</span>
                        <span class="label pull-right">{{ \App\Cprovider::all()->count() }}</span>
                    </a>
                </li>
                @endif

                <li class="{{(preg_match('/\badmin\/grbts/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/grbts') }}">
                        <i class="ion-ios-musical-notes"></i> <span>Greeting Rbts</span>
                        <span class="label pull-right">{{ \App\Greetingaudio::where("rbt",1)->count() }}</span>
                    </a>
                </li>
                <li class="{{(preg_match('/\badmin\/gnotifications/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/gnotifications') }}">
                        <i class="ion-ios-musical-notes"></i> <span>Greeting Notifications</span>
                        <span class="label pull-right">{{ \App\Greetingaudio::where("notification",1)->count() }}</span>
                    </a>
                </li>
                <li class="{{(preg_match('/\badmin\/gaudios/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/gaudios') }}">
                        <i class="ion-ios-musical-notes"></i> <span>Greeting Audios</span>
                        <span class="label pull-right">{{ \App\Greetingaudio::where("notification",0)->where("rbt",0)->count() }}</span>
                    </a>
                </li>

                <li class="{{(preg_match('/\badmin\/generateurls/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/generateurls') }}">
                        <i class="ion-link"></i> <span>Generated URLs</span>
                        <span class="label pull-right">{{ \App\Generatedurl::all()->count() }}</span>
                    </a>
                </li>
                <li class="{{(preg_match('/\badmin\/settings/i',Request::url())) ? 'active' : ''}}">
                    <a href="{{ url('admin/settings') }}">
                        <i class="ion-code-working"></i> <span>Settings</span>

                    </a>
                </li>

                @if(\Auth::user()->admin == true)
                    <li class="{{(preg_match('/\badmin\/user/i',Request::url())) ? 'active' : ''}}">
                        <a href="{{ url('admin/user') }}">
                            <i class="ion-person-stalker"></i> <span>Users</span>
                            <span class="label pull-right">{{ \App\User::all()->count() }}</span>
                        </a>
                    </li>
                @endif

                {{--<li class="nav-dropdown">
                    <a href="#">
                        <i class="ion-beaker"></i> <span>UI Elements</span>
                        <i class="ion-chevron-right pull-right"></i>
                    </a>
                    <ul>
                        <li><a href="panels.html">Panels</a></li>
                        <li><a href="tiles.html">Tiles</a></li>
                        <li><a href="typography.html">Typography</a></li>
                        <li><a href="material.html">Material Colors</a></li>
                        <li><a href="icons.html">Icons</a></li>
                        <li><a href="buttons.html">Buttons</a></li>
                        <li><a href="sliders.html">Sliders</a></li>
                    </ul>
                </li>
                <li>
                    <a href="calendar.html">
                        <i class="ion-calendar"></i> <span>Calendar</span>
                        <span class="label bg-green-700 pull-right">NEW</span>
                    </a>
                </li>--}}

            </ul>
            <!-- END NAV -->

        </div><!-- /.sidebar -->
    </div>
    <!-- END LEFTSIDE -->

    <!-- BEGIN RIGHTSIDE -->
    <div class="rightside bg-white">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100 margin-bottom-20">
            <h1 class="page-title">@yield('PageTitle')<small>@yield('PageDesc')</small></h1>
            <!-- BEGIN BREADCRUMB -->
            <ol class="breadcrumb">
                <li><a href="{{url('admin')}}"><i class="ion-home margin-right-5"></i> Dashboard</a></li>
                @yield('breadcrumb')
            </ol>
            <!-- END BREADCRUMB -->
        </div>
        <!-- END PAGE HEADING -->

        <div class="container-fluid">

            <div class="row">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('PageContent')
            </div>

            <!-- BEGIN FOOTER -->
            <footer style="z-index: -99999999;">
                <div class="pull-left">
                    <span class="pull-left margin-right-15">&copy; <?php echo date("Y") ?> IVAS .</span>
                    <ul class="list-inline pull-left">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Use</a></li>
                    </ul>
                </div>
            </footer>
            <!-- END FOOTER -->
        </div><!-- /.container-fluid -->
    </div><!-- /.rightside -->
</div><!-- /.wrapper -->
<!-- END CONTENT -->

<!-- BEGIN JAVASCRIPTS -->

<!-- BEGIN CORE PLUGINS -->
@include('javascripts')
<!-- END CORE PLUGINS -->
@yield('script')
<!-- END JAVASCRIPTS -->
<script>
     function pauseOther(e) {
           $("audio").not(e).each(function(index, audio) {
                audio.pause();
            });
    }
    $(function(){
        $("audio").on("play", function() {
            $("audio").not(this).each(function(index, audio) {
                audio.pause();
            });
        });
    });
		@if(isset($Occasion) && $Occasion->parent_id)
		$('.parent_select').prepend('<option> select parent occcasion </option>');
		$('.parent_select option:first').prop('disabled',true);
		@else
		$('.parent_select').prepend('<option selected="selected"> select parent occcasion </option>');
		$('.parent_select option:first').prop('disabled',true);
        @endif
    </script>
   <script>
    var check = false;

    function select_all(table_name, has_media)
    {
        if (!check)
        {
            $('.select_all_template').prop("checked", !check);
            $.get("{{url('admin/get_table_ids?table_name=')}}" + table_name, function (data, status) {
                data.forEach(function (item) {
                    collect_selected(item.id);
                });
            });
            check = true;
        }
        else
        {
            $('.select_all_template').prop("checked", !check);
            check = false;
            clear_selected();
        }
    }

</script>

<script>

    var selected_list = [];
    var checker_list = [];
    function collect_selected(element) {
        var id;
        if (!element.value)
        {
            id = element;
        }
        else {
            id = element.value;
        }

        if (checker_list[id])
        {
            var index = selected_list.indexOf(id);
            selected_list.splice(index, 1);
            checker_list[id] = false;
        }
        else {
            if (!selected_list.includes(id))
            {
                selected_list.push(id);
                checker_list[id] = true;
            }
        }
    }

    function clear_selected()
    {
        selected_list = [];
        checker_list = [];
    }

</script>

<script>
    $(document).ready(function () {
        // $('#example').DataTable();
    });


    function delete_selected(table_name) {
        var confirmation = confirm('Are you sure you want to delete this ?');
        if (confirmation)
        {
            var form = document.createElement("form");
            var element = document.createElement("input");
            var tb_name = document.createElement("input");
            var csrf = document.createElement("input");
            csrf.name = "_token";
            csrf.value = "{{ csrf_token() }}";
            csrf.type = "hidden";

            form.method = "POST";
            form.action = "{{url('admin/delete_multiselect')}}";

            element.value = selected_list;
            element.name = "selected_list";
            element.type = "hidden";

            tb_name.value = table_name;
            tb_name.name = "table_name";
            tb_name.type = "hidden";

            form.appendChild(element);
            form.appendChild(csrf);
            form.appendChild(tb_name);

            document.body.appendChild(form);

            form.submit();
        }
    }

    var initChosenWidgets = function () {
        $(".chosen").chosen();
    };

</script>
</body>
<!-- END BODY -->
</html>
