<div>
	<div class="shop-tool-bar col-sm-12 fix">
		<div class="sort-by">
			<span>Сортировать по стоимости от:</span>
			<select name="sort-by" wire:model="price">
				<option selected="selected" value="asc">Наименьшей</option>
				<option value="desc">Наибольшей</option>
			</select>
		</div>
	</div>
	<div class="shop-products">
		@forelse($products as $product)
		<div class="col-sm-4 fix">
			<div class="product-item fix">
				<div class="product-img-hover">
					<a href="{{ route('shop.pages.shop.show', $product->id) }}" class="pro-image fix"><img src="{{ asset('/uploads/main') }}/{{ $product->img }}" alt="{{ $product->title }}" /></a>
				</div>
				<div class="pro-name-price-ratting">
					<div class="pro-name">
						<a href={{ route('shop.pages.shop.show', $product->id) }}>{{ $product->title }}</a>
					</div>
					<div class="pro-price fix">
						@if($product->old_price)
						<p><span class="old">{{ $product->old_price }}€</span><span class="new">{{ $product->price }}€</span></p>
						@else
						<p><span class="new">{{ $product->price }}€</span></p>
						@endif
					</div>
				</div>
			</div>
		</div>
		@empty
		@endforelse
		<div>
			<button id="refresh" wire:click=""></button>
		</div>
		<div class="text-center">
			<div class="row justify-content-center">
				<div class="col-md-12">
					<div class="card-body">
						<div class="pagination" style="margin-bottom: 20px;">
							{{ $products->links('partials.pagination') }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
