<!-- Start Header -->
@include('front.rotanav2.header')
<!-- End Header -->
<style>
.new_rotana .main_filter_2day .filter_2day .filter_2day_img a.first_list_img_share {
    color: #a2a2a2;
}

.new_rotana .main_filter_2day .filter_2day .filter_2day_img a.first_list_img_heart {
    color: #a2a2a2;
}

</style>
<div class="main_filter_2day">
    <section class="filter_2day w-100 mt-3">
        <div class="container">
            <div class="row m-0">
                <div class="col-12">
                    <div class="filter_2day_title">
                        <h6 class="text-white text-right">{!! static_lang('usefilter')?static_lang('usefilter') : 'استخدم الفلتر'  !!}</h6>
                    </div>
                </div>
                <div class="col-10 m-auto d-block">
                    <div class="filter_2day_img mt-3">
                        <a href="{{$Rdata->snap_link}}" target="_blank">
                            <img class="w-100 d-block m-auto rounded" src="{{url('/'.$Rdata->path)}}"
                                alt="{{$Rdata->getTranslation('title',getCode())}}">
                            <div>
                                <a class="first_list_img_share" href="#0" data-toggle="modal" data-target="#modalForShare">
                                    <i class="fas fa-share-square"></i>
                                </a>
                            </div>

                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="filter_slide w-100 mt-3">
        <div class="col-12 p-0">
            <div class="second_slide_title">
                <a href="{{url('/rotanav2/'.$cat->id.'/occasion/'.uid())}}">
                    <h6 class="text-right text-white pt-0 pr-3">{{$cat->title}}
                        <i class="fas fa-th-large fa-1x float-left pl-3"></i>
                    </h6>
                </a>
            </div>
        </div>
        @if(count($occasis) < 2)
        <div class="owl_one owl-carousel owl-theme" dir="ltr">
            @elseif(count($occasis) == 2)
            <div class="owl_two owl-carousel owl-theme" dir="ltr">
                @else
                <div class="owl_three owl-carousel owl-theme" dir="ltr">
                    @endif
                    @foreach ($occasis as $occasi)
                    <div class="item">
                        <a class="owl_filter_img w-100" href="{{url('/rotanav2/'.$occasi->id.'/filter/'.uid())}}">
                            <img class="m-auto d-block" src="{{url('/'.$occasi->image)}}" alt="{{$occasi->title}}">
                        </a>
                    </div>
                    @endforeach
                </div>
    </section>

</div>


<!-- Modal -->
<div class="modal_share modal fade" id="modalForShare" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="rounded-social-buttons w-100 text-center">
                    <a class="social-button facebook_link"
                        href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}" target="_blank"
                        title="Facebook">
                        <i class="fab fa-facebook-f facebook_icon"></i>
                    </a>

                    <a class="social-button whatsapp_link"
                        href="whatsapp://send?abid=+20111682831&text={{URL::current()}}" title="Whatsapp">
                        <i class="fab fa-whatsapp whatsapp_icon"></i>
                    </a>

                    <a class="social-button twitter_link" href="http://twitter.com/share?url={{URL::current()}}"
                        target="_blank" title="Twitter">
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
