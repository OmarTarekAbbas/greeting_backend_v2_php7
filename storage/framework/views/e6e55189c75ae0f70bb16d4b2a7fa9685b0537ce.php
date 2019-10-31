<?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="main">
    <div class="container"  style="min-height:900px">


        <!-- search -->
        <div class="search">
            <i class="fas fa-search"></i>
            <form  action="<?php echo e(url('Search_v2/'.UID())); ?>" method="get">
              <?php echo e(csrf_field()); ?>

              <input type="text" name="search" id="myInput" placeholder="بحث" title="">
            </form>
        </div>
        <!-- end search -->

        <!-- popularion -->
        <div class="filtars">
            <div class="f_title">
                <h4>الاكثر شيوعا</h4>
            </div>
            <div class="f_filtar">
                <?php if(count($populars) > 2): ?>
                <div class="owl_three owl-carousel owl-theme">
                    <?php $__currentLoopData = $populars->shuffle(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <?php $__currentLoopData = $populars->shuffle(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <div class="item">
                        <?php if(Session::has('MSISDN') && Session::get('Status') == 'active' ): ?>
                          <i id="<?php echo e($popular->id); ?>" <?php if(check_favourtite(Session::get('MSISDN') , $popular->id)): ?> class="far fa-heart heart active" <?php else: ?> class="far fa-heart heart" <?php endif; ?>></i>
                        <?php endif; ?>
                        <div class="view">
                          <i id="eye" class="fas fa-eye"></i> <span>  <?php echo e($popular->popular_count); ?></span>
                        </div>
                          <a href="<?php echo e(url('inner_snap_v2/'.$popular->id.'/'.UID())); ?>">
                              <img src="<?php echo e(url('/'.$popular->path)); ?>" alt="">
                          </a>
                      </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div class="owl_one owl-carousel owl-theme">
                    <?php $__currentLoopData = $populars->shuffle(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
        <!-- end popularion -->

        <!-- fav cat -->
        <div class="fav_cat">
          <h2 style="text-align: center;color: #fff;border-bottom: 1px solid #000;border-top: 1px solid #000;padding-bottom: 7px;"><?php echo e($occasion->title); ?></h2>
            <div class="row" id="categoryStatus" action="inactive">
              <?php $__currentLoopData = $Rdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <a href="<?php echo e(url('inner_snap_v2/'.$value->id.'/'.UID())); ?>">
                            <img src="<?php echo e(url('/'.$value->path)); ?>" alt="">


                        <div class="view">
                          <i id="eye" class="fas fa-eye"></i> <span>  <?php echo e($value->popular_count); ?></span>
                        </div>


                        </a>
                    </div>
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <!-- end fav cat -->

    </div>
</div>
<!-- end main content -->
<div class="load" style="position: fixed;top: 40%;left:40%"><img src="<?php echo e(url('img/loading.gif')); ?>" width="10%" /></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    var arabicPattern = /[\u0600-\u06ff]|[\u0750-\u077f]|[\ufb50-\ufbc1]|[\ufbd3-\ufd3f]|[\ufd50-\ufd8f]|[\ufd92-\ufdc7]|[\ufe70-\ufefc]|[\uFDF0-\uFDFD]|[٠١٢٣٤٥٦٧٨٩]/;
    uid = "<?php echo e(UID()); ?>"
    occasion_id = "<?php echo e($occasion_id); ?>"
    var start = 0;
    var action = 'inactive';
    $('.load').hide();
    $(window).on("scroll", function () {
      if ($(window).scrollTop() + $(window).height() > $(".fav_cat").height() && action == 'inactive')
        {
          $('.load').show();
          action = 'active';
          start = start + <?php echo e(get_settings('pagination_limit')); ?>;
          setTimeout(function () {
              load_snap_data(start);
          }, 500);

        }
        $('.title').each( function() {
            var x = $(this).text();
            if (arabicPattern.test(x)) {
                $(this).css('direction', 'rtl');
            } else {
                $(this).css('direction', 'ltr');
                $(this).css('font-family', 'serif');
            }
        });
        $('.title').each( function () {
            if ($('.title').text().length > 15) {
            $('.fav_cat .label_title a .title').css({
                "text-overflow": "ellipsis",
                "overflow": "hidden"
                })
            }
        })
    });
    function load_snap_data(start)
    {
      $.get('<?php echo e(url("loadsnap/")); ?>/'+uid+ "?start=" + start+'&occasion_id='+occasion_id +'&type=snap',function (data) {
          if (data.html == '') {
          action = 'active';
          }
          else {
          $('#categoryStatus').append(data.html);
                  action = 'inactive';
          }
          $('.load').hide();

        })
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.new_snap_v2.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/new_snap_v2/snap.blade.php ENDPATH**/ ?>