<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

   use SoftDeletes;

   protected $fillable = [
   	'id',
    'unique_id',
   	'user_id',
    'unregistered_user_id',
   	'status',
    'sum',
    'method',
    'document',
    'note',
   	'created_at',
   	'updated_at',
   	'deleted_at'
   ];

   public $timestamps = false;

   public function orderProduct() {
        
        return $this->hasMany('App\Models\Order_product', 'order_id', 'id');

    }

}
