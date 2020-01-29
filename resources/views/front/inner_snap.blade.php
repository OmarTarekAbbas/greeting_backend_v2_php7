@extends('front.template')
@section('content')

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
<br/>
<div class="item-content">
    <div class="item-img">
        <img class="snap-item" src="{{asset("$snap->path")}}" alt="" draggable="false">
    </div>
    <a class="item-link"   target="_blank" href="{{$snap->snap_link}}"   >مشاهده</a>
    @if($snap->rbt_id)
      <div class="np-play play-status play-snap">
         <span class="fa fa-play" data-src="{{url($snap->Rbt->path)}}"></span>
      </div>
    <a class="item-link"  href="sms:{{$rbt_sms}} <?php echo $Att; ?>{{$code}}"><i class="fa fa-cart-plus"></i></a>
    @endif
</div>
<!--<div class="snap_recommend">
    <div class="owl-carousel owl-theme">
        @foreach($recommend as $k => $value)
        <div class="item">
            <a href="{{url('viewSnap/'.$value->id.'/'.UID())}}">
                <img src="{{asset("$value->path")}}"  alt="snap">
                <h2 class="titlee">{{$value->title}}</h2>
            </a>
        </div>
        @endforeach 

    </div>
</div>-->
<audio id="audio_test" controls="controls" style="display:none">
   <source id="audioSource" src="">
</audio>
@stop
@section('script')
<script>
    $('a[href="{{url("snap/".UID())}}"]').addClass('active_header');
</script>
@stop
