<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
	protected $fillable = [
		'user_id',
		'role_id'
	];

	public $timestamps = false;

	public function role() {

		return $this->belongsToMany('App\Models\Role', 'id', 'role_id');

	}
}
