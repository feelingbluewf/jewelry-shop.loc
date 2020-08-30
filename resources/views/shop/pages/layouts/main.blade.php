<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>{{ MetaTag::get('title') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Fav Icon -->
	<link id="favicon" rel="icon" type="image/png" href="{{ asset('/img/favicon.ico') }}" />
	<!-- Google Font Raleway -->
	<link href='https://fonts.googleapis.com/css?family=Raleway:200,300,500,400,600,700,800' rel='stylesheet' type='text/css'>
	<!-- Google Font Dancing Script -->
	<link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}" />
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
	<!-- Owl Carousel CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/owl.carousel.min.css') }}" />
	<!-- Animate CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/animate.min.css') }}" />
	<!-- simpleLens CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery.simpleLens.css') }}" />
	<!-- Price Slider CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery-price-slider.css') }}" />
	<!-- MeanMenu CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/meanmenu.min.css') }}" />
	<!-- Magnific Popup CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/magnific-popup.css') }}" />
	<!-- Nivo Slider CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/nivo-slider.css') }}" />
	<!-- Stylesheet CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}" />
	<!-- LightBox CSS -->
	<link rel="stylesheet" href="{{ asset('/css/lightbox.css') }}">
	<!-- Responsive Stylesheet -->
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/responsive.css') }}" />
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<!-- jQuery 2.1.4 -->
	<script type="text/javascript" src="{{ asset('/js/jquery-2.1.4.min.js') }}"></script>
	
	<script type="text/javascript">
		$.ajaxSetup({
			headers: {

				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

			}
		})
	</script>

	<livewire:styles>

