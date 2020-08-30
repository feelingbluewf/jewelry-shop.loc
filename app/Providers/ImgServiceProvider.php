<?php 

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ImgServiceProvider extends ServiceProvider {

	public function register() {

		$this->app->bind('Img', 'App\Services\Img');

	}

}