<?php $__env->startSection('content'); ?>
<?php $title = "بطاقة التهنئة"; ?>
<!-- ========================================================================= -->

<ul class="sounds check list-unstyled">
    <?php $count = menu() ?>
    <?php if($count['Snap'] >= 1): ?>
    <!-- Audio --> 
    <li class="rbt1">
        <a class="sound_icon" href="<?php echo e(url('snap/'.UID())); ?>" > <i class="far fa-image"></i></a>
        <a class="title_sound" href="<?php echo e(url('snap/'.UID())); ?>">Snap </a>      
    </li>
    <?php endif; ?>
    <?php if($count['Rbt'] >= 1): ?>
    <!-- Audio --> 
    <li class="rbt1">
        <a class="sound_icon" href="<?php echo e(url('rbts/'.UID())); ?>" > <i class="fa fa-headphones"></i></a>
        <a class="title_sound" href="<?php echo e(url('rbts/'.UID())); ?>">كول تون </a>      
    </li>
    <?php endif; ?>
    <?php if($count['Not'] >= 1): ?>
    <!-- Audio --> 
    <li class="rbt1">
        <a class="sound_icon" href="<?php echo e(url('notifications/'.UID())); ?>" > <i class="fa fa-bell"></i></a>
        <a class="title_sound" href="<?php echo e(url('notifications/'.UID())); ?>">نغمات اشعار</a>      
    </li>
    <?php endif; ?>
    <?php if($count['Imgs'] >= 1): ?>
    <!-- Audio --> 
    <li class="rbt1">
        <a class="sound_icon" href="<?php echo e(url('imgs/'.UID())); ?>" > <i class="far fa-image"></i></a>
        <a class="title_sound" href="<?php echo e(url('imgs/'.UID())); ?>">صور تهنئة </a>      
    </li>
    <?php endif; ?>                
    <?php if($count['Vid'] >= 1): ?>
    <!-- Audio --> 
    <li class="rbt1">
        <a class="sound_icon" href="<?php echo e(url('vids/'.UID())); ?>" > <i class="fa fa-film"></i></a>
        <a class="title_sound" href="<?php echo e(url('vids/'.UID())); ?>">فيديو تهنئة </a>


    </li>
    <?php endif; ?>
</ul>

<!-- ========================================================================= -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/chooseVideo.blade.php ENDPATH**/ ?>