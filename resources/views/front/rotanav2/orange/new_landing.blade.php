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
    .hemodal{
        display: none;
        text-align: center;
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: #d0be9d85;
        padding: 20px;
    }
    .hemodal div{
        margin-top: 50%;
    }
</style>
    <body>

    <div id="new_subscriber" class="modal" id="exampleModalCenter" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="new_sub">

            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">أنت غير مشترك في الخدمة</h5>

                    </div>
                    <div class="modal-body">
                        للإشتراك اضغط على اشتراك
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-success" style="margin-right: 40%;"
                                onclick="TPay_functions()">إشتراك</button>
                    </div>

                    <div class="dis">
                        <ul>
                            <p class="pag_color">يمكنك الغاء الاشتراك عن طريق هذا <a  href="{{url('Orange_unsub')}}" style="color: #007bff;"> الرابط </a> </p>
                            <li>برجاء إرسال اى أسئلة أو شكاوى عن الخدمة إلى support@flatter.ivascloud.com</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="loading_image" style="text-align: center;display: none;">
        <img src="{{asset('landing_page/img')}}/loading.gif" alt="" width="200" height="200" />
    </div>


    <div class="content">
        <center>
            <div class="container">
                <h4 style='margin-top: 0; color: #ffffff; font-weight: 400'>خدمه روتانا</h4>
                <div class="pd_page" id="div_wifi_box">
                    <div class="clearfix"></div>
                    <div  style="margin: auto ; width: 80%">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                {{ Session::get('success')}}
                            </div>
                        @elseif(Session::has('failed'))
                            <div class="alert alert-danger alert-dismissible">
                                {{ Session::get('failed')}}
                            </div>
                        @endif

                    </div>
                    {{-- @include('partial.landing_flash')--}}

                    {!! Form::open(['url'=>"AddSubscriptionContractRequest",'method'=>'post']) !!}
                    <div class="form-group" id="wifi_login_subscribe_form">
                        <p>أدخل رقم هاتفك:</p>

                        <input name="MSISDN" type="number" placeholder="XXXXXXXXXXX" onKeyPress="if (this.value.length == 12)
                                            return false;" required class="form-control center-block margb"
                               style="direction: ltr; width: 200px">

                        <input type="submit" value="إشترك" class="btn"
                               style=" background-color: #b8881d; color: white; width: 100px; font-size: 25px; margin-bottom: 0;" />

                    </div>
                    {!! Form::close() !!}


                    <div class="dis">
                        <ul>
                           <li><p class="pag_color">يمكنك الغاء الاشتراك عن طريق هذا <a href="{{url('Orange_unsub')}}" style="color: #007bff;"> الرابط </a> </p></li>
                            <li class="pag_color">برجاء إرسال اى أسئلة أو شكاوى عن الخدمة إلى support@flatter.ivascloud.com</li>
                        </ul>
                    </div>


                </div>
            </div>
        </center>

    </div>

    <div class="hemodal text-light">
        <div class="text-center bg-dark p-3 rounded shadow">
            <h4>مرحبا في خدمة روتانا فلاتر</h4>
            <h6>هل تريد المتابعة برقم </h6>
            <p id="hemsisdn"></p>
            <a class="btn btn-success" onclick="Binary_functions2()">تسجيل الدخول</a>
        </div>
    </div>

<!-- Start Footer -->
@include('front.rotanav2.footer')
<!-- End Footer -->

