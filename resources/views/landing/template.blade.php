<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head>

 <meta charset="utf-8">
    <!--IE Compatibility Meta-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Mobile Meta-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>snap landing page</title>
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing')}}/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing')}}/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/front/landing')}}/css/main-style.css">
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
</head>

<body>
    
        @yield('section')

    <!-- loading -->
    <div class="loading-overlay">
        <div class="spinner">
            <img src="{{ url('assets/front/landing')}}/img/Snapchat-logo2.webp" alt="loading_snap">
        </div>
    </div>
    <!-- end loading -->

    <!-- script -->
    <script src="{{ url('assets/front/landing')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ url('assets/front/landing')}}/js/popper.min.js"></script>
    <script src="{{ url('assets/front/landing')}}/js/bootstrap.min.js"></script>
    <script src="{{ url('assets/front/landing')}}/js/script.js"></script>
        @yield('script')
</body>

</html>

