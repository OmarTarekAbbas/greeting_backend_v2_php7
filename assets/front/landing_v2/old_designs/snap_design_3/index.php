<!DOCTYPE html>
<html lang="en" style="height:100%;">

<head>
    <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>snap landing page</title>
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main-style.css">
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
</head>

<body>
    <div class="landing_page">
        <img class="logo" src="img/logo1.png" alt="snap">
        <!--<h6>فلاتر سناب شات</h6>-->

        <img class="slogo" src="img/slogo2.png" alt="">

        <div class="shbka">
            <div class="container">
                <p>اختار شبكتك و اشترك في خدمة فلاتر سناب شات</p>
                <div class="zain_viva">
                    <div class="row">
                        <div class="col-4">
                            <img src="img/viva.png" id="viva">
                        </div>

                        <div class="col-4">
                            <img src="img/zain.png" id="zain">
                        </div>

                        <div class="col-4">
                            <img src="img/ooredoo.png" id="ooredoo">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="form_content">
                <h5>ادخل رقم الهاتف</h5>
                <form action="confirm.php">
                    <div class="form-group form-inline">
                        <label for="phone">50663</label>
                        <input type="text" class="form-control" id="phone" placeholder="000-000-000" name="phone" required pattern="[0-9]{9}">
                        <span class="validity"></span>
                    </div>
                    <button class="btn" type="submit">اشترك</button>
                </form>
                <h5>للاشتراك يرجى الارسال الى 50663</h5>
                <h5>الى 50663<span> STOP1 </span>لالغاء الاشتراك ارسل</h5>
            </div>
        </div>
    </div>

    <!-- loading -->
    <div class="loading-overlay">
        <div class="spinner">
            <img src="img/logo1.png" alt="loading_snap">
        </div>
    </div>
    <!-- end loading -->


    <!-- script -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>
