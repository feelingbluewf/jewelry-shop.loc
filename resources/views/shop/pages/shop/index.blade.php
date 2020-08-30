@extends('shop.pages.layouts.main')

@section('content')
<div class="page-title fix">
	<div class="overlay section">
		<h2>Украшения</h2>
	</div>
</div>
<div class="shop-product-area section fix">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="shop-sidebar fix">
					<div class="sin-shop-sidebar shop-category">
						<h2>Категория</h2>
						<ul id="categories">
							<li class="category-active"><a data-id="">Все</a></li>
							@forelse($categories as $category)
							<li><a data-id="{{ $category->id }}">{{ $category->title }}</a></li>
							@empty
							@endforelse
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="row">
					<livewire:shop-products-controller />
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
