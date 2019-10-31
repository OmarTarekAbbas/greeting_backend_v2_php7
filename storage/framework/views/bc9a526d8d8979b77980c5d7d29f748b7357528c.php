<?php $__currentLoopData = $Snapdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="col-6 Rdata">
      <div class="label_title">
          <div class="row">
              <div class="col-4 p-0">
                  <a class="more" href="<?php echo e(url('inner_snap_v2/'.$value->id.'/'.UID())); ?>">
                      <i class="fas fa-angle-right"></i>
                  </a>
              </div>

              <div class="col-4 p-0">
                <a href="<?php echo e(url('inner_snap_v2/'.$value->id.'/'.UID())); ?>">
                    <span class="title"><?php echo e($value->title); ?></span>
                </a>
              </div>

              <div class="col-4 p-0">
                  <img src="<?php echo e(url($value->occasion->image)); ?>" alt="">
              </div>
          </div>
      </div>
      <div class="fav_item">
        <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
          <i id="<?php echo e($value->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $value->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
        <?php endif; ?>
          <a href="<?php echo e(url('inner_snap_v2/'.$value->id.'/'.$url->UID)); ?>">
              <img src="<?php echo e(url('/'.$value->path)); ?>" alt="">
              <div class="view">
                <i id="eye" class="fas fa-eye"></i> <span>  <?php echo e($value->popular_count); ?></span>
              </div>
          </a>
      </div>
  </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/new_snap_v2/snap_load.blade.php ENDPATH**/ ?>