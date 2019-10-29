<?php $__env->startSection('title'); ?>
Create Snap Image
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
Create Snap Image
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
You can add and delete Snap Image
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li><a href="<?php echo e(url('admin/gsnap')); ?>"> Snap Image</a></li>
<li class="active">Create New</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <?php echo Form::open(['url'=>'admin/gsnap','files'=>true]); ?>

            <?php echo $__env->make('admin.gsnap.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>            
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

    var token = '<?php echo e(Session::token()); ?>';

    $('#occasion_list').on('change', function () {   
        $.ajax({
            method: 'POST',
            url: '<?php echo e(url("admin/date")); ?>',
            data: {
                 id: $(this).val(),
                 _token: token
                }
        })
        .done(function (data) { 
            $('#RDate').val(data.RDate);
            $('#EXDate').val(data.EXDate);
        });
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/gsnap/add.blade.php ENDPATH**/ ?>