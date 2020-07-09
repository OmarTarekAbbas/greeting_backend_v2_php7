<!-- Start Header -->
@include('front.akhbar.header')
<!-- End Header -->

<div class="main_fav">
  <div class="row m-0">
    <section class="fav_sec w-100 mt-3">
      <div class="col-12">
        <div class="img_like">
          <img class="d-block m-auto" src="{{url('assets/front/rotanav2/images/like_2.png')}}" alt="Like">
        </div>
      </div>
    </section>

    <section class="fav_list w-100 mt-4">
      <div id="favoritesAjax" class="row m-0">

      </div>
    </section>
  </div>
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
          <a class="social-button facebook_link" href="https://www.facebook.com/" target="_blank" title="Facebook">
            <i class="fab fa-facebook-f facebook_icon"></i>
          </a>

          <a class="social-button whatsapp_link" href="whatsapp://send?text=Hello%2C%20World!" title="Whatsapp">
            <i class="fab fa-whatsapp whatsapp_icon"></i>
          </a>

          <a class="social-button twitter_link" href="https://www.twitter.com/" target="_blank" title="Twitter">
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

<script>
var allfav = window.localStorage.getItem('favorite');

$.ajax({
  type: "get",
  url: "{{url('akhbar/favorites_load').'/'.uid()}}",
  data: {'ids' : allfav},
  success: function (response) {
    $('#favoritesAjax').html(response);
  }
});

</script>
