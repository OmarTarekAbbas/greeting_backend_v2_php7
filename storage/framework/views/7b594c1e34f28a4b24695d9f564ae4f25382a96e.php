<?php $__env->startSection('title'); ?>
Edit Snap Image
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
Edit Snap Image
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
Edit Snap Image
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li><a href="<?php echo e(url('admin/gsnap')); ?>"> Snap Images</a></li>
<li class="active">Edit</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <?php echo Form::model($GreetingImg,['method'=>'PATCH','files'=>true,'action'=>['GreetingSnapController@update',$GreetingImg->id]]); ?>

            <?php echo Form::hidden('redirects_to', URL::previous()); ?>

            <?php echo $__env->make('admin.gsnap.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            
            <br>
            <br>
            <br>            
            <div class="form-group">
                <button class="btn btn-labeled btn-info" type="submit"><span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Edit</button>
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
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/gsnap/edit.blade.php ENDPATH**/ ?>