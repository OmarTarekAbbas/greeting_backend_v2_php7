<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $__env->yieldContent('title'); ?></title>
    <?php echo $__env->make('head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <meta name="token" content="<?php echo e(csrf_token()); ?>">
    <style type="text/css" id="holderjs-style"></style>
</head>
<body class="fixed-leftside">
<!-- BEGIN HEADER -->
<header>
    <a href="<?php echo e(url('admin')); ?>" class="logo"><i class="ion-ios-bolt"></i> <span>IVAS</span></a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="navbar-btn sidebar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        

        
    </nav>
</header>
<!-- END HEADER -->

<div class="wrapper">
    <!-- BEGIN LEFTSIDE -->
    <div class="leftside">
        <div class="sidebar">
            <!-- BEGIN RPOFILE -->
            <div class="nav-profile">
                
                <div class="info">
                    <a href="#"><?php echo e(Auth::user()->name); ?></a>
                    
                </div>
                <a href="<?php echo e(url('logout')); ?>" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" class="button"><i class="ion-log-out"></i></a>
                <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>
            </div>
            <!-- END RPOFILE -->
            <!-- BEGIN NAV -->
            <div class="title">Navigation</div>
            <ul class="nav-sidebar">


                <li>
                    <a href="<?php echo e(url('admin')); ?>">
                        <i class="ion-home"></i> <span>Dashboard</span>
                    </a>
                </li>


                <?php if(Auth::user()->admin == true): ?>
                <li class="<?php echo e((preg_match('/\badmin\/country/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/country')); ?>">
                        <i class="ion-earth"></i> <span>Countries</span>
                        <span class="label pull-right"><?php echo e(\App\Country::all()->count()); ?></span>
                    </a>
                </li>

                <li class="<?php echo e((preg_match('/\badmin\/operator/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/operator')); ?>">
                        <i class="ion-android-phone-portrait"></i> <span>Operators</span>
                        <span class="label pull-right"><?php echo e(\App\Operator::all()->count()); ?></span>
                    </a>
                </li>

                <li class="<?php echo e((preg_match('/\badmin\/categories/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/categories')); ?>">
                        <i class="ion-folder"></i> <span>Categories</span>
                        <span class="label pull-right"><?php echo e(\App\Category::all()->count()); ?></span>
                    </a>
                </li>
                <?php endif; ?>

                <li class="<?php echo e((preg_match('/\badmin\/occasions/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/occasions')); ?>">
                        <i class="ion-ios-bookmarks"></i> <span>Occasions</span>
                        <span class="label pull-right"><?php echo e(\App\Occasion::all()->count()); ?></span>
                    </a>
                </li>


                      <li class="<?php echo e((preg_match('/\badmin\/addSnapFromCategoyForm/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/addSnapFromCategoyForm')); ?>">
                        <i class="ion-ios-bookmarks"></i> <span>Occasion operator</span>
                    </a>

                      </li>

                <li class="<?php echo e((preg_match('/\badmin\/gimages/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/gimages')); ?>">
                        <i class="ion-images"></i> <span>Greeting Images</span>
                        <span class="label pull-right"><?php echo e(\App\Greetingimg::where("snap",0)->count()); ?></span>
                    </a>
                </li>
                <li class="<?php echo e((preg_match('/\badmin\/gsnap/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/gsnap')); ?>">
                        <i class="ion-images"></i> <span>Snap Images</span>
                        <span class="label pull-right"></span>
                    </a>
                </li>
                <li class="<?php echo e((preg_match('/\badmin\/ordersnap/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/ordersnap')); ?>">
                        <i class="ion-images"></i> <span>SnapChat Ordering</span>
                        <span class="label pull-right"></span>
                    </a>
                </li>
                <li class="<?php echo e((preg_match('/\badmin\/operatorsnap/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/operatorsnap')); ?>">
                        <i class="ion-images"></i> <span>Operator SnapChat</span>
                        <span class="label pull-right"></span>
                    </a>
                </li>

                <?php if(Auth::user()->admin == true): ?>
                <li class="<?php echo e((preg_match('/\badmin\/cproviders/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/cproviders')); ?>">
                        <i class="ion-person-stalker"></i> <span>Content providers</span>
                        <span class="label pull-right"><?php echo e(\App\Cprovider::all()->count()); ?></span>
                    </a>
                </li>
                <?php endif; ?>

                <li class="<?php echo e((preg_match('/\badmin\/grbts/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/grbts')); ?>">
                        <i class="ion-ios-musical-notes"></i> <span>Greeting Rbts</span>
                        <span class="label pull-right"><?php echo e(\App\Greetingaudio::where("rbt",1)->count()); ?></span>
                    </a>
                </li>
                <li class="<?php echo e((preg_match('/\badmin\/gnotifications/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/gnotifications')); ?>">
                        <i class="ion-ios-musical-notes"></i> <span>Greeting Notifications</span>
                        <span class="label pull-right"><?php echo e(\App\Greetingaudio::where("notification",1)->count()); ?></span>
                    </a>
                </li>
                <li class="<?php echo e((preg_match('/\badmin\/gaudios/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/gaudios')); ?>">
                        <i class="ion-ios-musical-notes"></i> <span>Greeting Audios</span>
                        <span class="label pull-right"><?php echo e(\App\Greetingaudio::where("notification",0)->where("rbt",0)->count()); ?></span>
                    </a>
                </li>

                <li class="<?php echo e((preg_match('/\badmin\/generateurls/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/generateurls')); ?>">
                        <i class="ion-link"></i> <span>Generated URLs</span>
                        <span class="label pull-right"><?php echo e(\App\Generatedurl::all()->count()); ?></span>
                    </a>
                </li>
                <li class="<?php echo e((preg_match('/\badmin\/settings/i',Request::url())) ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('admin/settings')); ?>">
                        <i class="ion-code-working"></i> <span>Settings</span>

                    </a>
                </li>

                <?php if(Auth::user()->admin == true): ?>
                    <li class="<?php echo e((preg_match('/\badmin\/user/i',Request::url())) ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('admin/user')); ?>">
                            <i class="ion-person-stalker"></i> <span>Users</span>
                            <span class="label pull-right"><?php echo e(\App\User::all()->count()); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                

            </ul>
            <!-- END NAV -->

        </div><!-- /.sidebar -->
    </div>
    <!-- END LEFTSIDE -->

    <!-- BEGIN RIGHTSIDE -->
    <div class="rightside bg-white">
        <!-- BEGIN PAGE HEADING -->
        <div class="page-head bg-grey-100 margin-bottom-20">
            <h1 class="page-title"><?php echo $__env->yieldContent('PageTitle'); ?><small><?php echo $__env->yieldContent('PageDesc'); ?></small></h1>
            <!-- BEGIN BREADCRUMB -->
            <ol class="breadcrumb">
                <li><a href="<?php echo e(url('admin')); ?>"><i class="ion-home margin-right-5"></i> Dashboard</a></li>
                <?php echo $__env->yieldContent('breadcrumb'); ?>
            </ol>
            <!-- END BREADCRUMB -->
        </div>
        <!-- END PAGE HEADING -->

        <div class="container-fluid">

            <div class="row">
                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php echo $__env->yieldContent('PageContent'); ?>
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
<?php echo $__env->make('javascripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<!-- END CORE PLUGINS -->
<?php echo $__env->yieldContent('script'); ?>
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

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                }
        });

		<?php if(isset($Occasion) && $Occasion->parent_id): ?>
		$('.parent_select').prepend('<option> select parent occcasion </option>');
		$('.parent_select option:first').prop('disabled',true);
		<?php else: ?>
		$('.parent_select').prepend('<option selected="selected"> select parent occcasion </option>');
		$('.parent_select option:first').prop('disabled',true);
		<?php endif; ?>
</script>
</body>
<!-- END BODY -->
</html>
<?php /**PATH /var/www/html/greeting_backend_v2_php7/resources/views/admin/master.blade.php ENDPATH**/ ?>