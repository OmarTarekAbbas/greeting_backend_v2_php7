@extends('front.template')
@section('content')
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
@if(count($Rdata)>0)
<div class="chooseitem filter" id="chooseimageitem">
    <div class="owl-carousel owl-theme">
        @if(count($occasions)>1)
        <div class="item">
            <a href="#all">
                <img src="{{ url('assets/front/images/category/1.jpg')}}"  alt="category">
                <h2 class="titlee">الكل</h2>
            </a>
        </div>
        @endif
        @foreach($occasions as $occasion)
        <div class="item @if(Occasion()==$occasion->id) active1 @endif" action='inactive'>
            <a href="#occasion_{{$occasion->id}}">
                <img src="{{  url($occasion->image) }}"  alt="category">
                <h2 class="titlee">{{$occasion->title}}</h2>
            </a>
        </div>
        @endforeach  
    </div>
</div>
<!-- Gallery Content -->

<div class="category_title">
    <h3>كاس اسيا</h3>
</div>

<!-- sounds Content --> 
<ul class="sounds snapchat check list-unstyled">
    @foreach($occasions as $k => $occasion)
        @foreach($Snapdata[$k] as $key => $img) 
        <!-- Audio --> 
        <li data-type="<?= $img->rbt_id ? 1 : 0 ?>" class="snap occasion_{{$img->occasion_id}} @if(Occasion()!= $img->occasion_id ) sound_hide @endif" >
            <!--        @if($img->rbt_id)
                    <img class="star" src="../img/Gold_star.png" alt="star">
                     @endif-->
            <a class="sound_icon snap_info"   data-toggle="modal" data-target="#exampleModal"  href="{{$img->snap_link}}"> <img src="{{asset("$img->path")}}"></a>
            <a class="title_sound snap_info" data-toggle="modal" data-target="#exampleModal" href="#">{{$img->title}} </a>
            @if($img->rbt_id)
            <a class="icon"  href="sms:{{$rbt_sms}}<?php echo $Att; ?>{{$codes[$k][$key]}}"><i class="fas fa-cart-plus"></i></a>
            <div class="np-play play-status">
                <span class="fa fa-play" data-src="{{url($img->Rbt->path)}}"></span>
            </div>
            <a href='#' class="cf arabic"></a>
            @endif
        </li>
        @endforeach      
    @endforeach      

</ul>
<audio id="audio_test" controls="controls" style="display:none">
    <source id="audioSource" src="">
</audio>
@else
<div class="not-found">
    <img src="../img/sad.png" alt="sad">
    <h1 data-h1="لا يوجد محتوى" >لا يوجد محتوى</h1>
</div>
@endif
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
<div class="load" style="position: fixed;top: 40%;right:50%"><img src="{{url('img/loading.gif')}}" width="10%"/></div>


@stop
@section('script')
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
            $('a[href="{{url("snap/".UID())}}"]').addClass('active_header');

         $(document).on("click",".snap_info",function() {  
    var title = $(this).parent().find('.title_sound').text();
            var img = $(this).parent().find('.sound_icon img').attr('src');
            var link = $(this).parent().find('.sound_icon').attr('href');
            var type = $(this).parent().attr('data-type');
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
            var occasion_id = occasion[1];
            var start = $('.occasion_' + occasion_id).length
            load_snap_data(start, occasion_id);
          
    }

    });
    function load_snap_data(start, occasion_id)
    {
         $('.load').show();
         var loadtype = "{{$type}}";
         var SearchKey = "{{$SearchKey}}";
        $.ajax({
            type: 'GET',
            url : "{{url('loadMoreSnap')}}" + "?start=" + start + "&occasion_id=" + occasion_id + "&UID=" + {{UID()}}+ "&type="+ loadtype + "&SearchKey="+ SearchKey,
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
@stop
