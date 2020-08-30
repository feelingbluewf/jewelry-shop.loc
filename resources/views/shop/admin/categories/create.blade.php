@extends('shop.admin.layouts.app_admin')

@section('breadcrumbs')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-auto">
        <h1 class="m-0 text-dark">{{ MetaTag::get('title') }}</h1>
      </div>
      <div class="col">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('shop.admin.dashboard.index') }}"><i class="nav-icon fas fa-tachometer-alt"></i> Главная</a></li>
          <li class="breadcrumb-item"><a href="{{ route('shop.admin.categories.index') }}"><i class="nav-icon fas fa-clipboard-list"></i> Категории</a></li>
          <li class="breadcrumb-item"><i class="fas fa-plus-circle"></i>{{ MetaTag::get('title') }}</li>
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
          <form action="{{ route('shop.admin.categories.store') }}" method="post">
            @csrf
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Название</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input class="form-control" name="title" value="{{ old('title') }}" type="text" required>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Добавить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection
