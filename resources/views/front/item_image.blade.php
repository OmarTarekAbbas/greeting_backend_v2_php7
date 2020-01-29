<!-- ========================================================================= -->
@extends('front.template')
@section('content')
    <?php    $title = "الصور"; ?>
<!-- ========================================================================= -->
<div class="item-content">
   <div class="item-img">
      <img class="image-item" src="{{asset("$Response[0]")}}" alt="" draggable="false">
   </div>
   <a class="item-link" href="{{url('img/'.$Response[1])}}" download>تحميل 
   <i class="fa fa-download"></i>
   </a>
</div>
<!-- ========================================================================= -->
@stop
@section('script')
<script>  
   $('a[href="{{url("imgs/".UID())}}"]').addClass('active_header'); 
</script>
@stop
<!-- ========================================================================= -->