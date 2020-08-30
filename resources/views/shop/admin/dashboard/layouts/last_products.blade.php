<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Последние добавленные товары</h3>
        <div class="card-tools">
        </div>
      </div>
      <div class="card-body table-responsive p-0">
        <div class="box-boy">
          <ul class="products-list products-list-in-box">
            @foreach($lastProducts as $product)
            <li class="item" style="display: flex;">
              <div class="col-sm-2">
                <img src="{{ asset('/uploads/main') }}/{{ $product->img }}" class="img-fluid">
              </div>
              <div class="col-sm-auto">
                <a href="{{ route('shop.admin.products.edit', $product->id) }}" class="product-title">{{ $product->title }}
                  <span class="badge badge-warning pull-right">
                    {{ $product->price }}€
                  </span>
                </a>
                <span class="product-description">{{ $product->description }}</span>
              </div>
            </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>