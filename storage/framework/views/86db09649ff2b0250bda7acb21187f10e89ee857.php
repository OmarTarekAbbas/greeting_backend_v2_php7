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
        <?php if(get_settings('enable_delete')): ?>
        <a  id="delete_button" onclick="delete_selected('generatedurls')" class="btn btn-circle btn-danger show-tooltip" title="Delete All" href="#"><i class="fa fa-trash-o"></i></a>
        <?php endif; ?>
    </div>
    <br>
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-striped datatable">
                    <thead>
                        <tr>
                            <th style="width:18px"><input type="checkbox" onclick="select_all('generatedurls')"></th>
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
                                <td><input class="select_all_template" type="checkbox" name="selected_rows[]" value="<?php echo e($URL->id); ?>"
                                    class="roles" onclick="collect_selected(this)"></td>
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
                                    <span class="text text-info">link 1 : </span><input class="" value='<?php echo e(url("snap/$URL->UID")); ?>'/>
                                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                                    <br/>
                                    <span class="text text-info">link 2 : </span>  <input class="" value='<?php echo e(url("cuurentSnap/$URL->UID")); ?>'/>
                                    <button class="btn btn-info btn-xs copy" data-toggle="tooltip" data-placement="top" title="Copy to clipboard"><i class="fa fa-copy"></i></button>
                                    <br/>

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
            $(".copy").click(function () {
                var copyText = $(this).prev('input');
                console.log(copyText.attr('class'));
                copyText.select();
                document.execCommand("copy");
                //alert("Copied the text: " + copyText.val());
            });
            $('.datatable').DataTable()
        })
    </script>
     <script>
            var check = false;

            function select_all(table_name, has_media)
            {
                if (!check)
                {
                    $('.select_all_template').prop("checked", !check);
                    $.get("<?php echo e(url('admin/get_table_ids?table_name=')); ?>" + table_name, function (data, status) {
                        data.forEach(function (item) {
                            collect_selected(item.id);
                        });
                    });
                    check = true;
                }
                else
                {
                    $('.select_all_template').prop("checked", !check);
                    check = false;
                    clear_selected();
                }
            }

        </script>

        <script>

            var selected_list = [];
            var checker_list = [];
            function collect_selected(element) {
                var id;
                if (!element.value)
                {
                    id = element;
                }
                else {
                    id = element.value;
                }

                if (checker_list[id])
                {
                    var index = selected_list.indexOf(id);
                    selected_list.splice(index, 1);
                    checker_list[id] = false;
                }
                else {
                    if (!selected_list.includes(id))
                    {
                        selected_list.push(id);
                        checker_list[id] = true;
                    }
                }
            }

            function clear_selected()
            {
                selected_list = [];
                checker_list = [];
            }

        </script>

        <script>
            $(document).ready(function () {
                // $('#example').DataTable();
            });


            function delete_selected(table_name) {
                var confirmation = confirm('Are you sure you want to delete this ?');
                if (confirmation)
                {
                    var form = document.createElement("form");
                    var element = document.createElement("input");
                    var tb_name = document.createElement("input");
                    var csrf = document.createElement("input");
                    csrf.name = "_token";
                    csrf.value = "<?php echo e(csrf_token()); ?>";
                    csrf.type = "hidden";

                    form.method = "POST";
                    form.action = "<?php echo e(url('admin/delete_multiselect')); ?>";

                    element.value = selected_list;
                    element.name = "selected_list";
                    element.type = "hidden";

                    tb_name.value = table_name;
                    tb_name.name = "table_name";
                    tb_name.type = "hidden";

                    form.appendChild(element);
                    form.appendChild(csrf);
                    form.appendChild(tb_name);

                    document.body.appendChild(form);

                    form.submit();
                }
            }

            var initChosenWidgets = function () {
                $(".chosen").chosen();
            };
        </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/greeting_backend_v2_php7/resources/views/admin/urls/index.blade.php ENDPATH**/ ?>