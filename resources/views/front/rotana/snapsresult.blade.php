@foreach ($child_occasions as $snap)
<a class="m-auto d-block" href="{{url('rotana/suboccasion/'.$snap->id.'/'.UID())}}">
  <div class="col-12 mb-3 swirl-out-bck_2">
    <div class="sub_img sub_img_small">
      <img class="w-75 m-auto d-block sub_img_smImg" src="{{url('assets/front/rotana')}}/images/new_cutting/strip1.png"
        alt="strip">
      <img class="frame_icon frame_icon_sm rounded-circle" src="{{url('/'.$snap->image)}}" alt="{{$snap->getTranslation('title',getCode())}}">
    </div>

    <div class="sub_img_title sub_img_title_small">
      <h1 class="h4 text-center">{{$snap->getTranslation('title',getCode())}}</h1>
    </div>
  </div>
</a>
@endforeach

<div class="clearfix"></div>

@foreach ($Rdata as $snap)
<div class="col-6">
  <div class="categories_page_bg shadow">
    <a href="{{url('rotana/filter/'.$snap->id.'/'.UID())}}">
      <div class="categories_page_img">
        <img class="w-75 rounded m-auto d-block" height="83px" src="{{url('/'.$snap->path)}}"
          alt="{{$snap->getTranslation('title',getCode())}}">
      </div>
    </a>

    <div class="categories_page_title">
      <h3 class="text-center">{{$snap->getTranslation('title',getCode())}}</h3>
    </div>
  </div>
</div>
@endforeach