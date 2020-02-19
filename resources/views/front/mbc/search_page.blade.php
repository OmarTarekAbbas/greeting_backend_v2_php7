<!-- header -->
@extends('front.mbc.header')
@section('content')
<!-- end header-->
<style>
.row {
  margin-right: 0;
}
.categories_page .categories_page_bg{
  background-color: #ffffff;
  border-radius: 7px
}
</style>

<div class="main ">
  <div class="containeer">
    <div class="row">
      <div class="col-12">
        <div class="search_for bounce-left">
          <h4>{!! static_lang('tasnefat')?static_lang('tasnefat') : 'التصنيفات' !!}</h4>
        </div>
      </div>
    </div>
  </div>

 <!-- Start Search -->
<div class="search text-center">
    <i class="fas fa-search"></i>
    <form action="{{url('Search_v5/'.UID())}}" method="get">
         <input class="hide input-right" type="text" name="search" id="myInput" value="{{\Session::get('search')}}"
              placeholder="{!! static_lang('search') ?static_lang('search') : 'بحث' !!}" title="">
         <span class="bord"></span>
    </form>
</div>
<!-- End Search -->


  <section class="categories_page">
    <div class="containeer">
      <div class="row m-auto" id="categoryStatus" action="inactive" page='1'>
        @include('front.mbc.presult')
      </div>
    </div>
  </section>
</div>

@endsection
@section('script')
{{--
<script>

$(document).ready(function () {
    $('div#page').on('scroll', function () {
      console.log('safsdghfgjfg');
    });
});

</script> --}}

<script>
$(window).on("scroll", function() {
  var action = $('#categoryStatus').attr('action');
  var page = $('#categoryStatus').attr('page');

  if ($(window).scrollTop() + $(window).height() > $("#categoryStatus").height() && action == 'inactive') {
    console.log('firrrrrrrrrrrrrrreeeeeeeeeeeeee');
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

      // document.getElementById("categoryStatus").insertAdjacentHTML(front.newdesignv4.presult);

    }
  })
}
</script>

{{--
<script type="text/javascript">
  $(window).on('hashchange', function() {
      if (window.location.hash) {
          var page = window.location.hash.replace('#', '');
          if (page == Number.NaN || page <= 0) {
              return false;
          }else{
              getData(page);
          }
      }
  });

  $(document).ready(function()
  {
      $(document).on('click', '.pagination a',function(event)
      {
          event.preventDefault();

          $('li').removeClass('active');
          $(this).parent('li').addClass('active');

          var myurl = $(this).attr('href');
          var page=$(this).attr('href').split('page=')[1];

          getData(page);
      });

  });

  function getData(page){
      $.ajax(
      {
          url: '?page=' + page,
          type: "get",
          datatype: "html"
      }).done(function(Occasions){
          $("#tag_container").empty().html(Occasions);
          location.hash = page;
      }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
      });
  }
</script> --}}
{{---------------------------------------------------- -------------------------------}}

@endsection
