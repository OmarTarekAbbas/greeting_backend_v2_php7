<div class="form-group">
    <?php echo Form::label('name', 'Operator Name',['class'=>'control-label']); ?>

    <?php echo Form::text('name', null, ['class'=>'form-control','placeholder'=>'Operator Name']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('country_id', 'Select Country',['class'=>'control-label']); ?>

    <?php echo Form::select('country_id', $Countries, null, ['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('rbt_sms', 'Rbt SMS',['class'=>'control-label']); ?>

    <?php echo Form::text('rbt_sms', null, ['class'=>'form-control','placeholder'=>'Rbt SMS']); ?>

</div>
<div class="form-group">
  <?php echo Form::label('Status', 'Status',['class'=>'control-label']); ?>

  <?php echo Form::select('close',array('0' => 'open','1' => 'close'),null,['class'=>'form-control chosen-rtl','required']); ?>

</div>
<?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/operators/form.blade.php ENDPATH**/ ?>