
<?php $title = "البحث"; ?>
@extends('front.template')
@section('content')
<!-- ========================================================================= -->
<div class="search_body">
    <div class="container">
        @if($SearchKey)
        <h2 class="title_search">ابحث عن : {{$SearchKey}}</h2>
        @endif
        <ul>
            <a href="{{url('list_snap_v1/1/'.UID().'?'.$terms)}}" @if($Count['Snap']<=0) onclick="return false;"@endif>
               <li><i class="fa fa-picture-o"></i>Snap <span style="display: inline-block;">({{$Count['Snap']}})</span></li>
            </a>
            <a href="{{url('rbts/'.UID().'?'.$terms)}}" @if($Count['Rbts']<=0) onclick="return false;"@endif>
               <li><i class="fa fa-headphones"></i> كول تون<span>({{$Count['Rbts']}})</span></li>
            </a>
            <a href="{{url('notifications/'.UID().'?'.$terms)}}"  @if($Count['Notifications']<=0) onclick="return false;"@endif>
               <li><i class="fa fa-bell"></i>اشعارات <span>({{$Count['Notifications']}})</span></li>
            </a>
           <!-- <a href="{{url('imgs/'.UID().'?'.$terms)}}"  @if($Count['Imgs']<=0) onclick="return false;"@endif>
               <li><i class="fa fa-picture-o"></i>الصور <span>({{$Count['Imgs']}})</span></li>
            </a>
            <a href="{{url('vids/'.UID().'?'.$terms)}}" @if($Count['Video']<=0) onclick="return false;"@endif>
               <li><i class="fa fa-file-video-o"></i> الفيديوهات<span>({{$Count['Video']}})</span></li>
            </a>-->
        </ul>
    </div>
</div>
<!-- ========================================================================= -->
@stop
<!-- ========================================================================= -->
