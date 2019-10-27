@extends('front.template')
@section('content')
<?php $title = "الصور"; ?>
@if(count($greetingImgs)>0)
<div class="chooseitem filter" id="chooseimageitem">
    <div class="owl-carousel owl-theme">
        @if(count($occasions)>1)
        <div class="item">
            <a href="#all">
                <img src="{{ url('assets/front/images/category/1.jpg')}}"  alt="category">
                <h2 class="titlee">الكل</h2>
            </a>
        </div>
        @endif
        @foreach($occasions as $occasion)
        <div class="item @if(Occasion()==$occasion->id) active1 @endif">
            <a href="#occasion_{{$occasion->id}}">
                <img src="{{  url($occasion->image) }}"  alt="category">
                <h2 class="titlee">{{$occasion->title}}</h2>
            </a>
        </div>
        @endforeach        
    </div>
</div>
<!-- Gallery Content -->   
<div class="gallery check">
    @foreach($greetingImgs as $greetingImg)

    <a href="{{url('InputImage/'.$greetingImg->id.'/'.UID())}}" class="occasion_{{$greetingImg->occasion_id}} @if(Occasion()!= $greetingImg->occasion_id ) hide @endif"><img src="{{asset("$greetingImg->path")}}"></a>

    @endforeach


</div>
@else
<br/>
<div class="not-found">
    <img src="../img/sad.png" alt="sad">
    <h1 data-h1="لا يوجد محتوى" >لا يوجد محتوى</h1>
</div>
@endif
<div class="clearfix"></div>
<style>
    .add{
        display: none;
    }

</style>
<!-- ========================================================================= -->
@stop
@section('script')
<script>
    var numItems = $('.active1').length
    if (numItems == 0) {
        $(".item").first().addClass('active1');
        $(".gallery a").each(function () {
            $(this).removeClass('hide');
        });
    }
    $(".item").click(function () {
        $(".item").removeClass('active1');
    });
    $('a[href="{{url("imgs/".UID())}}"]').addClass('active_header');
</script>
@stop
