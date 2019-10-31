<?php $__env->startSection('title'); ?>
    Users
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Users
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete Users
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Users</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageContent'); ?>

    <div class="right">
        <a href="<?php echo e(url('admin/user/create')); ?>"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
    </div>

    <div class="col-xs-12">
        <div class="box">
            <div class="box-title">

                <h3>Users</h3>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Admin</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $__currentLoopData = $Users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $User): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($User->name); ?></td>

                            <td>
                                <?php if($User->admin == 0): ?>
                                    No
                                <?php else: ?>
                                    Yes
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($User->email); ?></td>
                            <td>
                                <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'DELETE', 'action' => array('UsersController@destroy', $User->id))); ?>

                                <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete this ?')">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                                <?php echo Form::close(); ?>

                                <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('UsersController@edit', $User->id))); ?>

                                <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="glyphicon glyphicon-pencil"></i>
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


    <?php echo $Users->setPath('user'); ?>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/auth/userlist.blade.php ENDPATH**/ ?>