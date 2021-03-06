<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <!-- font awesome -->
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />

    <!--my styles -->
    <link href="{{asset('css/base.css')}}" rel="stylesheet" type="text/css"/>
    <!--<link href="{{asset('css/styles.css')}}" rel="stylesheet" type="text/css"/>-->
    <link href="{{asset('css/vendor/image-picker.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/flat/layout.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/flat/config.css')}}" rel="stylesheet" type="text/css"/>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('js/image-picker.min.js')}}"></script>
    <!--<script src="{{asset('js/ajaxForm.js')}}"></script-->
    @yield('style')

</head>
<body>
<!--<div class="pageLoader"><img src="{{asset('img/oval.svg')}}"/></div>-->
<section class="mainSection">
    <header class="mainHeader">
        <div class="greeting_logo"><h1>بطاقة التهنئة</h1></div>
        <div class="operator_logo"></div>
        <div class="help"></div>
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

<script src="{{asset('js/multiForm.js')}}"></script>
<script src="{{ asset('js/player.js') }}"></script>
<script>
    $(function() {
        $('.pageLoader').hide();
        //$('#audio input[type="button"],#picture input[type="button"] ').hide();
        //initiate ajax form
        //$Form($('.ajax-select'));
        //show loading on submiting form
        $('#greetingForm').submit(function(){
            $('#submit').val('تحميل');
            var imgSrc = $('#submit').attr('data-img-src');
            var bgColor = $('#submit').css("background-color");
            console.log(bgColor);
            $('#submit').css({"background":bgColor+"url("+imgSrc+") no-repeat 8px center",
                "background-size":"24px"
            });
        });

        $('form').on('click','.errors i',function(){
            $(this).parent().remove();
        });
        /*$('.errors i').click(function(){
            $(this).parent().fadeOut();
        });*/



    });
</script>




<script>
    $(document).ready(function(){
      // bt default we cant make click event on select and the only way is on change event so we make :
      // Click event on select option element in chrome
        // link :  https://stackoverflow.com/questions/1402227/click-event-on-select-option-element-in-chrome
        $('#choosePicture').val('value').change();



       
        $('#choosePicture').on('change', function (e) {
            $("#continue").click();

        });



        $('input:radio').on('click', function (e) {
            $("#audio_next").click();
        });

    });
</script>

@yield('script')
</body>
</html>