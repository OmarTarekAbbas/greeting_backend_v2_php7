<?php $__env->startSection('title'); ?>
    Generated URLs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Generated URLs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    Generated URL
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Generated URL</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="form-group">
                     <?php if($snap> 0): ?>
                    <span class="text text-info">link 1 : </span><input type="text" name="generatedurl" class="form-control input-lg" value="<?php echo e(url('snap/'.$UID)); ?>" />
                    <span class="text text-info">link 2 : </span><input type="text" name="generatedurl" class="form-control input-lg" value="<?php echo e(url('cuurentSnap/'.$UID)); ?>" />
                    <?php else: ?>
                    <input type="text" name="generatedurl" class="form-control input-lg" value="<?php echo e(url($UID)); ?>" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <span class="divider"></span>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/urls/generated.blade.php ENDPATH**/ ?>