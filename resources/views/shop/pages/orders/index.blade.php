@extends('shop.pages.layouts.main')

@section('content')

<div class="page-title fix">
	<div class="overlay section">
		<h2>Заказы</h2>
	</div>
</div>
<section class="checkout-page page fix">
	<div class="container">
		<div class="col-md-3">
			<div class="checkout-right">
				<ul>
					<li><a href="{{ route('shop.pages.profile.show',  Auth::user()->id) }}" style="font-size: 16px;"><i class="fas fa-user"></i> {{ __('Профиль') }}</a></li>
					<li><a class="active-section" href="{{ route('shop.pages.orders.index') }}" style="font-size: 16px;"><i class="fas fa-boxes"></i> {{ __('Заказы') }}</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-9">
			<div class="table-responsive">
				<table class="table cart-table">
					<thead class="table-title">
						<tr>
							<th class="produ">Номер заказа</th>
							<th class="unit">Дата предоставления</th>
							<th class="namedes">Сумма & </br> Способ оплаты</th>
							<th class="valu">Статус</th>
							<th class="acti">Статус обновлен</th>
						</tr>													
					</thead>
					<tbody>
						@forelse($orders as $order)
						<tr class="table-info order" data-id="{{ $order->id }}">
							<td class="produ">
								<h2>{{ $order->unique_id }}</h2>
							</td>
							<td class="unit">
								<h2>{{ $order->created_at }}</h2>
							</td>
							<td class="namedes">
								<h2>{{ $order->sum }}€</h2>
								<p>{{ $order->method }}</p>
							</td>
							<td class="valu">
								@if($order->status == '0')
								<span class="badge" style="background-color: #ffc107;"><strong>Обрабатывается</strong></span>
								@elseif($order->status == '1')
								<span class="badge" style="background-color: #17a2b8;"><strong>Одобрен</strong></span>
								@elseif($order->status == '2')
								<span class="badge" style="background-color: #28a745;"><strong>Доставлен</strong></span>
								@endif
							</td>
							<td class="acti">
								<h2>{{ $order->updated_at }}</h2>
							</td>
						</tr>
						@empty
						<tr class="table-info">
							<td class="produ" colspan="7">
								<h4>Заказов нет</h4>
							</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

@endsection

@section('scripts')

@include('shop.pages.orders.scripts.index-script')

@endsection