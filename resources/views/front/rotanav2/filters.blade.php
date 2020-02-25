<!-- Start Header -->
@include('front.rotanav2.header')
<!-- End Header -->

<div class="main_list">

  <section class="first_list w-100 mt-3">
    <div class="row m-0" id="categoryStatus" action="inactive" page='1'>
@if ($filters->count() > 0)
@foreach ($filters as $item)
      <div class="col-4 p-0">
        <div class="first_list_img">
          <a href="{{url($item->snap_link)}}" target="_blank">
            <img class="w-100" src="{{url($item->path)}}" alt="Filter">

            <a class="first_list_img_heart" onclick="fav('{{$item->id}}')" href="javascript:void(0)">
              <i class="fas fa-heart heart_heart"></i>
            </a>

            <a class="first_list_img_share" href="#0" data-toggle="modal" data-target="#modalForShare">
              <i class="fas fa-share-square"></i>
            </a>
          </a>
        </div>
      </div>
      @endforeach
@else

  <h2>No Filters!</h2>

@endif
      
    </div>
  </section>

</div>


<!-- Modal -->
<div class="modal_share modal fade" id="modalForShare" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="rounded-social-buttons w-100 text-center">
          <a class="social-button facebook_link" href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}"
            target="_blank" title="Facebook">
            <i class="fab fa-facebook-f facebook_icon"></i>
          </a>

          <a class="social-button whatsapp_link" href="whatsapp://send?abid=+20111682831&text={{URL::current()}}"
            title="Whatsapp">
            <i class="fab fa-whatsapp whatsapp_icon"></i>
          </a>

          <a class="social-button twitter_link" href="http://twitter.com/share?url={{URL::current()}}" target="_blank"
            title="Twitter">
            <i class="fab fa-twitter twitter_icon"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->

<script>
  $(window).on("scroll", function() {
    var action = $('#categoryStatus').attr('action');
    var page = $('#categoryStatus').attr('page');
  
    if ($(window).scrollTop() + $(window).height() > $("#categoryStatus").height() && action == 'inactive') {
      $('#categoryStatus').attr('action', 'active');
      page++;
      $('#categoryStatus').attr('page', page);
      load_snap_data(page);
    }
  });
  
  function load_snap_data(page) {
    $('.load').show();
    $.ajax({
      type: 'GET',
      url: '?page=' + page,
      success: function(data) {
  
        $('#categoryStatus').append(data);
        $('#categoryStatus').attr('action', 'inactive');
  
        // document.getElementById("categoryStatus").insertAdjacentHTML(front.newdesignv4.presult); 
  
      }
    })
  }
</script>