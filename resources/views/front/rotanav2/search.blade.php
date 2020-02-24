<!-- Start Header -->
<?php include 'header.php'; ?>
<!-- End Header -->

<style>
  .main_home,
  footer {
    opacity: 0.3;
  }
</style>

<div class="main_home">
  <div class="row m-0">
    <section class="video_sec w-100">
      <div class="col-12 p-0">
        <video class="video-fluid w-100" poster="images/video.png" controls>
          <source src="images/IT.MP4" type="video/mp4" />
        </video>
      </div>
    </section>

    <section class="first_slide w-100 mt-3">
      <div class="col-12 p-0">
        <div class="owl_one owl-carousel owl-theme" dir="ltr">
          <div class="item">
            <a class="owl_one_img w-100" href="#0">
              <img class="m-auto d-block" src="images/001.png" alt="New">
            </a>
          </div>

          <div class="item">
            <a class="owl_one_img w-100" href="#0">
              <img class="m-auto d-block" src="images/002.png" alt="New">
            </a>
          </div>

          <div class="item">
            <a class="owl_one_img w-100" href="#0">
              <img class="m-auto d-block" src="images/003.png" alt="New">
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="second_slide w-100 mt-3">
      <div class="col-12 p-0">
        <div class="second_slide_title">
          <a href="list.php">
            <h6 class="text-right text-white pt-0 pr-3">سينما
              <i class="fas fa-th-large fa-1x float-left pl-3"></i>
            </h6>
          </a>
        </div>

        <div class="owl_two owl-carousel owl-theme" dir="ltr">
          <div class="item">
            <a class="owl_two_img w-100" href="#0">
              <img class="m-auto d-block" src="images/004.png" alt="New">
            </a>
          </div>

          <div class="item">
            <a class="owl_two_img w-100" href="#0">
              <img class="m-auto d-block" src="images/005.png" alt="New">
            </a>
          </div>

          <div class="item">
            <a class="owl_two_img w-100" href="#0">
              <img class="m-auto d-block" src="images/006.png" alt="New">
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="third_slide w-100 mt-3">
      <div class="col-12 p-0">
        <div class="second_slide_title">
          <a href="list.php">
            <h6 class="text-right text-white pt-0 pr-3">دراما
              <i class="fas fa-th-large fa-1x float-left pl-3"></i>
            </h6>
          </a>
        </div>

        <div class="owl_three owl-carousel owl-theme" dir="ltr">
          <div class="item">
            <a class="owl_three_img w-100" href="#0">
              <img class="m-auto d-block" src="images/007.png" alt="New">
            </a>
          </div>

          <div class="item">
            <a class="owl_three_img w-100" href="#0">
              <img class="m-auto d-block" src="images/008.png" alt="New">
            </a>
          </div>

          <div class="item">
            <a class="owl_three_img w-100" href="#0">
              <img class="m-auto d-block" src="images/009.png" alt="New">
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="search_search">
        <form class="w-100">
          <label class="w-100" for="search">
            <input type="search" class="form-control w-100 text-center" id="search" placeholder="أبحث عن فلترك المفضل">
            <div class="input_bg text-center">
              <i class="fas fa-search fa-lg text-white pt-3"></i>
            </div>
          </label>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Start Footer -->
<?php include 'footer.php'; ?>
<!-- End Footer -->