<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing</title>


    <link rel="stylesheet" type="text/css"  href="{{url('home/font.css')}}" >

    @yield('main_css')

    @yield('ar_css')


    <!--[if lt IE 9]>
    <script src="{{url('home/js/html5shiv.min.js')}}"></script>
    <script src="{{url('home/js/respond.min.js')}}"></script>
    <![endif]-->
    <script type="text/javascript">
        function showOperatorForm(operator_name) {

            if (operator_name == "oreedo") {
                // alert("oredo");
                $("#zain_kuwait").hide();
                $("#viva_kuwait").hide();
                $("#oreedo_kuwait").fadeIn(500);  // show ooredoo
                $("#orze").hide();
                $("#changeOP").hide();
            } else if (operator_name == "viva") {

              //  $("#zain_kuwait").hide();
             //   $("#oreedo_kuwait").hide();
              //  $("#viva_kuwait").fadeIn(500);  // show viva
             //   $("#orze").hide();
              //  $("#changeOP").hide();

                var viva_url = "http://ikwm-appvas.isys.mobi:2017/webchannel/Consent.aspx?MSISDN=964xxxx&ChannelID=1211&ServiceID=221&ImageURL=&CPWEBChannelID=3&INITAction=True"
                window.location.href = viva_url;

        }else{
               // alert("zain");
               $("#oreedo_kuwait").hide();
                $("#viva_kuwait").hide();
               $("#zain_kuwait").fadeIn(500);  // show zain
               $("#orze").hide();
               $("#changeOP").hide();
           }


        }
        
        
        function  vivaRedirect() {
            var viva_url = "http://ikwm-appvas.isys.mobi:2017/webchannel/Consent.aspx?MSISDN=964xxxx&ChannelID=1211&ServiceID=221&ImageURL=&CPWEBChannelID=3&INITAction=True"
            window.location.href = viva_url;



    /*
 //
   - for talal :
            http://ikwm-appvas.isys.mobi:2017/webchannel/Consent.aspx?MSISDN=965KVIVAS&ChannelID=1202&ServiceID=224&ImageURL=&CPWEBChannelID=1&INITAction=True

 - for landing :
     http://ikwm-appvas.isys.mobi:2017/webchannel/Consent.aspx?MSISDN=96451408560ChannelID=1211&ServiceID=221&ImageURL=&CPWEBChannelID=1&INITAction=True

     */


        }

    </script>
</head>
<body>

@yield('content')




<!--=============================== End-Term================================-->
<script src="{{url('home/js/jquery-2.0.2.min.js')}}"  type="text/javascript"></script>
<script src="{{url('home/js/bootstrap.min.js')}}"  type="text/javascript"></script>
<script src="{{url('home/js/main.js')}}"  type="text/javascript"></script>
<script src="{{url('home/js/wow.min.js')}}"  type="text/javascript"></script>
<script src="{{url('home/js/unsub.js')}}"  type="text/javascript"></script>

      <script>
         wow = new WOW(
           {
             animateClass: 'animated',
             offset:       100,
             callback:     function(box) {
               console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
             }
           }
         );
         wow.init();



      </script>


<script>
   //  fullUrl = '{{ Request::fullUrl()  }}' ;
    fullUrl = '{{url('/')}}' ;

   currentUrl =  '{{ Request::url() }}'  ;

    </script>

@if(Session::has('message'))

    <script>
        $("#myModal").modal("show");
        $("#myModal_zain_subscribe").modal("show");
        if( currentUrl != fullUrl ){
            $('#myModal').on('hidden.bs.modal', function () {
                location.href = "{{url('/')}}"  ;
            })
        }

        $('.unsubModel').on('hidden.bs.modal', function () {
            location.href = "{{url('/')}}"  ;
        })


        $('.myModalOreddoSub').on('hidden.bs.modal', function () {
            location.href = "{{url('/')}}"  ;
        })


    </script>

@endif


@if(Session::has('error'))
  {{--  <link rel="stylesheet" type="text/css" href="{{url('home/css/bootstrap-ar.css')}}">--}}
   <script>
        $("#myModal").modal("show");
        if( currentUrl != fullUrl ){
            $('#myModal').on('hidden.bs.modal', function () {
                location.href = "{{url('/')}}"  ;
            })
        }


        $('.unsubModel').on('hidden.bs.modal', function () {
            location.href = "{{url('/')}}"  ;
        })
   </script>

@endif





</body>
</html>




