<?php 

namespace App\Repositories;

use App\Repositories\CoreRepository;
use App\Models\Order as Model;
use Carbon\Carbon;
use UniqueId;

class OrderRepository extends CoreRepository {
	
	public function __construct() {

		parent::__construct();

	}
	
	protected function getModelClass() {

		return Model::class;
		
	}

	public function getAllOrders($perPage) {

		$orders = $this->startConditions()
		->join('users', 'orders.user_id', '=', 'users.id')
		->join('order_products', 'order_products.order_id', '=', 'orders.id')
		->select('orders.id', 'orders.user_id', 'orders.status', 'orders.note', 'orders.created_at', 'orders.updated_at', 'users.name', \DB::raw('SUM(order_products.price) AS sum'))
		->groupBy('orders.status')
		->groupBy('orders.id')
		->toBase()
		->paginate($perPage);

		return $orders;
	}

	public function getCountNewOrders() {

		$orders = $this->startConditions()
		->where('status', '0')
		->orWhere('status', '1')
		->get()
		->count();

		return $orders;

	}

	public function getCountOrders() {

		$orders = $this->startConditions()
		->get()
		->count();

		return $orders;

	}

	public function getOneOrder($id) {

		$order = $this->startConditions()
		->join('users', 'orders.user_id', '=', 'users.id')
		->join('order_products', 'order_products.order_id', '=', 'orders.id')
		->select('orders.*', 'users.name', 'users.id as user_id',\DB::raw('SUM(order_products.price) AS sum'))
		->where('orders.id', '=', $id)
		->groupBy('orders.id')
		->first();

		return $order;
	}

	function getOneOrderWithUserID($user_id, $id) {

		return $this->startConditions()
		->where('user_id', $user_id)
		->where('id', $id)
		->first();

	}

	public function getUserOrders($id, $perPage) {

		$order = $this->startConditions()
		->where('user_id', $id)
		->paginate($perPage);

		return $order;

	}

	public function addNote($id, $note) {

		$this->startConditions()
		->where('id', $id)
		->update([
			'note' => $note
		]);

		return true;

	}

	public function approveOrder($id) {

		$this->startConditions()
		->where('id', $id)
		->update([
			'status' => '1'
		]);

		return true;

	}

	public function returnToRevision($id) {

		$this->startConditions()
		->where('id', $id)
		->update([
			'status' => '0'
		]);

		return true;

	}

	public function delivered($id) {

		$this->startConditions()
		->where('id', $id)
		->update([
			'status' => '2'
		]);

		return true;

	}

	public function deleteOrder($id) {

		$this->startConditions()
		->where('id', $id)
		->delete();

		return true;

	}

	public function createOrder($user_id, $sum, $method) {

		return $this->startConditions()
		->create([
			'unique_id' => UniqueId::get($user_id),
			'user_id' => $user_id,
			'status' => '0',
			'sum' => $sum,
			'method' => $method,
			'created_at' => Carbon::now()->setTimezone('Europe/Tallinn')->format('Y-m-d H:i:s')
		]);

	}
}