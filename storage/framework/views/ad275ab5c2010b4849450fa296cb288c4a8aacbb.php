<?php $__env->startSection('title'); ?>
    Create Greeting Image
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Create Greeting Image
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete Greeting Image
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(url('admin/gimages')); ?>"> Greeting Image</a></li>
    <li class="active">Create New</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo Form::open(['files'=>true,'class'=>"dropzone dz-clickable"]); ?>

                    <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <span class="divider"></span>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/occasions/addimages.blade.php ENDPATH**/ ?>