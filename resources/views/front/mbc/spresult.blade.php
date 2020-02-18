@foreach ($Rdata as $item)
<div class="col-6">
  <div class="categories_page_bg shadow">
    <a href="{{url('mbc/filter/'.$item->id.'/'.UID())}}">
      <div class="categories_page_img">
        <img class="w-75 rounded m-auto d-block" src="{{url('/'.$item->path)}}" alt="{{$item->getTranslation('title',getCode())}}">
      </div>

      <div class="categories_page_title">
        <h3 class="text-center">{{$item->getTranslation('title',getCode())}}</h3>
      </div>
    </a>
  </div>
</div>
@endforeach
