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
$snap_Occasions = snap_Occasions()
?>
<?php if(count($Rdata)>0): ?>
<div class="chooseitem filter" id="chooseimageitem">
    <div class="owl-carousel owl-theme">
      <?php if(isset($_REQUEST['SearchKey'])): ?>
         <div class="item">
             <a href="#all">
                 <img src="<?php echo e(url('assets/front/images/category/1.jpg')); ?>"  alt="category">
                 <h2 class="titlee">الكل</h2>
             </a>
         </div>
         <?php $__currentLoopData = $occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="item <?php if(Occasion()==$occasion->id): ?> active1 <?php endif; ?>" action='inactive'>
             <a href="#occasion_<?php echo e($occasion->id); ?>">
                 <img src="<?php echo e(url($occasion->image)); ?>"  alt="category">
                 <h2 class="titlee"><?php echo e($occasion->title); ?></h2>
             </a>
         </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <?php else: ?>
        <?php $__currentLoopData = $snap_Occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item <?php if(isset($ID) && $ID==$occasion->id): ?> active1 <?php endif; ?>" action='inactive'>
          <?php if(isset($_REQUEST['SearchKey'])): ?>
            <a href="<?php echo e(url('/list_snap_v1/'.$occasion->id.'/'.UID())); ?>" onclick="window.location.replace('<?php echo e(url('/list_snap_v1/'.$occasion->id.'/'.UID().'?SearchKey='.$_REQUEST['SearchKey'])); ?>')">
          <?php else: ?>
            <a href="<?php echo e(url('/list_snap_v1/'.$occasion->id.'/'.UID())); ?>" onclick="window.location.replace('<?php echo e(url('/list_snap_v1/'.$occasion->id.'/'.UID())); ?>')">
          <?php endif; ?>
                <img src="<?php echo e(url($occasion->image)); ?>"  alt="category">
                <h2 class="titlee"><?php echo e($occasion->title); ?></h2>
            </a>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <?php endif; ?>
    </div>
</div>
<!-- Gallery Content -->
<!-- sounds Content -->
<ul class="sounds snapchat check list-unstyled">
  <?php $__currentLoopData = $occasions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $occasion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $Snapdata[$k]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <!-- Audio -->
        <li data-type="<?= $img->rbt_id ? 1 : 0 ?>" class="snap occasion_<?php echo e($img->occasion_id); ?> <?php if(isset($ID) && $ID!= $img->occasion_id ): ?> sound_hide <?php endif; ?>" >
            <!--        <?php if($img->rbt_id): ?>
                    <img class="star" src="../img/Gold_star.png" alt="star">
                     <?php endif; ?>-->
            <a class="sound_icon snap_info"   data-toggle="modal" data-target="#exampleModal"  href="<?php echo e($img->snap_link); ?>"> <img src="<?php echo e(asset("$img->path")); ?>"></a>
            <a class="title_sound snap_info" data-toggle="modal" data-target="#exampleModal" href="#"><?php echo e($img->title); ?> </a>
            <?php if($img->rbt_id): ?>
            <a class="icon"  href="sms:<?php echo e($rbt_sms); ?><?php echo $Att; ?><?php echo e($codes[$k][$key]); ?>"><i class="fas fa-cart-plus"></i></a>
            <div class="np-play play-status">
                <span class="fa fa-play" data-src="<?php echo e(url($img->Rbt->path)); ?>"></span>
            </div>
            <a href='#' class="cf arabic"></a>
            <?php endif; ?>

            <div class="view">
                    <i id="eye" eye-val="<?php echo e($img->popular_count); ?>" class="fas fa-eye"></i> <span> <?php echo e($img->popular_count); ?></span>
            </div>

        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<audio id="audio_test" controls="controls" style="display:none">
    <source id="audioSource" src="">
</audio>
<?php else: ?>
<div class="not-found">
    <img src="../img/sad.png" alt="sad">
    <h1 data-h1="لا يوجد محتوى" >لا يوجد محتوى</h1>
</div>
<?php endif; ?>
<div class="clearfix"></div>
<style>
    .add{
        display: none;
    }

    .sounds li .title_sound {
        color: #fff;
        padding: 11px 50px;
    }
</style>
<!-- ========================================================================= -->




