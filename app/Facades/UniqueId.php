<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class UniqueId extends Facade {

	protected static function getFacadeAccessor() {

		return 'UniqueId';

	}

}