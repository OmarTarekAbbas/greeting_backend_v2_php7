@foreach ($snap as $item)
<div class="col-4 py-1 px-0">
  <div class="all_content_img">
    <a href="{{url('akhbar/inner'.'/'.$item->id.'/'.UID())}}">
      <img class="d-block w-100 rounded" src="{{url('/'.$item->path)}}" alt="{{$item->title}}">
    </a>
  </div>
</div>
@endforeach