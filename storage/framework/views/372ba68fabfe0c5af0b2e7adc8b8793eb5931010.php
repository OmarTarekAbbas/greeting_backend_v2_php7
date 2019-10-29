<?php $__env->startSection('content'); ?>

<style type="text/css">
  body {
    /*height: 100%;*/
  }
</style>

<!-- main content -->
<div class="main">

    <div class="owl_main owl-carousel owl-theme">
        <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item">
            <a href="<?php echo e(url('occasion/'.$slider->id.'/'.UID())); ?>">
                <img src="<?php echo e(url('/'.$slider->image)); ?>" alt="">
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <!------------------------------------------------>

    <div class="container">

        <!-- search -->
        <div class="search">
            <i class="fas fa-search"></i>
            <form  action="<?php echo e(url('Search_v2/'.UID())); ?>" method="get">
              <?php echo e(csrf_field()); ?>

              <input type="text" name="search" id="myInput" placeholder="بحث" title="">
            </form>
        </div>
        <!-- end search -->

    </div>

    <?php if(isset($Rdata_today[0])): ?>
    <!-- daily post -->
    <div class="daily_post">
        <div class="daily_title">
            <h4>فلتر اليوم</h4>
        </div>
        <div class="poster">
            <div class="border_poster">
                <div class="container">
                  <div class="row">
                      <div class="col-8 0 p-0">
                          <div class="poster_title">
                              <h3><?php echo e($Rdata_today[0]->title); ?></h3>
                          </div>
                          <div class="p_poster">
                              <h4>فلتر <?php echo e($Rdata_today[0]->title); ?></h4>
                          </div>
                      </div>
                      <div class="col-4 p-0">
                          <div class="poster_filtar">
                            <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                              <i id="<?php echo e($Rdata_today[0]->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $Rdata_today[0]->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                            <?php endif; ?>
                              <a href="<?php echo e(url('inner_snap_v2/'.$Rdata_today[0]->id.'/'.UID())); ?>">
                                  <img src="<?php echo e(url('/'.$Rdata_today[0]->path)); ?>" alt="">

                                  <div class="view">
                                    <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($Rdata_today[0]->popular_count); ?></span>
                                  </div>

                              </a>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end daily post -->
    <?php endif; ?>


    <!-- Suggestion -->
    <div class="filtars">
        <div class="f_title">
            <h4>فلاتر مقترحة لك</h4>
        </div>
        <div class="f_filtar">
          <?php if(count($suggests) > 2): ?>
            <div class="owl_three owl-carousel owl-theme">
              <?php $__currentLoopData = $suggests->take(10)->shuffle(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suggest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                  <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                    <i id="<?php echo e($suggest->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $suggest->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                  <?php endif; ?>

                  <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($suggest->popular_count); ?></span>
                  </div>

                    <a href="<?php echo e(url('inner_snap_v2/'.$suggest->id.'/'.UID())); ?>">
                        <img src="<?php echo e(url('/'.$suggest->path)); ?>" alt="">
                    </a>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php elseif(count($suggests) == 2): ?>
            <div class="owl_two owl-carousel owl-theme">
            <?php $__currentLoopData = $suggests->take(10)->shuffle(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suggest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="item">
                <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                  <i id="<?php echo e($suggest->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $suggest->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                <?php endif; ?>

                <div class="view">
                  <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($suggest->popular_count); ?></span>
                </div>
                  <a href="<?php echo e(url('inner_snap_v2/'.$suggest->id.'/'.UID())); ?>">
                      <img src="<?php echo e(url('/'.$suggest->path)); ?>" alt="">
                  </a>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <?php else: ?>
            <div class="owl_one owl-carousel owl-theme">
             <?php $__currentLoopData = $suggests->take(10)->shuffle(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $suggest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="item">
                <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                  <i id="<?php echo e($suggest->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $suggest->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                <?php endif; ?>

                <div class="view">
                  <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($suggest->popular_count); ?></span>
                </div>
                  <a href="<?php echo e(url('inner_snap_v2/'.$suggest->id.'/'.UID())); ?>">
                      <img src="<?php echo e(url('/'.$suggest->path)); ?>" alt="">
                  </a>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <?php endif; ?>
        </div>
    </div>
    <!-- end Suggestion -->

    <!-- Suggestion -->
    <div class="filtars">
        <div class="f_title">
            <h4>الاكثر شيوعا</h4>
        </div>
        <div class="f_filtar">
          <?php if(count($populars) > 2): ?>
            <div class="owl_three owl-carousel owl-theme">
              <?php $__currentLoopData = $populars->take(10)->shuffle(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                  <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                    <i id="<?php echo e($popular->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $popular->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                  <?php endif; ?>

                  <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($popular->popular_count); ?></span>
                  </div>

                    <a href="<?php echo e(url('inner_snap_v2/'.$popular->id.'/'.UID())); ?>">
                        <img src="<?php echo e(url('/'.$popular->path)); ?>" alt="">
                    </a>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php elseif(count($populars) == 2): ?>
            <div class="owl_two owl-carousel owl-theme">
            <?php $__currentLoopData = $populars->take(10)->shuffle(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="item">
                <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                  <i id="<?php echo e($popular->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $popular->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                <?php endif; ?>

                <div class="view">
                  <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($popular->popular_count); ?></span>
                </div>

                  <a href="<?php echo e(url('inner_snap_v2/'.$popular->id.'/'.UID())); ?>">
                      <img src="<?php echo e(url('/'.$popular->path)); ?>" alt="">
                  </a>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <?php else: ?>
          <div class="owl_one owl-carousel owl-theme">
            <?php $__currentLoopData = $populars->take(10)->shuffle(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="item">
                <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                  <i id="<?php echo e($popular->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $popular->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                <?php endif; ?>

                <div class="view">
                  <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($popular->popular_count); ?></span>
                </div>

                  <a href="<?php echo e(url('inner_snap_v2/'.$popular->id.'/'.UID())); ?>">
                      <img src="<?php echo e(url('/'.$popular->path)); ?>" alt="">
                  </a>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
          <?php endif; ?>
        </div>
    </div>
    <!-- end Suggestion -->

    <?php if(count($favourites) > 0): ?>
    <!-- liked -->
    <div class="filtars">
        <div class="f_title">
            <h4>فلاتر اعجبتني</h4>
        </div>
         <div class="f_filtar">
           <?php if(count($favourites) > 2): ?>
            <div class="owl_three owl-carousel owl-theme">
              <?php $__currentLoopData = $favourites->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                  <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                    <i id="<?php echo e($fav->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $fav->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                  <?php endif; ?>

                  <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($fav->popular_count); ?></span>
                  </div>

                    <a href="<?php echo e(url('inner_snap_v2/'.$fav->id.'/'.UID())); ?>">
                        <img src="<?php echo e(url('/'.$fav->path)); ?>" alt="">
                    </a>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
           <?php elseif(count($favourites) == 2): ?>
            <div class="owl_two owl-carousel owl-theme">
             <?php $__currentLoopData = $favourites->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="item">
                 <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                   <i id="<?php echo e($fav->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $fav->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                 <?php endif; ?>

                 <div class="view">
                   <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($fav->popular_count); ?></span>
                 </div>


                   <a href="<?php echo e(url('inner_snap_v2/'.$fav->id.'/'.UID())); ?>">
                       <img src="<?php echo e(url('/'.$fav->path)); ?>" alt="">
                   </a>
               </div>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </div>
           <?php else: ?>
             <div class="owl_one owl-carousel owl-theme">
              <?php $__currentLoopData = $favourites->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item">
                  <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                    <i id="<?php echo e($fav->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $fav->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                  <?php endif; ?>

                  <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> <?php echo e($fav->popular_count); ?></span>
                  </div>

                    <a href="<?php echo e(url('inner_snap_v2/'.$fav->id.'/'.UID())); ?>">
                        <img src="<?php echo e(url('/'.$fav->path)); ?>" alt="">
                    </a>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
             </div>
          <?php endif; ?>
        </div>
    </div>
    <!-- end liked -->
    <?php endif; ?>


</div>
<!-- end main content -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.new_snap_v2.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/new_snap_v2/home.blade.php ENDPATH**/ ?>