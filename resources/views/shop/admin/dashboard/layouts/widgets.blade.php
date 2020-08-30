<div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-info">
    <div class="inner">
      <h3>{{ $countOrders ?? 0 }}</h3>

      <p>Заказы</p>
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
    <a href="{{ route('shop.admin.orders.index') }}" class="small-box-footer">Больше информации
     <i class="fas fa-arrow-circle-right"></i></a>
   </div>
 </div>

 <!-- ./col -->
 <div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-warning">
    <div class="inner">
      <h3>{{ $countUsers ?? 0 }}</h3>

      <p>Пользователи</p>
    </div>
    <div class="icon">
      <i class="ion ion-person-add"></i>
    </div>
    <a href="{{ route('shop.admin.users.index') }}" class="small-box-footer">Больше информации
     <i class="fas fa-arrow-circle-right"></i></a>
   </div>
 </div>
 <!-- ./col -->
 <div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-success">
    <div class="inner">
      <h3>{{ $countProducts ?? 0 }}</h3>

      <p>Товары</p>
    </div>
    <div class="icon">
      <i class="ion ion-bag"></i>
    </div>
    <a href="{{ route('shop.admin.products.index') }}" class="small-box-footer">Больше информации
     <i class="fas fa-arrow-circle-right"></i></a>
   </div>
 </div>
 <!-- ./col -->
 <div class="col-lg-3 col-6">
  <!-- small box -->
  <div class="small-box bg-danger">
    <div class="inner">
      <h3>{{ $countUniqueUsers ?? 0 }}</h3>

      <p>Уникальные посетители</p>
    </div>
    <div class="icon">
      <i class="ion ion-pie-graph"></i>
    </div>
    <a href="#" class="small-box-footer">Больше информации
     <i class="fas fa-arrow-circle-right"></i>
   </a>
   </div>
 </div>