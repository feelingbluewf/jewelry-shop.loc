<?php 

namespace App\Repositories;

use App\Repositories\CoreRepository;
use App\Models\Order_product as Model;

class OrderProductRepository extends CoreRepository {

	public function __construct() {

		parent::__construct();

	}
	
	protected function getModelClass() {

		return Model::class;
		
	}

	public function createOrderProducts($products) {

		return $this->startConditions()
		->insert($products);

	}

}