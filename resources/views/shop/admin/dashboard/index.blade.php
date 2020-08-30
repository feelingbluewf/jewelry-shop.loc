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
          <li class="breadcrumb-item">{{ MetaTag::get('title') }}</li>
        </ol>
      </div>
    </div>
  </div>
</div>

@endsection

@section('content')

<div class="container-fluid">
  <!-- Widgets -->
  <div class="row">

    @include('shop.admin.dashboard.layouts.widgets')

  </div>
  <!-- /.widgets -->

  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-6 connectedSortable">

      @include('shop.admin.dashboard.layouts.last_orders')

    </section>
    <!-- /.Left col -->

    <!-- right col -->
    <section class="col-lg-6 connectedSortable">

      @include('shop.admin.dashboard.layouts.last_products')

    </section>
    <!-- /.right col -->
  </div>

</div>


@endsection