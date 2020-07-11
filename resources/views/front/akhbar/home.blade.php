<!-- Start Header -->
@include('front.akhbar.header')
<!-- End Header -->

<div class="main_home">
  <div class="row m-0">
    <section class="slider_sec w-100">
      <div class="col-12 p-0">
        <div class="owl_one owl-carousel owl-theme" dir="ltr">
          @foreach ($news as $item)
          <div class="item">
            <a href="{{url('akhbar/news'.'/'.$item->id.'/'.UID())}}">
              <img class="d-block w-100 rounded" src="{{$item->image}}" alt="Slider">
              <div class="img_title">
                <p class="w-100 text-center mb-0">{{$item->title}}</p>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>

    <section class="all_content w-100 mb-3">
      <div class="title">
        <p class="w-100 text-right font-weight-bold">فلاتر</p>
      </div>

      <div class="row m-0">
        <div class="col-4 p-0">
          <div class="all_content_img">
            <a href="#0">
              <img class="d-block w-100 rounded" src="../assets/front/akhbar/images/Cutting/01.png" alt="Filter">
            </a>
          </div>
        </div>

        <div class="col-4 p-0">
          <div class="all_content_img">
            <a href="#0">
              <img class="d-block w-100 rounded" src="../assets/front/akhbar/images/Cutting/02.png" alt="Filter">
            </a>
          </div>
        </div>

        <div class="col-4 p-0">
          <div class="all_content_img">
            <a href="#0">
              <img class="d-block w-100 rounded" src="../assets/front/akhbar/images/Cutting/03.png" alt="Filter">
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="all_content w-100 mb-3">
      <div class="row m-0">
        <div class="col-4 p-0">
          <div class="all_content_img">
            <a href="#0">
              <img class="d-block w-100 rounded" src="../assets/front/akhbar/images/Cutting/04.png" alt="Filter">
            </a>
          </div>
        </div>

        <div class="col-4 p-0">
          <div class="all_content_img">
            <a href="#0">
              <img class="d-block w-100 rounded" src="../assets/front/akhbar/images/Cutting/05.png" alt="Filter">
            </a>
          </div>
        </div>

        <div class="col-4 p-0">
          <div class="all_content_img">
            <a href="#0">
              <img class="d-block w-100 rounded" src="../assets/front/akhbar/images/Cutting/06.png" alt="Filter">
            </a>
          </div>
        </div>
      </div>
    </section>

    <section class="all_content w-100 mb-3">
      <div class="row m-0">
        <div class="col-4 p-0">
          <div class="all_content_img">
            <a href="#0">
              <img class="d-block w-100 rounded" src="../assets/front/akhbar/images/Cutting/01.png" alt="Filter">
            </a> </div>
        </div>

        <div class="col-4 p-0">
          <div class="all_content_img">
            <a href="#0">
              <img class="d-block w-100 rounded" src="../assets/front/akhbar/images/Cutting/02.png" alt="Filter">
            </a> </div>
        </div>

        <div class="col-4 p-0">
          <div class="all_content_img">
            <a href="#0">
              <img class="d-block w-100 rounded" src="../assets/front/akhbar/images/Cutting/03.png" alt="Filter">
            </a> </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- Start Footer -->
@include('front.akhbar.footer')
<!-- End Footer -->
