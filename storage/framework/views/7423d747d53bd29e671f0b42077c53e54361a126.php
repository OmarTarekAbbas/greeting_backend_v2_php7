<?php $__env->startSection('title'); ?>
    Generated URLs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Generated URLs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    You can add and delete Generated URLs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Generated URLs</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <?php echo Form::open(['url'=>'admin/generateurls','id'=>'checkform','files'=>true]); ?>

                <?php echo $__env->make('admin.urls.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.switchery').click(function () {         
            if ($("input[name='img']:checked").length > 0 && $("input[name='video']:checked").length > 0) {                
                $(".occasion").show();
            } else {
                $(".occasion").hide();
            }
        })
    });
</script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/urls/add.blade.php ENDPATH**/ ?>