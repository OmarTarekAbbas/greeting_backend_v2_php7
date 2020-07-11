<!-- Start Header -->
@include('front.akhbar.header')
<!-- End Header -->

<div class="main_filter_2day">
  <section class="filter_2day w-100 mt-3">
    <div class="container m-0 p-0">
      @if(isset($Rdata_today))
      <div class="col-10 m-auto d-block">
        <div class="filter_2day_img today_filter mt-3">
          <a href="{{$Rdata_today->snap_link}}">
            <img class="d-block w-100 rounded" src="../../assets/front/akhbar/images/Cutting/Slider_Image.png" alt="fillter">
          </a>
        </div>
      </div>
      @endif

      <div class="row m-0">
        <div class="col-12">
          <div class="filter_2day_title">
            <h6 class=" text-right scale-in-left wow" data-wow-delay="1.5s" data-wow-duration="0.5s" data-wow-offset="100">@lang('messages.today_filter') </h6>
          </div>
        </div>

        <div class="col-12">
          <div class="filter_2day_title">
            <p class="text-center font-weight-bold">تحاول خدمات الإنقاذ والجنود في اليابان الوصول إلى آلاف المنازل المنكوبة بالفيضانات المدمرة والانزلاقات الأرضية التي أودت بحياة 60 شخصاً على الأقل وتسببت بأضرار كبيرة منذ السبت الماضي</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="filter_slide w-100 mt-3">
    <div class="row m-0">
      <div class="col-12 p-0">
        <div class="second_slide_title">
          <a href="{{url('/akhbar/'.$cat->id.'/occasion/'.uid())}}">
            @if(isset($cat))
            <h6 class="text-right pt-0 pr-3 scale-in-left wow" data-wow-delay="1.5s" data-wow-duration="0.5s" data-wow-offset="100">{{$cat->getTranslation('title',getCode())}}
              <i class="fas fa-th-large fa-1x float-left pl-3 pulsate-bck wow" data-wow-delay="1s" data-wow-duration="0.9s" data-wow-offset="100"></i>
            </h6>
          </a>
          @endif
        </div>
      </div>

      <div class="col-4 p-0">
        <div class="today_img mt-3">
          <a href="#0" target="_blank">
            <img class="d-block w-100 rounded" src="../../assets/front/akhbar/images/Cutting/01.png" alt="fillter">

            <div class="share_fav">
              <a class="first_list_img_share" href="#0" data-toggle="modal" data-target="#modalForShare">
                <i class="fas fa-share-square"></i>
              </a>
            </div>

            <div class="share_fav">
              <a class="first_list_img_heart" href="#0">
                <i class="heart_heart fas fa-heart"></i>
              </a>
            </div>
          </a>
        </div>
      </div>

      <div class="col-4 p-0">
        <div class="today_img mt-3">
          <a href="#0" target="_blank">
            <img class="d-block w-100 rounded" src="../../assets/front/akhbar/images/Cutting/02.png" alt="fillter">

            <div class="share_fav">
              <a class="first_list_img_share" href="#0" data-toggle="modal" data-target="#modalForShare">
                <i class="fas fa-share-square"></i>
              </a>
            </div>

            <div class="share_fav">
              <a class="first_list_img_heart" href="#0">
                <i class="heart_heart fas fa-heart"></i>
              </a>
            </div>
          </a>
        </div>
      </div>

      <div class="col-4 p-0">
        <div class="today_img mt-3">
          <a href="#0" target="_blank">
            <img class="d-block w-100 rounded" src="../../assets/front/akhbar/images/Cutting/03.png" alt="fillter">

            <div class="share_fav">
              <a class="first_list_img_share" href="#0" data-toggle="modal" data-target="#modalForShare">
                <i class="fas fa-share-square"></i>
              </a>
            </div>

            <div class="share_fav">
              <a class="first_list_img_heart" href="#0">
                <i class="heart_heart fas fa-heart"></i>
              </a>
            </div>
          </a>
        </div>
      </div>
    </div>
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
        <div class="rounded-social-buttons w-100 text-center">
          <a class="social-button facebook_link" href="https://www.facebook.com/sharer/sharer.php?u={{url('akhbar/inner/'.$Rdata_today->id.'/'.UID())}}" target="_blank" title="Facebook">
            <i class="fab fa-facebook-f facebook_icon"></i>
          </a>

          <a class="social-button whatsapp_link" href="whatsapp://send?text={{url('akhbar/inner/'.$Rdata_today->id.'/'.UID())}}" title="Whatsapp">
            <i class="fab fa-whatsapp whatsapp_icon"></i>
          </a>

          <a class="social-button twitter_link" href="http://twitter.com/share?url={{url('akhbar/inner/'.$Rdata_today->id.'/'.UID())}}" target="_blank" title="Twitter">
            <i class="fab fa-twitter twitter_icon"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  filterid = '{{$Rdata_today->id}}';
  var allfav = window.localStorage.getItem('favorite');
  var favArr = allfav.split(',');
  var find = favArr.indexOf(filterid);
  if (find == -1) { // not fav

  } else { // fav
    document.getElementById(filterid).classList.add("active_heart");
  }
</script>
<!-- Start Footer -->
@include('front.akhbar.footer')
<!-- End Footer -->
