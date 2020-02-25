<!-- Start Header -->
@include('front.rotanav2.header')
<!-- End Header -->
<style>
.not_fo {
    width: 14.5%;
    position: absolute;
    top: 744%;
    left: 22.4%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-53%, -50%);
}

.img_logo_st {
    top: 587%;
    position: absolute;
    right: 13%;
}
.font_not_filter{
    font-size: 5vw;
    transform: translate(4%, 668%);
}
</style>
<div class="col-12 mb-3 swirl-out-bck">
    <div class="sub_img">
        <img class="w-75 d-block img_logo_st" src="{{url('assets/front/rotanav2/images/strip.png')}}" alt="strip">
        <img class="frame_icon rounded-circle not_fo" src="{{url('assets/front/rotanav2/images/Rotana_Green.png')}}"
            alt="Rotana Logo">
            <h6 class="text-black text-center font_not_filter">{!! static_lang('nofilter')?static_lang('nofilter') : 'لا يوجد فلاتر اليوم'  !!}</h6>

    </div>

</div>
<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->