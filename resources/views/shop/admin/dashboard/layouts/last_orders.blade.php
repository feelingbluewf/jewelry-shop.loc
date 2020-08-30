<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Последние заказы</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>ID</th>
              <th>Покупатель</th>
              <th>Статус</th>
              <th>Цена</th>
            </tr>
          </thead>
          <tbody>
            @foreach($lastOrders as $order)
            <tr>
              <td><a href="{{ route('shop.admin.orders.edit', $order->id) }}">{{ $order->id }}</a></td>
              <td><a href="{{ route('shop.admin.users.show', $order->user_id)}}">{{ $order->name }}</a></td>
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
                <td>{{ $order->sum }}€</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>