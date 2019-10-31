<?php $__env->startSection('title'); ?>
Create Greeting Rbt
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
Create Greeting Rbt
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
You can add and delete Greeting Rbt
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li><a href="<?php echo e(url('admin/grbts')); ?>"> Greeting Rbt</a></li>
<li class="active">Create New</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <?php echo Form::open(['url'=>'admin/grbts','files'=>true]); ?>

            <?php echo $__env->make('admin.grbts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php $__env->startSection('script'); ?>
<script>
    $(document).ready(function () {
        $('#add').click(function () {
            $('#rbt_code').append("<div class='row'>" + $('#first_row').html() + '<a class="btn btn-circle btn-danger  del"><i class="fa fa-trash"></i></a></div>');
        });
        $(document).on("click", ".del", function () {
            $(this).closest('div.row').remove();
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/grbts/add.blade.php ENDPATH**/ ?>