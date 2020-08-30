@extends('shop.pages.layouts.main')

@section('content')

<div class="page-title fix">
	<div class="overlay section">
		<h2>Профиль</h2>
	</div>
</div>
<section class="checkout-page page fix">
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
		<div class="col-md-3">
			<div class="checkout-right">
				<ul>
					<li><a class="active-section" href="{{ route('shop.pages.profile.show',  $user->id) }}" style="font-size: 16px;"><i class="fas fa-user"></i> {{ __('Профиль') }}</a></li>
					<li><a href="{{ route('shop.pages.orders.index') }}" style="font-size: 16px;"><i class="fas fa-boxes"></i> {{ __('Заказы') }}</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-9">
			<div class="panel-group" id="checkout-progress">
				<div class="panel panel-default">
					<div class="panel-heading" >
						<a class="active" data-toggle="collapse" data-parent="#checkout-progress" href="#checkout-method"><span>1</span>Данные пользователя</a>
					</div>
					<div id="checkout-method" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="col">
								<div class="checkout-method checkout-reg fix">
									<div class="col-sm-4">
										<table class="table table-bordered table-hover">
											<tbody>
												<tr>
													<td>E-mail:</td>
													<td><strong>{{ $user->email }}</strong></td>
												</tr>
												<tr>
													<td>Имя:</td>
													<td><strong>{{ $user->name }}</strong></td>
												</tr>
												<tr>
													<td>Фамилия:</td>
													@if($user->surename !== NULL)
													<td><strong>{{ $user->surename }}</strong></td>
													@else
													<td><strong>{{ __('Не указана') }}</strong></td>
													@endif
												</tr>
												<tr>
													<td>Город:</td>
													@if($user->city !== NULL)
													<td><strong>{{ $user->city }}</strong></td>
													@else
													<td><strong>{{ __('Не указан') }}</strong></td>
													@endif
												</tr>
												<tr>
													<td>Адрес:</td>
													@if($user->address !== NULL)
													<td><strong>{{ $user->address }}</strong></td>
													@else
													<td><strong>{{ __('Не указан') }}</strong></td>
													@endif
												</tr>

												<tr>
													<td>Телефон:</td>
													@if($user->phone !== NULL)
													<td><strong>{{ $user->phone }}</strong></td>
													@else
													<td><strong>{{ __('Не указан') }}</strong></td>
													@endif
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default mb-30">
					<div class="panel-heading" >
						<a class="collapsed" data-toggle="collapse" data-parent="#checkout-progress" href="#profile-change"><span>2</span>Изменить данные</a>
					</div>
					<div id="profile-change" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="profile-change">
								<form action="{{ route('shop.pages.profile.update', $user->id) }}" method="POST">
									@csrf
									<input type="hidden" name="_method" value="PUT">
									<input type="hidden" name="type" value="change_user_data">
									<label for="name">{{ __('Имя:') }}</label>
									<input class="form-control" type="name" placeholder="Имя" id="name" name="name" value="{{ $user->name }}" required>
									<label for="surename">{{ __('Фамилия:') }}</label>
									<input class="form-control" type="name" placeholder="Фамилия" id="surename" name="surename" value="{{ $user->surename }}" required>
									<label for="city">{{ __('Город:') }}</label>
									<input class="form-control" type="text" placeholder="Город" id="city" name="city" value="{{ $user->city }}" required>
									<label for="address">{{ __('Адрес:') }}</label>
									<input class="form-control" type="text" placeholder="Адрес" id="address" name="address" value="{{ $user->address }}" required>
									<label for="phone">{{ __('Телефон:') }}</label>
									<input class="form-control" type="tel" placeholder="Телефон" id="phone" name="phone" value="{{ $user->phone }}" required>
									<button type="submit" class="btn" id="submit">{{ __('Изменить') }}</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default mb-30">
					<div class="panel-heading" >
						<a class="collapsed" data-toggle="collapse" data-parent="#checkout-progress" href="#password-change"><span>3</span>Изменить пароль</a>
					</div>
					<div id="password-change" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="password-change">
								<form action="{{ route('shop.pages.profile.update', $user->id) }}" method="POST">
									@csrf
									<input type="hidden" name="_method" value="PUT">
									<input type="hidden" name="type" value="change_password">
									<label for="current_password">{{ __('Текущий пароль:') }}</label>
									<input class="form-control" type="password" placeholder="Текущий пароль" id="current_password" name="current_password" required>
									<label for="new_password">{{ __('Новый пароль:') }}</label>
									<input class="form-control" type="password" placeholder="Новый пароль" id="new_password" name="new_password" required>
									<label for="repeat_new_password">{{ __('Повторите новый пароль:') }}</label>
									<input class="form-control" type="password" placeholder="Повторите новый пароль" id="repeat_new_password" name="repeat_new_password" required>
									<button type="submit" class="btn" id="submit">{{ __('Изменить') }}</button>
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