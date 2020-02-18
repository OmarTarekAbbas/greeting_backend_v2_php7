@foreach ($favourites as $cat)
<div class="col-6 Rdata">
  <div class="categories_page_bg shadow">
    <a href="{{$cat->snap_link}}">
      <div class="categories_page_img ">
        <img class="w-75 rounded m-auto d-block" height="83px" src="{{url('/'.$cat->path)}}"
          alt="{{$cat->getTranslation('title',getCode())}}">
      </div>
    </a>

    <div class="categories_page_title">
      <h3 class="text-center">{{$cat->getTranslation('title',getCode())}}</h3>
    </div>
  </div>
</div>
@endforeach

@foreach ($suggests as $cat)
<div class="col-6 Rdata">
  <div class="categories_page_bg shadow">
    <a href="{{url('mbc/filter/'.$cat->id.'/'.UID())}}">
      <div class="categories_page_img">
        <img class="w-75 rounded m-auto d-block" height="83px" src="{{url('/'.$cat->path)}}"
          alt="{{$cat->getTranslation('title',getCode())}}">
      </div>
      <div class="categories_page_title">
        <h3 class="h5 text-center">{{$cat->getTranslation('title',getCode())}}</h3>
      </div>
    </a>
  </div>
</div>
@endforeach
