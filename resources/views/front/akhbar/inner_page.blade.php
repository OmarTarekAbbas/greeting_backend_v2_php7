<!-- Start Header -->
@include('front.akhbar.header')
<!-- End Header -->

<div class="main_filter_2day">
  <section class="filter_2day w-100 mt-3">
    <div class="container">
      <div class="row m-0">
        <div class="col-12">
          <div class="filter_2day_title">
            <!-- <h6 class=" text-right">{!! static_lang('usefilter')?static_lang('usefilter') : 'استخدم الفلتر' !!}</h6> -->
            <h6 class=" text-right">فلتر أخبار 1</h6>
          </div>
        </div>

        <div class="col-10 m-auto d-block">
          <div class="filter_2day_img mt-3">
            <a href="{{$Rdata->snap_link}}" target="_blank">
              <img class="d-block w-100 rounded" src="./../../../assets/front/akhbar/images/Cutting/filter.png" alt="fillter">

              <div class="share_fav">
                <a class="first_list_img_share" href="#0" data-toggle="modal" data-target="#modalForShare">
                  <i class="fas fa-share-square"></i>
                </a>
              </div>

              <div class="share_fav">
                <a class="first_list_img_heart" href="#0">
                  <i class="fas fa-heart"></i>
                </a>
              </div>
            </a>
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
          <a class="social-button facebook_link" href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}" target="_blank" title="Facebook">
            <i class="fab fa-facebook-f facebook_icon"></i>
          </a>

          <a class="social-button whatsapp_link" href="whatsapp://send?text={{URL::current()}}" title="Whatsapp">
            <i class="fab fa-whatsapp whatsapp_icon"></i>
          </a>

          <a class="social-button twitter_link" href="http://twitter.com/share?url={{URL::current()}}" target="_blank" title="Twitter">
            <i class="fab fa-twitter twitter_icon"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Start Footer -->
@include('front.akhbar.footer')
<!-- End Footer -->
