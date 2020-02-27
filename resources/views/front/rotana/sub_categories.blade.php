<!-- header -->
@extends('front.rotana.header')
@section('content')
<!-- end header-->
<style>
/* .main {padding-bottom: 20%;} */
.row {
  margin-right: 0;
}
.categories_page .categories_page_bg{
  background-color: #ffffff;
  border-radius: 7px
}
</style>
@include('front.rotana.search')


<div class="main ">
  <section class="categories_page">
    <div class="containeer">
      <div class="row m-auto" id="categoryStatus" action="inactive" page='1'>
        <div class="col-12 mb-3 swirl-out-bck">
          <div class="sub_img">
            <img class="w-75 m-auto d-block" src="{{url('assets/front/rotana')}}/images/new_cutting/strip1.png"
              alt="strip">
            <img class="frame_icon rounded-circle" src="{{url('/'.$Occasion->image)}}" alt="{{$Occasion->getTranslation('title',getCode())}}">
          </div>

          <div class="sub_img_title">
            <h1 class="h4 text-center">{{$Occasion->getTranslation('title',getCode())}}</h1>
          </div>
        </div>

        @include('front.rotana.snapsresult')

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
