<div class="form-group">
    <?php echo Form::label('title', 'Image Title', ['class'=>'control-label']); ?>

    <ul id="myTab1" class="nav nav-tabs">
        <?php $i=0;?>
        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="<?php echo e(($i++)? '':'active'); ?>"><a href="#translations<?php echo e($language->short_code); ?>" data-toggle="tab"> <?php echo e($language->title); ?></a></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
      </ul>

      <div class="tab-content">
        <?php $i=0;?>
        <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="tab-pane fade in <?php echo e(($i++)? '':'active'); ?>" id="translations<?php echo e($language->short_code); ?>">
            <?php echo Form::text("title[$language->short_code]", (isset($GreetingImg)) ? $GreetingImg->getTranslation('title',$language->short_code):null, ['class'=>'form-control','maxlenght'=>60,'placeholder'=>"$language->title" ]); ?>

          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


      </div>

</div>

<div class="form-group">
    <?php echo Form::label('file', 'Snap Image File', ['class'=>'control-label']); ?>

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
<div class="form-group">
    <?php echo Form::label('snap_vid', 'Snap Video Link', ['class'=>'control-label']); ?>

    <ul id="myTab1" class="nav nav-tabs">
          <li class="active"><a href="#Internal" data-toggle="tab"> Internal</a></li>
          
      </ul>
      <br>
        <div class="tab-content">
            <div class="tab-pane fade in <?php echo e('active'); ?>" id="Internal">
                <?php echo Form::label('vid_file', 'Select video file', ['class'=>'control-label']); ?>

                <?php echo Form::file('vid_file', ['class'=>'form-control']); ?>

            </div>
            
        </div>
        
        <?php if(isset($GreetingImg) && $GreetingImg->vid_path): ?>
        <div class="row" style="margin-top:30px;">
            
            <video class="col-md-3" width="" src="<?php echo e(url('/'.$GreetingImg->vid_path)); ?>" controls></video>
            <img class="col-md-3" width="" src="<?php echo e(url('/'.$GreetingImg->vid_type)); ?>" controls/>

        </div>
        <?php endif; ?>

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


<?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/admin/gsnap/form.blade.php ENDPATH**/ ?>