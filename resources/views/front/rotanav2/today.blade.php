<!-- Start Header -->
<?php include 'header.php'; ?>
<!-- End Header -->

<div class="main_filter_2day">
  <section class="filter_2day w-100 mt-3">
    <div class="container">
      <div class="row m-0">
        <div class="col-12">
          <div class="filter_2day_title">
            <h6 class="text-white text-right">فلتر اليوم</h6>
          </div>
        </div>

        <div class="col-10 m-auto d-block">
          <div class="filter_2day_img mt-3">
            <a href="#0">
              <img class="w-100 d-block m-auto rounded" src="images/010.png" alt="Filter Today">

              <a class="first_list_img_heart" href="#0">
                <i class="fas fa-heart heart_heart"></i>
              </a>

              <a class="first_list_img_share" href="#0" data-toggle="modal" data-target="#modalForShare">
                <i class="fas fa-share-square"></i>
              </a>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="filter_slide w-100 mt-3">
    <div class="col-12 p-0">
      <div class="second_slide_title">
        <a href="list.php">
          <h6 class="text-right text-white pt-0 pr-3">دراما
            <i class="fas fa-th-large fa-1x float-left pl-3"></i>
          </h6>
        </a>
      </div>
    </div>

    <div class="owl_filter owl-carousel owl-theme" dir="ltr">
      <div class="item">
        <a class="owl_filter_img w-100" href="#0">
          <img class="m-auto d-block" src="images/007.png" alt="New">

        </a>
      </div>

      <div class="item">
        <a class="owl_filter_img w-100" href="#0">
          <img class="m-auto d-block" src="images/008.png" alt="New">
        </a>
      </div>

      <div class="item">
        <a class="owl_filter_img w-100" href="#0">
          <img class="m-auto d-block" src="images/009.png" alt="New">
        </a>
      </div>
    </div>
  </section>
</div>


<!-- Modal -->
<div class="modal_share modal fade" id="modalForShare" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="rounded-social-buttons w-100 text-center">
          <a class="social-button facebook_link" href="https://www.facebook.com/" target="_blank" title="Facebook">
            <i class="fab fa-facebook-f facebook_icon"></i>
          </a>

          <a class="social-button whatsapp_link" href="whatsapp://send?abid=+20111682831&text=Hello%2C%20World!" title="Whatsapp">
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
<?php include 'footer.php'; ?>
<!-- End Footer -->