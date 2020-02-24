@foreach ($filters as $item)
<div class="col-4 p-0">
  <div class="first_list_img">
    <a href="{{url($item->snap_link)}}" target="_blank">
      <img class="w-100" src="{{url($item->path)}}" alt="Filter">
      {{-- <p>{{$item->title}}</p> --}}
      <a class="first_list_img_heart" href="#0">
        <i class="fas fa-heart heart_heart"></i>
      </a>

      <a class="first_list_img_share" href="#0" data-toggle="modal" data-target="#modalForShare">
        <i class="fas fa-share-square"></i>
      </a>
    </a>
  </div>
</div>
@endforeach