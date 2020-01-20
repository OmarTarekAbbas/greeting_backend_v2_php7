<!-- header -->
@extends('front.newdesignv4.header')
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

@include('front.newdesignv4.search')

<div class="main ">

  <div class="containeer mb-2">
      <div class="row">
        <div class="col-12">
          <div class="search_for bounce-left">
            <h4>{!! static_lang('fav')?static_lang('fav') : 'المفضلة'  !!}</h4>
          </div>
        </div>
      </div>
  </div>

  <section class="categories_page">
    <div class="containeer">
      <div class="row m-auto" id="categoryStatus" action="inactive" page='1'>

          @include('front.newdesignv4.fpresult')
        
      </div>
    </div>
  </section>
</div>
@endsection
@section('script')
    

<script>
    $(window).on("scroll", function () {
      var action = $('#categoryStatus').attr('action');
      var page = $('#categoryStatus').attr('page');

      if ($(window).scrollTop() + $(window).height() > $("#categoryStatus").height() && action == 'inactive') {
          console.log('firrrrrrrrrrrrrrreeeeeeeeeeeeee');
          $('#categoryStatus').attr('action', 'active');
          page++;
          $('#categoryStatus').attr('page',page);
          load_snap_data(page);
      }
    });

    function load_snap_data(page){
      $('.load').show();
      $.ajax({
          type: 'GET',
          url: '?page=' + page,
          success: function (data) {

                $('#categoryStatus').append(data);
                $('#categoryStatus').attr('action', 'inactive');

              // document.getElementById("categoryStatus").insertAdjacentHTML(front.newdesignv4.presult); 

          }
      })
    }
  </script>
@endsection
