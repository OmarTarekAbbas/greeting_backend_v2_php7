<?php $__env->startSection('title'); ?>
Greeting Rbts
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
Greeting Rbts
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
You can add and delete Greeting Rbts
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="active">Greeting Rbts</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

<div class="row">
    <?php if($snap==0): ?>
    <div class="right">
        <a href="<?php echo e(url('admin/grbts/create')); ?>"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
    </div>
    <?php endif; ?>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <br/>
                <table class="table table-hover table-striped datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Occasion</th>
                            <th>Category</th>
                            <th>Content Provider</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>In Operators</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $(document).ready(function () {
        $('.datatable').DataTable({
            "processing": true,
            "serverSide": true,
            ajax: '<?php echo url("admin/grbts/allData?snap=$snap"); ?>',
            columns: [
                {data: 'id'},                                
                {data: 'title'},
                {data: 'occasionsTitle'},
                {data: 'categoriesTitle'},
                {data: 'cproviderName'},
                {data: 'RDate'},
                {data: 'EXDate'},
                {data: 'operators'},
                {data: 'featured'},
                {data: 'action', searchable: false}
            ]
             , "pageLength": <?php echo e(get_pageLength()); ?>

        });      
    });
      
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/grbts/index.blade.php ENDPATH**/ ?>