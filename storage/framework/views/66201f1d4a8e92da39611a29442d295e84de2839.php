<?php $__env->startSection('title'); ?>
    Edit User
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Edit User
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    Edit User (<?php echo e($User->name); ?>)
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li><a href="<?php echo e(url('admin/user')); ?>"> Users</a></li>
    <li class="active">Edit</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>
    <div class="canvas-wrapper col-lg-4">
        <?php echo Form::model($User,['method'=>'PATCH','action'=>['UsersController@update',$User->id],]); ?>

        <div class="form-group">
            <?php echo Form::label('name', 'Full Name', ['class'=>'control-label']); ?>

            <?php echo Form::text('name', null, ['class'=>'form-control']); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('email', 'E-Mail', ['class'=>'control-label']); ?>

            <?php echo Form::email('email', null, ['class'=>'form-control']); ?>

        </div>
        <div class="form-group">
            <?php echo Form::label('password', 'Password', ['class'=>'control-label']); ?>

            <input type="password" name="password" id="password" value="<?php echo e($User->password); ?>" class="form-control">

        </div>
        <div class="form-group">
            <?php echo Form::label('admin', 'Admin', ['class'=>'control-label']); ?>

            <?php echo Form::select('admin', [0=>'User',1=>'Admin'], null, ['class'=>'form-control']); ?>

        </div>
        <div class="form-group">
            <button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Edit</button>
        </div>
        <?php echo Form::close(); ?>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/auth/edit.blade.php ENDPATH**/ ?>