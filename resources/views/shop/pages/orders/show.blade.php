@extends('shop.pages.layouts.main')

@section('content')

<div class="page-title fix">
	<div class="overlay section">
		<h2>{{ __('Заказ') }} {{ $order->unique_id  }}</h2>
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
					<li><a href="{{ route('shop.pages.profile.show',  Auth::user()->id) }}" style="font-size: 16px;"><i class="fas fa-user"></i> {{ __('Профиль') }}</a></li>
					<li><a class="active-section" href="{{ route('shop.pages.orders.index') }}" style="font-size: 16px;"><i class="fas fa-boxes"></i> {{ __('Заказы') }}</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-9">
			<div class="panel-group" id="checkout-progress">
				<div class="panel panel-default">
					<div class="panel-heading" >
						<a class="active" data-toggle="collapse" data-parent="#checkout-progress" href="#checkout-method"><span>1</span>Общая информация</a>
					</div>
					<div id="checkout-method" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="col">
								<div class="checkout-method checkout-reg fix">
									<div class="col-sm-4">
										<table class="table table-bordered table-hover">
											<tbody>
												<tr>
													<td>Дата предоставления</td>
													<td><strong>{{ $order->created_at }}</strong></td>
												</tr>
												<tr>
													<td>Сумма & Способ оплаты</td>
													<td>
														<h2>{{ $order->sum }}€</h2>
														<p>{{ $order->method }}</p>
													</td>
												</tr>
												<tr>
													<td>Статус</td>
													<td>
														@if($order->status == '0')
														<span class="badge" style="background-color: #ffc107;"><strong>Обрабатывается</strong></span>
														@elseif($order->status == '1')
														<span class="badge" style="background-color: #17a2b8;"><strong>Одобрен</strong></span>
														@elseif($order->status == '2')
														<span class="badge" style="background-color: #28a745;"><strong>Доставлен</strong></span>
														@endif
													</td>
												</tr>
												<tr>
													<td>Статус обновлен</td>
													<td><strong>{{ $order->updated_at }}</strong></td>
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
						<a class="collapsed" data-toggle="collapse" data-parent="#checkout-progress" href="#profile-change"><span>2</span>Заказанные товары</a>
					</div>
					<div id="profile-change" class="panel-collapse collapse">
						<div class="table-responsive">
							<table class="table cart-table">
								<thead class="table-title">
									<tr>
										<th class="produ">Товар</th>
										<th class="namedes">Название &amp; Описание</th>
										<th class="unit">Цена (шт.)</th>
										<th class="quantity">Количество</th>
										<th class="valu">Сумма</th>
									</tr>													
								</thead>
								<tbody>
									@foreach($order->orderProduct as $orderProduct)
									<tr class="table-info">
										<td class="produ">
											<a href="{{ route('shop.pages.shop.show', $orderProduct->product_id) }}">
												<img alt="{{ $orderProduct->title }}" src="{{ asset('/uploads/main') }}/{{ $orderProduct->product->img }}">
											</a>
										</td>
										<td class="namedes">
											<h2>
												<a href="{{ route('shop.pages.shop.show', $orderProduct->product_id) }}">{{ $orderProduct->title }}</a>
											</h2>
											<p>Всем ку</p>
										</td>
										<td class="unit">
											<h5>{{ $orderProduct->price }}€</h5>
										</td>
										<td class="quantity">
											<h5>{{ $orderProduct->qty }}</h5>
										</td>
										<td class="valu">
											<h5>{{ $orderProduct->value }}€</h5>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
