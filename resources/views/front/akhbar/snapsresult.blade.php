@foreach ($Rdata as $key=>$snap)

<div class="col-4 p-0">
  <div class="first_list_img mb-4">
    <a href="{{$snap->snap_link}}" target="_blank">
      <img class="w-100 m-auto d-block rotate-scale-down wow" data-wow-delay="1.6s" data-wow-duration="0.9s" data-wow-offset="100" src="{{url('/'.$snap->path)}}" alt="{{$snap->getTranslation('title',getCode())}}">

      <a class="first_list_img_heart" onclick="fav('{{$snap->id}}')" href="javascript:void(0)">
        <i id="{{$snap->id}}" class="fas fa-heart heart_heart rotate-scale-down wow" data-wow-delay="1.6s" data-wow-duration="0.9s" data-wow-offset="100"></i>
      </a>

      <a class="first_list_img_share" href="#0" onclick="sharebtn('{{$snap->id}}')" data-toggle="modal" data-target="#modalForShare">
        <i class="fas fa-share-square rotate-scale-down wow" data-wow-delay="1.6s" data-wow-duration="0.9s" data-wow-offset="100"></i>
      </a>
    </a>
  </div>
</div>
<script>
  filterid = '{{$snap->id}}';
  var allfav = window.localStorage.getItem('favorite');
  var favArr = allfav.split(',');
  var find = favArr.indexOf(filterid);
  if (find == -1) { // not fav

  } else { // fav
    document.getElementById(filterid).classList.add("active_heart");
  }
</script>
@endforeach
