<!-- ========================================================================= -->
@extends('front.template')
@section('content')
<?php $title = "كول تون"; ?>
<!-- ========================================================================= --> 
<?php
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
        <div class="item @if(Occasion()==$occasion->id) active1 @endif">
            <a href="#occasion_{{$occasion->id}}">
                <img src="{{  url($occasion->image) }}"  alt="category">
                <h2 class="titlee">{{$occasion->title}}</h2>
            </a>
        </div>
        @endforeach        
    </div>
</div>
<!-- sounds Content -->   
<ul class="sounds check list-unstyled">
    @foreach($Rdata as $k => $audio)
    <!-- Audio --> 
    <li class="occasion_{{$audio->occasion_id}} @if(Occasion()!= $audio->occasion_id ) sound_hide @endif">
        <a class="sound_icon" href="sms:{{$rbt_sms}} <?php echo $Att; ?>{{$codes[$k]}}"><i class="fa fa-cart-plus"></i></a>
        <a class="title_sound" href="{{url('Audio/'.$audio->id.'/'.UID())}}">{{$audio->title}} </a>
        <div class="np-play play-status">
            <span class="fa fa-play" data-src="{{url($audio->path)}}"></span>
        </div>
        <a href='{{url('Audio/'.$audio->id.'/'.UID())}}' class="cf arabic">
        </a>
    </li>
    @endforeach  
</ul>
<audio id="audio_test" controls="controls" style="display:none">
    <source id="audioSource" src="">
</audio>
@else
<br/>
<div class="not-found">
    <img src="../img/sad.png" alt="sad">
    <h1 data-h1="لا يوجد محتوى" >لا يوجد محتوى</h1>
</div>
@endif
<!-- ========================================================================= -->
@stop
@section('script')
<script>
      var numItems = $('.active1').length
    if(numItems==0){
         $(".item").first().addClass('active1');
         $(".sounds li").each(function(){
             $(this).removeClass('sound_hide');
         }); 
    }
      $(".item").click(function () {
        $(".item").removeClass('active1');
    });
    $('a[href="{{url("rbts/".UID())}}"]').addClass('active_header');
</script>
@stop
<!-- ========================================================================= -->