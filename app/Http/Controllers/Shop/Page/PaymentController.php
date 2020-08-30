<?php

namespace App\Http\Controllers\Shop\Page;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Repositories\OrderProductRepository;
use App\Repositories\UserRepository;
use Auth;
use Validation;
use MetaTag;

class PaymentController extends BaseController
{

	private $orderRepository;
	private $orderProductRepository;
	private $userRepository;

	public function __construct() {

		$this->orderRepository = app(OrderRepository::class);
		$this->orderProductRepository = app(OrderProductRepository::class);
		$this->userRepository = app(UserRepository::class);

	}

	public function index() {

		if(\Session::get('user_data')) {

			MetaTag::set('title', 'Оплата | Аметист');

			return view('shop.pages.payment.index');

		}
		else {

			return redirect()->back()->with('warning', 'Сначала заполните форму ниже!');

		}

	}

	public function createOrder(Request $request) {

		if(Validation::validateMethod($request)) {

			$user = $this->userRepository->createOrUpdate(\Session::get('user_data'));

			if($user) {

				$cart = \Session::get('cart');
				$user_id = $user->id;
				$sum = 0;

				foreach ($cart as $value) {
					$sum = $value['total'] + $sum;
				}

				$order = $this->orderRepository->createOrder($user_id, $sum, $request->method);

				if($order) {

					$products = [];
					
					foreach($cart as $value) {
						$products[] = ['order_id' => $order->id, 'product_id' => $value['id'], 'qty' => $value['quantity'], 'title' => $value['title'], 'price' => $value['price'], 'value' => $value['total']];
					}

					$orderProducts = $this->orderProductRepository->createOrderProducts($products);

					if($orderProducts) {
						return redirect(route('process'));
					}
					else {
						abort(404);
					}
				}
				else {
					abort(404);
				}

			}

		} 

	}
}
