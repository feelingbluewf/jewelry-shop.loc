@extends('shop.pages.layouts.main')

@section('content')
<div class="page-title fix"><!--Start Title-->
	<div class="overlay section">
		<h2>Контакты</h2>
	</div>
</div><!--End Title-->
<div class="contact-page page fix"><!--Start Contact Area-->
	<div class="container">
		<div class="row">
			<div class="contact-info col-sm-12">
				<div class="row">
					<div class="col-sm-6">
						<h4>Contact Us</h4>
						<p>perspiciatis unde omnis iste natus error sit voluptatem accm doloremque antium, totam rem aperiam, eaque ipsa perspiciatis unde omnis iste  aque ipsa perspiciatis unde omnis iste </p>
						<div class="info-single">
							<i class="fa fa-map-marker"></i>
							<p>Main town,  Anystreen</p>
							<p>C/A 1254 New Yourk</p>
						</div>
						<div class="info-single">
							<i class="fa fa-phone"></i>
							<p>+012  456  456  456</p>
							<p>+012  356  897  222</p>
						</div>
						<div class="info-single">
							<i class="fa fa-globe"></i>
							<a href="#">info@olongker.com</a>
							<a href="#">www.olongker.com</a>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="contact-reduction">
							<img src="img/contact-less.jpg" alt="" />
							<div class="contact-less">
								<h3>UP TO</h3>
								<h3>25%</h3>
								<h3>off</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="map-container col-sm-12">
				<div id="googleMap"></div>
			</div>
			<div style="margin-bottom: 20px;" class="contact-form col-sm-12">
				<h2>LEAVE A MESSAGE</h2>
				<form action="#">
					<div class="row">
						<div class="col-sm-6">
							<label for="name">Name*</label>
							<input type="text" id="name" />
							<label for="email">E-mail*</label>
							<input type="text" id="email" />
							<label for="phone">Phone*</label>
							<input type="text" id="phone" />
							<label for="subject">Subject*</label>
							<input type="text" id="subject" />
						</div>
						<div class="col-sm-6">
							<label for="message">Message*</label>
							<textarea id="message" rows="7"></textarea>
							<input type="submit" class="submit" value="send"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!--End Contact Area-->
@endsection

@section('scripts')

@include('shop.pages.contacts.scripts.index-script')

@endsection