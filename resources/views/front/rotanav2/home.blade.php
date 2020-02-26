<!-- Start Header -->
@include('front.rotanav2.header')
<!-- End Header -->

<div class="main_home">
  <div class="row m-0">
    {{-- vid slider --}}
    <section class="video_sec w-100">
      <div class="col-12 p-0">
        <div class="owl-video owl-carousel owl-theme" dir="ltr">
          @if (isset($newsnap) && $newsnap != null)
          @foreach ($newsnap as $item)
          <div class="item">
            <video class="video-fluid w-100" poster="{{url($item->vid_type)}}" controls>
              <source src="{{url($item->vid_path)}}" />
            </video>

            <a class="fontIcon text-white text-center d-block" href="{{url($item->snap_link)}}" target="_blank">
              <i class="far fa-eye fa-2x"></i>
            </a>
          </div>
          @endforeach
          @endif
        </div>
    </section>
    {{-- category slider --}}
    @foreach ($categories as $category)

    @if ($category->occasions()->get()->count() == 1)
    <section class="first_slide w-100 mt-3">
      <div class="col-12 p-0">
        <div class="second_slide_title">
          <a href="{{url('/rotanav2/'.$category->id.'/occasion/'.uid())}}">
            <h6 class="text-right text-white pt-0 pr-3 scale-in-left wow" data-wow-delay="1.5s" data-wow-duration="0.5s" data-wow-offset="100"> {{$category->title}}
              <i class="fas fa-th-large fa-1x float-left pl-3 pulsate-bck wow" data-wow-delay="1s" data-wow-duration="0.9s" data-wow-offset="100"></i>
            </h6>
          </a>
        </div>

        <div class="owl_one owl-carousel owl-theme" dir="ltr">
          @foreach ($category->occasions()->limit(get_settings('pagination_slider'))->get() as $item)
          <div class="item">
            <a class="owl_one_img w-100" href="{{url('/rotanav2/'.$item->id.'/filter/'.uid())}}">
              <img class="m-auto d-block" src="{{url($item->image)}}" alt="New">
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif

    @if ($category->occasions()->get()->count() == 2)
    <section class="second_slide w-100 mt-3">
      <div class="col-12 p-0">
        <div class="second_slide_title">
          <a href="{{url('/rotanav2/'.$category->id.'/occasion/'.uid())}}">
            <h6 class="text-right text-white pt-0 pr-3 scale-in-left wow" data-wow-delay="1.5s" data-wow-duration="0.5s" data-wow-offset="100"> {{$category->title}}
              <i class="fas fa-th-large fa-1x float-left pl-3 pulsate-bck wow" data-wow-delay="1s" data-wow-duration="0.9s" data-wow-offset="100"></i>
            </h6>
          </a>
        </div>

        <div class="owl_two owl-carousel owl-theme" dir="ltr">
          @foreach ($category->occasions()->limit(get_settings('pagination_slider'))->get() as $item)
          <div class="item">
            <a class="owl_two_img w-100" href="{{url('/rotanav2/'.$item->id.'/filter/'.uid())}}">
              <img class="m-auto d-block" src="{{url($item->image)}}" alt="New">
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif

    @if ($category->occasions()->get()->count() > 2)
    <section class="third_slide w-100 mt-3">
      <div class="col-12 p-0">
        <div class="second_slide_title">
          <a href="{{url('/rotanav2/'.$category->id.'/occasion/'.uid())}}">
            <h6 class="text-right text-white pt-0 pr-3 scale-in-left wow" data-wow-delay="1.5s" data-wow-duration="0.5s" data-wow-offset="100"> {{$category->title}}
              <i class="fas fa-th-large fa-1x float-left pl-3 pulsate-bck wow" data-wow-delay="1s" data-wow-duration="0.9s" data-wow-offset="100"></i>
            </h6>
          </a>
        </div>

        <div class="owl_three owl-carousel owl-theme" dir="ltr">
          @foreach ($category->occasions()->limit(get_settings('pagination_slider'))->get() as $item)
          <div class="item">
            <a class="owl_three_img w-100" href="{{url('/rotanav2/'.$item->id.'/filter/'.uid())}}">
              <img class="m-auto d-block" src="{{url($item->image)}}" alt="New">
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif

    @endforeach

  </div>
</div>

<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->
