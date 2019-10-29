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
    <div class="right">
        <a href="<?php echo e(url('admin/generateurls/create')); ?>"><button class="btn btn-labeled btn-info"><i class="glyphicon glyphicon-plus"></i></span>Add New</button></a>
    </div>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped datatable">
                    <thead>
                        <tr>
                            <th>Operator Name</th>
                            <th>Occasion</th>
                            <th>Images</th>
                            
                            <th>Video</th>
                            <th>Snap</th>
                            <th>URL</th>
                            <th>Actions</th>
                            <th>Occasion Expire</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $URLs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $URL): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $snap = $URL->operator->greetingimgs()->PublishedSnap()->count() ?>
                        <tr>
                            <td><a href="<?php echo e(url('admin/operator/'.$URL->operator['id'])); ?>"> <?php echo e($URL->operator['name']); ?>-<?php echo e($URL->operator->country['name']); ?></a></td>
                            <td><?php echo e($URL->occasion['title']); ?></td>
                            <td>
                                <?php if($URL->img == 1): ?>
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                <?php else: ?>
                                <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                <?php endif; ?>

                            </td>
                            
                            <td>
                                <?php if($URL->video == 1): ?>
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                <?php else: ?>
                                <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($snap >0): ?>
                                <button type="button" class="btn btn-info btn-circle"><i class="ion-checkmark-round bg-blue-500"></i></button>
                                <?php else: ?>
                                <button type="button" class="btn btn-danger btn-circle"><i class="ion-close-round bg-red-500"></i></button>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($snap> 0): ?>
                                <div style="display: none"><?php echo e(url("snap/$URL->UID")); ?></div>
                                <span class="text text-info">link 1 : </span><input class="" value='<?php echo e(url("snap/$URL->UID")); ?>'/>
                                <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                                <br/>
                                <div style="display: none"><?php echo e(url("cuurentSnap/$URL->UID")); ?></div>
                                <span class="text text-info">link 2 : </span>  <input class="" value='<?php echo e(url("cuurentSnap/$URL->UID")); ?>'/>
                                <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                                <br/>
                                <div style="display: none"><?php echo e(url("cuurentSnap_v2/$URL->UID")); ?></div>
                                <span class="text text-info">link 3 : </span>  <input class="" value='<?php echo e(url("cuurentSnap_v2/$URL->UID")); ?>'/>
                                <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                                <?php else: ?>
                                <a  target="_blank" href="<?php echo e(url($URL->UID)); ?>"><?php echo e(url($URL->UID)); ?></a>
                                <?php endif; ?>
                            <td>
                                <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'GET', 'action' => array('GenerateurlController@edit', $URL->id))); ?>

                                <button class="btn btn-info btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <i class="fa fa-edit  "></i>
                                </button>
                                <?php echo Form::close(); ?>

                                <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'DELETE', 'action' => array('GenerateurlController@destroy', $URL->id))); ?>

                                <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Are you sure you want to delete this item')">
                                    <i class="fa fa-trash-o "></i>
                                </button>
                                <?php echo Form::close(); ?>

                            </td>
                            <td>
                                <?php if($URL->video == true): ?>
                                <?php if($URL->operator->greetingaudios()->publishedocc($URL->occasion->id)->count() == 0): ?>
                                <p class="text-danger">Expired Audio Contents</p>

                                <?php elseif($URL->operator->greetingimgs()->publishedocc($URL->occasion->id)->count() == 0): ?>
                                <p class="text-danger">Expired Images Contents</p>
                                <?php endif; ?>

                                <?php elseif($URL->img == true): ?>
                                    <?php if($URL->operator->greetingimgs()->publisheSnapdocc($URL->occasion->id)->count() == 0): ?>
                                        <p class="text-danger">Expired Images Contents</p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>
                </table>
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
        $('.datatable').DataTable()
        $(".copy").click(function () {
            var copyText = $(this).prev('input');
            console.log(copyText.attr('class'));
            copyText.select();
            document.execCommand("copy");

            //alert("Copied the text: " + copyText.val());
        })
    })

</script>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/urls/index.blade.php ENDPATH**/ ?>