<?php $__currentLoopData = $GreetingImg->operators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $op): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<p class="btn btn-info btn-sm" style="margin-bottom:2px" type="submit" data-toggle="tooltip" data-placement="bottom" title="<?php echo e($op->name); ?>-<?php echo e($op->country->name); ?>">
  <?php echo e($op->name); ?>-<?php echo e($op->country->name); ?>

</p>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/gsnap/operator.blade.php ENDPATH**/ ?>