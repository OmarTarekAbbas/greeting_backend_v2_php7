<!-- Start Header -->
@include('front.rotanav2.header')
<!-- End Header -->
<style>
    .footer_head{
        display: none;
    }

    .pd_page form p {
        font-size: 25px;
        margin-bottom: 0px;
        font-weight: bold;
        color: #bf9434;
        direction: rtl;
    }
    .pd_page form input {
        margin-top: 15px;
    }
    .dis ul li {
        margin-bottom: 10px;
        color: white;
    }
    .pag_color{
        color: white;
    }
</style>
<div class="confirm_page">

        <div class="content">
                <center>
                    <div class="container">
                        <h4 style='margin-top: 0; color: #ffffff; font-weight: 400'>خدمه روتانا</h4>
                        <div class="pd_page" id="div_wifi_box">
                            <div class="clearfix"></div>

                            {{-- @include('partial.landing_flash')--}}

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


                            {!! Form::open(['url'=>'ConfirmPinCode','method'=>'post','class'=>'form','files'=>'true']) !!}
                            <div class="form-group" id="wifi_login_subscribe_form">
                                <p>ادخل كود التفعيل:</p>

                                <input type="hidden"  name="msisdn" value="{{$msisdn}}">

                                <input type="number" name="pincode" id="pincode" required pattern="[0-9]{5}" class="form-control center-block margb" style="direction: ltr; width: 200px">

                                <input type="submit" value="تاكيد" class="btn"
                                    style=" background-color: #b8881d; color: white; width: 100px; font-size: 25px; margin-bottom: 0;" />

                            </div>
                            {!! Form::close() !!}

                            <div class="dis">
                                <ul>
                                    <li><p class="pag_color">يمكنك الغاء الاشتراك عن طريق هذا <a href="{{url('Orange_unsub')}}" style="color: #007bff;"> الرابط </a> </p></li>
                                    {{-- <li>برجاء إرسال اى أسئلة أو شكاوى عن الخدمة إلى support@flatter.ivascloud.com</li> --}}
                                </ul>
                            </div>


                        </div>
                    </div>
                </center>

            </div>



    <div id="loading_image" style="text-align: center;display: none;">
        <img class="logo" src="{{asset('landing_page/img')}}/logo.png" alt="">
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
<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->
