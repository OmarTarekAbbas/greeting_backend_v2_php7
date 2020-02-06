<!-- header -->
@extends('front.rotana.header')
@section('content')
<!-- end header-->
<style>
    .row {
        margin-right: 0;
    }

    .col-12 {
        padding-right: 0;
        /* padding-left: 0; */
    }

    .main .status .contant .filter-img i {
        color: #7b407a;
        position: absolute;
        left: 11%;
        top: 81%;
    }

    .main .status .contant .filter-title {
        padding-top: 21px;
    }

    .main .status .contant .owl-carousel.owl-three .item .heart_two {
        left: 28%;
        top: 74px;
        font-size: 15px;
    }
    .main .status .contant{
        background-color: #c9c9c9;
    }
    .rounded {
    border-radius: .35rem!important;
    }
    .main .user_filter .use_filter_link{
        transform: scale(0.8);
        bottom: 32%;
    left: -3%;
    width: 38%;
    }
    .main .status .s_title{
        color: #454445d9;
    }
    .main .status .contant .filter-img i {
        color: #fff;
        font-size: 10px;
    }
    .main .owl-video .item .video-fluid{
        max-height: 170px;
    }
    .filter_today1{
        padding-left: 0px;
    }
    .owl-theme .owl-dots .owl-dot span{
        background: #347742;
    }
    .main .owl-theme .owl-dots .owl-dot.active span, .main .owl-theme .owl-dots .owl-dot:hover span{
        background-color: #489157;
    }
