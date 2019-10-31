<?php $__env->startSection('title'); ?>
    Generated URLs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Generated URLs
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
    Generated URL
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Generated URL</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="form-group">
                    <?php if($snap> 0): ?>
                    <span class="text text-info">link 1 : </span><input type="text" name="generatedurl" class="form-control input-lg" value="<?php echo e(url('snap/'.$UID)); ?>" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <span class="text text-info">link 2 : </span><input type="text" name="generatedurl" class="form-control input-lg" value="<?php echo e(url('cuurentSnap/'.$UID)); ?>" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <span class="text text-info">link 3 : </span><input type="text" name="generatedurl" class="form-control input-lg" value="<?php echo e(url('cuurentSnap_v2/'.$UID)); ?>" />
                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                    <?php else: ?>
                    <input type="text" name="generatedurl" class="form-control input-lg" value="<?php echo e(url($UID)); ?>" />
                    <?php endif; ?>
                </div>
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
            $(".copy").click(function () {
                var copyText = $(this).prev('input');
                console.log(copyText.attr('class'));
                copyText.select();
                document.execCommand("copy");
                //alert("Copied the text: " + copyText.val());
            });
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/urls/generated.blade.php ENDPATH**/ ?>