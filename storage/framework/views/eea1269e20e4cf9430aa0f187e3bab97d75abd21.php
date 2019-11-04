<?php $__env->startSection('title'); ?>
    Order Snap
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageTitle'); ?>
    Order Snap
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageDesc'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="active">Order Snap</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>
    <style>
        .table.table-bordered > thead > tr > th {
            text-align: center;
        }
        /*.dataTables_wrapper .dataTables_paginate{*/
        /*    display: none;*/
        /*}*/
        #ss{

        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css">

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <br/>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped table-hover js-basic-example dataTable display responsive nowrap"

                               style="width: 100%;">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>disLike Count</th>
                                <th class='notexport'>Image</th>
                                <th>Title</th>
                                <th>Occasion</th>
                                <th>Category</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            <?php if(count($GreetingImgs) > 0): ?>
                                <?php $__currentLoopData = $GreetingImgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $GreetingImg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($GreetingImg->id); ?></td>
                                        <td><?php echo e($GreetingImg->dislike); ?></td>
                                        <td><img src="<?php echo e(url($GreetingImg->path)); ?>" style="width: 100px;height: 100px"  alt=""></td>
                                        <td><?php echo e($GreetingImg->title); ?></td>
                                        <td><?php echo e($GreetingImg->occasionsTitle); ?></td>
                                        <td><?php echo e($GreetingImg->categoriesTitle); ?></td>
                                        <td><?php echo e($GreetingImg->RDate); ?></td>
                                        <td><?php echo e($GreetingImg->EXDate); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "order": [],
                "columnDefs": [ {
                    "targets"  : 'no-sort',
                    "orderable": false,
                }],
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn btn-default',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    }]

            } );
        } );
    </script>
     <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/ordersnap/dislike_index.blade.php ENDPATH**/ ?>