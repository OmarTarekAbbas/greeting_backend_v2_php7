<!-- ==================================== -->

<?php $__env->startSection('content'); ?>
<!-- ==================================== -->
<!--=========== content start =================== -->
<?php if(count($Rdata)>0): ?>


<style type="text/css">
    .title_photo img {
    width: 70px;
    height: 70px;
    top: 44%;
    position: absolute;
    transform: translate(-50%, -50%);
    border: 2px solid red;
    border-radius: 50%;
}

.main_category .left {
    left: 70%;
}

.main_category .right_text {
    top: 45% !important;
    right: -8% !important;
}

.category:nth-child(even) .view {
    position: absolute;
    left: 123px;
    bottom: 45px;
    color: #f23c57;
}

.main_category .title_photo p {
    position: absolute;
    top: 45%;
    width: 50%;
    text-align: center;
    transform: translate(-50%, -50%);
    right: 14%;
    color: #111;
    font-weight: 800;
}
    .main_category .right{
        right: 5%;
    }
    @media    only screen and (min-width: 0) and (max-width: 600px) {
        .main_category .right{
            right: -3%;
        }
    }
</style>


<div class="main">
      <div class="main_category">
          <?php $__currentLoopData = $occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="category">
               <a href="<?php echo e(url('listSnap/'.$value->id .'/'.UID())); ?>" class="main_inner">
                  <img src="<?php echo e(url('assets/front/newdesign')); ?>/img/frame.png">

                  <!-- <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> 20</span>
                  </div> -->

                  <div class="title_photo">
                     <img class="<?php echo e(($key%2 == 0)?'left':'right'); ?>" src="<?php echo e(url($value->image)); ?>">
                     <p class="<?php echo e(($key%2 == 0)?'left_text':'right_text'); ?>"><?php echo e($value->title); ?></p>
                  </div>
               </a>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.newdesign.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/newdesign/snap.blade.php ENDPATH**/ ?>