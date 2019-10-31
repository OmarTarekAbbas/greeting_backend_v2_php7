<?php $__env->startSection('title'); ?>
Snap Images
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
Snap Images
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>
You can add and delete Snap Images
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
<li class="active">Snap Images</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>

<div class="row">
    <div class="right">
        <a href="<?php echo e(url('admin/gsnap/create')); ?>"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
    </div>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <br/>
                <table class="table table-hover table-striped datatable ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Occasion</th>
                            <th>Category</th>
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
            ajax: "<?php echo url('admin/gsnap/allData'); ?>",
            columns: [
                {data: 'id'},
                {data: 'image',name:'path', searchable: false},
                {data: 'title'},
                {data: 'occasionsTitle'},
                {data: 'categoriesTitle'},
                {data: 'RDate'},
                {data: 'EXDate'},
                {data: 'operators'},
                {data: 'featured'},
                {data: 'action', searchable: false}


            ] , "pageLength": <?php echo e(get_pageLength()); ?>

        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/gsnap/index.blade.php ENDPATH**/ ?>