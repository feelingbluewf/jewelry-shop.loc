<?php 

namespace App\Repositories;

use App\Repositories\CoreRepository;
use App\Models\Category as Model;

class CategoryRepository extends CoreRepository {

	public function __construct() {

		parent::__construct();

	}
	
	protected function getModelClass() {

		return Model::class;
		
	}

	public function getAllCategories() {

		$categories = $this->startConditions()->all();

		return $categories;

	}

	public function getAllCategoriesPaginate($perPage) {

		$categories = $this->startConditions()->paginate($perPage);

		return $categories;

	}

	public function getCountCategories() {

		$count = $this->startConditions()
		->get()
		->count();

		return $count;

	}

	public function getOneCategory($id) {

		$category = $this->startConditions()
		->where('id', $id)
		->first();

		return $category;

	}

	public function changeTitle($id, $title) {

		$category = $this->startConditions()
		->where('id', $id)
		->update([
			'title' => $title
		]);

		return $category;

	}

	public function createCategory($title) {

		$createdCategory = $this->startConditions()
		->firstOrCreate([
			'title' => $title
		]);

		return $createdCategory;

	}

	public function deleteCategory($id) {

		$this->startConditions()
		->where('id', $id)
		->delete();

		return true;

	}

}