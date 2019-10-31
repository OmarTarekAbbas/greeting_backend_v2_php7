<?php $__env->startSection('content'); ?>
<?php
$title = "";
$snap_Occasions = snap_Occasions() ;
?>

<!-- sounds Content -->
<ul class="sounds snapchat check list-unstyled">
  <?php $__currentLoopData = $snap_Occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
            <a class="sound_icon snap_info"     href="<?php echo e(url('/list_snap_v1/'.$occasion->id.'/'.UID())); ?>"> <img src="<?php echo e(asset("$occasion->image")); ?>"></a>
            <a class="title_sound snap_info" href="<?php echo e(url('/list_snap_v1/'.$occasion->id.'/'.UID())); ?>"><?php echo e($occasion->title); ?> </a>

            <!-- <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> 20</span>
                  </div> -->

        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/list_occasion.blade.php ENDPATH**/ ?>