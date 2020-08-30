<?php

namespace App\Http\Controllers\Shop\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MetaTag;

class ProcessController extends Controller
{
    
	public function index() {

		MetaTag::set('title', 'Заказ оформлен | Аметист');

		return view('shop.pages.process.index');

	}

}
