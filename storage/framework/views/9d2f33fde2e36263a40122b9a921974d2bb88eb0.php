<?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="main">
    <div class="container">
        <!-- search -->
        <div class="search">
            <i class="fas fa-search"></i>
            <form  action="<?php echo e(url('Search_v2/'.UID())); ?>" method="get">
              <?php echo e(csrf_field()); ?>

              <input type="text" name="search" id="myInput" placeholder="بحث" title="">
            </form>
        </div>
        <!-- end search -->
        <!-- liked -->
        <div class="filtars">
            <div class="category_title">
                <div class="row">
                    <div class="col-4 p-0">
                        <a class="i_arrow" href="<?php echo e(url('/occasion/'.$Rdata->occasion_id.'/'.UID())); ?>"><?php echo e($Rdata->occasion->title); ?> <i class="fas fa-chevron-right"></i></a>
                    </div>
                    <div class="a_title col-4 p-0">
                        <h5><?php echo e($Rdata->title); ?></h5>
                    </div>
                    <div class="col-4 p-0">
                        <img src="<?php echo e(url($Rdata->occasion->image)); ?>" alt="icon">
                    </div>
                </div>
            </div>
            <div class="inner_page" data-toggle="modal" data-target="#snapModal">
                <img src="<?php echo e(url($Rdata->path)); ?>" alt="snap_image">

                <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($Rdata->popular_count); ?></span>
                  </div>

            </div>
            <div class="button-inner">
                <a href="#" data-toggle="modal" data-target="#snapModal">تحميل</a>
                <a href="#" data-toggle="modal" data-target="#snapModal2">مشاركة</a>
            </div>
        </div>
        <!-- end liked -->
    </div>
</div>
<!-- end main content -->

<?php $__env->stopSection(); ?>
<!-- The Modal -->
<div class="modal fade" id="snapModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
              <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                <i id="<?php echo e($Rdata->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $Rdata->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
              <?php endif; ?>
                <img src="<?php echo e(url($Rdata->path)); ?>" alt="snap">

                <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($Rdata->popular_count); ?></span>
                  </div>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="#" data-dismiss="modal">الغاء الامر</a>
                <a href="<?php echo e($Rdata->snap_link); ?>">استخدام العدسة</a>
            </div>
        </div>
    </div>
</div>

<!-- The Modal 2 -->
<div class="modal fade" id="snapModal2">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <a class="fab fa-facebook-square" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(URL::current()); ?>" target="_blank"></a>
                <a class="fab fa-twitter-square" href="http://twitter.com/intent/tweet?url=<?php echo e(URL::current()); ?>" target="_blank"></a>
                <a class="fab fa-google-plus-square" href="https://plus.google.com/share?url=<?php echo e(URL::current()); ?>" target="_blank"></a>
                <a class="fab fa-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo e(URL::current()); ?>" target="_blank"></a>
                <a class="fab fa-pinterest-square" href="http://pinterest.com/pin/create/button?url=<?php echo e(URL::current()); ?>" target="_blank"></a>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="#" data-dismiss="modal">اغلق</a>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('front.new_snap_v2.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/new_snap_v2/inner_snap.blade.php ENDPATH**/ ?>