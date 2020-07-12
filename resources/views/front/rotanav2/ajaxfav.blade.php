@php
    if(session()->has('only_favorites')){
      $class = '';
    }else{
      $class = 'active_heart';
    }
@endphp
@foreach ($snap as $item)
<div class="col-4 p-0">
  <div class="fav_list_img mb-2">
    <a href="{{url($item->snap_link)}}" target="_blank">
      <img class="w-100 m-auto d-block rotate-scale-down wow" data-wow-delay="1.6s" data-wow-duration="0.9s" data-wow-offset="100" src="{{url($item->path)}}" alt="{{$item->title}}">

      <a id="{{$item->id}}" class="first_list_img_heart heart_heart {{$class}}" onclick="fav('{{$item->id}}');$(this).toggleClass('active_heart');" href="javascript:void(0)">
        <i class="fas fa-heart heart_heart rotate-scale-down wow" data-wow-delay="1.6s" data-wow-duration="0.9s" data-wow-offset="100"></i>
      </a>

      <a class="first_list_img_share" href="#0" onclick="sharebtn('{{$item->id}}')" data-toggle="modal" data-target="#modalForShare">
        <i class="fas fa-share-square rotate-scale-down wow" data-wow-delay="1.6s" data-wow-duration="0.9s" data-wow-offset="100"></i>
      </a>
    </a>
  </div>
</div>
@endforeach
