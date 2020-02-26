@foreach ($snap as $item)    
<div class="col-4 p-0">
  <div class="fav_list_img">
    <a href="{{url($item->snap_link)}}" target="_blank">
      <img class="w-100" src="{{url($item->path)}}" alt="Filter">
      
      <a id="{{$item->id}}" class="first_list_img_heart heart_heart active_heart" onclick="fav('{{$item->id}}');$(this).toggleClass('active_heart');" href="javascript:void(0)">
        <i class="fas fa-heart"></i>
      </a>
      
      <a class="first_list_img_share" href="#0" onclick="sharebtn('{{$item->id}}')" data-toggle="modal" data-target="#modalForShare">
        <i class="fas fa-share-square"></i>
      </a>
    </a>
  </div>
</div>
@endforeach