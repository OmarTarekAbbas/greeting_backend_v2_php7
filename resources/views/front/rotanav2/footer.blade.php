</main>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="search_search">
                                <form action="{{url('Search_v6/'.UID())}}" method="get" class="w-100">
                                    <label class="w-100" for="search">
                                        <input type="search" class="form-control w-100 text-center" name="search"
                                            value="{{session('search')}}" id="search"
                                            placeholder="{!! static_lang('search') ?static_lang('search') : 'بحث' !!}">
                                        <div class="input_bg text-center">
                                            <i class="fas fa-search fa-lg text-white pt-3"></i>
                                        </div>
                                    </label>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<footer class="footer_head w-100">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <div class="foot_link text-center">
                    <a id="indexed" class="active_menu" href="{{url('/rotanav2/'.uid())}}">
                        <i class="fas fa-home fa-lg"></i>
                    </a>
                </div>
            </div>

            <div class="col-3">
                <div class="foot_link text-center">
                    <a href="{{url('/rotanav2/favorites/'.uid())}}">
                        <i class="fas fa-heart fa-lg"></i>
                    </a>
                </div>
            </div>

            <div class="col-3">
                <div class="foot_link text-center">
                    <a href="#0" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-search fa-lg"></i>
                    </a>
                </div>
            </div>

            <div class="col-3">
                <div class="foot_link foot_link_img text-center">
                    <a href="{{url('rotanav2/today/'.UID())}}">
                        <img class="rotana_foot_img" src="{{url('assets/front/rotanav2/images/Rotana_Green.png')}}"
                            alt="Rotana">
                        <img class="rotana_foot_new" src="{{url('assets/front/rotanav2/images/New.png')}}"
                            alt="Rotana new">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
::-webkit-scrollbar {
    display: none;
}

  .the-frame {
    padding: 0;
    margin: 0;
    border-radius: 30px;
    border-top: 15px solid #a0a19f;
    border-bottom: 15px solid #a0a19f;
    border-right: 15px solid #a0a19f;
    border-left: 15px solid #a0a19f;
    box-shadow: 0 6px 10px 0 rgba(245, 205, 205, 0.14), 0 1px 18px 0 rgba(247, 172, 172, 0.12), 0 3px 5px -1px rgba(158, 85, 85, 0.3);
    width: 370px;
    height: 600px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    visibility: visible;
}

.main .filter_services {
    height: 200px !important;
}

@media only screen and (max-width: 600px) {
    .the-frame {
        display: none;
    }

    .enter {
        display: block;
    }

    .enter h4 {
        padding: 20px;
        text-align: center;
        color: #347742;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        font-size: 1.25rem;
    }

    .enter a {
        font-weight: bold;
        font-size: 18px;
        color: #fff;
        padding: 5px 20px;
        background-color: #347742;
        border-radius: 5px;
        text-decoration: none;
        position: absolute;
        top: 60%;
        left: 38%;
        transform: translate(-50%, -50%);
    }
}

@media only screen and (min-width: 600px) {
    body {
      visibility: hidden;
      overflow: hidden
    }

    .enter {
        display: none;
    }
  }

  @media only screen and (min-width: 1024px) {
    .the-frame {
      top: 35%;
    }
  }
</style>

<div class="the-frame">
    <iframe class="full-screen-preview__frame" src="{{url()->current()}}" name="preview-frame" frameborder="0"
        noresize="noresize" data-view="fullScreenPreview" style="height: 570px; width: 340px; border-radius: 10px;">
    </iframe>
</div>

<!-- <div class="enter">
    <h4>انت الان على الهاتف للدخول اضغط هنا</h4>
    <a href="home.php" class="wow pulse" data-wow-delay="300ms" data-wow-iteration="infinite" data-wow-duration="1.5s">دخول</a>
  </div> -->

<script src="{{url('assets/front/rotanav2/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{url('assets/front/rotanav2/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/front/rotanav2/js/popper.min.js')}}"></script>
<script src="{{url('assets/front/rotanav2/js/owl.carousel.min.js')}}"></script>
<script src="{{url('assets/front/rotanav2/js/wow.min.js')}}"></script>
<script src="{{url('assets/front/rotanav2/js/script.js')}}"></script>

<script type="text/javascript">
if (screen.width <= 600) {
    // document.location.href = "#0";
}
new WOW().init();
</script>

<script>

  function fav(filterid){
    // var filterid = $(this).attr('id');
    var allfav = window.localStorage.getItem('favorite');
    if(allfav != null && allfav != ""){// second time
      var favArr = allfav.split(',');
      var find = favArr.indexOf(filterid);
      if(find == -1){ // add to favorite
        favArr.push(filterid);
        allfav = favArr.join(',');
        window.localStorage.setItem('favorite', allfav);
      }else{ // remove from favorite
        favArr.splice(find, 1);
        allfav = favArr.join(',');
        window.localStorage.setItem('favorite', allfav);
      }
    }else{ //first time
      allfav = filterid;
      window.localStorage.setItem('favorite', allfav);
    }
    console.log(allfav);
  }

</script>

 