<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zain Iraq</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ url('assets/front/zain_iraq_landing/bootstrap.min.css')}}">

  <style>
    body {
      padding: 0;
      margin: 0;
      width: 100%;
      height: 100%;
      /* overflow-y: scroll; */
      background-image: url('assets/front/zain_iraq_landing/BG.png');
      background-size: 100% 100%;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed
    }

    section.container {
      cursor: pointer;
      padding: 0;
      margin: 0;
    }

    section .landing_img {
      text-decoration: none;
      width: 100%;
    }

    section .landing_img .section_two .h_6 {
      background-color: #ffefe1;
      color: #e16d32;
      width: 58%;
      margin: 0 auto;
      border-radius: 0.75rem;
    }

    section .landing_img .section_two div.h_6 {
      font-size: small;
      margin-bottom: 1rem;
      margin-top: 1rem;
    }

    @media (min-width: 320px) and (max-width: 359.98px) {
      .copy {
        position: unset !important;
      }
    }
  </style>
</head>

<body>
  <section class="container">
    <div class="row m-0">
      <div class="col-12 p-0">
        <div class="landing_img">
          <div class="section_one">
            <img class="w-100" src="assets/front/zain_iraq_landing/mob.png" alt="">
          </div>

          <div class="section_two">
            <p class="w-100 text-center mt-3 text-white h5">مكتبة تضم اكثر من</p>

            <h6 class="h_6 p-2 text-center h5" dir="rtl">3000 سناب شات فلتر</h6>

            <p class="w-100 text-center mt-3 text-white">اهلا بك في خدمة فلاتر من زين العراق</p>
            <img class="w-50 m-auto d-block" src="assets/front/zain_iraq_landing/zain.png" alt="">
            <div class="h_6 text-center p-1 w-75">سوف تحصل على يوم واحد مجاني عند الاشتراك</div>
            <p class="w-75 m-auto mb-3 text-center text-white">سعر الخدمة 240 دينار عراقي للرسالة الواحدة المستلمة بعد انتهاء الفترة المجانية. لالغاء الاشترا ك ارسل 0 الى 2680</p>
          </div>

          <div class="copy text-capitalize text-center text-white w-100" style="font-size: x-small; position: fixed; bottom: 0;">Copy &copy; 2020 digi zone all rights reserved</div>
        </div>
      </div>
    </div>
  </section>


  <!-- ========================= Scripts Files ========================= -->
  <!-- jQuery -->
  <script src="{{ url('assets/front/js/jquery-3.2.1.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{ url('assets/front/zain_iraq_landing/bootstrap.min.js')}}"></script>
  <!-- ========================= Scripts Files ========================= -->
</body>

</html>