<div class="modal main_snap_modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img id="img" src="">
                <h5 class="modal-title" id="exampleModalLabel"></h5>

                <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> 20</span>
                  </div>

                </button>
            </div>
            <div class="modal-body snap-modal">
                <a class="snap_button" id="link" href="">استخدم العدسة</a>

                <a class="snap_button cart" id="sms" href="">اشترى النغمة</a>
            </div>
            <div class="modal-footer">
                <a data-dismiss="modal">الغاء الامر</a>
            </div>
        </div>
    </div>
</div>
<div class="load" style="position: fixed;top: 40%;right:50%"><img src="<?php echo e(url('img/loading.gif')); ?>" width="10%"/></div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $('.load').hide();
            var numItems = $('.active1').length
            if (numItems == 0) {
    $(".item").first().addClass('active1');
            $(".sounds li").each(function () {
    $(this).removeClass('sound_hide');
    });
    }
    $(".item").click(function () {
    $(".item").removeClass('active1');
    });
            $('a[href="<?php echo e(url("snap/".UID())); ?>"]').addClass('active_header');

         $(document).on("click",".snap_info",function() {
    var title = $(this).parent().find('.title_sound').text();
            var img = $(this).parent().find('.sound_icon img').attr('src');
            var link = $(this).parent().find('.sound_icon').attr('href');
            var type = $(this).parent().attr('data-type');
            var eye = $(this).parent().find('i').attr('eye-val');
            console.log(eye);
            $('#exampleModal .view #eye').next('span').html(eye);
            if (type == 1) {
    var sms = $(this).parent().find('.icon').attr('href');
            $('#exampleModal #sms').attr('href', sms);
            $('#exampleModal .cart').show();
    }
    else {
    $('#exampleModal .cart').hide();
    }
    $('#exampleModal #img').attr('src', img);
            $('#exampleModal .modal-title').text(title);
            $('#exampleModal #link').attr('href', link);

    });




    var w =window.location.href;
    if( w.includes("#occasion") ){
    var x = w.substr(w.indexOf("#") + 1)
            $(".item").each(function () {
    $(this).removeClass('active1');
    });
            $(".sounds li").each(function () {
    $(this).addClass('sound_hide');
    });
       $("a[href='#"+x+"']").parent().addClass("active1");
       $("."+x).removeClass("sound_hide");
    }
    // load more
    $(window).on("scroll", function () {
         var action = $('#chooseimageitem .active1').attr('action');
      if(typeof action == "undefined")
        var action = $('#chooseimageitem .active1 .item').attr('action');

            if ($(window).scrollTop() + $(window).height() > $(".snapchat").height() && action == 'inactive') {
             $('#chooseimageitem .active1').attr('action','active');
            var occasion = $('#chooseimageitem .active1').find('a').attr("href");
            occasion = occasion.split("_");
            <?php if(isset($_REQUEST['SearchKey'])): ?>
            var occasion_id = occasion[1];
            <?php else: ?>
            var occasion_id = "<?php echo e($ID); ?>";
            <?php endif; ?>
            var start = $('.occasion_' + occasion_id).length
            load_snap_data(start, occasion_id);

    }

    });
    function load_snap_data(start, occasion_id)
    {
         $('.load').show();
         var loadtype = "<?php echo e($type); ?>";
         var SearchKey = "<?php echo e($SearchKey); ?>";
        $.ajax({
            type: 'GET',
            url : "<?php echo e(url('loadMoreSnap')); ?>" + "?start=" + start + "&occasion_id=" + occasion_id + "&UID=" + <?php echo e(UID()); ?>+ "&type="+ loadtype + "&SearchKey="+ SearchKey,
            success: function (data) {
            if (data.html == '') {
            $('#chooseimageitem .active1').attr('action', 'active');
            $('#chooseimageitem .active1 .item').attr('action', 'active');
            }
            else {
            $('.snapchat').append(data.html);
                    $('#chooseimageitem .active1').attr('action', 'inactive');
                    $('#chooseimageitem .active1 .item').attr('action', 'inactive');
            }
            $('.load').hide();
            }, error: function (data) {

            },
        })
    }


</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\greeting_backend_v2_php7\resources\views/front/list_snap_v1.blade.php ENDPATH**/ ?>