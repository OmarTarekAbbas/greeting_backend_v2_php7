<?php $__env->startSection('title'); ?>
    Operators
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Operators
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete Operators
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Operators</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="right">
            <a href="<?php echo e(url('admin/operator/create')); ?>"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Operator Name</th>
                            <th>Country</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $Operators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Operator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($Operator->id); ?></td>
                                <td><a href="<?php echo e(url('admin/operator/'.$Operator->id)); ?>"> <?php echo e($Operator->name); ?></a></td>
                                <td><a href="<?php echo e(url('admin/country/'.$Operator->country->id )); ?>"> <?php echo e($Operator->country->name); ?></a></td>
                                <td><?php if(!$Operator->close): ?> Open <?php else: ?> Close <?php endif; ?></td>
                                <td>
                                    <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('OperatorsController@edit', $Operator->id))); ?>

                                    <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <i class="fa fa-edit  "></i>
                                    </button>
                                    <?php echo Form::close(); ?>

                                    <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'DELETE', 'action' => array('OperatorsController@destroy', $Operator->id))); ?>

                                    <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Are you sure you want to delete <?php echo e($Operator->name); ?>')">
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

    <?php echo $Operators->setPath('operator'); ?>


    <div class="row">
        <span class="divider"></span>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/operators/index.blade.php ENDPATH**/ ?>