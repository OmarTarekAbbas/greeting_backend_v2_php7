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
        }

        section.container {
            cursor: pointer;
            padding: 0;
            margin: 0;
        }

        section .landing_img {
            text-decoration: none;
            width: 100%;
            height: 100%;
            background-image: url('assets/front/zain_iraq_landing/landing_page.jpg');
            background-size: 100% 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            position: fixed;
        }
    </style>
</head>

<body>
    <section class="container">
        <div class="row">
            <div class="col-12">
                <div class="landing_img"></div>
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