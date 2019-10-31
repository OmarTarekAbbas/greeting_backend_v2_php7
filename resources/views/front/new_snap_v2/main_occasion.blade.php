@extends('front.new_snap_v2.layout')
@section('content')
<!-- main content -->

<style type="text/css">
  body{
    /*height: 100%;*/
  }

.filtars .f_filtar .a_title{
  color: #fff;
  text-decoration: none;
}

.filtars .f_filtar .a_title .category_title .h_title{
  text-align: center;
  padding-top: 10%;
}

.category_title img{
    width: 60px;
    height: 60px;
    margin: 5px 5px 5px 40px;
}

</style>

<div class="main">
    <div class="container">
        <!-- search -->
        <div class="search">
            <i class="fas fa-search"></i>
            <form action="#" method="get">
                <input type="text" name="search" id="myInput" placeholder="بحث" title="">
            </form>
        </div>
        <!-- end search -->
    </div>

    <!-- Suggestion -->
    <div class="filtars">
        <div class="f_title">
            <h4>فلاتر مقترحة لك</h4>
        </div>
        <div class="f_filtar">
          @if(count($suggests) > 2)
            <div class="owl_three owl-carousel owl-theme">
                @foreach($suggests->take(10)->shuffle() as $suggest)
                <div class="item">
                    @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                    <i id="{{$suggest->id}}" @if(check_favourtite(Session::get('MSISDN') , $suggest->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                    @endif

                    <div class="view">
                      <i id="eye" class="fas fa-eye"></i> <span> {{$suggest->popular_count}}</span>
                    </div>

                    <a href="{{url('inner_snap_v2/'.$suggest->id.'/'.UID())}}">
                        <img src="{{url('/'.$suggest->path)}}" alt="">
                    </a>
                </div>
                @endforeach
            </div>
          @elseif(count($suggests) == 2)
          <div class="owl_two owl-carousel owl-theme">
              @foreach($suggests->take(10)->shuffle() as $suggest)
              <div class="item">
                  @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                  <i id="{{$suggest->id}}" @if(check_favourtite(Session::get('MSISDN') , $suggest->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                  @endif

                  <div class="view">
                      <i id="eye" class="fas fa-eye"></i> <span> {{$suggest->popular_count}}</span>
                    </div>

                  <a href="{{url('inner_snap_v2/'.$suggest->id.'/'.UID())}}">
                      <img src="{{url('/'.$suggest->path)}}" alt="">
                  </a>
              </div>
              @endforeach
          </div>
          @else
          <div class="owl_one owl-carousel owl-theme">
              @foreach($suggests->take(10)->shuffle() as $suggest)
              <div class="item">
                  @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                  <i id="{{$suggest->id}}" @if(check_favourtite(Session::get('MSISDN') , $suggest->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
                  @endif

                  <div class="view">
                      <i id="eye" class="fas fa-eye"></i> <span> {{$suggest->popular_count}}</span>
                    </div>

                  <a href="{{url('inner_snap_v2/'.$suggest->id.'/'.UID())}}">
                      <img src="{{url('/'.$suggest->path)}}" alt="">
                  </a>
              </div>
              @endforeach
          </div>
          @endif
        </div>
    </div>
    <!-- end Suggestion -->

    @foreach($occasions as $occasion)
    <!-- liked -->
    <div class="filtars">
        <div class="f_filtar">
          <a class="a_title" href="{{url('occasion/'.$occasion->id.'/'.UID())}}">
            <div class="category_title">
                <div class="row">
                    <div class="col-6 p-0">
                        <h4 class="h_title">{{$occasion->title}}</h4>
                    </div>
                    <div class="col-6 p-0">
                        <img src="{{url($occasion->image)}}" alt="icon">
                    </div>
                </div>
              </div>
            </a>
        </div>
    </div>
    <!-- end liked -->
    @endforeach

    @if(isset($Rdata) && count($Rdata)>0)
      <div class="container">
          <div class="fav_cat">
            <h2 style="text-align: center;color: #fff;border-bottom: 1px solid #000;border-top: 1px solid #000;padding-bottom: 7px;">{{$Rdata[0]->occasion->title}}</h2>
            <div class="row" id="categoryStatus" action="inactive">
              @foreach($Rdata as $value)
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
                        <a href="{{url('inner_snap_v2/'.$value->id.'/'.UID())}}">
                            <img src="{{url('/'.$value->path)}}" alt="">


                        <div class="view">
                          <i id="eye" class="fas fa-eye"></i> <span>  {{$value->popular_count}}</span>
                        </div>


                        </a>
                    </div>
                </div>
              @endforeach
            </div>
          </div>
      </div>
    @endif

</div>
<!-- end main content -->
@if(isset($Rdata) && count($Rdata)>0)
<div class="load" style="position: fixed;top: 40%;left:40%"><img src="{{url('img/loading.gif')}}" width="10%" /></div>
@endif

@stop

@if(isset($Rdata) && count($Rdata)>0)
@section('script')
<script>
    var arabicPattern = /[\u0600-\u06ff]|[\u0750-\u077f]|[\ufb50-\ufbc1]|[\ufbd3-\ufd3f]|[\ufd50-\ufd8f]|[\ufd92-\ufdc7]|[\ufe70-\ufefc]|[\uFDF0-\uFDFD]|[٠١٢٣٤٥٦٧٨٩]/;
    uid = "{{UID()}}"
    occasion_id = "{{$Rdata[0]->occasion->id}}"
    var start = 0;
    var action = 'inactive';
    $('.load').hide();
    $(window).on("scroll", function () {
      if ($(window).scrollTop() + $(window).height() > $(".fav_cat").height() && action == 'inactive')
        {
          $('.load').show();
          action = 'active';
          start = start + {{get_settings('pagination_limit')}};
          setTimeout(function () {
              load_snap_data(start);
          }, 500);

        }
        $('.title').each( function() {
            var x = $(this).text();
            if (arabicPattern.test(x)) {
                $(this).css('direction', 'rtl');
            } else {
                $(this).css('direction', 'ltr');
                $(this).css('font-family', 'serif');
            }
        });
        $('.title').each( function () {
            if ($('.title').text().length > 15) {
            $('.fav_cat .label_title a .title').css({
                "text-overflow": "ellipsis",
                "overflow": "hidden"
                })
            }
        })
    });
    function load_snap_data(start)
    {
      $.get('{{url("loadsnap/")}}/'+uid+ "?start=" + start+'&occasion_id='+occasion_id +'&type=snap',function (data) {
          if (data.html == '') {
          action = 'active';
          }
          else {
          $('#categoryStatus').append(data.html);
                  action = 'inactive';
          }
          $('.load').hide();

        })
    }
</script>
@stop
@endif
