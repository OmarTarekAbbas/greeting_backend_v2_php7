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
    <div class="confirm_page">
        <img src="img/logo1.png" alt="snap">

        <div class="container">
            <div class="confirm">
                <h2>ادخل كود التفعيل</h2>
                <hr>
                <form action="#">
                    <div class="form-group">
                        <input type="text" class="form-control" id="code" placeholder="" name="code" required pattern="[0-9]{5}">
                    </div>
                    <button class="btn" type="submit" data-toggle="modal" data-target="#loginModal">تاكيد</button>
                </form>
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
    </div>
</body>

</html>
