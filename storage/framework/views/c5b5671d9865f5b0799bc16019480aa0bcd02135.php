<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label"><?php echo app('translator')->getFromJson('messages.campain.title'); ?>*</label>
    <div class="col-sm-9 col-lg-10 controls">
        <?php echo Form::text('title',old('title'), ['class'=>'form-control input-lg','required' => 'required']); ?>

    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 col-lg-2 control-label"><?php echo app('translator')->getFromJson('messages.short_code'); ?>*</label>
    <div class="col-sm-9 col-lg-10 controls">
        <?php echo Form::text('short_code',old('short_code'), ['class'=>'form-control input-lg','required' => 'required']); ?>

    </div>
</div>

<div class="form-group">
  <label class="col-sm-3 col-lg-2 control-label"><?php echo app('translator')->getFromJson('messages.right_to_list'); ?> ?*</label>
  <div class="col-sm-9 col-lg-10 controls">
      <select class="form-control chosen-rtl" name="rtl">
          <option value="0">NO</option>
          <option value="1">YES</option>
      </select>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
        <?php echo Form::button('<i class="fa fa-check"></i> Save',['type'=>'submit','class'=>'btn btn-primary']); ?>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/language/_form.blade.php ENDPATH**/ ?>