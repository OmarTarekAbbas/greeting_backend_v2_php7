@extends('front.rotana.header')
@section('content')
<style>
  .row {
    margin-right: 0;
  }
</style>
@include('front.rotana.search')


<div class="main ">
  <section class="categories_page">
    <div class="containeer">
      <div class="row m-auto">
        <div class="col-12">
          <div class="s_title bounce-left">
            <h4>{!! static_lang('usefilter')?static_lang('usefilter') : 'استخدم الفلتر'  !!}</h4>
          </div>
        </div>

        <div class="col-12 mb-3 swirl-out-bck">
          <div class="sub_img">
            <img class="w-75 m-auto d-block" src="{{url('assets/front/rotana')}}/images/new_cutting/strip1.png" alt="strip">
            <img class="frame_icon rounded-circle" src="{{url('/'.$Rdata->path)}}" alt="{{$Rdata->getTranslation('title',getCode())}}">
          </div>

          <div class="sub_img_title">
            <h1 class=" text-center">{{$Rdata->getTranslation('title',getCode())}}</h1>
          </div>
        </div>

        <div class="col-10 m-auto">
          <a href="#">
            <div class="roll-in-bottom categories_page_img_inner ipad_width" style="margin-top: 1%;">
              <img class="w-75 rounded m-auto d-block" height="auto" src="{{url('/'.$Rdata->path)}}" alt="{{$Rdata->getTranslation('title',getCode())}}">
            </div>
          </a>
        </div>
      </div>

        <div class="col-12 text-center m-auto">
          <div class="download_share">
            <a href="{{$Rdata->snap_link}}">
              <img class="w-50" src="{{url('assets/front/rotana')}}/images/new_cutting/shape1.png" alt="download">
              <h3 class="yousefh3 text-center">{!! static_lang('usefilter')?static_lang('usefilter'): 'استخدم الفلتر' !!}</h3>
            </a>
          </div>
        </div>
      </div>

        <div class="col-12 text-center m-auto">
          <div class="download_share">
            <a href="#" data-toggle="modal" data-target="#snapModal2">
              <img class="w-50" src="{{url('assets/front/rotana')}}/images/new_cutting/shape1.png" alt="Share">
              <h3 class="yousefh3 text-center">{{static_lang('share')?static_lang('share'): 'مشاركة' }}</h3>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection


<!-- Start Modal -->
<div class="modal fade" id="snapModal2">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <!-- Modal body -->
      <div class="modal-body">
        <a class="fab fa-facebook-square" href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}" target="_blank"></a>
        <a class="fab fa-twitter-square" href="http://twitter.com/share?url={{URL::current()}}" target="_blank"></a>
        <a class="fab fa-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url={{URL::current()}}" target="_blank"></a>
        <a class="fab fa-pinterest-square" href="http://pinterest.com/pin/create/button/?url={{URL::current()}}" target="_blank"></a>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <a href="#" data-dismiss="modal">{{static_lang('close')?static_lang('close'): 'اغلق' }}</a>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->