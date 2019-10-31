<?php $__env->startSection('title'); ?>
    Edit Content Provider
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Edit Content Provider
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    Edit Content Provider (<?php echo e($Cprovider->name); ?>)
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(url('admin/cproviders')); ?>"> Content Providers</a></li>
    <li class="active">Edit</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo Form::model($Cprovider,['method'=>'PATCH','action'=>['CprovidersController@update',$Cprovider->id]]); ?>

                <?php echo Form::hidden('redirects_to', URL::previous()); ?>

                <?php echo $__env->make('admin.cproviders.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="form-group">
                    <button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Edit</button>
                </div>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <span class="divider"></span>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/cproviders/edit.blade.php ENDPATH**/ ?>