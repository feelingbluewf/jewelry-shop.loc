
@extends('shop.pages.layouts.main')

@section('content')
<div class="page-title fix">
	<div class="overlay section">
		<h2>Подробнее</h2>
	</div>
</div>
<section class="product-page page fix">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="details-pro-tab">
					<div class="tab-content details-pro-tab-content">
						<div class="tab-pane fade in active" id="image-1">
							<div class="simpleLens-big-image-container">
								<a href="{{ url('/uploads/main', $product->img) }}" data-lightbox="image-1">
									<img id="image" width="600px" src="{{ url('/uploads/main', $product->img) }}" alt="{{ $product->title }}" class="simpleLens-big-image">
								</a>
							</div>
						</div>
					</div>
					<ul class="tabs-list details-pro-tab-list" role="tablist">
						@forelse($product->gallery as $gallery)
						<li class="active">
							<a href="{{ url('/uploads/gallery', $gallery->img) }}" data-lightbox="image-1"><img src="{{ url('/uploads/gallery', $gallery->img) }}" alt="{{ $product->title }}" /></a>
						</li>
						@empty
						@endforelse
					</ul>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="shop-details">
					<h2 id="title">{{ $product->title }}</h2>
					@if($product->old_price)
					<h3><span>{{ $product->old_price }}€</span><price id="price">{{ $product->price }}€</price></h3>
					@else
					<h3 id="price">{{ $product->price }}€</h3>
					@endif
					@if($product->quantity == '0')
					<h5><span>Нет в наличии</span></h5>
					@else
					<h5><span>В наличии</span></h5>
					@endif
					<h6>Описание</h6>
					<p id="description">{{ $product->description }}</p>
					<button class="btn btn-shop" data-id="{{ $product->id }}">
						<i class="fas fa-shopping-cart"></i> В корзину
					</button>
				</div>
			</div>
			<div class="col-md-12 fix">
				<div class="section-title">
					<h2>Также смотрите</h2>
					<div class="underline"></div>
				</div>
				<div class="related-pro-slider owl-carousel">
					@forelse($otherProducts as $product)
					<div class="product-item fix">
						<div class="product-img-hover">
							<a href="{{ route('shop.pages.shop.show', $product->id) }}" class="pro-image fix"><img src="{{ url('/uploads/main', $product->img) }}" alt="{{ $product->title }}" /></a>
							<div class="product-action-btn">
							</div>
						</div>
						<div class="pro-name-price-ratting">
							<div class="pro-name">
								<a href="{{ route('shop.pages.shop.show', $product->id) }}">{{ $product->title }}</a>
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
					@empty
					@endforelse
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
