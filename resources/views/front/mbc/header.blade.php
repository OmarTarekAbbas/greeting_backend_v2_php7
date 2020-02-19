<!DOCTYPE html>
<html lang="en">

<head>
	<title>خدمة ام بي سي </title>
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
	<link rel="stylesheet" href="{{url('assets/front/mbc/')}}/css/all.min.css">
	<!-- Owl Carousel CSS-->
	<link rel="stylesheet" href="{{url('assets/front/mbc/')}}/css/owl.carousel.min.css">
	<link rel="stylesheet" href="{{url('assets/front/mbc/')}}/css/owl.theme.default.css">
	<!-- Animate CSS-->
	<link rel="stylesheet" href="{{url('assets/front/mbc/')}}/css/animate.css">
	<!-- Animate CSS-->
	<link rel="stylesheet" href="{{url('assets/front/mbc/')}}/css/magic.css">
	<!-- Style CSS-->
	<link rel="stylesheet" href="{{url('assets/front/mbc/')}}/css/style.css">
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
					<div class="logo-title  ">
						<img class="rounded-0" src="{{url('assets/front/mbc/')}}/images/Logo.png" alt="mbc Flater Logo">
					</div>

				</div>
			</div>
		</header>
		<!-- header -->
		@yield('content')

		<!-- loading -->
		<div class="loading-overlay">
			<div class="spinner">
				<img src="{{url('assets/front/mbc/')}}/images/logos/logo_1.png" alt="loading">
			</div>
		</div>
	</div>
	<!-- end loading -->

	<!-- footer -->
	<footer>
		<div class="footer">
			<div class="container-fluid">
				<div class="row">
					<div class="col-4">
						<a href="{{url('mbc/occasion/'.UID())}}">
							<div class="f-nav">
								<i class="fas fa-list-ul"></i>
								<span>{!! static_lang('tasnefat')?static_lang('tasnefat') : 'التصنيفات'  !!}</span>
							</div>
						</a>
					</div>
					<div class="col-4">
						<a href="{{url('favourites_mbc/'.UID())}}">
							<div class="f-nav">
								<i class="far fa-heart"></i>
								<span>{!! static_lang('fav')?static_lang('fav') : 'المفضلة'  !!}</span>
							</div>
						</a>
					</div>
					<div class="col-4">
						<a href="{{url('mbc/'.UID())}}">
							<div class="f-nav">
								<i class="fas fa-home"></i>
								<span>{!! static_lang('homee')?static_lang('homee') : 'الرئيسية'  !!}</span>
							</div>
						</a>
					</div>
				</div>
			</div>
		</footer>
		<!-- end footer -->

		<!-- script -->

		<!-- jQuery JS -->
		<script src="{{url('assets/front/mbc/')}}/js/jquery-3.3.1.min.js"></script>
		<!-- Bootstrap Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<!-- <script src="js/popper.min.js"></script> -->
		<!-- Bootstrap JS -->
		<!-- <script src="js/bootstrap.min.js"></script> -->
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<!-- Woow JS -->
		<script src="{{url('assets/front/mbc/')}}/js/wow.min.js"></script>
		<!-- Owl Carousel JS -->
		<script src="{{url('assets/front/mbc/')}}/js/owl.carousel.min.js"></script>
		<!-- Script JS -->
		<script src="{{url('assets/front/mbc/')}}/js/script.js"></script>

	</div>
	@yield('script')
</body>

</html>
