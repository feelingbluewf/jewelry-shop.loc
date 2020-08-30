@extends('shop.admin.layouts.app_admin')

@section('breadcrumbs')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-auto">
				<h1 class="m-0 text-dark">{{ MetaTag::get('title') }}</h1>
			</div>
			@if($order->status == 0)
			<div class="col-sm-auto mb-2">
				<a href="{{ url('/admin/orders/approve', $order->id) }}" title="Одобрить заказ" onclick="confirmationApproved(event)">
					<button type="submit" class="btn btn-success">
						<i class="fas fa-thumbs-up"></i> Одобрить
					</button>
				</a>
			</div>
			@elseif($order->status == 1)
			<div class="col-sm-auto mb-2">
				<a href="{{ url('/admin/orders/returnToRevision', $order->id) }}" title="Вернуть на доработку" onclick="confirmationReturnToRevision(event)">
					<button type="submit" class="btn btn-dark">
						<i class="fas fa-undo-alt"></i> Вернуть на доработку
					</button>
				</a>
			</div>
			<div class="col-sm-auto mb-2">
				<a href="{{ url('/admin/orders/delivered', $order->id) }}" title="Доставлен" onclick="confirmationDelivered(event)">
					<button type="submit" class="btn btn-success">
						<i class="fas fa-check-circle"></i> Товар доставлен!
					</button>
				</a>
			</div>
			@endif
			<div class="col-sm-auto">
				<a href="{{ url('/admin/orders/deleteOrder', $order->id) }}" onclick="confirmationDelete(event)">
					<button type="submit" class="btn btn-danger" title="Удалить заказ">
						<i class="fas fa-trash-alt"></i> Удалить
					</button>
				</a>
			</div>
			<div class="col">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('shop.admin.dashboard.index') }}"><i class="nav-icon fas fa-tachometer-alt"></i> Главная</a></li>
					<li class="breadcrumb-item"><a href="{{ route('shop.admin.orders.index') }}"><i class="nav-icon fas fa-shopping-cart"></i> Заказы</a></li>
					<li class="breadcrumb-item"><i class="fas fa-edit"></i> {{ MetaTag::get('title') }}</li>
				</ol>
			</div>
		</div>
	</div>
</div>

@endsection

@section('content')

<section class="content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body table-responsive p-0">
					<form action="{{ route('shop.admin.orders.update', $order->id) }}" method="post">
						<input type="hidden" name="_method" value="PUT">
						@csrf
						<table class="table table-bordered table-hover">
							<tbody>
								<tr>
									<td>Номер заказа</td>
									<td>{{ $order->id }}</td>
								</tr>
								<tr>
									<td>Дата заказа</td>
									<td>{{ $order->created_at }}</td>
								</tr>
								<tr>
									<td>Дата изменения</td>
									<td>{{ $order->updated_at }}</td>
								</tr>
								<tr>
									<td>Кол-во позиций в заказе</td>
									<td>{{ $order->orderProduct->count() }}</td>
								</tr>
								<tr>
									<td>Сумма</td>
									<td>{{ $order->sum }}</td>
								</tr>
								<tr>
									<td>Имя заказчика</td>
									<td><a href="{{ route('shop.admin.users.show', $order->user_id) }}">{{ $order->name }}</a></td>
								</tr>
								<tr>
									<td>Статус</td>
									<td>
										@if($order->status == 0)  
										<span class="badge badge-warning">
											Новый
										</span>
										@elseif($order->status == 1)  
										<span class="badge badge-info">
											Одобрен
										</span>
										@elseif($order->status == 2)  
										<span class="badge badge-success">
											Доставлен
										</span>
										@endif 
									</td>
								</tr>
								<tr>
									<td>Комментарий</td>
									<td>
										@if($order->note === NULL)
										<input class="form-control" type="text" name="note" value="" required>
										@else
										<input class="form-control" type="text" name="note" value="{{ $order->note }}">
										@endif
									</td>
								</tr>
							</tbody>
						</table>
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="card-footer">
							<button type="submit" class="btn btn-warning">Добавить комментарий</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<h3 class="content-header">Детали заказа</h3>
		<div class="col-12">
			<div class="card">
				<div class="card-body table-responsive p-0">`
					<table class="table table-bordere table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Название</th>
								<th>Количество</th>
								<th>Цена</th>
							</tr>
						</thead>
						<tbody>
							@php $qty = 0; @endphp
							@foreach($order->orderProduct as $product)
							<tr>
								<td>{{ $product->id }}</td>
								<td>{{ $product->title }}</td>
								<td>{{ $product->qty, $qty+=$product->qty }}</td>
								<td>{{ $product->price }}€</td>
							</tr>
							@endforeach
							<tr class="active">
								<td colspan="2"><b>Итого:</b></td>
								<td><b>{{ $qty }}</b></td>
								<td><b>{{ $order->sum }}€</b></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</section>

@endsection

@section('scripts')

@include('shop.admin.orders.scripts.edit-script')

@endsection