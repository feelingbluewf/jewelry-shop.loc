@extends('layouts.app_admin')

@section('breadcrumbs')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">{{ MetaTag::get('title') }}</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{ route('project.admin.dashboard.index') }}"><i class="nav-icon fas fa-tachometer-alt"></i> Главная</a></li>
					<li class="breadcrumb-item"><i class="fas fa-clipboard-list"></i> {{ MetaTag::get('title') }}</li>
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
								<th>Фото</th>
								<th>Название</th>
								<th>Цена</th>
								<th>Категория</th>
								<th>Кол-во в наличии</th>
								<th>Статус</th>
								<th>Действия</th>
							</tr>
						</thead>
						<tbody>
							@forelse($products as $product)
							<tr>
								<td>{{ $product->id }}</td>
								<td>
									<div class="col-sm-4">
										<img src="{{ asset('/uploads/main') }}/{{ $product->img }}" class="img-fluid">
									</div>
								</td>
								<td>{{ $product->title }}</td>
								<td>{{ $product->price }}€</td>
								@if($product->category)
								<td>{{ $product->category->title }}</td>
								@else
								<td><span class="badge badge-danger" style="text-transform: uppercase;">нужно срочно добавить категорию!</span></td>
								@endif
								<td>{{ $product->quantity }}</td>
								@if($product->status == 1)
								<td><span class="badge badge-success">Включен</span></td>
								@else
								<td><span class="badge badge-danger">Выключен</span></td>
								@endif
								<td>
									<a href="{{ route('shop.admin.products.edit', $product->id) }}" title="Редактировать товар">
										<button class="btn btn-primary mb-2"><i class="far fa-edit"></i> Редактировать</button>
									</a>
									@if($product->status == 1)
									<a href="{{ url('/admin/products/toggleOff', $product->id) }}" title="Выключить">
										<button type="submit" class="btn btn-dark mb-2"><i class="fas fa-toggle-off"></i> Выключить</button>
									</a>
									@else
									<a href="{{ url('/admin/products/toggleOn', $product->id) }}" title="Выключить">
										<button type="submit" class="btn btn-dark mb-2"><i class="fas fa-toggle-on"></i> Включить</button>
									</a>
									@endif
									<a href="{{ url('/admin/products/deleteProduct', $product->id) }}/{{ $product->title }}" title="Удалить товар" onclick="confirmation(event)">
										<button class="btn btn-danger mb-2"><i class="fas fa-trash-alt"></i> Удалить</button>
									</a>
								</td>
							</tr>
							@empty 
							<tr>
								<td colspan="8" class="text-center"><h2>Нет обрядов!</h2></td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="text-center">
					<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="card-body">
								{{ $products->links() }}
								<span style="font-size: 20px;" class="badge badge-info">Всего товаров: {{ $products->count() }}</span>
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

{{-- @include('shop.admin.products.scripts.index-script') --}}

@endsection