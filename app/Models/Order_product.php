<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_product extends Model
{

	protected $fillable = [
		'id',
		'order_id',
		'product_id',
		'qty',
		'title',
		'price',
		'value'
	];

	public $timestamps = false;

	public function event() {

		return $this->belongsTo('App\Models\Order');

	}

	public function product() {
		return $this->belongsTo(Product::class, 'product_id', 'id');
	}
}
