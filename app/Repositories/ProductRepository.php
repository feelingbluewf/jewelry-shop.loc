<?php 

namespace App\Repositories;

use App\Repositories\CoreRepository;
use App\Models\Product as Model;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;

class ProductRepository extends CoreRepository {

	public function __construct() {

		parent::__construct();

	}
	
	protected function getModelClass() {

		return Model::class;
		
	}

	public function getLastProducts($perPage) {

		$products = $this->startConditions()
		->orderBy('id', 'desc')
		->limit($perPage)
		->paginate($perPage);

		return $products;

	}

	public function getCountProducts() {

		$products = $this->startConditions()
		->get()
		->count();

		return $products;

	}

	public function getAllProducts($perPage) {

		$products = $this->startConditions()
		->paginate($perPage);

		return $products;

	}

	public function getRandomProducts($count, $category_id) {

		$products = $this->startConditions()
		->limit($count)
		->get();

		return $products;

	}

	public function createProduct($product) {

		$new = $product->new ? '1' : '0';
		$hot = $product->hot ? '1' : '0';

		$createdProduct = $this->startConditions()->firstOrCreate([
			'category_id' => $product->category,
			'title' => $product->title,
			'price' => $product->price,
			'old_price' => $product->old_price,
			'status' => '1',
			'description' => $product->description,
			'quantity' => $product->quantity,
			'img' => \Session::get('main'),
			'new' => $new,
			'hot' => $hot,
			'created_at' => Carbon::now()->setTimezone('Europe/Tallinn')->format('Y-m-d H:i:s')
		]);

		\Session::forget('main');

		return $createdProduct;

	}

	public function saveGallery($id) {

		$gallery = \Session::get('gallery');

		if(!empty($gallery)){

			$images = '';

			foreach ($gallery as $img) {
				$images .= "('$img', $id),";			
			}

			$images = rtrim($images, ',');
			\DB::insert("INSERT INTO galleries (img, product_id) VALUES $images");

			\Session::forget('gallery');

		}
	}

	public function getOneProduct($id) {

		$product = $this->startConditions()
		->where('id', $id)
		->first();

		return $product;

	}

	public function updateProduct($id, $product) {

		$new = $product->new ? '1' : '0';
		$hot = $product->hot ? '1' : '0';

		$img = \Session::get('main');

		if(!empty($img)) {

			$updatedProduct = $this->startConditions()
			->updateOrCreate([
				'id' => $id
			],
			[
				'category_id' => $product->category,
				'title' => $product->title,
				'price' => $product->price,
				'old_price' => $product->old_price,
				'status' => '1',
				'description' => $product->description,
				'quantity' => $product->quantity,
				'img' => $img,
				'new' => $new,
				'hot' => $hot,
				'updated_at' => Carbon::now()->setTimezone('Europe/Tallinn')->format('Y-m-d H:i:s')
			]);

			\Session::forget('main');

		}
		else {

			$updatedProduct = $this->startConditions()
			->updateOrCreate([
				'id' => $id
			],
			[
				'category_id' => $product->category,
				'title' => $product->title,
				'price' => $product->price,
				'old_price' => $product->old_price,
				'status' => '1',
				'description' => $product->description,
				'quantity' => $product->quantity,
				'new' => $new,
				'hot' => $hot,
				'updated_at' => Carbon::now()->setTimezone('Europe/Tallinn')->format('Y-m-d H:i:s')
			]);

			\Session::forget('main');

		}

		return $updatedProduct;

	}

	public function updateGallery($id) {

		$deletedImg = \Session::get('deleted_img');

		if(!empty($deletedImg)) {

			$ids = '';

			foreach (\Session::get('deleted_img') as $deletedImgId) {
				$ids .= "('$deletedImgId'),";			
			}

			$ids = rtrim($ids, ',');
			\DB::delete("DELETE FROM galleries WHERE id IN ($ids)");

			\Session::forget('deleted_img');

		}

		$gallery = \Session::get('gallery');

		if(!empty($gallery)){

			$images = '';

			foreach ($gallery as $img) {
				$images .= "('$img', $id),";			
			}

			$images = rtrim($images, ',');
			\DB::insert("INSERT INTO galleries (img, product_id) VALUES $images");

			\Session::forget('gallery');

		}
	}

	public function disableProduct($id) {

		$this->startConditions()
		->where('id', $id)
		->update([
			'status' => '0'
		]);

		return true;

	}

	public function enableProduct($id) {

		$this->startConditions()
		->where('id', $id)
		->update([
			'status' => '1'
		]);

		return true;

	}

	public function deleteProduct($id) {

		$this->startConditions()
		->where('id', $id)
		->delete();

		return true;

	}

	public function removeCategory($id) {

		$this->startConditions()
		->where('category_id', $id)
		->update([
			'category_id' => ''
		]);

		return true;

	}
}