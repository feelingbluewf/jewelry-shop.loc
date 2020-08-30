@extends('shop.pages.layouts.main')

@section('content')

<div class="page-title fix">
	<div class="overlay section">
		<h2>Заказ оформлен</h2>
	</div>
</div>
<div class="alert alert-purple" style="margin-top: 20px;">
	<ul>
		<li>
			Ваш заказ успешно оформлен!
		</li>
	</ul>
</div>
@endsection

@section('scripts')

@include('shop.pages.checkout.scripts.index-script')

@endsection