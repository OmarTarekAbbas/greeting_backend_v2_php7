</main>
<style>
  .main .filter_services {
    height: 200px !important;
  }
</style>
<!-- Modal -->
<div class="modal_search modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body p-2">
        <div class="container p-0 m-0">
          <div class="row m-0">
            <div class="col-12 p-0">
              <div class="search_search">
                <form action="{{url('Search_v6/'.UID())}}" method="get" class="w-100 slide-search">
                  <label class="w-100" for="search">
                    <input type="search" class="form-control w-100 text-center" name="search" value="{{session('search')}}" id="search" placeholder="{!! static_lang('search') ?static_lang('search') : 'بحث' !!}">
                    <div class="input_bg text-center">
                      <button>
                        <i class="fas fa-search fa-lg text-white pt-3"></i>
                      </button>
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

<footer class="footer_head">
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
          <a id="search_input" href="#0" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-search fa-lg"></i>
          </a>
        </div>
      </div>

      <div class="col-3">
        <div class="foot_link foot_link_img text-center">
          <a href="{{url('rotanav2/today/'.UID())}}">
            <img class="rotana_foot_img" src="{{url('assets/front/rotanav2/images/Rotana_Green.png')}}" alt="Rotana">
            @if(getCode() == 'ar')
            <img class="rotana_foot_new" src="{{url('assets/front/rotanav2/images/New.png')}}" alt="Rotana new">
            @endif
            @if(getCode() == 'en' || getCode() == '')
            <img class="rotana_foot_new" src="{{url('assets/front/rotanav2/images/new_english.png')}}" alt="Rotana new">
            @endif
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>

<script src="{{url('assets/front/rotanav2/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{url('assets/front/rotanav2/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/front/rotanav2/js/popper.min.js')}}"></script>
<script src="{{url('assets/front/rotanav2/js/owl.carousel.min.js')}}"></script>
<script src="{{url('assets/front/rotanav2/js/wow.min.js')}}"></script>
<script src="{{url('assets/front/rotanav2/js/script.js')}}"></script>
<script>
  var modal = Binary_functions();
  if(modal){
      console.log(modal)
      $('#hemsisdn').html(modal);
      $('.hemodal').css('display', 'block')
  }
</script>

<script type="text/javascript">
  wow = new WOW({
    boxClass: 'wow', // default
    animateClass: 'animated', // default
    offset: 0, // default
    mobile: true, // default
    live: true // default
  });

  wow.init();
  // new WOW().init();
</script>

<script>
  function fav(filterid) {
    // var filterid = $(this).attr('id');
    var allfav = window.localStorage.getItem('favorite');
    if (allfav != null && allfav != "") { // second time
      var favArr = allfav.split(',');
      var find = favArr.indexOf(filterid);
      if (find == -1) { // add to favorite
        favArr.push(filterid);
        allfav = favArr.join(',');
        window.localStorage.setItem('favorite', allfav);
      } else { // remove from favorite
        favArr.splice(find, 1);
        allfav = favArr.join(',');
        window.localStorage.setItem('favorite', allfav);
      }
    } else { //first time
      allfav = filterid;
      window.localStorage.setItem('favorite', allfav);
    }
    console.log(allfav);
  }

  function sharebtn(id) {
    var url = "{{url('/rotanav2').'/inner/'}}" + id + "/" + "{{UID()}}";
    console.log(url);
    var facebook = "https://www.facebook.com/sharer/sharer.php?u=" + url;
    var whatsapp = "whatsapp://send?text=" + url;
    var twitter = "http://twitter.com/share?url=" + url;

    $('.facebook_link').attr('href', facebook);
    $('.twitter_link').attr('href', twitter);
    $('.whatsapp_link').attr('href', whatsapp);
  }
</script>
</body>
</html>
