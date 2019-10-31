<?php $__env->startSection('title'); ?>
    Create Occasion
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Create Occasion
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    Add new Occasion
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(url('admin/occasions')); ?>"> Occasions</a></li>
    <li class="active">Create New</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo Form::open(['url'=>'admin/occasions']); ?>

                <div class="form-group">
                    <?php echo Form::label('title', 'Occasion name', ['class'=>'control-label']); ?>

                    <?php echo Form::text('title', null, ['class'=>'form-control','maxlenght'=>60]); ?>

                </div>
                <input type="text" hidden value="<?php echo e($id); ?>" name="category_id">
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
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/categories/add_occasion.blade.php ENDPATH**/ ?>