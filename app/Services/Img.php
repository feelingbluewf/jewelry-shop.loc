<?php

namespace App\Services;

use Intervention\Image\ImageManagerStatic as Image;

class Img {

	public function store($original_file_name, $directory, $file, $type, $width, $height) {

		$image = Image::make($file->getRealPath());
		$image->resize($width, $height);
		$store = $image->save(public_path($directory . $original_file_name));

		if($store) {

			if($type == 'main') {
				\Session::put('main', $original_file_name);
			}
			else {
				\Session::push('gallery', $original_file_name);
			}

			return true;

		}

	}

}

?>