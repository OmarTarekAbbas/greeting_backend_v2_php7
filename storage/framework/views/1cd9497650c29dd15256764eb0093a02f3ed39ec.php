<div class="form-group">
    <?php echo Form::label('title', 'Image Title', ['class'=>'control-label']); ?>

    <?php echo Form::text('title', null, ['class'=>'form-control']); ?>

</div>

<div class="form-group">
    <?php echo Form::label('file', 'Select greeting file', ['class'=>'control-label']); ?>

    <?php echo Form::file('file', ['class'=>'form-control']); ?>

</div>

<div class="form-group">
    <?php echo Form::label('occasion_id', 'Select occasion', ['class'=>'control-label']); ?>

    
    <?php echo Form::select('occasion_id', $Occasions, null, ['id' => 'occasion_list' ,'class'=>'form-control']); ?>

    
</div>
<div class="form-group margin-top-20">
    <input type="checkbox" class="js-switch" id="checkbox" name="featured" <?php if(isset($GreetingImg) && $GreetingImg->featured==1): ?> checked <?php endif; ?>/><label for="checkbox" class="font-size-12 normal margin-left-10">Featured</label>
</div>

<div class="form-group margin-top-20"id="snap_link" >
    <?php echo Form::label('snap_link', 'Snap Link', ['class'=>'control-label']); ?>

    <?php echo Form::text('snap_link',  null, ['class'=>'form-control']); ?>


</div>
<?php if(Auth::user()->admin == true): ?>
<div class="form-group">
    <?php echo Form::label('operator_list', 'Select Operator'); ?>

    <?php echo Form::select('operator_list[]',$operators,null,['id'=>'operator_list','class'=>'form-control','multiple']); ?>


</div>
<div class="form-group" style="margin-bottom: 25px;">
    <div class="row">
        <div class="col-xs-6">

            <?php echo Form::label('RDate', 'Start Date', ['class'=>'control-label']); ?>

            <div class="input-group ">
                <?php echo Form::text('RDate',null,['class'=>'form-control datepicker','id'=>'RDate']); ?>

                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
        <div class="col-xs-6">
            <?php echo Form::label('EXDate', 'End Date', ['class'=>'control-label']); ?>

            <div class="input-group ">
                <?php echo Form::text('EXDate',null,['class'=>'form-control datepicker','id'=>'EXDate']); ?>

                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>


<?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/gsnap/form.blade.php ENDPATH**/ ?>