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
      color: #fff;
      width: 58%;
      margin: 0 auto;
    }

    section .landing_img .section_two p {
      margin: 0 auto;
    }

    section .landing_img .section_two div.h_6 {
      font-size: medium;
      margin-bottom: 1rem;
      margin-top: 3rem;
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
            <p class="w-75 text-center mt-5 mb-2 text-white h4">للاسف لم يتم اشتراكك في خدمة فلاتر</p>

            <div class="h_6 text-center p-1 w-75">للاشتراك ارسل 1 الى 2680</div>
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
