@extends('landing_v2.template_zain_ksa')
@section('section')
<style>
  @media (min-width: 1025px) {
    body {
      background-image: url('{{url("assets/front/landing_v2/img/snap_new_landing/BG.jpg")}}');
    }
  }
  .main_container {
    background-image: url('assets/front/landing_v2/img/snap_new_landing/BG.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
  }

  .confirm_page .confirm {
    top: 64%;
  }

  .confirm form input {
    width: 80%;
}
</style>

  <div class="confirm_page">
    <img src="{{ url('assets/front/landing_v2')}}/img/logo.png" alt="snap">

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

            <h2>ادخل كود التفعيل</h2>
            <hr>
           {!! Form::open(['url'=>'zain_ksa_pincode_confirm','method'=>'post','class'=>'form','files'=>'true']) !!}
                <div class="form-group">
                      <input type="tel" name="pincode" placeholder="ادخل كود التفعيل" class="form-control text-center" id="pincode" required>
                </div>
                <input type="hidden"  name="msisdn" value="{{$msisdn}}">

                <button class="btn" type="submit" >تاكيد</button>
             {!! Form::close() !!}
        </div>
    </div>

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
