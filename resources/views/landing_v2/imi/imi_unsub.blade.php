<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
    <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mondia TimeWe landing page</title>
    <link rel="stylesheet" href='{{url('front/stc')}}/css/bootstrap.min.css'>
    <link rel="stylesheet" href='{{url('front/stc')}}/css/all.min.css'>
    <link rel="stylesheet" type="text/css" href="{{ url('front/stc/css/')}}/main-style_urdu.css">

</head>

<body>
    <div class="main_container">
        <div class="landing_page">

            <div class="strip">
                <h2 class="text-light">فلاتر</h2>
            </div>

            <div class="shbka">
                <div class="container">
                    <h3 class="text-light">الغاء الاشترك</h3>
                    <div class="zain_viva">
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
                        <div class="row justify-content-center">

                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="form_content">
                    <!--<h5>ادخل رقم الهاتف</h5>-->
                    <form method="post" action="{{url('subscriptions/unsubscription')}}"   onsubmit="document.getElementById('zain_submit').disabled='true';"  id="form_zain">
                        {{ csrf_field() }}
                        <div class="form-group form-inline">
                            <label for="phone"><span>{{phoneKey}}</span></label>
                            <input type="hidden" name="prev_url"
                                value="{{(isset($_REQUEST['prev_url'])?$_REQUEST['prev_url']:'')}}">
                            <input type="tel" class="form-control" @if(session()->has('msisdn')) value="{{session()->get('msisdn')}}" @endif id="phone"
                                placeholder="ادخل رقم تليفونك"
                                oninvalid="setCustomValidity('يجب ان تدخل 9 ارقام')" name="number" required
                                pattern="[0-9]{9}">
                            <span class="validity"></span>
                        </div>

                        <!--<button class="btn back">رجوع</button>-->
                        <button id="zain_submit" class="btn" type="submit">الغاء الاشتراك</button>
                    </form>
                    <!--<h5>للاشتراك يرجى الارسال الى <span>965</span></h5>
                <h5>الى <span>965</span><span> STOP1 </span>لالغاء الاشتراك ارسل</h5>-->
                </div>
            </div>

            <div class="cancel text-center mt-4 font-weight-bold">
                <p class="h4"><a class="btn-success p-1" href="{{url('imi/login')}}">للاشتراك</a></p>
            </div>

        </div>

    </div>
    <!-- script -->
    <script src="{{url('front/stc')}}/js/jquery-3.4.0.min.js"></script>
    <script src="{{url('front/stc')}}/js/bootstrap.min.js"></script>

    <script src="{{ url('front/stc')}}/js/popper.min.js"></script>
    <script src="{{ url('front/stc')}}/js/script_viva.js"></script>


    <script>
        $(document).ready(function(){
           var msisdn =   $("#phone").val() ;
            if(msisdn != "" && msisdn.length == 8 && msisdn!= "@_MSISDN"){
                $("#viva_form").submit();
             }
         });

        $('#zain_submit').focusin(function () {
            $('#viva_form').submit()
        });

    </script>

</body>

</html>