</head>
<body>
	<div class="header-top"><!--Start Header Top Area-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<div class="info">
						<div class="phn-num float-left">
							<i class="fa fa-phone float-left"></i>
							<p>(000)  123  288  456 </p>
						</div>
						<div class="mail-id float-left">
							<i class="fa fa-envelope-o float-left"></i>
							<p><a href="#">info@olongker.com</a></p>
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div class="socials text-center">
						<a href="#"><i class="fab fa-facebook"></i></a>
						<a href="#"><i class="fab fa-twitter"></i></a>
						<a href="#"><i class="fab fa-vk"></i></a>
						<a href="#"><i class="fab fa-google"></i></a>
					</div>
				</div>
				<div class="col-sm-12 col-md-4">
					<div id="top-menu" class="float-right">
						<ul>
							@if(Auth::check())
							@if(Auth::User()->isAdministrator())
							<li><a href="{{ route('shop.admin.dashboard.index') }}"><i class="fas fa-crown" style="font-size: 20px;"></i> {{ __('Админ') }}</a></li>
							@endif
							<li><a href="{{ route('shop.pages.profile.show', Auth::user()->id) }}">
								<i class="fas fa-user" style="font-size: 20px;"></i> {{ __('Профиль') }}
								<ul style="z-index: 99999;">
									<li><a style="font-size: 16px;" href="{{ route('shop.pages.orders.index') }}">
										<i class="fas fa-boxes"></i> {{ __('Заказы') }}
									</a></li>
									<li><a style="font-size: 16px;" href="{{ route('logout') }}"
										onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
										<i class="fas fa-sign-out-alt"></i> {{ __('Выйти') }}</a></li>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
									</ul>
								</a>
							</li>

							@else 
							<li><a href="{{ route('shop.pages.auth.index') }}"><i class="fas fa-user" style="font-size: 20px;"></i> {{ __('Авторизация') }}</a></li>
							@endif
							<li class="cart-info" id="minicart">
								<a href="{{ route('shop.pages.cart.index') }}">
									<i class="fa fa-shopping-cart" style="font-size: 20px;"></i> {{ __('Корзнина') }}
								</a>
								<div class="cart-hover">
									<ul class="header-cart-pro">
										<li>
											<div class="content fix"><a href="#"><h4>{{ __('Корзина пуста') }}</h4></a></div>
										</li>
									</ul>
									<div class="header-button-price">
										<a href="{{ route('shop.pages.cart.index') }}"><i class="fa fa-sign-out"></i><span>{{ __('Пересмотреть') }}</span></a>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--End Header Top Area-->
	<div class="menu-area"><!--Start Main Menu Area-->
		<div class="container">
			<div class="row">
				<div class="clo-md-12">
					<div class="main-menu hidden-sm hidden-xs">
						<nav>
							<ul>
								<li><a href="{{ route('shop.pages.home-page.index') }}/">{{ __('Главная') }}</a>
								</li>
								<li><a href="{{ route('shop.pages.shop.index') }}">{{ __('Магазин') }}</a>
								</li>
								<li><a href="{{ route('shop.pages.about-us.index') }}">{{ __('О нас') }}</a>
								</li>
								<li><a href="{{ route('shop.pages.contacts.index') }}">{{ __('Контакты') }}</a>
								</li>
							</ul>
						</nav>
					</div>
					<div class="mobile-menu hidden-md hidden-lg">
						<nav>
							<ul>
								<li>
									<a href="{{ route('shop.pages.home-page.index') }}/">{{ __('Главная') }}</a>
								</li>
								<li>
									<a href="{{ route('shop.pages.shop.index') }}">{{ __('Магазин') }}</a>
								</li>
								<li>
									<a href="{{ route('shop.pages.about-us.index') }}">{{ __('О нас') }}</a>
								</li>
								<li>
									<a href="{{ route('shop.pages.contacts.index') }}">{{ __('Контакты') }}</a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	@yield('content')
	<div class="footer-top-area fix"><!--Start Footer top area-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-md-3">
					<div class="footer-about">
						<div class="image">
							<img src="img/header/logo.png" alt="" />
							<h3>online jewelry store</h3>
						</div>
						<p>perspiciatis unde omnis iste natus error sit voluptatem accm doloremque antium, totam rem aperiam, eaque ipsa perspiciatis unde omnis iste</p>
					</div>
					<div class="footer-contact">
						<div class="single-contact">
							<div class="icon">
								<i class="fa fa-map-marker"></i>
							</div>
							<div class="details">
								<p>Main town, Anystreen</p>
								<p>C/A 1254 New Yourk</p>
							</div>
						</div>
						<div class="single-contact">
							<div class="icon">
								<i class="fa fa-phone"></i>
							</div>
							<div class="details">
								<p>+012  456  456  456</p>
								<p>+012  356  897  222</p>
							</div>
						</div>
						<div class="single-contact">
							<div class="icon">`
								<i class="fa fa-dribbble"></i>
							</div>
							<div class="details">
								<a href="#">info@olongker.com</a>
								<a href="#">www.olongker.com</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-3">
					<div class="footer-quick-link footer-links">
						<h2>QUICK LINK</h2>
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="shop.html">Shop</a></li>
							<li><a href="shop-left-sidebar.html">New Arrivals</a></li>
							<li><a href="services.html">Services</a></li>	
							<li><a href="portfolio-1.html">Portfolio</a></li>
							<li><a href="blog.html">Blog</a></li>
							<li><a href="#">Shortcodes</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-12 col-md-6">
					<div class="row">
						<div class="col-sm-8 footer-support footer-links">
							<h2>OUR SUPPORT</h2>
							<ul>
								<li><a href="#">Site Map</a></li>
								<li><a href="#">privacy Policy</a></li>
								<li><a href="#">Your Account</a></li>
								<li><a href="#">Term & Conditions</a></li>
								<li><a href="#">Advance Search</a></li>
								<li><a href="faq.html">Help & FAQs</a></li>
								<li><a href="#">Gift Voucher</a></li>
								<li><a href="contact-2.html">Contact Us</a></li>
							</ul>
						</div>
						<div class="col-sm-4 footer-account footer-links">
							<h2>my Account</h2>
							<ul>
								<li><a href="#">my Account</a></li>
								<li><a href="#">order History</a></li>
								<li><a href="#">Returns</a></li>
								<li><a href="#">Specials</a></li>
							</ul>
						</div>
					</div>
					<div class="footer-newslater fix">
						<div class="wrap fix">
							<h3>NEWS LETTER ! </h3>
							<form action="#">
								<input type="email" placeholder="Your E-mail...">
								<button class="submit">SUBSCRIBE</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!--Start Footer top area-->
	<!-- Cart -->
	@include('shop.pages.scripts.cart-js')
	<!-- Bootstrap JS -->
	<script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>

	@yield('scripts')

	<!-- Owl Carousel JS -->
	<script type="text/javascript" src="{{ asset('/js/owl.carousel.min.js') }}"></script>
	<!--countTo JS -->
	<script type="text/javascript" src="{{ asset('/js/jquery.countTo.js') }}"></script>
	{{-- mixitup JS --}}
	<script type="text/javascript" src="{{ asset('/js/jquery.mixitup.min.js') }}"></script>
	<!-- LightBox JS -->
	<script type="text/javascript" src="{{ asset('/js/lightbox.js') }}"></script>
	<!-- magnific popup JS -->
	<script type="text/javascript" src="{{ asset('/js/jquery.magnific-popup.min.js') }}"></script>
	<!-- Appear JS -->
	<script type="text/javascript" src="{{ asset('/js/jquery.appear.js') }}"></script>
	<!-- MeanMenu JS -->
	<script type="text/javascript" src="{{ asset('/js/jquery.meanmenu.min.js') }}"></script>
	<!-- Nivo Slider JS -->
	<script type="text/javascript" src="{{ asset('/js/jquery.nivo.slider.pack.js') }}"></script>
	<!-- Scrollup JS -->
	<script type="text/javascript" src="{{ asset('/js/jquery.scrollup.min.js') }}"></script>
	{{-- simpleLens JS --}}
	<script type="text/javascript" src="{{ asset('/js/jquery.simpleLens.min.js') }}"></script>
	<!-- Price Slider JS -->
	<script type="text/javascript" src="{{ asset('/js/jquery-price-slider.js') }}"></script>
	<!-- WOW JS -->
	<script type="text/javascript" src="{{ asset('/js/wow.min.js') }}"></script>

	<script>

		$('.main-menu a, .mobile-menu a').each(function() {
			var pathname = window.location.pathname;
			var path =  pathname.split('/')[1];
			var location = window.location.protocol + '//' + window.location.host + '/' + path;
			var link = $(this).attr('href');
			if (link === location) {
				$(this).addClass('nav-active');
			}
		}); 

	</script>

	<script>
		new WOW().init();
	</script>	
	<!-- Main JS -->
	<script type="text/javascript" src="{{ asset('/js/main.js') }}"></script>

	<script>

		$('#categories a').on('click', function() {
			$('#refresh').attr('wire:click', "$set('category_id', " + $(this).data('id') + ")").click();
		});

		$('#categories li').on('click', function() {
			$(this).parent().find('.category-active').removeClass('category-active');
			$(this).addClass('category-active');
		});

	</script>

	
	<livewire:scripts>

</body>

</html>