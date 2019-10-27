@extends('front.template')
@section('content')
<?php $title = "بطاقة التهنئة"; ?>
<!-- ========================================================================= -->

<ul class="sounds check list-unstyled">
    <?php $count = menu() ?>
    @if($count['Snap'] >= 1)
    <!-- Audio --> 
    <li class="rbt1">
        <a class="sound_icon" href="{{ url('snap/'.UID()) }}" > <i class="far fa-image"></i></a>
        <a class="title_sound" href="{{ url('snap/'.UID()) }}">Snap </a>      
    </li>
    @endif
    @if($count['Rbt'] >= 1)
    <!-- Audio --> 
    <li class="rbt1">
        <a class="sound_icon" href="{{ url('rbts/'.UID()) }}" > <i class="fa fa-headphones"></i></a>
        <a class="title_sound" href="{{ url('rbts/'.UID()) }}">كول تون </a>      
    </li>
    @endif
    @if($count['Not'] >= 1)
    <!-- Audio --> 
    <li class="rbt1">
        <a class="sound_icon" href="{{ url('notifications/'.UID()) }}" > <i class="fa fa-bell"></i></a>
        <a class="title_sound" href="{{ url('notifications/'.UID()) }}">نغمات اشعار</a>      
    </li>
    @endif
    @if($count['Imgs'] >= 1)
    <!-- Audio --> 
    <li class="rbt1">
        <a class="sound_icon" href="{{ url('imgs/'.UID()) }}" > <i class="far fa-image"></i></a>
        <a class="title_sound" href="{{ url('imgs/'.UID()) }}">صور تهنئة </a>      
    </li>
    @endif                
    @if($count['Vid'] >= 1)
    <!-- Audio --> 
    <li class="rbt1">
        <a class="sound_icon" href="{{ url('vids/'.UID()) }}" > <i class="fa fa-film"></i></a>
        <a class="title_sound" href="{{ url('vids/'.UID()) }}">فيديو تهنئة </a>


    </li>
    @endif
</ul>

<!-- ========================================================================= -->
@stop

