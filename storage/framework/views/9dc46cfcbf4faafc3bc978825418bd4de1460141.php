<?php  $title = "خطأ";?>

<?php $__env->startSection('content'); ?>
  
   <style type="text/css">
   header {
    display: none !important;
   }
   </style>
<!-- ========================================================================= -->
  


<div class="error-page">
  <div>

    <h1 data-h1="404">404</h1>
    <p data-p="NOT FOUND">NOT FOUND</p>
    <a class="btn-link error_btn" href="<?php echo e(url(UID())); ?>">الصفحه الرئيسيه</a>

  </div>
</div>



<?php $__env->stopSection(); ?>




<?php echo $__env->make('front.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/greeting_backend_v2_php7/resources/views/errors/404.blade.php ENDPATH**/ ?>