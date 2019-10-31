<?php $__env->startSection('title'); ?>
    Create Operator
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Create Operator
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete Operators
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(url('admin/operator')); ?>"> Operators</a></li>
    <li class="active">Create New</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo Form::open(['url'=>'admin/operator']); ?>


                <input type="integer" hidden="hidden" value="<?php echo e($id); ?>" name="country_id">

                <div class="form-group">
                    <?php echo Form::label('name', 'Operator Name',['class'=>'control-label']); ?>

                    <?php echo Form::text('name', null, ['class'=>'form-control','placeholder'=>'Operator Name']); ?>

                </div>



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
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/countries/add_operator.blade.php ENDPATH**/ ?>