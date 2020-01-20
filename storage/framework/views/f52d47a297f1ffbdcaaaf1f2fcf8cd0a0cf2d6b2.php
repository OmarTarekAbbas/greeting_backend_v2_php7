<?php $__env->startSection('page_title'); ?>
	<?php echo app('translator')->getFromJson('messages.static_translations'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('PageContent'); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-black">
				<div class="box-title">
					<h3><i class="fa fa-table"></i><?php echo app('translator')->getFromJson('messages.static_translations'); ?></h3>
	
				</div>
				<div class="box-content">
				<div class="btn-toolbar pull-right">
                        <div class="btn-group">
                            <a class="btn btn-circle show-tooltip" title="" href="<?php echo e(url('admin/static_translation/create')); ?>" data-original-title="Add new record"><i class="fa fa-plus"></i></a>
                            <?php
                            $table_name = "static_translations" ;
                            // pass table name to delete all function
                            // if the current route exists in delete all table flags it will appear in view
                            // else it'll not appear
                        ?>
                        </div>
                    </div>
                    <br><br>
					<div class="table-responsive">
						<table id="example" class="table table-striped dt-responsive" cellspacing="0" width="100%">
							<thead>
							<tr>
							<th style="width:18px"><input type="checkbox" onclick="select_all('<?php echo e($table_name); ?>')"></th>
							<th><?php echo app('translator')->getFromJson('messages.keyword'); ?></th>
								<th><?php echo app('translator')->getFromJson('messages.translation'); ?></th>
								<th class="visible-md visible-lg" style="width:130px"><?php echo app('translator')->getFromJson('messages.action'); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php $__currentLoopData = $static_translations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $static_translation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr class="table-flag-blue">
								<th><input class="select_all_template" type="checkbox" name="selected_rows[]" value="<?php echo e($static_translation->id); ?>" class="roles" onclick="collect_selected(this)"></th>
									<td><?php echo e($static_translation->key_word); ?></td>
									<td>
										<?php if(strlen($static_translation->getBody()) < 50): ?>
											<ul>
			                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<li>
			                                        	<?php echo $static_translation->getBody($language->short_code); ?>

													</li>
			                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</ul>
										<?php else: ?>
											<a href="<?php echo e(url('admin/static_translation/'.$static_translation->id)); ?>" title="View Translation">View Translation</a>
										<?php endif; ?>
									</td>
									<td class="visible-md visible-lg">
										<div class="btn-group">
											<a class="btn btn-sm show-tooltip" title="" href="<?php echo e(url('admin/static_translation/'.$static_translation->id.'/edit')); ?>" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                            <?php echo Form::open(array('class' => 'form-inline col-lg-1','method' => 'DELETE', 'action' => array('StaticTranslationController@destroy', $static_translation->id))); ?>

                                            <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="bottom" title="Delete" onclick="return confirm('Are you sure you want to delete')">
                                                <i class="fa fa-trash-o "></i>
                                            </button>
                                            <?php echo Form::close(); ?>

										</div>
									</td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
		$('#static').addClass('active');
		$('#static-index').addClass('active');
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/static_translation/index.blade.php ENDPATH**/ ?>