<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
    <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>snap Pin page</title>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing_v2')}}/css/main-style_ooredoo.css">
</head>

<body class="main_container">
    <div class="start_video" id="video">
        <video width="100%" autoplay muted loop="true">
            <source src="{{ url('assets/front/landing_v2')}}/video/1.mp4" type="video/mp4">
        </video>
    </div>

    <div class="confirm_page">

    <div class="container">

        <div class="confirm" style="top:55%">

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
           {!! Form::open(['url'=>'subscription/confirm/'.partnerRoleId,'method'=>'post','class'=>'form']) !!}
                <div class="form-group">
                      <input type="tel" style="font-family: cursive" name="pincode" class="form-control" id="pincode" required pattern="[0-9]{4}">
                </div>
                <button class="btn" type="submit" >تاكيد</button>
             {!! Form::close() !!}
             <h6>ان لم تصلك رسالة تأكيد يرجي الضغط علي هذا <a href="{{url('ooredoo_qatar_landing' )}}">الرابط</a></h6>
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



    <!-- loading -->
    <div class="loading-overlay">
        <div class="spinner">
            <img src="{{ url('assets/front/landing_v2')}}/img/logo.jpg" alt="loading_snap">
        </div>
    </div>
    <!-- end loading -->
</div>
<!-- script -->
<script src="{{ url('assets/front/landing_v2')}}/js/jquery-3.3.1.min.js"></script>
<script src="{{ url('assets/front/landing_v2')}}/js/popper.min.js"></script>
<script src="{{ url('assets/front/landing_v2')}}/js/bootstrap.min.js"></script>
<script src="{{ url('assets/front/landing_v2')}}/js/script_ooredoo.js"></script>

<script type="text/javascript">
$(document).ready(function(){
       var msisdn = $("#phone").val() ;
       if(msisdn != ""){
           $('#form').submit()
       }
});
</script>

</body>
</html>
