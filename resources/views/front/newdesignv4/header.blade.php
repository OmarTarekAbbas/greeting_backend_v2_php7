<!DOCTYPE html>
<html lang="en">

<head>
	<title>خدمة فلاتر </title>
	<meta charset="utf-8">
	<!--IE Compatibility Meta-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- SEO Engine -->
	<meta name="keywords" content="Snap , Filter , سناب , فلاتر , صور , Images">
	<meta name="description" content="يقدم خدمة سناب عمل مؤثرات على الصور">
	<meta name="title" content="يقدم خدمة سناب عمل مؤثرات على الصور" />
	<!-- for phons -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- links -->
	<!-- Bootstrap CSS-->
	<!-- <link rel="stylesheet" href='css/bootstrap.min.css'> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<!-- Fontawesome CSS-->
	<link rel="stylesheet" href="{{url('assets/front/newdesignv4/')}}/css/all.min.css">
	<!-- Owl Carousel CSS-->
	<link rel="stylesheet" href="{{url('assets/front/newdesignv4/')}}/css/owl.carousel.min.css">
	<link rel="stylesheet" href="{{url('assets/front/newdesignv4/')}}/css/owl.theme.default.css">
	<!-- Animate CSS-->
	<link rel="stylesheet" href="{{url('assets/front/newdesignv4/')}}/css/animate.css">
	<!-- Animate CSS-->
	<link rel="stylesheet" href="{{url('assets/front/newdesignv4/')}}/css/magic.css">
	<!-- Style CSS-->
	<link rel="stylesheet" href="{{url('assets/front/newdesignv4/')}}/css/style.css">
    <style>
    .yousefh3 {
        font-size: 6vw;
    }
    </style>

</head>

<body>
	<div class="main_container">
		<!-- header -->
		<header>
			<div class="row">
				<div class="col-3">
					<div class="h_arrow">
						<a class="arrow_back back" href="#">
							<i class="fas fa-angle-left fa-lg"></i>
						</a>
					</div>
				</div>

				<div class="col-9">
					<div class="logo-title pulsate-bck ">
						<a href="{{url('newdesignv4/'.UID())}}">
              <img class="rounded-0" src="{{url('assets/front/newdesignv4/')}}/images/FALATR_LOGO.png" alt="Falater Logo">
            </a>
					</div>
				</div>
			</div>
		</header>
		<!-- header -->
		@yield('content')

		<!-- loading -->
		<div class="loading-overlay">
			<div class="spinner">
				<img src="{{url('assets/front/newdesignv4/')}}/images/logos/logo_1.png" alt="loading">
			</div>
		</div>
	</div>
	<!-- end loading -->
	@php

	if (session()->has('currentOp')) {
		if(session()->get('currentOp') == 14 || session()->get('currentOp') == 16){
			$class = 'col-3';
			$display = 'block';
		}else {
			$class = 'col-4';
			$display = 'none';
		}
	} else {
		$class = 'col-4';
		$display = 'none';
	}

	@endphp
	<!-- footer -->
	<footer>
		<div class="footer">
			<div class="container-fluid">
				<div class="row">
					<div class="{{$class}}">
						<a href="{{url('newdesignv4/occasion/'.UID())}}">
							<div class="f-nav">
								<i class="fas fa-list-ul"></i>
								<span>{!! static_lang('tasnefat')?static_lang('tasnefat') : 'التصنيفات'  !!}</span>
							</div>
						</a>
					</div>
					<div class="{{$class}}">
						<a href="{{url('favourites/'.UID())}}">
							<div class="f-nav">
								<i class="far fa-heart"></i>
								<span>{!! static_lang('fav')?static_lang('fav') : 'المفضلة'  !!}</span>
							</div>
						</a>
					</div>
					<div class="{{$class}}">
						<a href="{{url('newdesignv4/'.UID())}}">
							<div class="f-nav">
								<i class="fas fa-home"></i>
								<span>{!! static_lang('homee')?static_lang('homee') : 'الرئيسية'  !!}</span>
							</div>
						</a>
					</div>
					<div class="{{$class}}" style="display: {{$display}}">
						<a href="{{url('newdesignv4/logout/'.UID())}}">
							<div class="f-nav">
								<i class="fas fa-sign-out-alt    "></i>
								<span>{!! static_lang('logout')?static_lang('logout') : 'الخروج'  !!}</span>
							</div>
						</a>
					</div>
				</div>
			</div>
		</footer>
		<!-- end footer -->

		<!-- script -->

		<!-- jQuery JS -->
		<script src="{{url('assets/front/newdesignv4/')}}/js/jquery-3.3.1.min.js"></script>
		<!-- Bootstrap Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<!-- <script src="js/popper.min.js"></script> -->
		<!-- Bootstrap JS -->
		<!-- <script src="js/bootstrap.min.js"></script> -->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<!-- Woow JS -->
		<script src="{{url('assets/front/newdesignv4/')}}/js/wow.min.js"></script>
		<!-- Owl Carousel JS -->
		<script src="{{url('assets/front/newdesignv4/')}}/js/owl.carousel.min.js"></script>
		<!-- Script JS -->
		<script src="{{url('assets/front/newdesignv4/')}}/js/script.js"></script>

	</div>


  <!-- <script type="text/javascript">
    if (screen.width <= 1025) {
      // document.location.href = "{{url('front.home')}}";
    }
  </script> -->

  <div class="the-frame">
    <iframe class="full-screen-preview__frame" src="{{url()->full()}}" name="preview-frame" frameborder="0" noresize="noresize" data-view="fullScreenPreview" style="height: 570px; width: 370px; border-radius: 10px;">
    </iframe>
  </div>
	@yield('script')
</body>

</html>
