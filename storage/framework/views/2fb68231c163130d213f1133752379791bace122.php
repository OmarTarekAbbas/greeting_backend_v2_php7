<!DOCTYPE html>
<html lang="en">

<head>
    <!-- metas -->
    <meta charset="utf-8">
    <!-- IE compatibility meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- for phons -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- links -->
    <link rel="stylesheet" href='<?php echo e(url("assets/new_snap_v2/")); ?>/css/bootstrap.min.css'>
    <link rel="stylesheet" href="<?php echo e(url('assets/new_snap_v2/')); ?>/css/animate.css">
    <link rel="stylesheet" href="<?php echo e(url('assets/new_snap_v2/')); ?>/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(url('assets/new_snap_v2/')); ?>/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo e(url('assets/new_snap_v2/')); ?>/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('assets/new_snap_v2/')); ?>/css/main-style.css">


    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->

    <!-- title -->
    <title>Snap filter</title>

    <style>
        .dropdown-submenu {
            position: relative;
            direction: ltr;
        }

        .dropdown-submenu a {
            color: #000;
            text-decoration: none;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
            padding: 10px;
            background: #fff;
        }

        .dropdown-submenu .dropdown-menu .divider {
            height: 1px;
            background: #1d2124;
        }

        .dropdown-toggle::after {
            color: #fff;
        }
        .heart{
          color: #d62b2b !important;
        }

    </style>
</head>

<body>
    <div class="main_container">

        <!-- navbar -->
        <header>

        </header>
        <!-- end navbar -->
        <?php echo $__env->yieldContent('content'); ?>
        <!-- loading -->
        <div class="loading-overlay">
            <div class="spinner">
                <img src="<?php echo e(url('assets/new_snap_v2/')); ?>/img/Snapchat-logo.png" alt="loading">
            </div>
        </div>
        <!-- end loading -->

        <!-- footer -->
        <footer>
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-3">
                        <a href="<?php echo e(url('/cuurentSnap_v2/'.UID())); ?>">
                            <div class="f-nav">
                                <i class="fas fa-home"></i>
                                <span>الرئيسية</span>
                            </div>
                        </a>
                    </div>
                    <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                    <div class="col-3">
                        <a href="<?php echo e(url('/all_favourite/'.UID())); ?>">
                            <div class="f-nav">
                                <i class="fas fa-heart"></i>
                                <span>المفضلة</span>
                            </div>
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="col-3"></div>
                    <?php endif; ?>
                    <div class="col-3">
                        <a href="<?php echo e(url('/main_occasion/'.UID())); ?>">
                            <div class="f-nav">
                                <i class="fas fa-list-ul"></i>
                                <span>التصنيفات</span>
                            </div>
                        </a>
                    </div>
                    <?php if(Session::has('MSISDN') && Session::get('MSISDN')!=""): ?>
                    <div class="col-3">
                      <a href="<?php echo e(url('logout_v2/'.UID())); ?>">
                          <div class="f-nav">
                              <i class="fas fa-sign-out-alt"></i>
                              <span>خروج</span>
                          </div>
                      </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </footer>
        <!-- end footer -->

        <!-- script -->
        <script src="<?php echo e(url('assets/new_snap_v2/')); ?>/js/jquery-3.3.1.min.js"></script>
        <script src="<?php echo e(url('assets/new_snap_v2/')); ?>/js/popper.min.js"></script>
        <script src="<?php echo e(url('assets/new_snap_v2/')); ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo e(url('assets/new_snap_v2/')); ?>/js/wow.min.js"></script>
        <script src="<?php echo e(url('assets/new_snap_v2/')); ?>/js/isotope.js"></script>
        <script src="<?php echo e(url('assets/new_snap_v2/')); ?>/js/owl.carousel.min.js"></script>
        <script src="<?php echo e(url('assets/new_snap_v2/')); ?>/js/script.js"></script>
        <script type="text/javascript">
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
        </script>
        <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
        <script type="text/javascript">

        //heart
        number = "<?php echo e(Session::get('MSISDN')); ?>"
        uid = "<?php echo e(UID()); ?>"
        $(document).on('click','.heart',function () {
            id=$(this).prop('id')
            var this_el = $(this)
            if($(this).hasClass('active'))
            {
              $.get('<?php echo e(url("delete/favourite/")); ?>/'+uid+'/'+number+'/'+id , function(response){
                 console.log(response);
                //this_el.parent('div').parent('div').remove();
                this_el.removeClass('active')
              });
            }
            else
            {
              $.get('<?php echo e(url("add/favourite")); ?>/'+uid+'/'+number+'/'+id , function(response){
                console.log(response);
                if(response == 'success'){
                    this_el.addClass('active')
                }

              });
            }
            //$(this).toggleClass('active');
        });
        </script>
        <?php endif; ?>
        <?php echo $__env->yieldContent('script'); ?>
      </div>
  </body>

</html>
<?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/new_snap_v2/layout.blade.php ENDPATH**/ ?>