@extends('landing_v2.template_zain_ksa')
@section('section')
<style>
  @font-face {
    font-family: myFont;
    src: url('{{url("assets/front/landing_v2/font/HelveticaNeueLTArabic-Bold.ttf")}}');
  }

  body {
    font-family: myFont;
  }

  @media (min-width: 1025px) and (max-width: 2000px) {
    .main_container {
      width: 30%;
      margin: 0 auto;
      display: block;
      position: unset;
      background-attachment: unset !important;
    }
  }

  .main_container {
    background-image: url('assets/front/landing_v2/img/snap_new_landing/zain_kuwait.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }

  .confirm_page img {
    z-index: -9;
    top: 85%;
    width: 35%;
  }

  .confirm_page .confirm .btn {
    background-color: #000;
  }

  .confirm_page .confirm {
    background-color: transparent;
  }

  .confirm_page .confirm {
    background-color: rgba(255, 255, 255, 0.6);
    margin: 15% auto !important;
    position: unset;
    top: unset;
    left: unset;
    margin-right: 0;
    transform: unset;
}

  .confirm form input {
    width: 80%;
  }
</style>

<div class="confirm_page">
  <img src="{{ url('assets/front/landing_v2')}}/img/logo.png" alt="snap">

  <div class="start_video" id="video">
    <!-- <video width="100%" poster="{{ url('assets/front/landing_v2')}}/video/snap2.jpg" id="my_audio" controls>
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/mp4">
          <source src="{{ url('assets/front/landing_v2')}}/video/New_VID.mp4" type="video/ogg">
        </video> -->

    <video style="object-fit: cover; height: 12.875rem;" width="100%" poster="{{ url('assets/front/landing_v2')}}/img/01.jpg" id="my_audio" controls>
      <source src="{{ url('assets/front/landing_v2')}}/img/snap_new_landing/New_VID.mp4" type="video/mp4">
      <source src="{{ url('assets/front/landing_v2')}}/img/snap_new_landing/New_VID.mp4" type="video/ogg">
    </video>
  </div>

  <div class="text-center mt-2">
    <!-- <h5>استمتع بوقتك مع فلاتر</h5> -->

    <h5 class="font-weight-bold">احصل علي فلاتر متجددة يومياً</h5>
    <h5 style="font-size: 1.10rem;">اكثر من 3000 فلتر حصري</h5>
  </div>

  <div class="container">
    <div class="confirm">

      @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('success')}}
      </div>
      @elseif(Session::has('failed'))
      <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('failed')}}
      </div>
      @endif

      <h2 style="font-size: 1.1rem;">ادخل كود التفعيل</h2>
      {!! Form::open(['url'=>'ZainKuwaitPinCodeSuccess','method'=>'post','class'=>'form','files'=>'true']) !!}
      <div class="form-group">
        <input type="tel" name="pincode" placeholder="ادخل كود التفعيل" class="form-control text-center" id="pincode" required>
      </div>
      <input type="hidden" name="msisdn" value="{{$msisdn}}">

      <button class="btn" type="submit">تاكيد</button>
      {!! Form::close() !!}
    </div>
  </div>

  <div id="loginModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-right">
          <div class="alert alert-success" role="alert">تم تاكيد الكود بنجاح</div>
        </div>
      </div>
    </div>
  </div>

</div>

@stop
