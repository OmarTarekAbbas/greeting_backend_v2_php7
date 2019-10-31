<?php $__env->startSection('title'); ?>
    Categories
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Categories
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete Categories
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Categories</li>
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
                            <th>Category Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $Categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($Category->id); ?></td>
                                <td><?php echo e($Category->title); ?></td>
                                <td>
                                    <?php echo Form::open(array('class' => 'col-xs-1','method' => 'DELETE', 'action' => array('CategoriesController@destroy', $Category->id))); ?>

                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete <?php echo e($Category->title); ?>')">
                                        <i class="fa fa-trash-o "></i>
                                    </button>
                                    <?php echo Form::close(); ?>

                                    <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('CategoriesController@edit', $Category->id))); ?>

                                    <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <i class="fa fa-edit  "></i>
                                    </button>
                                    <?php echo Form::close(); ?>

                                    <a href="<?php echo e(url('admin/categories/'.$Category->id.'/occasion')); ?>"><button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add Occasion"><i class="ion-ios-bookmarks"></i> </button> </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php echo $Categories->setPath('categories'); ?>

    <div class="row">
        <span class="divider"></span>
    </div>
    <hr class="fc-agenda-divider-inner">
    <div class="page-head margin-bottom-20">
        <h1 class="page-title">Add new Category</h1>
    </div>
    <div class="row">

        <div class="col-xs-9">
            <div class="box">
                <?php echo Form::open(['url'=>'admin/categories']); ?>

                    <?php echo $__env->make('admin.categories.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="form-group">
                        <button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-plus"></i></span>Add</button>
                    </div>
                <?php echo Form::close(); ?>

            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>