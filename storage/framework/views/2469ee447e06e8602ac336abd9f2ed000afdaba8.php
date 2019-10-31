<?php $__env->startSection('title'); ?>
    Countries
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Countries
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete countries
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Countries</li>
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
                            <th>Country Name</th>
                            <th>Opertators count</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $__currentLoopData = $Countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($Country->id); ?></td>
                                <td><a href="<?php echo e(url('admin/country/'.$Country->id)); ?>"><?php echo e($Country->name); ?></a></td>
                                <td><a href="<?php echo e(url('admin/country/'.$Country->id)); ?>"><?php echo e($Country->operators->count()); ?></a></td>
                                <td>
                                    <?php echo Form::open(array('class' => 'col-xs-4','method' => 'DELETE', 'action' => array('CountriesController@destroy', $Country->id))); ?>

                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete" type="submit" onclick="return confirm('Are you sure you want to delete <?php echo e($Country->Name); ?>')">
                                        <i class="fa fa-trash-o "></i>
                                    </button>
                                    <?php echo Form::close(); ?>

                                    <a href="<?php echo e(url('admin/country/'.$Country->id.'/operator')); ?>"><button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add Operator"><i class="ion-android-phone-portrait"></i> </button> </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php echo $Countries->setPath('country'); ?>

    <div class="row">
        <span class="divider"></span>
    </div>
    <div class="row">
        <div class="col-xs-9">
            <div class="box">
                <?php echo $__env->make('admin.countries.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/countries/index.blade.php ENDPATH**/ ?>