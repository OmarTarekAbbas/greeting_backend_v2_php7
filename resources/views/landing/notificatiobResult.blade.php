@extends('landing.template_1')
@section('section')
<div class="confirm_page">
    <img src="{{ url('assets/front/landing')}}/img/Snapchat-logo2.webp" alt="snap">

    <div class="container">
        <div class="confirm">
            <h2>خدمة فلاتر</h2>
            <h6>{{$operator_name}}</h6>
            <hr>
            <span>{{$message}}</span>

            <a class="btn" href="{{url('landing')}}">الرئيسية</a>
        </div>
    </div>
</div>
@stop