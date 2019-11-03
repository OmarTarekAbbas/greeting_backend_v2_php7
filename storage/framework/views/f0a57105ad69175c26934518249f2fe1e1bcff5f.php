<?php if(isset($_REQUEST['parent_id'])): ?>
<div class="form-group">
    <?php echo Form::label('parentid', 'Select Parent Occasion', ['class'=>'control-label']); ?>

    <select class="form-control" name="parent_id">
      <option value="<?php echo e($_REQUEST['parent_id']); ?>"><?php echo e($_REQUEST['title']); ?></option>
    </select>
</div>
<?php else: ?>
<div class="form-group">
    <?php echo Form::label('parent_id', 'Select Parent Occasion', ['class'=>'control-label']); ?>

    <?php echo Form::select('parent_id',$occasion_parent, null, ['class'=>'form-control parent_select']); ?>

</div>
<?php endif; ?>

<div class="form-group">
    <?php echo Form::label('title', 'Occasion name', ['class'=>'control-label']); ?>

    <?php echo Form::text('title', null, ['class'=>'form-control','maxlenght'=>60]); ?>

</div>
<div class="form-group">
    <?php echo Form::label('category_id', 'Select Category', ['class'=>'control-label']); ?>

    <?php echo Form::select('category_id', $Categories, null, ['class'=>'form-control']); ?>

</div>
<div class="form-group">
    <?php echo Form::label('file', 'Select Image', ['class'=>'control-label']); ?>

    <?php echo Form::file('image', ['class'=>'form-control']); ?>

</div>

 <?php if($Occasion && $Occasion->image): ?>
    <div class="form-group">
        <img src="<?php echo e(url($Occasion->image)); ?>" alt="" class="img-thumbnail" style="height:200px"/>
    </div>
<?php endif; ?>

<div class="form-group">
    <label class=" control-label">Slider<span class="text-danger">*</span></label>
    <?php echo Form::select('slider',array('1' => 'YES' , '0' => 'NO'),null,['class'=>'form-control']); ?>

</div>

<div class="form-group" style="margin-bottom: 25px;">
    <div class="row">
        <div class="col-xs-6">
            <?php echo Form::label('RDate', 'Start Date', ['class'=>'control-label']); ?>

            <div class="input-group ">
                <?php echo Form::text('occasion_RDate',null,['class'=>'form-control datepicker']); ?>

                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
        <div class="col-xs-6">
            <?php echo Form::label('EXDate', 'End Date', ['class'=>'control-label']); ?>

            <div class="input-group ">
                <?php echo Form::text('occasion_EXDate',null,['class'=>'form-control datepicker']); ?>

                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
    </div>
</div>

<?php /**PATH /var/www/html/greeting_backend_v2_php7/resources/views/admin/occasions/form.blade.php ENDPATH**/ ?>