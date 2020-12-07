<?php 
use App\Models\AutoloadModel;


if (! function_exists('insert_wholesale')){
	function insert_wholesale(array $param = [], $module = '', $method = '' , $id = ''){
		$model = new AutoloadModel();
		$new_array = [];
		foreach ($param as $key => $value) {
			foreach ($param['number_start'] as $keyChild => $valChild) {
				if($param['number_start'][$keyChild] == '' && $param['number_end'][$keyChild] == '' && $param['wholesale_price'][$keyChild] == ''){
					unset($param['number_start'][$keyChild]);
					unset($param['number_end'][$keyChild]);
					unset($param['wholesale_price'][$keyChild]);
				}
			}
		}
		$start = json_encode($param['number_start']);
		$end = json_encode($param['number_end']);
		$price = json_encode($param['wholesale_price']);
		
		$store = [
			'objectid' => $id,
			'module' => $module,
			'number_start' => $start,
			'number_end' => $end,
			'price' => $price
		];
		if($method =='create'){
			$flag = $model->_insert([
				'table' => 'product_wholesale',
				'data' => $store
			]);
		}else{
			$flag = $model->_update([
				'table' => 'product_wholesale',
				'data' => $store,
				'where' => [
					'objectid' => $id,
					'module' => $module
				]
			]);
		}

	 	return $flag;
	}
}

if (! function_exists('insert_version')){
	function insert_version(array $param = [], $objectid = '', $language = '', $method = ''){
		$model = new AutoloadModel();
		$new_array = [];
		$insert = [];
		if($method == 'update'){
			$delete = $model->_delete([
				'table' => 'product_version',
				'where' => ['objectid' => $objectid,'language' => $language]
			]);
		}

		if($param != []){
			$attribute['attribute_catalogue'] = array_shift($param);
			$attribute['attribute'] = array_shift($param);
			foreach ($attribute as $key => $value) {
				foreach ($value as $keyChild => $valChild) {
					$new_attribute[$key][] = $attribute[$key][$keyChild];
				}
			}
			foreach ($param as $key => $value) {
				foreach ($value as $keyChild => $valChild) {
					$new_array[$keyChild][$key] = $param[$key][$keyChild];
				}
			}
			foreach ($new_array as $key => $value) {
				$new_array[$key]['img_version'] = validate_input($value['img_version']);
			}

			
			foreach ($new_array as $key => $value) {
				$insert[] = [
					'objectid' => $objectid,
					'language' => $language,
					'content' => json_encode($new_array[$key]),
					'checked' => $new_array[0]['checked'],
					'attribute' => json_encode($new_attribute['attribute']),
					'attribute_catalogue' => json_encode($new_attribute['attribute_catalogue']),
				];
			}

			$flag =	$model->_create_batch([
				'table' => 'product_version',
				'data' => $insert,
			]);
		}
	}	
}

if (! function_exists('insert_attribute')){
	function insert_attribute(array $param = [], $id = '', $language = '', $catalogueid = ''){
		$model = new AutoloadModel();
		$data = [];
		$new_array = [];
		foreach ($param as $key => $value) {
			foreach ($value as $keyChild => $valChild) {
				$data[$param['attribute_catalogue'][$keyChild]] = $param['attribute'][$keyChild];
			}
		}

		// Explode color -> array
		
		foreach ($data as $key => $value) {
			if($key == 'color'){
				$color_explode = explode(",", $value[0]);
				$data[$key] = $color_explode;
			}
		}

		// // Tao mang moi: id => []
		
		foreach ($data as $key => $value) {
			$new_array[$id] = $data;
		}

		$attr = $model->_get_where([
			'select' => 'attribute',
			'table' => 'product_translate',
			'where' => [
				'language' => $language,
				'module' => 'product_catalogue',
				'objectid' => $catalogueid
			]
		]);
		$attr = json_decode($attr['attribute'] , TRUE);
		$new_array = $attr + $new_array;
		$new_array = json_encode($new_array);
		// Nhap vao CSDL table: product_transalte
		$insert = [
			'attribute' => $new_array
		];
		$flag = $model->_update([
			'table' => 'product_translate',
			'data' => $insert,
			'where' => [
				'language' => $language,
				'module' => 'product_catalogue',
				'objectid' => $catalogueid
			]
		]);
	}	
}


?>

