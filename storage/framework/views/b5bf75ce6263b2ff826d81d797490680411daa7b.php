<?php $__env->startSection('title'); ?>
Create Snap for operator
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
Create Snap for operator
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
Create Snap for operator
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li><a href="<?php echo e(url('admin/occasions')); ?>"> Occasions</a></li>
<li class="active">Create New</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>


<?php if(Session::has('success')): ?>
<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> <?php echo e(Session::get('success')); ?>

</div>
<?php endif; ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <?php echo Form::open(['url'=>'operatorAddSnapFromCategoySave','files'=>true]); ?>


            <div class="form-group">
                <?php echo Form::label('occasion_id', 'Select Occasion', ['class'=>'control-label']); ?>

                <?php echo Form::select('occasion_id', $Occasions, null, ['class'=>'form-control']); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('operator_id', 'Select Operator', ['class'=>'control-label']); ?>

                <?php echo Form::select('operator_id[]', $Operators, null, ['id' => 'operator_list','class'=>'form-control' ,'multiple'] ); ?>

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

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/occasions/addToOperator.blade.php ENDPATH**/ ?>