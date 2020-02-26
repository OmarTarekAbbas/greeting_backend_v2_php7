<!-- Start Header -->
@include('front.rotanav2.header')
<!-- End Header -->
<style>
  .new_rotana .main_filter_2day .filter_2day .filter_2day_img a.first_list_img_share {
    color: #a2a2a2;
  }

  .new_rotana .main_filter_2day .filter_2day .filter_2day_img a.first_list_img_heart {
    color: #a2a2a2;
  }
</style>

<div class="main_filter_2day">
  <section class="filter_2day w-100 mt-3">
    <div class="container">
      <div class="row m-0">
        <div class="col-12">
          <div class="filter_2day_title">
            <h6 class="text-white text-right scale-in-left">فلتر اليوم</h6>
          </div>
        </div>
        @if(isset($Rdata_today))
        <div class="col-10 m-auto d-block">
          <div class="filter_2day_img mt-3">
            <a href="{{$Rdata_today->snap_link}}">
              <img class="w-100 d-block m-auto rounded rotate-scale-down" src="{{url('/'.$Rdata_today->path)}}" alt="Filter Today">

              <a class="first_list_img_heart" onclick="fav('{{$Rdata_today->id}}');$(this).toggleClass('active_heart');" href="javascript:void(0)">
                <i class="fas fa-heart fa-lg ajax_call"></i>
              </a>

              <a class="first_list_img_share" href="#0" data-toggle="modal" data-target="#modalForShare">
                <i class="fas fa-share-square fa-lg"></i>
              </a>
            </a>

          </div>
        </div>
        <!-- <h3 class="text-center" style="color: #dedede;font-weight: bold;margin-right: 40%;">{{$Rdata_today->getTranslation('title',getCode())}}</span></h3> -->
        @endif
      </div>
    </div>
  </section>

  <section class="filter_slide w-100 mt-3">
    <div class="col-12 p-0">
      <div class="second_slide_title">
        <a href="{{url('/rotanav2/'.$cat->id.'/occasion/'.uid())}}">
          @if(isset($cat))
          <h6 class="text-right text-white pt-0 pr-3 scale-in-left">دراما
            <i class="fas fa-th-large fa-1x float-left pl-3 pulsate-bck"></i>
          </h6>
        </a>
        @endif
      </div>
    </div>

    @if(isset($occasis))
    @if(count($occasis) < 2) <div class="owl_one owl-carousel owl-theme" dir="ltr">
      @elseif(count($occasis) == 2)
      <div class="owl_two owl-carousel owl-theme" dir="ltr">
        @else
        <div class="owl_three owl-carousel owl-theme" dir="ltr">
          @endif
          @foreach ($occasis as $occasi)
          <div class="item">
            <a class="owl_filter_img w-100" href="{{url('/rotanav2/'.$occasi->id.'/filter/'.uid())}}">
              <img class="w-100 m-auto d-block" src="{{url('/'.$occasi->image)}}" alt="{{$occasi->title}}">
            </a>
          </div>
          @endforeach
        </div>
        @endif

  </section>
</div>


<!-- Modal -->
<div class="modal_share modal fade" id="modalForShare" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

            <div class="modal-body">
                <div class="rounded-social-buttons w-100 text-center">
                    <a class="social-button facebook_link"
                        href="https://www.facebook.com/sharer/sharer.php?u={{url('rotanav2/inner/'.$Rdata_today->id.'/'.UID())}}" target="_blank"
                        title="Facebook">
                        <i class="fab fa-facebook-f facebook_icon"></i>
                    </a>

                    <a class="social-button whatsapp_link"
                        href="whatsapp://send?abid=+20111682831&text={{url('rotanav2/inner/'.$Rdata_today->id.'/'.UID())}}" title="Whatsapp">
                        <i class="fab fa-whatsapp whatsapp_icon"></i>
                    </a>

                    <a class="social-button twitter_link" href="http://twitter.com/share?url={{url('rotanav2/inner/'.$Rdata_today->id.'/'.UID())}}"
                        target="_blank" title="Twitter">
                        <i class="fab fa-twitter twitter_icon"></i>
                    </a>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->
