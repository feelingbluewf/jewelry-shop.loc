<?php 

namespace App\Repositories;

use App\Repositories\CoreRepository;
use App\Models\User as Model;

class UserRepository extends CoreRepository {

	public function __construct() {

		parent::__construct();

	}
	
	protected function getModelClass() {

		return Model::class;
		
	}

	public function getCountUsers() {

		$users = $this->startConditions()
		->get()
		->count();

		return $users;

	}

	public function getAllUsers($perPage) {

		$users = $this->startConditions()
		->orderBy('id')
		->paginate($perPage);

		return $users;

	}

	public function getOneUser($id) {

		$user = $this->startConditions()
		->where('id', $id)
		->first();

		return $user;

	}

	public function changePassword($id, $new_password) {

		return $this->startConditions()
		->where('id', $id)
		->update([
			'password' => $new_password
		]);

	}

	public function changeUserData($id, $user) {

		return $this->startConditions()
		->where('id', $id)
		->update([
			'name' => $user->name,
			'surename' => $user->surename,
			'address' => $user->address,
			'phone' => $user->phone,
			'city' => $user->city
		]);

	}

	public function createOrUpdate($user) {

		return $this->startConditions()
		->firstOrCreate([
			'email' => $user['email']
		],
			[
			'name' => $user['name'],
			'surename' => $user['surename'],
			'address' => $user['address'],
			'phone' => $user['phone'],
			'city' => $user['city']
		]);

	}

	public function ifExistsByEmail($email) {

		return $this->startConditions()
		->where('email', '=', $email)
		->where('email_verified_at', '!=', NULL)
		->exists();

	}

}