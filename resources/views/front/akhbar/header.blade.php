<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotana</title>
    <link rel="stylesheet" href="{{url('assets/front/akhbar/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/akhbar/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/akhbar/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/akhbar/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/akhbar/css/animate.css')}}">
    <link rel="stylesheet" href="{{url('assets/front/akhbar/css/style.css')}}">
    <base target="_parent">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <?php
      $dateString = date('Y-m-d H:i:s\Z');
      $serviceId = ServiceId;
      $ServiceAPIKey = ServiceAPIKey;
      $ServiceAPIPassword = ServiceAPIPassword;

      $message = $serviceId . $dateString;

      $signature = $ServiceAPIKey . ":" . hash_hmac("sha256", $ServiceAPIPassword, $message);
      $js = "http://bw.ghaneely.com/BWOHETest/HeaderHandler.ashx?service=" . $serviceId . "&date=" . $dateString . "&signature=" . $signature . "&demo=true&msisdn=201223872695";
    ?>

    <script src="<?php echo $js; ?>" type="text/javascript"></script>


    <script>
        function Binary_functions() {
            try {
              //Then to get MSISDN:
              var msisdn = HE.GetMSISDN();
              //For Operator Code:
              var operatorCode= HE.GetOperatorCode();
              //And for Referene number:
              var refNo = HE.GetRefrenceNo();
              return msisdn;
            } catch (e) {
              return false;
            }
        }

        function Binary_functions2() {
            var csrf = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                method: "POST",
                url: "{{url('AddSubscriptionContractRequest')}}",
                data: {
                    "MSISDN": HE.GetMSISDN(),
                    "operatorCode": HE.GetOperatorCode(),
                    "refNo": HE.GetRefrenceNo(),
                    'X-CSRF-TOKEN': csrf
                },

                success: function(result) {
                    data = JSON.parse(result);
                    if (data.val == 1) {
                        alert(data.message);
                    } else if (data.val == 2) {
                      alert(data.message);
                      $('body').html(data.html)
                    } else if (data.val == 4) {
                        alert("تم الاشتراك بنجاح");
                        window.location.href = "{{url('/"+data.message+"')}}";
                    } else {
                        // alert("fail unknow error");
                        alert("يوجد خطأ");
                    }
                },
                error: function() {
                    //  alert("ajax error");
                    alert("يوجد خطأ");
                }
            });

        }
    </script>


</head>

<body>
  <main class="new_rotana">
    <header class="header_head w-100">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="header_logo">
              <a href="{{url('/akhbar/'.uid())}}">
                <img class="d-block m-auto slide-in-fwd-bottom" src="{{url('assets/front/akhbar/images/Cutting/logo.png')}}" alt="Rotana Logo">
              </a>
            </div>
        </header>
