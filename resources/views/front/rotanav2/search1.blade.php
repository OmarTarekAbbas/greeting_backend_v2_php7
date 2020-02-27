<!-- Start Header -->
@include('front.rotanav2.header')
<!-- End Header -->

@if(count($Rdata) > 0)
<div class="main_list">
    <section class="first_list w-100 mt-3">
    <div class="row m-auto" id="categoryStatus" action="inactive" page='1'>
            @include('front.rotanav2.snapsresult')
        </div>
    </section>
</div>
<!-- Modal -->
<div class="modal_share modal fade" id="modalForShare" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="rounded-social-buttons w-100 text-center">
                    <a class="social-button facebook_link" href="" target="_blank"
                        title="Facebook">
                        <i class="fab fa-facebook-f facebook_icon"></i>
                    </a>

                    <a class="social-button whatsapp_link" href="" title="Whatsapp">
                        <i class="fab fa-whatsapp whatsapp_icon"></i>
                    </a>

                    <a class="social-button twitter_link" href="" target="_blank" title="Twitter">
                        <i class="fab fa-twitter twitter_icon"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@else
@include('front.rotanav2.nofilter')
@endif

<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->

<script>
$(window).on("scroll", function() {
  var action = $('#categoryStatus').attr('action');
  var page = $('#categoryStatus').attr('page');

  if ($(window).scrollTop() + $(window).height() < $("#categoryStatus").height() && action == 'inactive') {
    console.log($(window).height() < $("#categoryStatus").height());
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


    }
  })
}

$('.first_list_img_share').click(function(){
    var id = $(this).attr('id');
    var url = "{{url('/rotanav2').'/inner/'}}"+id+"/"+"{{UID()}}";

    var facebook = "https://www.facebook.com/sharer/sharer.php?u="+url;
    var whatsapp = "whatsapp://send?abid=+20111682831&text="+url;
    var twitter = "http://twitter.com/share?url="+url;

    $('.facebook_link').attr('href', facebook);
    $('.twitter_link').attr('href', twitter);
    $('.whatsapp_link').attr('href', whatsapp);
});
</script>

