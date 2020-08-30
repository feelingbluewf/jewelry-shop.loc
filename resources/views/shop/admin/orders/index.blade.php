@extends('shop.admin.layouts.app_admin')

@section('breadcrumbs')

<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">{{ MetaTag::get('title') }}</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('shop.admin.dashboard.index') }}"><i class="nav-icon fas fa-tachometer-alt"></i> Главная</a></li>
					<li class="breadcrumb-item"><i class="nav-icon fas fa-shopping-cart"></i> {{ MetaTag::get('title') }}</li>
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
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Покупатель</th>
								<th>Статус</th>
								<th>Цена</th>
								<th>Комментарий</th>
								<th>Дата создания</th>
								<th>Дата изменения</th>
								<th>Действия</th>
							</tr>
						</thead>
						<tbody>
							@forelse($orders as $order)
							@php $class = $order->status ? 'success' : '' @endphp
							<tr class="{{ $class }}">
								<td><a href="">{{ $order->id }}</a></td>
								<td><a href="">{{ $order->name }}</a></td>
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
								<td>{{ $order->sum }}€</td>
								<td>{{ $order->note }}</td>
								<td>{{ $order->created_at }}</td>
								<td>{{ $order->updated_at }}</td>
								<td>
									<a href="{{ route('shop.admin.orders.edit', $order->id) }}" title="Редактировать заказ">
										<button class="btn btn-primary">
											<i class="far fa-edit"></i> Редактировать
										</button>
									</a>
									<a href="{{ url('/admin/orders/deleteOrder', $order->id) }}" onclick="confirmation(event)" title="Удалить товар">
										<button class="btn btn-danger">
											<i class="fas fa-trash-alt"></i> Удалить
										</button>
									</a>
								</td>
							</tr>
							@empty
							<tr>
								<td class="text-center" colspan="8"><h2>Нет заказов!</h2></td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="text-center">
					<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="card-body">
								{{ $orders->links() }}
								<span style="font-size: 20px;" class="badge badge-info">Всего заказов: {{ $countOrders }}</span>
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

@include('shop.admin.orders.scripts.index-script')

@endsection