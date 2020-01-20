<?php $__env->startSection('title'); ?>
    Create Occasion
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Create Occasion
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete Occasion
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(url('admin/occasions')); ?>"> Occasions</a></li>
    <li class="active">Create New</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo Form::open(['url'=>'admin/occasions','files'=>true]); ?>

                <?php echo $__env->make('admin.occasions.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="form-group">
                    <button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span>Add</button>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <span class="divider"></span>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/occasions/add.blade.php ENDPATH**/ ?>