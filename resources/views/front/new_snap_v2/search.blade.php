@extends('front.new_snap_v2.layout')
@section('content')

<!-- main content -->
<div class="main">
    <div class="container" style="min-height:900px">

        <!-- search -->
        <div class="search">
            <i class="fas fa-search"></i>
            <form action="{{url('Search_v2/'.UID())}}" method="get">
                {{csrf_field()}}
                <input type="text" name="search" id="myInput" placeholder="بحث" title="">
            </form>
        </div>
        <!-- end search -->


        <!-- fav cat -->
        <div class="fav_cat">
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
                                    <h6 class="title">{{$value->title}}</h6>
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
                                  <i id="eye" class="fas fa-eye"></i> <span> {{$value->popular_count}}</span>
                                </div>

                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- end fav cat -->

    </div>
</div>
<!-- end main content -->
<div class="load" style="position: fixed;top: 40%;left:40%"><img src="{{url('img/loading.gif')}}" width="10%" /></div>
@stop
@section('script')
<script>
    uid = "{{UID()}}"
    search_key = "{{$search}}"
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

    function load_snap_data(start) {
        $.get('{{url("loadsnap/")}}/' + uid + "?start=" + start + '&search=' + search_key + '&type=search', function(data) {
            if (data.html == '') {
                action = 'active';
            } else {
                $('#categoryStatus').append(data.html);
                action = 'inactive';
            }
            $('.load').hide();

        })
    }

</script>

@stop
