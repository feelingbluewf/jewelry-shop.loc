<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ShopProductsController extends Component
{
	private $product;

	public $category_id;
	public $price = 'asc';

	public function render()
	{

		$perPage = 12;

		return view('livewire.shop-products-controller', [
			'products' => Product::getReadyProducts($perPage, $this->category_id, $this->price)
		]);

	}
}
