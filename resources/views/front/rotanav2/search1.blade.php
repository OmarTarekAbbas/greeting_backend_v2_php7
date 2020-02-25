<!-- Start Header -->
@include('front.rotanav2.header')
<!-- End Header -->


<div class="main_list">
    <section class="first_list w-100 mt-3">
        <div class="row m-auto" id="categoryStatus" action="inactive" page='1'>
            @include('front.rotanav2.snapsresult')
        </div>
    </section>
</div>
<script src="{{url('assets/front/rotanav2/js/jquery-3.3.1.min.js')}}"></script>
<script>
$(window).on("scroll", function() {
    var action = $('#categoryStatus').attr('action');
    var page = $('#categoryStatus').attr('page');

    if ($(window).scrollTop() + $(window).height() > $("#categoryStatus").height() && action == 'inactive') {
        // console.log('firrrrrrrrrrrrrrreeeeeeeeeeeeee');
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
<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->
@section('script')




@endsection
