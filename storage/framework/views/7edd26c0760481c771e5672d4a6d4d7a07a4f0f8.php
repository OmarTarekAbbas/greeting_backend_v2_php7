<!-- header -->

<?php $__env->startSection('content'); ?>
<!-- end header-->
<style>
.row {
    margin-right: 0;
}

.col-12 {
    padding-right: 0;
    /* padding-left: 0; */
}

.main .status .contant .filter-img i {
    color: #7b407a;
    position: absolute;
    left: 11%;
    top: 81%;
}

.main .status .contant .filter-title {
    padding-top: 21px;
}

.main .status .contant .owl-carousel.owl-three .item .heart_two {
    left: 28%;
    top: 74px;
    font-size: 15px;
}

.main .status .contant {
    background-color: #ffffff;
}

.rounded {
    border-radius: .35rem !important;
}

.main .user_filter .use_filter_link {
    transform: scale(0.8);
    bottom: 32%;
    left: -3%;
    width: 52%;
}

.main .status .s_title {
    color: #454445d9;
}

.main .status .contant .filter-img i {
    color: #fff;
    font-size: 10px;
}

.main .owl-video .item .video-fluid {
    max-height: 170px;
}

.filter_today1 {
    padding-left: 0px;
}

.owl-theme .owl-dots .owl-dot span {
    background: #7d537c;
}

.main .owl-theme .owl-dots .owl-dot.active span,
.main .owl-theme .owl-dots .owl-dot:hover span {
    background-color: #7d228a;
}
</style>
<!-- main content -->
<div class="main">
    <!-- Start Owl Carousel Video -->
    <div class="owl-video owl-carousel owl-theme">

        <?php $__currentLoopData = $newsnap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $snap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item">
            <a href="#">
                <video class="video-fluid" poster="<?php echo e(url('/'.$snap->vid_type)); ?>" controls>
                    <source src="<?php echo e(url('/'.$snap->vid_path)); ?>" type="video/mp4" />
                </video>
                <a href="<?php echo e($snap->snap_link); ?>" class="user_filter">
                    <h4 class=" use_filter_link text-center p-1">استخدم الفلتر
