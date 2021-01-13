<?php 
use App\Models\AutoloadModel;


if (! function_exists('insert_wholesale')){
	function insert_wholesale(array $param = [], $module = '', $method = '' , $id = ''){
		$model = new AutoloadModel();
		$new_array = [];
		$module_explode = explode("_", $module);
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
				'table' => $module_explode[0].'_wholesale',
				'data' => $store
			]);
		}else{
			$flag = $model->_update([
				'table' => $module_explode[0].'_wholesale',
				'data' => $store,
				'where' => [
					'objectid' => $id,
					'module' => $module
				]
			]);

			if($flag == ''){
				$flag = $model->_insert([
					'table' => $module_explode[0].'_wholesale',
					'data' => $store
				]);
			}
		}

	 	return $flag;
	}
}

if (! function_exists('insert_version')){
	function insert_version(array $param = [], $objectid = '', $language = '', $method = '', $module = ''){
		$model = new AutoloadModel();
		$new_array = [];
		$insert = [];
		$module_explode = explode("_", $module);
		if($method == 'update'){
			$delete = $model->_delete([
				'table' => $module_explode[0].'_version',
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
				'table' => $module_explode[0].'_version',
				'data' => $insert,
			]);
		}
	}	
}

?>

