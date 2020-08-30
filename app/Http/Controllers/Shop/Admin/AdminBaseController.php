<?php

namespace App\Http\Controllers\Shop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Shop\BaseController as BaseController;

class AdminBaseController extends BaseController
{

	public function __construct() {

		$this->middleware('auth');
		$this->middleware('role');

	}

}
