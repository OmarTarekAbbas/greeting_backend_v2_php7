<?php $__env->startSection('title'); ?>
    Content Providers
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Content Providers
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete Content Providers
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Content Providers</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Content Providers</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $Cproviders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Cprovider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($Cprovider->id); ?></td>
                                <td><?php echo e($Cprovider->name); ?></td>
                                <td>
                                    <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('CprovidersController@edit', $Cprovider->id))); ?>

                                    <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <i class="fa fa-edit  "></i>
                                    </button>
                                    <?php echo Form::close(); ?>

                                    <?php echo Form::open(array('class' => 'col-xs-1','method' => 'DELETE', 'action' => array('CprovidersController@destroy', $Cprovider->id))); ?>

                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete <?php echo e($Cprovider->name); ?>')">
                                        <i class="fa fa-trash-o "></i>
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
    <?php echo $Cproviders->setPath('cproviders'); ?>

    <div class="row">
        <span class="divider"></span>
    </div>
    <div class="row">
        <div class="col-xs-9">
            <div class="box">

                <?php echo Form::open(); ?>

                    <?php echo $__env->make('admin.cproviders.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <div class="form-group">

                        <button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span>Add</button>
                    </div>
                <?php echo Form::close(); ?>


            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/cproviders/index.blade.php ENDPATH**/ ?>