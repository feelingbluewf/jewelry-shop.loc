<?php

namespace App\Services;

class UniqueId {

	function get($id) {
		
		$unique_id = base_convert(uniqid(), 6, 10);
		$zero_count = mt_rand(1, 4);
		$zero = '';
		for ($i=0; $i < $zero_count; $i++) { 
			$zero .= '0';
		}
		$unique_id = '#' . $zero . $id . $unique_id;

		return $unique_id;

	}

}

?>