</style>
<!-- main content -->
<div class="main">
    <!-- Start Owl Carousel Video -->
    <div class="owl-video owl-carousel owl-theme">

        @foreach ($newsnap as $snap)
        <div class="item">
            <a href="#">
                <video class="video-fluid" poster="{{url('/'.$snap->vid_type)}}" controls>
                    <source src="{{url('/'.$snap->vid_path)}}" type="video/mp4" />
                </video>
                <a href="{{$snap->snap_link}}" class="user_filter">
                    <h4 class=" use_filter_link text-center p-1">استخدم الفلتر</h4>
                    <!-- <img src="{{url('assets/front/newdesignv4/')}}/images/use_filter.png" alt="Use Filter" class="w-25 use_filter_link"> -->
                </a>
            </a>
        </div>
        @endforeach
    </div>
    <!-- End Owl Carousel Video -->

    @include('front.rotana.search')

    <!-- Start Filter Today -->
    @if(isset($Rdata_today[0]))

    <div class="status">
        <div class="s_title bounce-left">
            <h5>{!! static_lang('todayfilter')?static_lang('todayfilter') : 'فلتراليوم' !!}</h5>
        </div>

        <div class="contant rounded" style="padding: 5px 20px;">
            <div class="row">
                <div class="filter_today1 col-8" style="margin-top: -9%;">
                    @if(\Session::has('MSISDN') && \Session::get('Status') == 'active' )
                    <i id="{{$Rdata_today[0]->id}}" @if(check_favourtite(\Session::get('MSISDN') , $Rdata_today[0]->id)) class="far fa-heart heart active"
                        @else class="far fa-heart heart" @endif></i>
                    @endif

                    <a href="{{url('rotana/filter/'.$Rdata_today[0]->id.'/'.UID())}}">

                        <div class="filter-img">
                            <img class="img-fluid" src="{{url('/'.$Rdata_today[0]->path)}}" alt="today filter" style="margin-top: 19%">
                            <i class="fas fa-heart fa-lg ajax_call" value="{{$Rdata_today[0]->id}}"></i>
                        </div>
                    </a>
                </div>
                <div class="col-4">
                    <div class="filter-title">
                    <h3 class="text-center" style="color:#347742">{{$Rdata_today[0]->getTranslation('title',getCode())}}</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- End Filter Today -->

    <!-- Start Filter Category -->
    <div class="status">
        <div class="row">
            <div class="col-12">
                <div class="s_title bounce-left">
                    <h4>{!! static_lang('categ')?static_lang('categ') : 'الفئات' !!}</h4>
                </div>
            </div>

            <div class="col-12">
                <div class="contant rounded">
                    @if(count($sliders) < 2)
                    <div class="owl-one owl-carousel owl-theme">
                        @elseif(count($sliders) == 2)
                        <div class="owl-two owl-carousel owl-theme">
                            @else
                            <div class="owl-three owl-carousel owl-theme">
                                @endif

                                @foreach ($sliders as $suggest)
                                <div class="item m-1">
                                    @if(\Session::has('MSISDN') && \Session::get('Status') == 'active' )
                                    <i id="{{$suggest->id}}" @if(check_favourtite(\Session::get('MSISDN') , $suggest->id)) class="far fa-heart heart active"
                                        @else class="far fa-heart heart" @endif></i>
                                    @endif
                                    <a href="{{url('rotana/suboccasion/'.$suggest->id.'/'.UID())}}">
                                        <img class="rounded d-block m-auto" height="83" src="{{url('/'.$suggest->image)}}" alt="{{$suggest->getTranslation('title',getCode())}}">
                                        {{-- <i class="heart_one fas fa-heart"></i> --}}
                                        <!-- <h4 class="h6 text-center" style="color:#495057">{{$suggest->getTranslation('title',getCode())}}</h4> -->
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
            <!-- End Filter Category -->

            <!-- Start Filter Suggestion -->
            <div class="status">
                <div class="row">
                    <div class="col-12">
                        <div class="s_title bounce-left">
                            <h4>{!! static_lang('mostp')?static_lang('mostp') : 'المقترحةلك' !!}</h4>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="contant">
                            @if(count($Rdata_today2) < 2) <div class="owl-one owl-carousel owl-theme">
                                @elseif(count($Rdata_today2) == 2)
                                <div class="owl-two owl-carousel owl-theme">
                                    @else
                                    <div class="owl-three owl-carousel owl-theme">
                                        @endif

                                        @foreach ($Rdata_today2 as $fav)
                                        <div class="item m-1">
                                            @if(\Session::has('MSISDN') && \Session::get('Status') == 'active' )
                                            <i id="{{$fav->id}}" @if(check_favourtite(\Session::get('MSISDN') , $fav->id)) class="far fa-heart heart active"
                                                @else class="far fa-heart heart" @endif></i>
                                            @endif

                                            <a href="{{url('rotana/filter/'.$fav->id.'/'.UID())}}">
                                                <img class="rounded d-block m-auto" src="{{url('/'.$fav->path)}}" alt="" height="83">
                                                <!-- <h4 class="h6 text-center d-block m-auto" style="color:#495057;">{{$fav->getTranslation('title',getCode())}}</h4> -->
                                            </a>
                                            <!-- <i class="heart_two far fa-heart ajax_call" id="{{$fav->id}}"></i> -->
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- End Filter Suggestion -->
                </div>
            </div>
            <!-- end main content -->
            @endsection

            @section('script')
            <script>
                $(document).on('click', '.ajax_call', function() {
                    console.log($(this).attr('id'))
                    if ($(this).hasClass('fa-heart')) {
                        $(this).removeClass('far').addClass('fas')
                    } else {
                        $(this).removeClass('fas').addClass('far')
                    }
                })


                $(document).on('click', '.ajax_call', function() {
                    if ($(this).hasClass('fa-heart')) {
                        var str = '?id=' + $(this).attr('id') + '&type=1';

                        $.get('{{url("like_dislike/".UID())}}' + str, function(response) {
                            $(this).removeClass('fa-heart').addClass('fa-thumbs-up')
                        })
                    } else {
                        var str = '?id=' + $(this).attr('id') + '&type=2'
                        $.get('{{url("like_dislike/".UID())}}' + str, function(response) {
                            $(this).removeClass('fa-thumbs-up').addClass('fa-heart')
                        })
                    }
                })
            </script>
            @endsection
