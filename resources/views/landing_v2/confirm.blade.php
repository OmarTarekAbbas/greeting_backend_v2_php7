@extends('landing_v2.template')
@section('section')
<div class="confirm_page">
    <img src="{{ url('assets/front/landing_v2')}}/img/logo.png" alt="snap">

    <div class="container">
        <div class="confirm">
            <h2>لتاكيد الاشتراك</h2>
            <hr>
            <span>سوف يتم خصم</span>
            <span>١٠٠ فلس يوميا</span>
            <span>نظير الاشتراك في خدمة <br>فلاتر سناب شات</span>
            <a class="btn" href="{{url('pincode')}}">استمرار</a>
            <p>عند الضغط على استمرار سيتم الاشتراك فى خدمة <br>فلاتر سناب شات</p>
        </div>
    </div>
</div>
@stop
