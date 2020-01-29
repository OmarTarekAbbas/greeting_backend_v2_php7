<!-- ========================================================================= -->
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
}?>
   <style type="text/css">
     footer {
         position: fixed;
         width: 100%;
         bottom: 0;
      }
   </style>
<!-- ========================================================================= -->
<br/>
<div class="audio-player">
   <audio id="player" src="{{url($audio->path)}}">
   </audio>
   <div class="time-holder">
      <div class="current-time">00:00</div>
      <div>/</div>
      <div class="duration">00:00</div>
   </div>
   <div class="audio-controls ">
      <div class="play-btn ">
         <span class="fa fa-play"></span>
      </div>
   </div>
   <div class="seek-bar">
      <div class="seek-bar-track"></div>
      <div class="seek-bar-thumb"></div>
   </div>
</div>
<div class="controls">
   <a href="{{url('downloadAudio/'.$audio->id)}}" download>تحميل</a>
   @if($type=="RBT")
        <a href="{{url('rbts/'.UID())}}">
   @else
        <a href="{{url('notifications/'.UID())}}">
   @endif
   المزيد</a>
</div>
@if($type=="RBT")
    <a class="colton" href="sms:{{$rbt_sms}} <?php echo $Att; ?>{{$code}}">اجعلها نغمة انتظار</a>
@endif
<!-- ========================================================================= -->
@stop
@section('script')
<script>
    @if($type=="RBT")
   $('a[href="{{url("rbts/".UID())}}"]').addClass('active_header');
   @else
     $('a[href="{{url("notifications/".UID())}}"]').addClass('active_header');
   @endif
</script>
@stop
<!-- ========================================================================= -->