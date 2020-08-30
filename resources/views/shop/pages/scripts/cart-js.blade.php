<script>
	//cart
	var cart = {};

	// on click add to cart
	$('.btn-shop').on('click', addToCart);

	//add to cart
	function addToCart() {

		//properties
		var id = $(this).data('id');
		var title = $('#title').text();
		var quantity = 1;
		var price = Number.parseFloat($('#price').text().split('€')[0]);
		var description = $('#description').text();
		var image = $('#image').attr('src');

		//if doesn't exist
		if(cart[id] === undefined) {
			cart[id] = {"title": title, "quantity": quantity, "price": price.toFixed(2), "total": price.toFixed(2), "description": description, "image": image};
		}
		//if exist
		else {
			var total = Number.parseFloat(cart[id]['total']) + Number.parseFloat(price);
			cart[id] = {"title": title, "quantity": cart[id]['quantity'] + 1, "price": price.toFixed(2), "total": total.toFixed(2), "description": description, "image": image};
		}
		//save cart
		saveCart()
		//render cart
		loadCart();

	}

	function saveCart() {
		//save cart to localStroage as cart
		localStorage.setItem('cart', JSON.stringify(cart));
	}

	//render cart
	function showMiniCart() {

		//get count of orders
		var count_products = Object.keys(cart).length;

		//if cart is empty
		if(count_products == 0) {
			//to hide counter (span) if cart is empty
			count_products = '';

			var out = '<a href="{{ route('shop.pages.cart.index') }}"><i class="fa fa-shopping-cart" style="font-size: 20px;"></i> Корзина</a><div class="cart-hover"><ul class="header-cart-pro"><li><div class="content fix"><a href="#"><h4>Корзина пуста</h4></a></div></li></ul><div class="header-button-price"><a href="{{ route('shop.pages.cart.index') }}"><i class="fa fa-sign-out"></i><span>Пересмотреть</span></a>/div></div>';

		}
		else {

			var out = '<span class="order-count badge">' + count_products + '</span><a href="{{ route('shop.pages.cart.index') }}"><i class="fa fa-shopping-cart" style="font-size: 20px;"></i> Корзина</a><div class="cart-hover"><ul class="header-cart-pro">';

			var total = 0;

			for(var key in cart) {
			//calculate total price
			total = Number.parseFloat(cart[key]["total"]) + Number.parseFloat(total);

			out += '<li><div class="image"><a href="{{ asset('shop/') }}/' + key + '"><img alt="' + cart[key]['title'] + '" src="' + cart[key]['image'] + '"></a></div><div class="content fix"><a href="{{ asset('/shop/') }}/' + key + '">' + cart[key]['title'] + '</a><span class="price">Цена: ' + cart[key]['price'] + '€</span><span class="quantity">Количество: ' + cart[key]['quantity'] + '</span><span class="price">Сумма: ' + cart[key]['total'] + '€</span></div><i class="fa fa-trash delete" data-id="' + key + '" onclick="deleteFromCart(this)"></i></li>';
		}

		out += '</ul><div class="header-button-price"><a href="{{ route('shop.pages.cart.index') }}"><span>Купить</span></a><div class="total-price"><h3>Общая сумма : <span>' + Number.parseFloat(total).toFixed(2) + '€</span></h3></div></div></div>';

	}


	$('#minicart').html(out);

}

	function showCart() {
		//prop
		var out = '';
		var allTotal = 0;

		if(Object.keys(cart).length == 0) {

			//output for table
			out += '<tr class="table-info"><td class="produ" colspan="6"><h4>Корзина пуста</h4></td></tr>';

			//output for total
			var out2 = '<div class="proceed fix"><div class="total"><h6>Общая сумма <span>0€</span></h6></div></div>'

		}
		else {

			for(var key in cart) {
			//calculate total price of all
			var allTotal = Number.parseFloat(cart[key]['total']) + Number.parseFloat(allTotal);

			//output for table
			out += '<tr class="table-info"><td class="produ"><a href="{{ asset('/shop') }}/' + key + '"><img alt="' + cart[key]['title'] + '" src="' + cart[key]['image'] + '"></a></td><td class="namedes"><h2><a href="{{ asset('/shop') }}/' + key + '">' + cart[key]['title'] + '</a></h2><p>' + cart[key]['description'] + '</p></td><td class="unit"><h5>' + cart[key]['price'] + '€</h5></td><td class="quantity"><div class="cart-plus-minus"><div class="dec qtybutton">-</div><input type="text" value="' + cart[key]['quantity'] + '" name="qtybutton" class="cart-plus-minus-box" data-id="' + key + '" disabled><div class="inc qtybutton">+</div></div></td><td class="valu"><h5>' + cart[key]['total'] + '€</h5></td><td class="acti"><a href="#"><i class="fas fa-trash" onclick="deleteFromCart(this)" data-id="' + key + '"></i></a></td></tr>';

		}
		//output for total
		var out2 = '<div class="proceed fix"><a href="#" onclick="deleteCart()">Очистить корзину</a><div class="total"><h6>Общая сумма <span>' + allTotal.toFixed(2) + '€</span></h6></div><form action="{{ route('shop.pages.cart.store') }}" method="POST" id="cartForm">@csrf<input type="hidden" name="cart" id="cart" value=""><button type="submit" id="procedto">Продолжить <i class="fas fa-arrow-right"></i></button></form>';

		}
		console.log(cart);
		$('#continue').html(out2);
		$('tbody').html(out);

	}

	function incrementCount(id) {

		//increment quantity
		cart[id]['quantity']++;

		//recalculate total 
		reCalculateTotal(id);

		//save cart
		saveCart();

		//rerender cart
		loadCart();

	}

	function decrementCount(id) {

		//decrement quantity
		cart[id]['quantity']--;

		//recalculate total
		reCalculateTotal(id);

		//save cart
		saveCart();

		//rerender cart
		loadCart();

	}

	function reCalculateTotal(id) {

		//get quantity and total
		var quantity = cart[id]['quantity'];
		var price = cart[id]['price'];

		//calculate
		var total = quantity *  Number.parseFloat(price);

		//set new totoal
		cart[id]['total'] = total.toFixed(2);

	}

	function deleteCart() {

		//clean cart
		cart = {};

		//save cart
		saveCart();

		//load cart
		loadCart();


	}

	function deleteFromCart(item) {

		//get id of object
		var id = $(item).data('id');

		//delete by id from object
		delete cart[id];

		//save cart
		saveCart();

		//render cart
		loadCart();

	}

	//load cart
	function loadCart() {
		//if is set
		if(localStorage.getItem('cart')) {

			//set cart
			cart = JSON.parse(localStorage.getItem('cart'));

			//render minicart
			showMiniCart();

			//if url has cart
			if(window.location.pathname == '/cart') {
				//render main cart
				showCart();
			}
		}
	}

	loadCart();

</script>