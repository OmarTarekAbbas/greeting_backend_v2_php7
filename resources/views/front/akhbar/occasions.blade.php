<!-- Start Header -->
@include('front.akhbar.header')
<!-- End Header -->

<div class="main_list">
  <section class="first_list w-100 mt-3">
    <div class="row m-0" id="categoryStatus" action="inactive" page='1'>
      @foreach ($Occasions as $item)
      @if ($item->greetingimgs()->get()->count() > 0)
      <div class="col-4 p-0">
        <div class="first_list_img mb-2">
          <a href="{{url('/akhbar/'.$item->id.'/filter/'.uid())}}">
            <img class="w-100 d-block m-auto rotate-scale-down wow" data-wow-delay="1s" data-wow-duration="0.9s" data-wow-offset="100" src="{{url($item->image)}}" alt="{{$item->title}}">
          </a>
        </div>
      </div>
      @endif
      @endforeach
    </div>
  </section>
</div>

<!-- Start Footer -->
@include('front.akhbar.footer')
<!-- End Footer -->

<script>
  $(window).on("scroll", function() {
    var action = $('#categoryStatus').attr('action');
    var page = $('#categoryStatus').attr('page');

    if ($(window).scrollTop() + $(window).height() > $("#categoryStatus").height() && action == 'inactive') {
      $('#categoryStatus').attr('action', 'active');
      page++;
      $('#categoryStatus').attr('page', page);
      load_snap_data(page);
    }
  });

  function load_snap_data(page) {
    $('.load').show();
    $.ajax({
      type: 'GET',
      url: '?page=' + page,
      success: function(data) {

        $('#categoryStatus').append(data);
        $('#categoryStatus').attr('action', 'inactive');

      }
    })
  }
</script>
