<?php 
use App\Models\AutoloadModel;

if (! function_exists('get_data')){
	function get_data(array $param = []){
		$model = new AutoloadModel();

		$where = [];
		if(isset($param['where'])){
			$where = $param['where'];
		}
	 	$object = $model->_get_where([
            'select' => $param['select'],
            'table' => $param['table'],
            'where' => $where,
            'order_by' => $param['order_by']
        ], TRUE);
	 	return $object;
	}
}
if (! function_exists('separateArray')){
	function separateArray($param= [], $target=[]){
		$data=[];
		for ($i = 0; $i < count($param);$i++){
			if (isset($param[$i]))
				for ($j = 0; $j < count($target);$j++){
					$data[$i][$target[$j]] = $param[$i][$target[$j]]; 
				}
			}
		return $data;
	} 
}
if(!function_exists('get_id_create_batch')){
	function get_id_create_batch(int $firstid = 0, int $length = 0){
		$data[] = $firstid;
		for($i = 1 ; $i < $length; $i++){
			$data[] = $firstid + $i;
		}

		return $data;
	}
}

if (! function_exists('count_object')){
	function count_object(array $param = []){
		$model = new AutoloadModel();

		$catalogueid = $param['catalogueid'];

		$id = [];	
		if($catalogueid > 0){
			$catalogue = $model->_get_where([
				'select' => 'id, lft, rgt, title',
				'table' => $param['module'].'',
				'where' => ['id' => $catalogueid],
			]);

			$catalogueChildren = $model->_get_where([
				'select' => 'id',
				'table' => $param['module'].'',
				'where' => ['lft >=' => $catalogue['lft'],'rgt <=' => $catalogue['rgt']],
			], TRUE);

			$id = array_column($catalogueChildren, 'id');
		}

		$count = 0;
		$module = explode('_',  $param['module']);
		if(isset($id) && is_array($id)  && count($id)){
			$count = $model->_get_where([
				'select' => 'tb1.id',
				'table' => current($module).' as tb1',
				'where' => [
					'tb1.deleted_at' => 0,
					'tb1.publish' => 1,
				],
				'where_in' => $id,
				'where_in_field' => 'tb2.catalogueid',
				'join' => [
					[
						'object_relationship as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.current($module).'\' ', 'inner'
					],
					[
						'user as tb3','tb1.userid_created = tb3.id','inner'
					]
				],
				'group_by' => 'tb1.id',
				'count' => TRUE
			]);
		}

		

		return $count;
		
	}
}

if (! function_exists('get_catalogue_object')){
	function get_catalogue_object(array $param = []){
		$model = new AutoloadModel();


		$object = $model->_get_where([
		  	'select' => 'tb1.id, tb4.title',
            'table' => $param['module'].'_catalogue as tb1',
            'join' => [
	            		[
							$param['module'].'_translate as tb4','tb1.id = tb4.objectid ','inner'
						]
					],
            'where' => ['tb1.deleted_at' => 0],
            'where_in' => $param['catalogue'],
            'where_in_field' => 'tb1.id',
            'order_by' => 'tb4.title asc'
		], TRUE);
		return $object;
		
	}
}


if (! function_exists('get_language')){
	function get_list_language(array $param = []){
		$model = new AutoloadModel();

		$language = $model->_get_where([
			'select' => 'id, canonical, image',
			'table' => 'language',
			'where' => ['publish' => 1,'canonical !=' => $param['currentLanguage']]
		], TRUE);

		return $language;
	}
}


if (! function_exists('get_full_language')){
	function get_full_language(array $param = []){
		$model = new AutoloadModel();

		$language = $model->_get_where([
			'select' => 'id, canonical, image',
			'table' => 'language',
			'where' => ['publish' => 1]
		], TRUE);

		return $language;
	}
}


?>

