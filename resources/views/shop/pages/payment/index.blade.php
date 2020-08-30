@extends('shop.pages.layouts.main')

@section('content')

<div class="page-title fix"><!--Start Title-->
	<div class="overlay section">
		<h2>Оплата</h2>
	</div>
</div><!--End Title-->
{{ print_r(\Session::get('user_data')) }}
<section class="checkout-page page pb-30"><!--Start Checkout Area-->
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<div class="panel-group" id="checkout-progress">
					<div class="panel panel-default">
						<div class="panel-heading" >
							<a class="active"><span>1</span>Способ оплаты</a>
						</div>
						<div id="checkout-method" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="col-sm-12">
									<div class="checkout-method checkout-login checkout-reg fix">
										<h2>Выберите способ оплаты</h2>
										<form action="{{ route('createOrder') }}" method="POST">
											@csrf
											<ul class="flex-inner" style="margin: 0px 0px 5px 0px;">
												<li>
													<label for="swedbank">
														<input type="radio" value="swedbank" name="method" id="swedbank">
														<img class="swedbank" src="{{ asset('images/swedbank.png') }}" alt="SEB" required>
													</label>
												</li>
												<li>
													<label for="seb">
														<input type="radio" value="seb" name="method" id="seb">
														<img class="seb" src="{{ asset('images/seb.png') }}" alt="SEB" required>
													</label>
												</li>
												<li>
													<label for="card">
														<input type="radio" value="card" name="method" id="card" required>
														Банковская карта
													</label>
												</li>
												<li>
													<label for="cash">
														<input type="radio" value="cash" name="method" id="cash" required>
														Наличные
													</label>
												</li>
											</ul>
											<a style="cursor: pointer;" href="{{ route('checkout') }}"><i class="fas fa-arrow-left"></i> Назад</a>
											<a style="cursor: pointer; float: right;" onclick="$('#next').click()">Продолжить <i class="fas fa-arrow-right"></i></a>
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
						<li><a href="{{ route('checkout') }}">Доставка</a></li>
						<li><a class="active" href="{{ route('payment') }}">Оплата</a></li>
						<li><a>Заказ оформлен</a></li>
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

@endsection