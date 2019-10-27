<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <link href="{{asset('css/vendor/foundation/css/foundation.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/base.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/vendor/image-picker.css')}}" rel="stylesheet" type="text/css"/>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('js/image-picker.min.js')}}"></script>
    <!--<script src="{{asset('js/ajaxForm.js')}}"></script-->
    @yield('style')

</head>
<body>
<div class="pageLoader"><img src="{{asset('img/oval.svg')}}"/></div>
<section class="mainSection">
    <header class="mainHeader">
        <div class="logo"><h1>Greeting</h1></div>
    </header>
    @yield('form')


</section>
<!--<footer class="pageFooter">
    <div class="copyright cf">
        <div class="ivas-logo">
            <img src="img/ivas_logo.png" />
        </div>
    </div>
</footer>-->

<script src="js/multiForm.js"></script>
<script src="js/player.js"></script>
<script>
    $(function() {
        $('.pageLoader').hide();
        //$('#audio input[type="button"],#picture input[type="button"] ').hide();
        //initiate ajax form
        //$Form($('.ajax-select'));
        //show loading on submiting form
        $('#greetingForm').submit(function(){
            $('#submit').val('تحميل');
            $('#submit').css({"background":"#01BBF3 url('img/ring.svg') no-repeat 5px center",
                "background-size":"24px"
            });
        });
    });
</script>
@yield('script')
</body>
</html>