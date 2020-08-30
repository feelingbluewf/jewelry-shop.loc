<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unregistered_user extends Model
{

	protected $fillable = [
		'name',
		'surename',
		'email',
		'city',
		'address',
		'phone'
	];

}
