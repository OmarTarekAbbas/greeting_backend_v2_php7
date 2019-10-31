<?php $__env->startSection('content'); ?>
<?php $title = "فيديوهات"; ?>
<?php if(count($greetingImgs)> 0 && isset($greetingAudiosForOcc) && count($greetingAudiosForOcc)>0 ): ?>
<div class="chooseitem filter" id="chooseimageitem">
    <div class="owl-carousel owl-theme">
        <?php if(count($occasions)>1): ?>
        <div class="item">
            <a href="#all">
                <img src="<?php echo e(url('assets/front/images/category/1.jpg')); ?>"  alt="category">
                <h2 class="titlee">الكل</h2>
            </a>
        </div>
        <?php endif; ?>
        <?php $__currentLoopData = $occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item <?php if(Occasion()==$occasion->id): ?> active1 <?php endif; ?>">
            <a href="#occasion_<?php echo e($occasion->id); ?>">
                <img src="<?php echo e(url($occasion->image)); ?>"  alt="category">
                <h2 class="titlee"><?php echo e($occasion->title); ?></h2>
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>        
    </div>
</div>
<!-- Gallery Content -->   
<div class="gallery check">
    <?php $__currentLoopData = $greetingImgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $greetingImg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <a href="<?php echo e(url('InputVideo/'.$greetingImg->id.'/'.UID())); ?>" class="occasion_<?php echo e($greetingImg->occasion_id); ?> <?php if(Occasion()!= $greetingImg->occasion_id ): ?> hide <?php endif; ?>"><img src="<?php echo e(asset("$greetingImg->path")); ?>"></a>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


</div>
<?php else: ?>
<br/>
<div class="not-found">
    <img src="../img/sad.png" alt="sad">
    <h1 data-h1="لا يوجد محتوى" >لا يوجد محتوى</h1>
</div>
<?php endif; ?>
<div class="clearfix"></div>
<style>
    .add{
        display: none;
    }


</style>
<!-- ========================================================================= -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $(".item").click(function () {
        $(".item").removeClass('active1');
    });
    $('a[href="<?php echo e(url("vids/".UID())); ?>"]').addClass('active_header');
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('front.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/greetingVideo.blade.php ENDPATH**/ ?>