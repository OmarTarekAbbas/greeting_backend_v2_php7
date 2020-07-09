@foreach ($Occasions as $item)
@if ($item->greetingimgs()->get()->count() > 0)
<div class="col-4 p-0">
  <div class="first_list_img">
    <a href="{{url('/akhbar/'.$item->id.'/filter/'.uid())}}">
      <img class="w-100" src="{{url($item->image)}}" alt="{{$item->title}}">
    </a>
  </div>
</div>
@endif
@endforeach