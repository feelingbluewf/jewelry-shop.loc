<?php 

namespace App\Repositories;

use App\Repositories\CoreRepository;
use App\Models\Unregistered_user as Model;

class UnregisteredUserRepository extends CoreRepository {

	public function __construct() {

		parent::__construct();

	}
	
	protected function getModelClass() {

		return Model::class;
		
	}

	public function createUnregisteredUser($user) {

		return $this->startConditions()
		->create([
			'name' => $user['name'],
			'surename' => $user['surename'],
			'address' => $user['address'],
			'phone' => $user['phone'],
			'city' => $user['city']
		]);

	}

}