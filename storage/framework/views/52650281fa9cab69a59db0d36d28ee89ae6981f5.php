<div class="form-group">
    <?php echo Form::label('occasion_id', 'Select occasion', ['class'=>'control-label']); ?>

    <?php echo Form::select('occasion_id', $Occasions, null, ['class'=>'form-control']); ?>

</div>

<div class="form-group">
    <?php echo Form::label('operator_id', 'Select Operator', ['class'=>'control-label']); ?>

    <?php echo Form::select('operator_id', $Operators, null, ['class'=>'form-control']); ?>

</div>

<div class="form-group margin-top-20">
    <input type="checkbox" class="js-switch" id="checkbox" name="img" <?php if($GeneratedURL && $GeneratedURL->img==1): ?> checked <?php endif; ?>/><label for="checkbox" class="font-size-12 normal margin-left-10">Image</label>
</div>

<div class="form-group margin-top-20">
    <input type="checkbox"  class="js-switch" id="checkbox" name="video" <?php if($GeneratedURL && $GeneratedURL->video==1): ?> checked <?php endif; ?> /><label for="checkbox" class="font-size-12 normal margin-left-10">Video</label>
</div>
<div class="occasion"style="display: none">
    <div class="form-group">
        <?php echo Form::label('url_occasion_text', 'Url Occasion Text', ['class'=>'control-label']); ?>

        <?php echo Form::textarea('url_occasion_text', null, ['class'=>'form-control']); ?>

    </div>

    <div class="form-group">
        <?php echo Form::label('file', 'Select Occasion Image', ['class'=>'control-label']); ?>

        <?php echo Form::file('file', ['class'=>'form-control']); ?>

    </div>
    <?php if($GeneratedURL && $GeneratedURL->url_occasion_image): ?>
    <div class="form-group">
        <img src="<?php echo e(url($GeneratedURL->url_occasion_image)); ?>" alt="" class="img-thumbnail" style="height:200px"/>
    </div>
    <?php endif; ?>
</div>   <?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/urls/form.blade.php ENDPATH**/ ?>