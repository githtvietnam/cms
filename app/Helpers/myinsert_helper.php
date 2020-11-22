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
				'table' => 'wholesale',
				'data' => $store
			]);
		}else{
			$flag = $model->_update([
				'table' => 'wholesale',
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


?>

