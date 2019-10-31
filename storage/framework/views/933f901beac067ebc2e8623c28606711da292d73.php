<?php $__env->startSection('title'); ?>
    Settings
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Settings
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete Settings
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Settings</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

<div class="row">   
    <div class="right">
        <a href="<?php echo e(url('admin/settings/create')); ?>"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
    </div>
    
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <br/>
                <table class="table table-hover table-striped datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Key</th>
                            <th>Value</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($value->id); ?></td>
                                <td><?php echo e($value->key); ?></td>
                                <td><?php echo e($value->value); ?></td>
                                <td>
                                    <?php echo Form::open(array('class' => 'col-xs-1','method' => 'DELETE', 'action' => array('SettingsController@destroy', $value->id))); ?>

                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete <?php echo e($value->key); ?>')">
                                        <i class="fa fa-trash-o "></i>
                                    </button>
                                    <?php echo Form::close(); ?>

                                   <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('SettingsController@edit', $value->id))); ?>

                                    <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <i class="fa fa-edit  "></i>
                                    </button>
                                    <?php echo Form::close(); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/settings/index.blade.php ENDPATH**/ ?>