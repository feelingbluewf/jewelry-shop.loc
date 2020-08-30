<script>
		
	if(Object.keys(cart).length === 0 && cart.constructor === Object) {

		window.location.href = "/";

		alert('Вы не добавили товары в корзину!');

	}

</script>

<script>
	
	var total = 0;
	var count = Object.keys(cart).length;
	var long = '<a href="{{ route('shop.pages.cart.index') }}" style="color: #9966cc;"><i class="fas fa-eye"></i> Пересмотреть</a><div class="cart-hover"><ul class="header-cart-pro">';

	for(var key in cart) {
3
		total = Number.parseFloat(cart[key]['total']) + total;

		long += '<li><div class="image"><a href="{{ asset('shop/') }}/' + key + '"><img alt="' + cart[key]['title'] + '" src="' + cart[key]['image'] + '"></a></div><div class="content fix"><a href="{{ asset('/shop/') }}/' + key + '">' + cart[key]['title'] + '</a><span class="price">Цена: ' + cart[key]['price'] + '€</span><span class="quantity">Количество: ' + cart[key]['quantity'] + '</span><span class="price">Сумма: ' + cart[key]['total'] + '€</span></div></li>';


	}

	long += '</ul><div class="total-price"><h4>Общая сумма : <span>' + Number.parseFloat(total).toFixed(2) + '€</span></h4></div></div>';

	var short = '<tr><td>Кол-во товаров:</td><td>' + count + '</td></tr><tr><td><strong>Сумма:</strong></td><td><strong>' + total.toFixed(2) + '€</strong></td></tr>'

	$('#cart').html(short);
	$('#recheck').html(long);

</script>