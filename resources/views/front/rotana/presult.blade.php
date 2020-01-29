@foreach ($Occasions as $cat)
<div class="col-6 Rdata">
  <div class="categories_page_bg shadow">
    <a href="{{url('rotana/suboccasion/'.$cat->id.'/'.UID())}}">
      <div class="categories_page_img">
        <img class="w-75 rounded d-block m-auto" height="83px" src="{{url('/'.$cat->image)}}"
          alt="{{$cat->getTranslation('title',getCode())}}">
      </div>
      <!-- <div class="categories_page_title">
        <h3 class="h5 text-center">{{$cat->getTranslation('title',getCode())}}</h3>
      </div> -->
    </a>
  </div>
</div>
@endforeach