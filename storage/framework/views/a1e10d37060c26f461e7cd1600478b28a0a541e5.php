<?php if($Img): ?>
<?php echo Form::hidden('snapID',$Img->id,''); ?>

<?php endif; ?>
<div class="form-group">
    <?php echo Form::label('title','Audio Title',['class'=>'control-label']); ?>

    <?php echo Form::text('title',$Img ? $Img->title:null,['class'=>'form-control']); ?>

</div>

<div class="form-group">
    <?php echo Form::label('file', 'Select greeting file', ['class'=>'control-label']); ?>

    <?php echo Form::file('file', ['class'=>'form-control']); ?>

</div>

<div class="form-group">
    <?php echo Form::label('occasion_id', 'Select occasion', ['class'=>'control-label']); ?>

    <?php echo Form::select('occasion_id', $Occasions, $Img ? $Img->occasion_id:null, ['class'=>'form-control']); ?>

</div>

<div class="form-group">
    <?php echo Form::label('cprovider_id', 'Select Content Provider', ['class'=>'control-label']); ?>

    <?php echo Form::select('cprovider_id', $Cproviders, null, ['class'=>'form-control']); ?>

</div>

<div class="form-group margin-top-20">
    <input type="checkbox" class="js-switch" id="checkbox" name="featured" <?php if($Greetingaudio && $Greetingaudio->featured==1): ?> checked <?php endif; ?>/><label for="checkbox" class="font-size-12 normal margin-left-10">Featured</label>
</div>

<?php if(Auth::user()->admin == true): ?>

<div class="form-group" id="rbt_code" style="margin-bottom: 25px;" >
    <a class="btn btn-circle btn-info pull-right" id="add">
        <i class="fa fa-plus"></i>
    </a>
    <div class="clearfix"></div>
    <div class="row" >
        <div class="col-md-6">
            <?php echo Form::label('operator_id', 'Select Operator'); ?>

        </div>
        <div class="col-md-6">
            <?php echo Form::label('code', 'Code'); ?>

        </div>
    </div>
    <?php if($codes): ?>
    <?php $__currentLoopData = $codes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row">
        <input type="hidden" name="code_id[]" value="<?php echo e($code->id); ?>"/>
        <div class="col-md-6">
            <?php echo Form::select('operator_id[]',$operators,$code->operator_id,['class'=>'form-control']); ?>

        </div>
        <div class="col-md-5">
            <?php echo Form::text('code[]',$code->code,['class'=>'form-control ']); ?>

        </div>
        <a class="btn btn-circle btn-danger  del_code" data-id="<?php echo e($code->id); ?>"><i class="fa fa-trash"></i></a>
    </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    <div class="row" id="first_row" <?php if($codes && count($codes)>=1): ?> style='display:none' <?php endif; ?> >
         <div class="col-md-6">
            <?php echo Form::select('operator_id[]',$operators,null,['class'=>'form-control']); ?>

        </div>
        <div class="col-md-5">
            <?php echo Form::text('code[]',null,['class'=>'form-control ']); ?>

        </div>
    </div>
</div>


<div class="form-group" style="margin-bottom: 25px;">
    <div class="row">
        <div class="col-xs-6">

            <?php echo Form::label('RDate', 'Start Date', ['class'=>'control-label']); ?>

            <div class="input-group ">
                <?php echo Form::text('RDate',$Img ? $Img->RDate:null,['class'=>'form-control datepicker']); ?>

                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
        <div class="col-xs-6">
            <?php echo Form::label('EXDate', 'End Date', ['class'=>'control-label']); ?>

            <div class="input-group ">
                <?php echo Form::text('EXDate',$Img ? $Img->EXDate:null,['class'=>'form-control datepicker']); ?>

                <span class="input-group-addon"><i class="ion-calendar"></i></span>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/grbts/form.blade.php ENDPATH**/ ?>