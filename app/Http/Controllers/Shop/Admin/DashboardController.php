<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use MetaTag;

class DashboardController extends AdminBaseController
{
    private $orderRepository;
	private $productRepository;
	private $userRepository;

	public function __construct() {

		parent::__construct();

		$this->orderRepository = app(orderRepository::class);
		$this->productRepository = app(productRepository::class);
		$this->userRepository = app(userRepository::class);

	}

	public function index() {

		MetaTag::set('title', 'Панель управления');

		$orders = 20;
		$products = 9;

		return view('shop.admin.dashboard.index', [
			'countNewOrders' => $this->orderRepository->getCountNewOrders(),
			'countOrders' => $this->orderRepository->getCountOrders(),
			'countProducts' => $this->productRepository->getCountProducts(),
			'countUsers' => $this->userRepository->getCountUsers(),
			'lastOrders' => $this->orderRepository->getAllOrders($orders),
			'lastProducts' => $this->productRepository->getLastProducts($products)
		]);

	}
}
