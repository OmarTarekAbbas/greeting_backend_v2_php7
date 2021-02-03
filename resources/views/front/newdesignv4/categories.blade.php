@extends('front.newdesignv4.header')
@section('content')
<style>
.row {
  margin-right: 0;
}
</style>
@if( OP() == timwe_op_id())
<style>
.categories_page .categories_page_bg{
  background-color: #ffffff;
  border-radius: 7px;
  border: 1px solid  #eb1c23;
}
</style>
@else
<style>
.categories_page .categories_page_bg{
  background-color: #ffffff;
  border-radius: 7px;
}
</style>
@endif

@include('front.newdesignv4.search')

<div class="main ">
  <section class="categories_page">
    <div class="containeer">
      <div class="row m-auto" id="categoryStatus" action="inactive" page='1'>
        @include('front.newdesignv4.spresult')
      </div>
    </div>
  </section>
</div>
@endsection
@section('script')


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

@endsection