</h4>
                    <!-- <img src="<?php echo e(url('assets/front/newdesignv4/')); ?>/images/use_filter.png" alt="Use Filter" class="w-25 use_filter_link"> -->
                </a>
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <!-- End Owl Carousel Video -->

    <?php echo $__env->make('front.newdesignv4.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Start Filter Today -->
    <?php if(isset($Rdata_today[0])): ?>

    <div class="status">
        <div class="s_title bounce-left">
            <h5><?php echo static_lang('todayfilter')?static_lang('todayfilter') : 'فلتراليوم'; ?></h5>
        </div>

        <div class="contant rounded" style="padding: 5px 20px;">
            <div class="row">
                <div class="filter_today1 col-8" style="margin-top: -9%;">
                    <?php if(\Session::has('MSISDN') && \Session::get('Status') == 'active' ): ?>
                    <i id="<?php echo e($Rdata_today[0]->id); ?>" <?php if(check_favourtite(\Session::get('MSISDN') , $Rdata_today[0]->id)): ?>
                        class="far fa-heart heart active"
                        <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                    <?php endif; ?>

                    <a href="<?php echo e(url('newdesignv4/filter/'.$Rdata_today[0]->id.'/'.UID())); ?>">

                        <div class="filter-img">
                            <img class="img-fluid" src="<?php echo e(url('/'.$Rdata_today[0]->path)); ?>" alt="today filter"
                                style="margin-top: 13%">
                            <i class="fas fa-heart fa-lg ajax_call" value="<?php echo e($Rdata_today[0]->id); ?>"></i>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <div class="filter-title">
                        <h3 class="text-center"><?php echo e($Rdata_today[0]->getTranslation('title',getCode())); ?></span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- End Filter Today -->

    <!-- Start Filter Category -->
    <div class="status">
        <div class="row">
            <div class="col-12">
                <div class="s_title bounce-left">
                    <h4><?php echo static_lang('categ')?static_lang('categ') : 'الفئات'; ?></h4>
                </div>
            </div>

            <div class="col-12">
                <div class="contant rounded">
                    <?php if(count($sliders) < 2): ?> <div class="owl-one owl-carousel owl-theme">
                        <?php elseif(count($sliders) == 2): ?>
                        <div class="owl-two owl-carousel owl-theme">
                            <?php else: ?>
                            <div class="owl-three owl-carousel owl-theme">
                                <?php endif; ?>

                                <!-- <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suggest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item m-1">
                                    <?php if(\Session::has('MSISDN') && \Session::get('Status') == 'active' ): ?>
                                    <i id="<?php echo e($suggest->id); ?>" <?php if(check_favourtite(\Session::get('MSISDN') , $suggest->id)): ?> class="far fa-heart heart active"
                                        <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                                    <?php endif; ?>
                                    <a href="<?php echo e(url('newdesignv4/suboccasion/'.$suggest->id.'/'.UID())); ?>">
                                        <img class="rounded d-block m-auto" height="83" src="<?php echo e(url('/'.$suggest->image)); ?>" alt="<?php echo e($suggest->getTranslation('title',getCode())); ?>">
                                    </a>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->

                                <?php $snap_Occasions = snap_Occasions() ?>
                                <?php $__currentLoopData = $snap_Occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=> $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="item m-1">
                                    <?php if(\Session::has('MSISDN') && \Session::get('Status') == 'active' ): ?>
                                    <i id="<?php echo e($occasion->id); ?>" <?php if(check_favourtite(\Session::get('MSISDN') , $occasion->id)): ?> class="far fa-heart heart active"
                                        <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                                    <?php endif; ?>
                                    <a href="<?php echo e(url('newdesignv4/suboccasion/'.$occasion->id.'/'.UID())); ?>">
                                        <img class="rounded d-block m-auto" height="83" src="<?php echo e(url('/'.$occasion->image)); ?>" alt="<?php echo e($occasion->getTranslation('title',getCode())); ?>">
                                    </a>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                </div>
            </div>
            <!-- End Filter Category -->

            <!-- Start Filter Suggestion -->
            <div class="status">
                <div class="row">
                    <div class="col-12">
                        <div class="s_title bounce-left">
                            <h4><?php echo static_lang('mostp')?static_lang('mostp') : 'المقترحةلك'; ?></h4>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="contant">
                            <?php if(count($Rdata_today2) < 2): ?> <div class="owl-one owl-carousel owl-theme">
                                <?php elseif(count($Rdata_today2) == 2): ?>
                                <div class="owl-two owl-carousel owl-theme">
                                    <?php else: ?>
                                    <div class="owl-three owl-carousel owl-theme">
                                        <?php endif; ?>

                                        <?php $__currentLoopData = $Rdata_today2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="item m-1">
                                            <?php if(\Session::has('MSISDN') && \Session::get('Status') == 'active' ): ?>
                                            <i id="<?php echo e($fav->id); ?>" <?php if(check_favourtite(\Session::get('MSISDN') ,
                                                $fav->id)): ?> class="far fa-heart heart active"
                                                <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                                            <?php endif; ?>

                                            <a href="<?php echo e(url('newdesignv4/filter/'.$fav->id.'/'.UID())); ?>">
                                                <img class="rounded d-block m-auto" src="<?php echo e(url('/'.$fav->path)); ?>" alt=""
                                                    height="83">
                                                <!-- <h4 class="h6 text-center d-block m-auto" style="color:#495057;"><?php echo e($fav->getTranslation('title',getCode())); ?></h4> -->
                                            </a>
                                            <!-- <i class="heart_two far fa-heart ajax_call" id="<?php echo e($fav->id); ?>"></i> -->
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- End Filter Suggestion -->
                </div>
            </div>
            <!-- end main content -->
            <?php $__env->stopSection(); ?>

            <?php $__env->startSection('script'); ?>
            <script>
            $(document).on('click', '.ajax_call', function() {
                console.log($(this).attr('id'))
                if ($(this).hasClass('fa-heart')) {
                    $(this).removeClass('far').addClass('fas')
                } else {
                    $(this).removeClass('fas').addClass('far')
                }
            })


            $(document).on('click', '.ajax_call', function() {
                if ($(this).hasClass('fa-heart')) {
                    var str = '?id=' + $(this).attr('id') + '&type=1';

                    $.get('<?php echo e(url("like_dislike/".UID())); ?>' + str, function(response) {
                        $(this).removeClass('fa-heart').addClass('fa-thumbs-up')
                    })
                } else {
                    var str = '?id=' + $(this).attr('id') + '&type=2'
                    $.get('<?php echo e(url("like_dislike/".UID())); ?>' + str, function(response) {
                        $(this).removeClass('fa-thumbs-up').addClass('fa-heart')
                    })
                }
            })
            </script>
            <?php $__env->stopSection(); ?>

<?php echo $__env->make('front.newdesignv4.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/newdesignv4/home.blade.php ENDPATH**/ ?>