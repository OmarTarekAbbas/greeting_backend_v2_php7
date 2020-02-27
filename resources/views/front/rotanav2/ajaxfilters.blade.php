@foreach ($filters as $item)
<div class="col-4 p-0">
  <div class="first_list_img">
    <a href="{{url($item->snap_link)}}" target="_blank">
      <img class="w-100" src="{{url($item->path)}}" alt="Filter">
      {{-- <p>{{$item->title}}</p> --}}
      <a class="first_list_img_heart" onclick="fav('{{$item->id}}')" href="javascript:void(0)">
        <i id="{{$item->id}}" class="fas fa-heart heart_heart"></i>
      </a>

      <a class="first_list_img_share" href="#0" onclick="sharebtn('{{$item->id}}')" data-toggle="modal" data-target="#modalForShare">
        <i class="fas fa-share-square"></i>
      </a>
    </a>
  </div>
</div>
<script>
  filterid = '{{$item->id}}' ;
  var allfav = window.localStorage.getItem('favorite');
  var favArr = allfav.split(',');
  var find = favArr.indexOf(filterid);
  if(find == -1){ // not fav

  }else{ // fav 
      document.getElementById(filterid).classList.add("active_heart");
  }
</script>
@endforeach