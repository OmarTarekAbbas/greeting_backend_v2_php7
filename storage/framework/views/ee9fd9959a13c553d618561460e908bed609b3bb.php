<?php $__env->startSection('title'); ?>
    Occasions
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    <?php if(isset($occasion) && $occasion): ?> <?php echo e($occasion->title); ?> <?php else: ?> Occasions <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete Occasions
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Occasions</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="right">
            <a href="<?php echo e(url('admin/occasions/create')); ?>"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
        </div>
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Occasion Name</th>
                            <th>Category</th>
                            <th>Slider</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $Occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($Occasion->id); ?></td>
                                <td><?php echo e($Occasion->title); ?></td>
                                <td><?php echo e($Occasion->category->title); ?></td>
                                <td><?php if($Occasion->slider): ?> YES <?php else: ?> NO <?php endif; ?></td>
                                <td>
                                    <?php if(Auth::user()->admin == true): ?>
                                    <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('OccasionsController@edit', $Occasion->id))); ?>

                                    <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <i class="fa fa-edit  "></i>
                                    </button>
                                    <?php echo Form::close(); ?>

                                    <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'DELETE', 'action' => array('OccasionsController@destroy', $Occasion->id))); ?>

                                    <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Are you sure you want to delete <?php echo e($Occasion->title); ?>')">
                                        <i class="fa fa-trash-o "></i>
                                    </button>
                                    <?php echo Form::close(); ?>

                                    <?php endif; ?>
                                    <a href="<?php echo e(url('admin/occasions/'.$Occasion->id.'/gimage')); ?>"><button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add Images"><i class="ion-images"></i> </button> </a>
                                    <a href="<?php echo e(url('admin/occasions/create?parent_id='.$Occasion->id.'&title='.$Occasion->title)); ?>"><button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add Sub Occasion"><i class="ion-plus"></i> </button> </a>
                                    <?php if(count($Occasion->sub_occasions) > 0): ?>
                                      <a href="<?php echo e(url('admin/occasions/'.$Occasion->id)); ?>"><button class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="bottom" title="Show Sub Occasion"><i class="fa fa-arrow-right"></i> </button> </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php echo $Occasions->render(); ?>

    <div class="row">
        <span class="divider"></span>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/occasions/index.blade.php ENDPATH**/ ?>