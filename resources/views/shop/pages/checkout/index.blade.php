@extends('shop.pages.layouts.main')

@section('content')

<div class="page-title fix">
	<div class="overlay section">
		<h2>Доставка</h2>
	</div>
</div>
<section class="checkout-page page pb-30">
	<div class="container">
		@if(count($errors))
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
				<li>
					{{ $error }}
				</li>
				@endforeach
			</ul>
		</div>
		@endif
		@if(session()->has('error'))
		<div class="alert alert-danger">
			<ul>
				<li>
					{{ session('error') }}
				</li>
			</ul>
		</div>
		@endif
		@if(session()->has('warning'))
		<div class="alert alert-purple">
			<ul>
				<li>
					{{ session('warning') }}
				</li>
			</ul>
		</div>
		@endif
		@if(session()->has('success'))
		<div class="alert alert-success">
			<li>
				{{ session('success') }}
			</li>
		</div>
		@endif
		{{ print_r(\Session::get('user_data')) }}
		<div class="row">
			<div class="col-md-9">
				<div class="panel-group" id="checkout-progress">
					<div class="panel panel-default">
						<div class="panel-heading" >
							<a class="active"><span>1</span>Адрес доставки</a>
						</div>
						<div id="checkout-method" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="col-sm-12">
									<div class="checkout-method checkout-login checkout-reg fix">
										<p>Пожалуйста введите данные лица, принимающего заказ, и точный адрес.</p>
										<form action="{{ route('setUserData') }}" method="POST">
											@csrf
											@if(\Session::get('user_data'))
											@php
											if(\Session::get('user_data')) {
												$user_data = \Session::get('user_data');
											}
											@endphp
											@if(Auth::check())
											<input type="hidden" value="{{ Auth::user()->email }}" name="email">
											@else
											<label for="email">E-mail</label>
											<input type="email" value="{{ $user_data['email'] }}" name="email">
											@endif
											<label for="name">Имя</label>
											<input type="name" value="{{ $user_data['name'] }}" name="name">
											<label for="surename">Фамилия</label>
											<input type="name" value="{{ $user_data['surename'] }}" name="surename">
											<label for="phone">Номер телефона</label>
											<input type="text" value="{{ $user_data['phone'] }}" name="phone">
											<label for="city">Город</label>
											<select name="city" id="city">
												<option value="0"></option>
												<option value="Tallinn">Tallinn</option>
												<option value="Maardu">Maardu</option>
											</select>
											<label for="address">Адрес</label>
											<input type="text" value="{{ $user_data['address'] }}" name="address">
											@elseif(Auth::check())
											<input type="hidden" value="{{ Auth::user()->email }}" name="email">
											<label for="name">Имя</label>
											<input type="name" value="{{ Auth::user()->name }}" name="name">
											<label for="surename">Фамилия</label>
											<input type="name" value="{{ Auth::user()->surename }}" name="surename">
											<label for="phone">Номер телефона</label>
											<input type="text" value="{{ Auth::user()->phone }}" name="phone">
											<label for="city">Город</label>
											<select name="city" id="city">
												<option value="0"></option>
												<option value="Tallinn">Tallinn</option>
												<option value="Maardu">Maardu</option>
											</select>
											<label for="address">Адрес</label>
											<input type="text" value="{{ Auth::user()->address }}" name="address">
											@else
											<label for="email">E-mail</label>
											<input type="email" value="{{ \Session::get('email') }}" name="email">
											<label for="name">Имя</label>
											<input type="name" value="{{ old('name') }}" name="name">
											<label for="surename">Фамилия</label>
											<input type="name" value="{{ old('surename')}}" name="surename">
											<label for="phone">Номер телефона</label>
											<input type="text" value="{{ old('phone') }}" name="phone">
											<label for="city">Город</label>
											<select name="city" id="city">
												<option value="0"></option>
												<option value="Tallinn">Tallinn</option>
												<option value="Maardu">Maardu</option>
											</select>
											<label for="address">Адрес</label>
											<input type="text" value="{{ old('address') }}" name="address">
											@endif
											<a style="cursor: pointer;" onclick="$('#next').click()">Продолжить <i class="fas fa-arrow-right"></i></a>
											<button type="submit" id="next"></button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 pb-30">
				<div class="checkout-right">
					<h2>Прогресс</h2>
					<ul class="checkout-progress">
						<li><a class="active" href="{{ route('checkout') }}">Доставка</a></li>
						<li>Оплата</a></li>
						<li><a >Заказ оформлен</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3">
				<div class="checkout-right">
					<h2>Корзина</h2>
					<table class="table table-bordered table-hover">
						<tbody id="cart">
							<tr>
								<td>Кол-во товаров:</td>
								<td>2</td>
							</tr>
							<tr>
								<td><strong>Сумма:</strong></td>
								<td><strong>35€</strong></td>
							</tr>
						</tbody>
					</table>
					<div class="cart-info" id="recheck">
						<a href="{{ route('shop.pages.cart.index') }}" style="color: #9966cc;">Пересмотреть</a>
						<div class="cart-hover">
							<ul class="header-cart-pro">
								<li>
									<div class="content fix"><a href="#"><h4>{{ __('Корзина пуста') }}</h4></a></div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection


@section('scripts')

@include('shop.pages.checkout.scripts.index-script')

<script>
	
	$('#city option').each(function () {

		var session = "<?php if(isset($user_data)) print_r($user_data['city']) ?>";

		var user_data = "<?php if(Auth::check()) { echo Auth::user()->city; } ?>";

		if(session != "" && $(this).attr('value') == session) {

			$(this).prop('selected', true);

		}
		if(user_data != "" && session == "" && $(this).attr('value') == user_data) {

			$(this).prop('selected', true);

		}

	})
	
</script>

@endsection