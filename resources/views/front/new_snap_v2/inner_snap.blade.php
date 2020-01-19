@extends('front.new_snap_v2.layout')
@section('content')
<!-- main content -->
<div class="main">
    <div class="container">
        <!-- search -->
        <div class="search">
            <i class="fas fa-search"></i>
            <form  action="{{url('Search_v2/'.UID())}}" method="get">
              {{csrf_field()}}
              <input type="text" name="search" id="myInput" placeholder="بحث" title="">
            </form>
        </div>
        <!-- end search -->
        <!-- liked -->
        <div class="filtars">
            <div class="category_title">
                <div class="row">
                    <div class="col-4 p-0">
                        <a class="i_arrow" href="{{url('/occasion/'.$Rdata->occasion_id.'/'.UID())}}">{{$Rdata->occasion->title}} <i class="fas fa-chevron-right"></i></a>
                    </div>
                    <div class="a_title col-4 p-0">
                        <h5>{{$Rdata->title}}</h5>
                    </div>
                    <div class="col-4 p-0">
                        <img src="{{url($Rdata->occasion->image)}}" alt="icon">
                    </div>
                </div>
            </div>
            <div class="inner_page" data-toggle="modal" data-target="#snapModal">
                <img src="{{url($Rdata->path)}}" alt="snap_image">

                <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> {{$Rdata->popular_count}}</span>
                  </div>

            </div>
            <div class="button-inner">
                <a href="#" data-toggle="modal" data-target="#snapModal">تحميل</a>
                <a href="#" data-toggle="modal" data-target="#snapModal2">مشاركة</a>
            </div>
        </div>
        <!-- end liked -->
    </div>
</div>
<!-- end main content -->

@stop
<!-- The Modal -->
<div class="modal fade" id="snapModal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
              @if(Session::has('MSISDN') && Session::get('Status') == 'active' )
                <i id="{{$Rdata->id}}" @if(check_favourtite(Session::get('MSISDN') , $Rdata->id)) class="far fa-heart heart active" @else class="far fa-heart heart" @endif></i>
              @endif
                <img src="{{url($Rdata->path)}}" alt="snap">

                <div class="view">
                    <i id="eye" class="fas fa-eye"></i> <span> {{$Rdata->popular_count}}</span>
                  </div>

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="#" data-dismiss="modal">{!! static_lang('close')?static_lang('close') : 'اغلق'  !!}</a>
                <a href="{{$Rdata->snap_link}}">استخدام العدسة</a>
            </div>
        </div>
    </div>
</div>

<!-- The Modal 2 -->
<div class="modal fade" id="snapModal2">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
                <a class="fab fa-facebook-square" href="https://www.facebook.com/sharer/sharer.php?u={{URL::current()}}" target="_blank"></a>
                <a class="fab fa-twitter-square" href="http://twitter.com/intent/tweet?url={{URL::current()}}" target="_blank"></a>
                <a class="fab fa-google-plus-square" href="https://plus.google.com/share?url={{URL::current()}}" target="_blank"></a>
                <a class="fab fa-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url={{URL::current()}}" target="_blank"></a>
                <a class="fab fa-pinterest-square" href="http://pinterest.com/pin/create/button?url={{URL::current()}}" target="_blank"></a>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <a href="#" data-dismiss="modal">اغلق</a>
            </div>
        </div>
    </div>
</div>
