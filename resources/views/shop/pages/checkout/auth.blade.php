@extends('shop.pages.layouts.main')

@section('content')
<div class="page-title fix"><!--Start Title-->
	<div class="overlay section">
		<h2>Заказ</h2>
	</div>
</div><!--End Title-->
<section class="checkout-page fix" style="padding-top: 30px;"><!--Start Checkout Area-->
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
		@if(session()->has('success'))
		<div class="alert alert-success">
			<li>
				{{ session('success') }}
			</li>
		</div>
		@endif
		<div class="panel-group" id="checkout-progress">
			<div class="panel panel-default mb-30">
				<div class="panel-heading" >
					<a class="active" data-toggle="collapse" data-parent="#checkout-progress" href="#checkout-method"><span>1</span>Продолжить без авторизации</a>
				</div>
				<div id="checkout-method" class="panel-collapse collapse in">
					<div class="panel-body">
						<div class="col-sm-12">
							<div class="checkout-method checkout-login checkout-reg fix">
								<form id="login-form" method="POST" action="{{ route('checkMail') }}">
									@csrf
									<h2>Введите E-mail</h2>
									<label for="email">{{ __('E-mail') }}</label>
									<input type="email" name="email" id="email" required>
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
									<a style="cursor: pointer;" onclick="$('#next').click()">Продолжить</a>
									<button type="submit" id="next"></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default mb-30">
				<div class="panel-heading" >
					<a class="active" data-toggle="collapse" data-parent="#checkout-progress" href="#checkout-method"><span>1</span>Авторизация</a>
				</div>
				<div id="checkout-method" class="panel-collapse collapse in">
					<div class="panel-body">
						<div class="col-sm-6">
							<div class="checkout-method checkout-login checkout-reg fix">
								<form id="login-form" method="POST" action="{{ route('login') }}">
									@csrf
									<h2>Вход</h2>
									<h3>Уже зарегистрированы?</h3>
									<label for="email">{{ __('E-mail') }}</label>
									<input type="email" class="@error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email">
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
									<label for="password">{{ __('Пароль') }}</label>
									<input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
									@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
									<a style="cursor: pointer;" onclick="$('#submitLog').click()">Войти</a>
									<button type="submit" id="submitLog"></button>
								</form>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="checkout-method checkout-login">
								<form id="signup-form" method="POST" action="{{ route('register') }}">
									@csrf
									<h2>Регистрация</h2>
									<p>Создайте свой аккаунт</p>
									<label for="name">{{ __('Имя') }}<span>*</span></label>
									<input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">
									@error('name')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
									<label for="email">{{ __('E-mail') }}<span>*</span></label>
									<input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
									<label for="password">{{ __('Пароль') }}<span>*</span></label>
									<input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
									@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
									<label for="password-confirm">{{ __('Подтвердите пароль') }}<span>*</span></label>
									<input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
									<a style="cursor: pointer;" onclick="$('#submitReg').click()">Зарегистрироваться</a>
									<button type="submit" id="submitReg"></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</section>

@endsection

@section('scripts')

<script>
	
	if(Object.keys(cart).length === 0 && cart.constructor === Object) {

		window.location.href = "/";

		alert('Вы не добавили товары в корзину!');

	}

</script>

@endsection