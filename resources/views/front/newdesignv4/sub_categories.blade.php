<!-- header -->
@extends('front.newdesignv4.header')
@section('content')
<!-- end header-->
<style>
/* .main {padding-bottom: 20%;} */
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
        <div class="col-12 mb-3 swirl-out-bck">
          <div class="sub_img">
          @if( OP() == timwe_op_id())
          <img class="w-75 m-auto d-block" src="{{url('assets/front/newdesignv4')}}/images/orooedoo/VectorSmart Object114.png" alt="strip">
          @else
          <img class="w-75 m-auto d-block" src="{{url('assets/front/newdesignv4')}}/images/new_cutting/strip.png" alt="strip">
          @endif
            <img class="frame_icon rounded-circle" src="{{url('/'.$Occasion->image)}}" alt="{{$Occasion->getTranslation('title',getCode())}}">
          </div>

          <div class="sub_img_title">
            <h1 class="h4 text-center">{{$Occasion->getTranslation('title',getCode())}}</h1>
          </div>
        </div>

        @include('front.newdesignv4.snapsresult')

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
