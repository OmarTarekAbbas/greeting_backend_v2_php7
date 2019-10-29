<?php $__env->startSection('title'); ?>
Edit Greeting Rbt
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
Edit Greeting Rbt
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
Edit Greeting Rbt
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li><a href="<?php echo e(url('admin/grbts')); ?>"> Greeting Rbts</a></li>
<li class="active">Edit</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>
<style>
    .row{
        margin-bottom: 10px;
    }
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <?php echo Form::model($Greetingaudio,['method'=>'PATCH','files'=>true,'action'=>['GreetingRbtController@update',$Greetingaudio->id]]); ?>

            <?php echo Form::hidden('redirects_to', URL::previous()); ?>

            <?php echo $__env->make('admin.grbts.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
           
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
    $(document).ready(function () {
       
        $('#add').click(function () {
            $('#rbt_code').append("<div class='row'>" + $('#first_row').html() + '<a class="btn btn-circle btn-danger  del"><i class="fa fa-trash"></i></a></div>');
        });
        $(document).on("click", ".del", function () {
            $(this).closest('div.row').remove();
        });
        $(document).on('click', '.del_code', function () {
            var confirmed = confirm('Are you sure you want to delete?');
            if (confirmed) {                
                var ele = $(this);
                var id = $(this).attr('data-id');
                $.ajax({
                    method: "get",
                    url: "<?= url('admin/grbts/del_code') ?>",
                    data: {id: id},
                    success: function (data) {
                        if (data == 'success') {
                            ele.closest('div.row').remove();
                        }
                    }
                });
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/grbts/edit.blade.php ENDPATH**/ ?>