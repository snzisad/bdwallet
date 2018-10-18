<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Unicat project">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- unicat css files -->
	<link rel="stylesheet" type="text/css" href="{{asset('/content/unicat/styles/bootstrap4/bootstrap.min.css')}}">
	<link href="{{asset('/content/unicat/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{{asset('/content/unicat/plugins/OwlCarousel2-2.2.1/owl.carousel.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/content/unicat/plugins/OwlCarousel2-2.2.1/owl.theme.default.cs')}}s">
	<link rel="stylesheet" type="text/css" href="{{asset('/content/unicat/plugins/OwlCarousel2-2.2.1/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/content/unicat/styles/main_styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/content/unicat/styles/responsive.css')}}">

	<!-- custom css files -->
	<link rel="stylesheet" type="text/css" href="{{asset('content/css/app.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('content/css/home.css')}}">



</head>
<body style="
	background: url('/content/bg.jpg');
	background-repeat: no-repeat;
	background-size: cover;">

	<!-- Header -->
	<header class="header">
			
		<!-- Header Content -->
		<div class="header_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="logo_container">
								<a href="{{asset('/')}}">
									<div class="logo_text">BD<span>W</span>allet</div>
								</a>
							</div>
							<nav class="main_nav_contaner ml-auto">
								<ul class="main_nav">

									<li><a href="{{asset('/')}}">Exchange</a></li>
									<li><a href="{{asset('/reviews')}}">Reviews</a></li>
									<li><a href="{{asset('#')}}">Affiliate</a></li>
									<li><a href="{{asset('/contact')}}">Contact</a></li>
									@if (Auth::guest())
										<li><a href="{{ route('login') }}">Login</a></li>
										<li><a href="{{ route('register') }}">Register</a></li>
									@else
										<li><a href="{{ asset('profile') }}">Profile</a></li>
										<li>
											<a href="{{ route('logout') }}"
												onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
												Logout
											</a>

											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
										</li>
									@endif
									
								</ul>

								<div class="hamburger menu_mm">
									<i class="fa fa-bars menu_mm" aria-hidden="true"></i>
								</div>

							</nav>

						</div>
					</div>
				</div>
			</div>
		</div>
		@if($errors->has("message"))
		<div class="bg-success text-light text-center" style="padding: 5px; font-size: 16px;">
			<i class="fa fa-check"></i> {{ $errors->first("message") }}
		</div>
		@elseif(count($errors)>0)
		<div class="bg-danger text-light text-center" style="padding: 5px; font-size: 16px;">
			<i class="fa fa-close"></i> 
			@foreach($errors->all() as $error)
				{{ $error }}
			@endforeach
		</div>
		@endif

	</header>

	<!-- Menu -->
	<div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">
		<div class="menu_close_container"><div class="menu_close"><div></div><div></div></div></div>
		<nav class="menu_nav">
			<ul class="menu_mm">
				
				<li><a href="{{asset('#')}}'">Exchange</a></li>
				<li><a href="{{asset('#')}}'">Testimonials</a></li>
				<li><a href="{{asset('#')}}'">Affiliate</a></li>
				<li><a href="{{asset('#')}}'">Contact</a></li>
				@if (Auth::guest())
					<li><a href="{{ route('login') }}">Login</a></li>
					<li><a href="{{ route('register') }}">Register</a></li>
				@else
					<li><a href="{{ asset('/') }}">Profile</a></li>
					<li>
						<a href="{{ route('logout') }}"
							onclick="event.preventDefault();
									document.getElementById('logout-form').submit();">
							Logout
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				@endif
					
			</ul>
		</nav>
	</div>

	<div class="super_container">
		@yield('content')
	</div>

	<!-- Footer -->
	<footer class="footer">
		<div class="container">
			<div class="row copyright_row">
				<div class="col">
					<div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
						<div class="cr_text">Developed By: <a href="https://banglasofttech.com">Bangla Soft Tech</a></div>
						<div class="ml-lg-auto cr_links">
							<ul class="cr_list">
								<li><a href="#">FAQ</a></li>
								<li><a href="#">Terms of Use</a></li>
								<li><a href="#">Privacy Policy</a></li>
								<li><a href="#">About</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>


	<!-- Custom JS Files -->
	<script src="{{asset('content/unicat/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('content/unicat/styles/bootstrap4/popper.js')}}"></script>
	<script src="{{asset('content/unicat/styles/bootstrap4/bootstrap.min.js')}}"></script>
	<script src="{{asset('content/unicat/plugins/greensock/TweenMax.min.js')}}"></script>
	<script src="{{asset('content/unicat/plugins/greensock/TimelineMax.min.js')}}"></script>
	<script src="{{asset('content/unicat/plugins/scrollmagic/ScrollMagic.min.js')}}"></script>
	<script src="{{asset('content/unicat/plugins/greensock/animation.gsap.min.js')}}"></script>
	<script src="{{asset('content/unicat/plugins/greensock/ScrollToPlugin.min.js')}}"></script>
	<script src="{{asset('content/unicat/plugins/OwlCarousel2-2.2.1/owl.carousel.js')}}"></script>
	<script src="{{asset('content/unicat/plugins/easing/easing.js')}}"></script>
	<script src="{{asset('content/unicat/plugins/parallax-js-master/parallax.min.js')}}"></script>
	<script src="{{asset('content/unicat/js/custom.js')}}"></script>

	<!-- Custom JS -->
	<script src="{{asset('content/js/exchangeMoney.js')}}"></script>
	<script src="{{asset('content/js/withdrawMoney.js')}}"></script>
	
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/5bc65d4808387933e5bb9045/default';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();
	</script>
	<!--End of Tawk.to Script-->

</body>
</html>