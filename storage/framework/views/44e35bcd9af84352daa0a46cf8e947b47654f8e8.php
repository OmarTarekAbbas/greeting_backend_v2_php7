<?php $__env->startSection('page_title'); ?>
    <?php echo app('translator')->getFromJson('messages.add_language'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('PageContent'); ?>
    <?php echo $__env->make('admin.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i><?php echo app('translator')->getFromJson('messages.languagee'); ?></h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                     <?php if(isset($language)): ?>
                        <?php echo Form::model($language, ['url'=>'admin/language/'.$language->id , 'method' => 'patch', 'class' => 'form-horizontal', 'files'=>'true' ]); ?>


                    <?php else: ?>
                        <?php echo Form::open(['method' => 'POST', 'url'=>'admin/language' , 'class' => 'form-horizontal', 'files'=>'true' ]); ?>



                    <?php endif; ?>
                        <?php echo $__env->make('admin.language._form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo Form::close(); ?>

                </div>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $('#language').addClass('active');
        $('#language-create').addClass('active');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/language/create.blade.php ENDPATH**/ ?>