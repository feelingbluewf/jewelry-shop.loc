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
					<li class="breadcrumb-item"><i class="nav-icon fas fa-users"></i> {{ MetaTag::get('title') }}</li>
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
								<th>Имя</th>
								<th>E-mail</th>
								<th>Роль</th>
								<th>Действия</th>
							</tr>
						</thead>
						<tbody>
							@forelse($users as $user)
							@php
							$class = '';
							$status = $user->role;
							if($status == 'disaled') $class = 'danger';
							@endphp
							<tr class="{{ $class }}">
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->role->first()->name}}</td>
								<td><a href="{{ route('shop.admin.users.show', $user->id) }}" title="Посмотреть пользователя">
									<button class="btn btn-primary"><i class="fa fa-fw fa-eye"></i> Подробнее</button>
								</a></td>
							</tr>
							@empty 
							<tr>
								<td colspan="5" class="text-center"><h2>Нет пользователей!</h2></td>
							</tr>
							@endforelse
						</tbody>
					</table>
				</div>
				<div class="text-center">
					<div class="row justify-content-center">
						<div class="col-md-12">
							<div class="card-body">
								{{ $users->links() }}
								<span style="font-size: 20px;" class="badge badge-info">Всего пользователей: {{ $users->count() }}</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection