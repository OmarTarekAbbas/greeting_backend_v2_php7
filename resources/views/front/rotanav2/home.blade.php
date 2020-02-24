<!-- Start Header -->
@include('front.rotanav2.header')
<!-- End Header -->

<div class="main_home">
  <div class="row m-0">
    <section class="video_sec w-100">
      <div class="col-12 p-0">
        <div class="owl-video owl-carousel owl-theme" dir="ltr">
          <div class="item">
            <video class="video-fluid w-100" poster="images/video.png" controls>
              <source src="{{url('assets/front/rotanav2/images/IT.MP4" type="video/mp4')}}" />
            </video>
          </div>

          <div class="item">
            <video class="video-fluid w-100" poster="images/video.png" controls>
              <source src="images/IT.MP4" type="video/mp4" />
            </video>
          </div>

          <div class="item">
            <video class="video-fluid w-100" poster="images/video.png" controls>
              <source src="images/IT.MP4" type="video/mp4" />
            </video>
          </div>

          <div class="item">
            <video class="video-fluid w-100" poster="images/video.png" controls>
              <source src="images/IT.MP4" type="video/mp4" />
            </video>
          </div>
        </div>

      </div>
    </section>

    <section class="first_slide w-100 mt-3">
      <div class="col-12 p-0">
        <div class="owl_one owl-carousel owl-theme" dir="ltr">
          <div class="item">
            <a class="owl_one_img w-100" href="#0">
              <img class="m-auto d-block" src="{{url('assets/front/rotanav2/images/001.png')}}" alt="New">
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
              <img class="m-auto d-block" src="{{url('assets/front/rotanav2/images/004.png')}}" alt="New">
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
              <img class="m-auto d-block" src="{{url('assets/front/rotanav2/images/007.png')}}" alt="New">
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

<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->
