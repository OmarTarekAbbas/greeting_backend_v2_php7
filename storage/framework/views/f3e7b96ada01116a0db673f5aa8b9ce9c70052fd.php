<?php  $title = "خطأ";?>

<?php $__env->startSection('content'); ?>
  
   <style type="text/css">
   header {
    display: none !important;    
   }
   a{font-family: 'Cairo', sans-serif;}
   </style>
<!-- ========================================================================= -->
  


<div class="error-page">
  <div>

    <h1 data-h1="404">404</h1>
    <p data-p="NOT FOUND">NOT FOUND</p>
    <?php if(ValidUID()==1): ?>
    <a class="btn-link error_btn" href="<?php echo e(url(UID())); ?>">الصفحه الرئيسيه</a>
    <?php endif; ?>
  </div>
</div>



<?php $__env->stopSection(); ?>




<?php echo $__env->make('front.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/error.blade.php ENDPATH**/ ?>