<!-- Start Header -->
@include('front.akhbar.header')
<!-- End Header -->

<div class="main_filter_2day">
  <section class="filter_2day w-100 mt-3">
    <div class="container m-0 p-0">
      <div class="col-10 m-auto d-block p-0">
        <div class="filter_2day_img today_filter mt-3">
          <img class="d-block w-100 rounded" src="{{url($news->image)}}" alt="fillter">
        </div>
      </div>

      <div class="row m-0">
        <div class="col-12">
          <div class="filter_2day_title">
          <h6 class=" text-left scale-in-left wow" data-wow-delay="1.5s" data-wow-duration="0.5s" data-wow-offset="100">{{$news->title}}</h6>
          </div>
        </div>

        <div class="col-12">
          <div class="filter_2day_title text-center">
          <p class="text-center font-weight-bold">{!!$news->description!!}</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="filter_slide w-100 mt-3">
    <div class="row m-0">
      <div class="col-12 p-0">
        <div class="second_slide_title">
            <h6 class="text-left pt-0 pl-3 scale-in-left wow" data-wow-delay="1.5s" data-wow-duration="0.5s" data-wow-offset="100"> فلاتر مقترحة
              <i class="fas fa-th-large fa-1x float-right pr-3 pulsate-bck wow" data-wow-delay="1s" data-wow-duration="0.9s" data-wow-offset="100"></i>
            </h6>
        </div>
      </div>

      @foreach ($snaps as $snap)
      <div class="col-4 p-0">
        <div class="today_img mt-3">
          <a href="{{url('akhbar/inner'.'/'.$snap->id.'/'.UID())}}" target="_blank">
            <img class="d-block w-100 rounded" src="{{url($snap->path)}}" alt="filter">

            <div class="share_fav">
              <a class="first_list_img_share" href="#0" onclick="sharebtn('{{$snap->id}}')" data-toggle="modal" data-target="#modalForShare">
                <i class="fas fa-share-square"></i>
              </a>
            </div>

            <div class="share_fav">
              <a class="first_list_img_heart" href="#0" onclick="fav('{{$snap->id}}')">
                <i id="{{$snap->id}}" class="heart_heart fas fa-heart"></i>
              </a>
            </div>
          </a>
        </div>
      </div>
      <script>
        filterid = '{{$snap->id}}';
        var allfav = window.localStorage.getItem('favorite');
        var favArr = allfav.split(',');
        var find = favArr.indexOf(filterid);
        if (find == -1) { // not fav

        } else { // fav
          document.getElementById(filterid).classList.add("active_heart");
        }
      </script>
      @endforeach

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
          <a class="social-button facebook_link" href="https://www.facebook.com/sharer/sharer.php?u={{url('akhbar/inner/'.$news->id.'/'.UID())}}" target="_blank" title="Facebook">
            <i class="fab fa-facebook-f facebook_icon"></i>
          </a>

          <a class="social-button whatsapp_link" href="whatsapp://send?text={{url('akhbar/inner/'.$news->id.'/'.UID())}}" title="Whatsapp">
            <i class="fab fa-whatsapp whatsapp_icon"></i>
          </a>

          <a class="social-button twitter_link" href="http://twitter.com/share?url={{url('akhbar/inner/'.$news->id.'/'.UID())}}" target="_blank" title="Twitter">
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
