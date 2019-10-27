<!-- ========================================================================= -->
@extends('front.template')
@section('content')
    <?php  $title = "الفيديو";  ?>
<!-- ========================================================================= -->
<div class="item-content">
   <div class="item-img">
      <video id="my_video" onclick="playPause('my_video')">
         <source src='{{asset("$Response[0]")}}' type="video/mp4">
      </video>
      <i class="video-icon fa fa-play fa-lg" id="video_icon" onclick="playPause('my_video')"></i>
   </div>
   <a class="item-link" href="{{url('vid/'.$Response[1])}}" download>تحميل 
   <i class="fa fa-download"></i>
   </a>
</div>
<!-- ========================================================================= -->
@stop
@section('script')
<script>  
   $('a[href="{{url("vids/".UID())}}"]').addClass('active_header'); 
</script>
@stop
<!-- ========================================================================= -->