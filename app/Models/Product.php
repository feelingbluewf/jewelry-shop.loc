<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	use SoftDeletes;

  public $timestamps = false;

  protected $fillable = [
    'category_id',
    'title',
    'content',
    'price',
    'old_price',
    'status',
    'keywords',
    'description',
    'quantity',
    'img',
    'new',
    'hot',
    'created_at',
    'updated_at',
    'deleted_at'
  ];

  public function category() {
    return $this->belongsTo(Category::class, 'category_id', 'id');
  }

  public function gallery() {
    return $this->HasMany(Gallery::class, 'product_id', 'id');
  }

  static function getReadyProducts($perPage, $category_id, $price) {

    if(empty($category_id)) {

     $products = static::where('status', '!=', '0')
     ->orderBy('price', $price)
     ->paginate($perPage);

   }
   else {

    $products = static::where('status', '!=', '0')
    ->where('category_id', $category_id)
    ->orderBy('price', $price)
    ->paginate($perPage);

  }

  return $products;

}

}
