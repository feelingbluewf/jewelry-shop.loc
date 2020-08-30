@extends('shop.pages.layouts.main')

@section('content')
<div class="page-title fix">
	<div class="overlay section">
		<h2>Авторизация / Регистрация</h2>
	</div>
</div>
<div class="login-page page fix">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-5">
				<div class="login">
					<form id="login-form" method="POST" action="{{ route('login') }}">
						@csrf
						<h2>Войти</h2>
						<p>Войдите в свой аккаунт</p>
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
						<div class="remember">
							<a href="{{ route('password.request') }}">{{ __('Забыли свой пароль?') }}</a>
						</div>
						<input type="submit" value="Войти" / style="margin-top: 0px !important;">
					</form>
				</div>
			</div>
			<div class="col-md-2"></div>
			<div class="col-sm-6 col-md-5">
				<div class="login">
					<form id="signup-form" method="POST" action="{{ route('register') }}">
						@csrf
						<h2>Создать новый аккаунт</h2>
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
						<input type="submit" value="Зарегистрироваться" />
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection