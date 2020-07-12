<!-- Start Header -->
@include('front.akhbar.header')
<!-- End Header -->

<div class="main_home">
  <div class="row m-0">
    <section class="slider_sec w-100">
      <div class="col-12 p-0">
        <div class="owl_one owl-carousel owl-theme" dir="ltr">
          @foreach ($news as $item)
          <div class="item">
            <a href="{{url('akhbar/news'.'/'.$item->id.'/'.UID())}}">
              <img height="180px" class="d-block w-100 rounded" src="{{$item->image}}" alt="{{$item->title}}">
              <div class="img_title">
                <p class="w-100 text-center mb-0">{{$item->title}}</p>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <section class="all_content w-100 mb-3">
      <div class="title">
        <p class="w-100 text-left font-weight-bold">IG Filters</p>
      </div>

      <div class="row m-0" id="filterajax" action="inactive" page='1'>

        @foreach ($snap as $item)
        <div class="col-4 py-1 px-0">
          <div class="all_content_img">
            <a href="{{url('akhbar/inner'.'/'.$item->id.'/'.UID())}}">
              <img class="d-block w-100 rounded" src="{{url('/'.$item->path)}}" alt="{{$item->title}}">
            </a>
          </div>
        </div>
        @endforeach

      </div>
    </section>

  </div>
</div>

<!-- Start Footer -->
@include('front.akhbar.footer')
<!-- End Footer -->

<script>
  $(window).on("scroll", function() {
    var action = $('#filterajax').attr('action');
    var page = $('#filterajax').attr('page');

    if ($(window).scrollTop() + $(window).height() > $("#filterajax").height() && action == 'inactive') {
      $('#filterajax').attr('action', 'active');
      page++;
      $('#filterajax').attr('page', page);
      load_snap_data(page);
    }
  });

  function load_snap_data(page) {
    $('.load').show();
    $.ajax({
      type: 'GET',
      url: '?page=' + page,
      success: function(data) {

        $('#filterajax').append(data);
        $('#filterajax').attr('action', 'inactive');

      }
    })
  }
</script>
