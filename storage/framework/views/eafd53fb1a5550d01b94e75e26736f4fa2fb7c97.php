<?php $__env->startSection('title'); ?>
    Edit Operator
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Edit Operator
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    Edit Operator (<?php echo e($Operator->name); ?>)
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(url('admin/operator')); ?>"> Operators</a></li>
    <li class="active">Edit</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo Form::model($Operator,['method'=>'PATCH','action'=>['OperatorsController@update',$Operator->id]]); ?>

                <?php echo Form::hidden('redirects_to', URL::previous()); ?>

                <?php echo $__env->make('admin.operators.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/operators/edit.blade.php ENDPATH**/ ?>