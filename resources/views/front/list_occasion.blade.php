@extends('front.template')
@section('content')
<?php
$title = "";
$snap_Occasions = snap_Occasions() ;
?>

<!-- sounds Content -->
<ul class="sounds snapchat check list-unstyled">
  @foreach($snap_Occasions as $k => $occasion)
        <li>
            <a class="sound_icon snap_info"     href="{{url('/list_snap_v1/'.$occasion->id.'/'.UID())}}"> <img src="{{asset("$occasion->image")}}"></a>
            <a class="title_sound snap_info" href="{{url('/list_snap_v1/'.$occasion->id.'/'.UID())}}">{{$occasion->title}} </a>

            <!-- <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> 20</span>
                  </div> -->

        </li>
    @endforeach
</ul>



@stop
@section('script')

@stop
