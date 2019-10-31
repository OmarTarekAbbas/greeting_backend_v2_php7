<?php if(count($Snapdata)>0): ?>
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

<?php $__currentLoopData = $Snapdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>



<div class="col-xs-12 Rdata">
    <div class="inner_category">
        <a href="#" data-type="<?= $img->rbt_id ? 1 : 0 ?>" data-link="<?php echo e($img->snap_link); ?>" data-img_src="<?php echo e(url($img->path)); ?>"  data-toggle="modal" data-target="#myModal" class="main_inner snap_info">
            <img src="<?php echo e(url('assets/front/newdesign')); ?>/img/frame.png">

            <div class="view">
                    <i id="eye" eye-val="<?php echo e($img->popular_count); ?>" class="fas fa-eye"></i> <span> <?php echo e($img->popular_count); ?></span>
                  </div>

            <div class="title_photo_inner">
                <img src="<?php echo e(url($img->path)); ?>">
                <a   href="<?php echo e(url('viewSnap2/'.$img->id.'/'.$url->UID)); ?>" >
                    <p  style="color:#000 !important;" ><?php echo e($img->title); ?>   </p>
                </a>
            </div>
            <?php if($img->rbt_id): ?>
            <a  class="icon"  href="sms:<?php echo e($rbt_sms); ?><?php echo $Att; ?><?php echo e($codes[$key]); ?>" style="display:none;"></a>
            <?php endif; ?>
        </a>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<!-- =============================== -->
<?php endif; ?>
<?php /**PATH E:\php7.2\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/newdesign/snap_load.blade.php ENDPATH**/ ?>