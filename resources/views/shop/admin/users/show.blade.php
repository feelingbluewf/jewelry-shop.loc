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
					<li class="breadcrumb-item"><a href="{{ route('shop.admin.users.index') }}"><i class="nav-icon fas fa-users"></i> Пользователи</a></li>
					<li class="breadcrumb-item"><i class="far fa-eye"></i> {{ MetaTag::get('title') }}</li>
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
					<form action="" method="post">
						@csrf
						<table class="table table-bordered table-hover">
							<tbody>
								<tr>
									<td>ID</td>
									<td>{{ $user->id }}</td>
								</tr>
								<tr>
									<td>Имя</td>
									<td>{{ $user->name }}</td>
								</tr>
								<tr>
									<td>E-mail</td>
									<td>{{ $user->email }}</td>
								</tr>
								<tr>
									<td>Роль</td>
									<td>{{ $user->role->first()->name }}</td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div>
		<h3 class="content-header">Заказы пользователя</h3>
				<div class="col-12">
					<div class="card">
						<div class="card-body table-responsive p-0">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Статус</th>
										<th>Цена</th>
										<th>Дата создания</th>
										<th>Дата изменения</th>
										<th>Действия</th>
									</tr>
								</thead>
								<tbody>
									@forelse($userOrders as $userOrder)
									<tr>
										<td>{{ $userOrder->id }}</td>
										<td>{{ $userOrder->status ? 'Завершен' : 'Новый' }}</td>
										@php $price = 0; $general_price = 0;@endphp
										@foreach($userOrder->orderProduct as $product)
										@php 
										$price = $product->price + $price;
										@endphp
										@endforeach
										<td>{{ $price }}€</td>
										@php
										$general_price = $price + $general_price;
										@endphp
										<td>{{ $userOrder->created_at }}</td>
										<td>{{ $userOrder->updated_at }}</td>
										<td><a href="{{ route('shop.admin.orders.edit', $userOrder->id) }}" title="Посмотреть заказ подробнее"><i class="fa fa-fw fa-eye"></i></a></td>
									</tr>
									@empty
										<td colspan="6" class="text-center"><h2>У данного пользователя еще нет заказов!</h2></td>
									@endforelse
									@if(isset($general_price))
									<tr class="active">
										<td colspan="2"><b>Итого:</b></td>
										<td><strong>{{ $general_price }}€</strong></td>
									</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>

		@endsection