@extends('front.landing_template')

@section('content')
<div id="page" class="text-center">

    <div class="content-container">

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            {{ Session::get('success')}}
        </div>
        @elseif(Session::has('failed'))
        <div class="alert alert-danger alert-dismissible">
            {{ Session::get('failed')}}
        </div>
        @endif

        <!-- HERE IS CONTENTS -->
        {!! Form::open(['url'=>"SendSubscriptionCancellationPinSMS",'method'=>'post', 'id'=>'directUnsubsHEDiv']) !!}
        <div class="pages login-page">
            <div class="maleo-card signup animated fadeInUp">
                <img class="logo" src="{{asset('landing_page/img')}}/Snapchat-logo.png" alt="">
                <h4 style='margin-top: -18px; color: #992d15;'>خدمة فلاتر</h4>
                <h2 class="maleo-card_title big-title text-center">الغاء الاشتراك</h2>
                <div class="form-content">
                    <p class="app-desc">من فضلك! أدخل رقم التليفون, ثم أضغط تأكيد</p>
                    <div class="input-field with-icon"><span class="icon"><i class="fa fa-phone"></i></span>
                        <input id="login" type="number" class='form-control' style='direction: ltr; width: 200px; margin: auto;' onKeyPress="if(this.value.length==12) return false;" name="MSISDN" placeholder="رقم التليفون"></div>
                    <button class="btn-large btn block margin-bottom" type="submit">تأكيد</button>

                    {{-- <span class="app-desc">ليس لديك حساب؟ <a class="primary-text" href="{{url('register')}}">تسجيل جديد</a></span>--}}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <!-- //HERE IS CONTENTS -->


        <div class="ptb--200 showw" style="display: none;"></div>

    </div>
</div>
@stop



@section('remove_susbcribe_fancy')
<script>
    $(document).ready(function() {
        $("#new_subscriber").css("display", "none");
    });
</script>


<script>
    $(document).ready(function() {

        // $("#new_subscriber").css("display","block");
        // $('#login_form').css("display",'none') ;


        if (window.TPay && TPay.HeaderEnrichment && TPay.HeaderEnrichment.enriched()) { // 1- TPay.HeaderEnrichment.enriched
            TPay.HeaderEnrichment.hasSubscription("", function(hasSub, subId) { // 2 -TPay.HeaderEnrichment.hasSubscription

                if (!hasSub) { // not subscriber  [ new register]
                    window.location.href = "/login";
                } else { // already subscriber ... so make auto login
                    /* $("#directUnsubsHEDiv").hide(function(){
                     $(".showw").show();
                     }) ;*/

                    $("#directUnsubsHEDiv").hide();
                    $(".showw").show();


                    var conf = confirm("أنت علي وشك الغاء الاشتراك");
                    if (conf == true) {
                        login_data = {
                            "contract_id": subId,
                            "_token": "{{csrf_token()}}"
                        };
                        // alert(subId) ;
                        $.ajax({
                            method: "POST",
                            url: "{{url('/directUnsubscribeWithHE')}}",
                            data: login_data,
                            success: function(result) {
                                data = JSON.parse(result);
                                if (data.val == 2 || data.val == 3) { // error messages
                                    alert(data.message);
                                } else if (data.val == 1) {
                                    alert(data.message);
                                    window.location.href = "{{url('/')}}";
                                } else {
                                    alert("حدث خطأ");
                                }

                            }
                        });

                    } else {
                        alert("لم يتم الغاء الاشتراك");
                        window.location.href = "{{url('/')}}";
                    }


                }
            });
        } else {


        }
    });
</script>
@stop