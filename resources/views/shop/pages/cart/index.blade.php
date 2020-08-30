@extends('shop.pages.layouts.main')

@section('content')

<div class="page-title fix">
	<div class="overlay section">
		<h2>Корзина</h2>
	</div>
</div>
<section class="cart-page page fix">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table cart-table">
						<thead class="table-title">
							<tr>
								<th class="produ">Товар</th>
								<th class="namedes">Название &amp; Описание</th>
								<th class="unit">Цена (шт.)</th>
								<th class="quantity">Количество</th>
								<th class="valu">Сумма</th>
								<th class="acti">Действие</th>
							</tr>													
						</thead>
						<tbody>
							<tr class="table-info">
								<td class="produ" colspan="6">
									<h4>Корзина пуста</h4>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-sm-6 col-md-7">
				<div class="coupon">
					<a href="{{ route('shop.pages.shop.index') }}"><i class="fas fa-undo"></i> Вернуться</a>
				</div>
			</div>
			<div class="col-sm-6 col-md-5" id="continue">
				<div class="proceed fix">
					<div class="total">
						<h6>Общая сумма <span>0€</span></h6>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

@endsection

@section('scripts')

<script>
	$(document).on("click", "#procedto" , function(e) {
		$('#cart').val(JSON.stringify(cart));
		e.preventDefault();

		setTimeout("$('#cartForm').submit()", 500);

	});

</script>

@endsection