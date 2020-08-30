<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class UniqueIdServiceProvider extends ServiceProvider {

	public function register() {

		$this->app->bind('UniqueId', 'App\Services\UniqueId');

	}

}