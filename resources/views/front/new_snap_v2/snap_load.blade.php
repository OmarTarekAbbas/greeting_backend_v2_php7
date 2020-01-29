@foreach($Snapdata as $value)
  <div class="col-6 Rdata">
      <div class="label_title">
          <div class="row">
              <div class="col-4 p-0">
                  <a class="more" href="{{url('inner_snap_v2/'.$value->id.'/'.UID())}}">
                      <i class="fas fa-angle-right"></i>
                  </a>
              </div>

              <div class="col-4 p-0">
                <a href="{{url('inner_snap_v2/'.$value->id.'/'.UID())}}">
                    <span class="title">{{$value->title}}</span>
                </a>
              </div>

              <div class="col-4 p-0">
                  <img src="{{url($value->occasion->image)}}" alt="">
              </div>
          </div>
      </div>
      <div class="fav_item">
        @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
          <i id="{{$value->id}}" @if(check_favourtite(Session::get('MSISDN') , $value->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
        @endif
          <a href="{{url('inner_snap_v2/'.$value->id.'/'.$url->UID)}}">
              <img src="{{url('/'.$value->path)}}" alt="">
              <div class="view">
                <i id="eye" class="fas fa-eye"></i> <span>  {{$value->popular_count}}</span>
              </div>
          </a>
      </div>
  </div>
@endforeach
