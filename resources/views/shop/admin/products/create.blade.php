@php

\Session::forget('gallery');
\Session::forget('main');

@endphp

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
					<li class="breadcrumb-item"><a href="{{ route('shop.admin.products.index') }}"><i class="nav-icon fas fa-boxes"></i> Товары</a></li>
					<li class="breadcrumb-item"><i class="fas fa-plus-circle"></i> {{ MetaTag::get('title') }}</li>
				</ol>
			</div>
		</div>
	</div>
</div>

@endsection

@section('content')

<link rel="stylesheet" href="{{ asset('/css/upload.css') }}">
<link rel="stylesheet" href="{{ asset('/css/img.css') }}">
<script src="{{ asset('/js/core.js') }}"></script>
<script src="{{ asset('/js/upload.js') }}"></script>

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<form id="addProductForm" action="{{ route('shop.admin.products.store') }}" method="POST">
					@csrf
					<div class="card-body">
						<div class="form-group has-feedback">
							<label for="title">Название товара</label>
							<input type="text" name="title" class="form-control" id="title" placeholder="Название товара" value="{{ old('title') }}" required>
							<span class="glyphicon form-control-feedback"></span>
						</div>
						<div class="form-group">
							<select name="category" id="category" class="form-control" required>
								<option value="">--- Выберите категорию ---</option>
								@forelse($categories as $category)
								<option value="{{ $category->id }}">{{ $category->title }}</option>
								@empty
								@endforelse
							</select>
						</div>
						<div class="form-group">
							<label for="description">Описание</label>
							<input type="text" name="description" class="form-control" id="description" placeholder="Описание" value="{{ old('description') }}" required>
						</div>
						<div class="form-group has-feedback">
							<label for="price">Цена</label>
							<input type="text" name="price" class="form-control" id="price" placeholder="Цена" pattern="^([0-9]{1,})([\.]{1,1}[0-9]{2,2})$" value="{{ old('price') }}" required> 
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group has-feedback">
							<label for="old_price">Старая цена</label>
							<input type="text" name="old_price" class="form-control" id="old_price" placeholder="Старая цена" pattern="^([0-9]{1,})([\.]{1,1}[0-9]{2,2})$" value="{{ old('old_price') }}">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-group has-feedback">
							<label for="quantity">Количество</label>
							<input type="text" name="quantity" class="form-control" id="quantity" placeholder="Количество" pattern="^[0-9]{1,}$" value="{{ old('quantity') }}">
							<div class="invalid-feedback" required></div>
						</div>
						<div class="form-group">
							<label>
								<input id="new" type="checkbox" name="new">NEW
							</label>
						</div>
						<div class="form-group">
							<label>
								<input id="hot" type="checkbox" name="hot">HOT
							</label>
						</div>
						<div class="row">
							<div class="col-md-4">
								@include('shop.admin.products.include.image_main')
							</div>
							<div class="col-md-8">
								@include('shop.admin.products.include.image_gallery')
							</div>
						</div>
					</div>
					<input type="hidden" id="_token" value="{{ csrf_token() }}">
					<div class="card-footer">
						<button type="submit" id="submitForm" class="btn btn-success" style="margin-bottom: 10px;">Добавить</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

@endsection

@section('scripts')

@include('shop.admin.products.scripts.create-script')

@endsection
