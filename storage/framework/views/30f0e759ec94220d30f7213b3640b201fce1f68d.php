<!--==================================== -->

<?php $__env->startSection('content'); ?>
<?php
$title = "";
preg_match("/iPhone|iPad|iPod/", $_SERVER['HTTP_USER_AGENT'], $matches);
$os = current($matches);

switch ($os) {
    case 'iPhone':
        if (preg_match('/OS 8/', $_SERVER['HTTP_USER_AGENT']) || preg_match('/OS 9/', $_SERVER['HTTP_USER_AGENT'])) {
            $Att = '&body=';
        } else {
            $Att = ';';
        }
        break;
    case 'iPad': $Att = '&body=';
        break;
    case 'iPod': $Att = '&body=';
        break;
    default : $Att = '?body=';
        break;
}
?>
<?php if($snap): ?>
<!-- ==================================== -->


<style type="text/css">
    .inner_category .view {
    position: absolute;
    left: 51px;
    bottom: 55px;
    color: #f23c57;
}

.category:nth-child(even) .view {
    position: absolute;
    left: 115px;
    bottom: 45px;
    color: #f23c57;
}
</style>


<div class="main">
    <div class="container">
        <div class="row" id="categoryStatus" action="inactive">
            <!-- =============================== -->
            <div class="col-xs-12 Rdata">
                <div class="inner_category inner daily_failter">
                    <h4>فلتر اليوم</h4>

                    <a href="#" data-type="<?= $snap->rbt_id ? 1 : 0 ?>" data-link="<?php echo e($snap->snap_link); ?>"  data-img_src="<?php echo e(url($snap->path)); ?>"  data-toggle="modal" data-target="#myModal" class="main_inner snap_info">
                        <img src="<?php echo e(url('assets/front/newdesign')); ?>/img/frame.png">

                        <div class="view">
                    <i id="eye" eye-val="<?php echo e($snap->popular_count); ?>" class="fas fa-eye"></i> <span> <?php echo e($snap->popular_count); ?></span>
                  </div>

                        <div class="title_photo_inner">
                            <img src="<?php echo e(url($snap->path)); ?>">
                            <p ><?php echo e($snap->title); ?></p>
                        </div>
                        <?php if($snap->rbt_id): ?>
                        <a class="icon"  href="sms:<?php echo e($rbt_sms); ?><?php echo $Att; ?><?php echo e($code); ?>" style="display:none;"></a>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
            <!-- =============================== -->



            <div class="main_category cat">

                <h4>التصنيفات</h4>

                <?php $snap_Occasions = snap_Occasions();$i=0 ?>
                <?php $__currentLoopData = $snap_Occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="category">
                    <a href="<?php echo e(url('listSnap/'.$value->id .'/'.UID())); ?>" class="main_inner">
                        <img src="<?php echo e(url('assets/front/newdesign')); ?>/img/frame.png">

                        <!-- <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> 20</span>
                  </div> -->

                        <div class="title_photo">
                            <img class="<?php echo e(($i%2 == 0)?'left':'right'); ?>" src="<?php echo e(url($value->image)); ?>">
                            <p class="<?php echo e(($i%2 == 0)?'left_text':'right_text'); ?>"><?php echo e($value->title); ?></p>
                        </div>
                    </a>
                </div>
                <?php $i++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>



        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade main_snap_modal" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <img id="img" src="">
                <h5 class="modal-title" id="exampleModalLabel"></h5>

                <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> 20</span>
                  </div>

            </div>
            <div class="modal-body snap-modal">
                <a class="snap_button" id="link" href="">استخدم العدسة</a>

                <a class="snap_button cart" id="cart"  href="">اشترى النغمة</a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-snap" data-dismiss="modal">الغاء الامر</button>
            </div>
        </div>

    </div>
</div>


<div class="load" style="position: fixed;top: 40%;left:40%"><img src="<?php echo e(url('img/loading.gif')); ?>" width="10%"/></div>


<!-- ==================================== -->
<?php endif; ?>
<?php $__env->stopSection(); ?>
<!-- ==================================== -->
<?php $__env->startSection('script'); ?>
<script>
    $('.load').hide();
    $(document).on("click", ".snap_info", function () {

        //  var img = $(this).parent().find('.title_photo_inner img').attr('src');
        var img = $(this).attr('data-img_src');
        console.log(img);
        var link = $(this).attr('data-link');
        var type = $(this).attr('data-type');
        var eye = $(this).parent().parent().find('.view #eye').attr('eye-val');
        console.log(eye);
        $('#myModal .view #eye').next('span').html(eye);
        if (type == 1) {
            var sms = $(this).parent().find('.icon').attr('href');
            $('#myModal #cart').attr('href', sms);
            $('#myModal .cart').show();
        }
        else {
            $('#myModal .cart').hide();
        }
        $('#myModal #img').attr('src', img);
        $('#myModal #link').attr('href', link);
    });



</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.newdesign.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/newdesign/list_snap_inner.blade.php ENDPATH**/ ?>