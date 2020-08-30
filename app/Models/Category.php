<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

	public $timestamps = false;

	protected $fillable = [
		'id',
		'title',
		'created_at',
		'updated_at',
		'deleted_at'
	];

	public function order() {

		return $this->hasMany(Product::Class, 'category_id', 'id');

	}

}
