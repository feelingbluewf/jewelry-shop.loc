@extends('shop.admin.layouts.app_admin')

@section('breadcrumbs')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-auto">
        <h1 class="m-0 text-dark">{{ MetaTag::get('title') }}</h1>
      </div>
      <div class="col-sm-auto">
        <a href="{{ route('shop.admin.categories.create') }}">
          <button class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Добавить категорию
          </button>
        </a>
      </div>
      <div class="col">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('shop.admin.dashboard.index') }}"><i class="nav-icon fas fa-tachometer-alt"></i> Главная</a></li>
          <li class="breadcrumb-item"><i class="nav-icon fas fa-clipboard-list"></i> {{ MetaTag::get('title') }}</li>
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
                <th>Название</th>
                <th>Привязанные товары</th>
                <th>Действия</th>
              </tr>
            </thead>
            <tbody>
              @forelse($categories as $category)
              <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->title }}</td>
                <td>
                  @forelse($category->order as $order)
                  @if($loop->last)
                  <a href="{{ route('shop.admin.products.edit', $order->id) }}"><span class="badge badge-info">{{ $order->title }}</span></a>
                  @else
                  <a href="{{ route('shop.admin.products.edit', $order->id) }}"><span class="badge badge-info">{{ $order->title }}</span></a> ,
                  @endif
                  @empty
                  <span class="badge badge-warning">Привязанных товаров нет!</span>
                  @endforelse
                </td>
                <td>
                  <a href="{{ route('shop.admin.categories.edit', $category->id) }}" title="Редактировать категорию">
                    <button class="btn btn-primary">
                      <i class="far fa-edit"></i> Редактировать
                    </button>
                  </a>
                  <a href="{{ url('/admin/categories/deleteCategory', $category->id) }}/{{ $category->title }}" onclick="confirmation(event)" title="Удалить категорию">
                    <button class="btn btn-danger">
                      <i class="fas fa-trash-alt"></i> Удалить
                    </button>
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                <td class="text-center" colspan="4"><h2>Нет категорий</h2></td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <div class="text-center">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card-body">
                {{ $categories->links() }}
                <span style="font-size: 20px;" class="badge badge-info">Всего заказов: {{ $countCategories }}</span>
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

@include('shop.admin.categories.scripts.index-script')

@endsection
