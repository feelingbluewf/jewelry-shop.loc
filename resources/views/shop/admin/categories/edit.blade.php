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
          <li class="breadcrumb-item"><a href="{{ route('shop.admin.categories.index') }}"><i class="nav-icon fas fa-clipboard-list"></i> Категории</a></li>
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
          <form action="{{ route('shop.admin.categories.update', $category->id) }}" id="form" method="post">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Название</th>
                  <th>Привязанные товары</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $category->id }}</td>
                  <td><input type="text" id="categoryTitle" name="categoryTitle" value="{{ $category->title }}" required></td>
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
                </tr>
              </tbody>
            </table>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="card-footer">
            <button id="changeTitle" class="btn btn-warning">
              <i class="far fa-edit"></i> Поменять название
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')

@include('shop.admin.categories.scripts.edit-script')

@endsection
