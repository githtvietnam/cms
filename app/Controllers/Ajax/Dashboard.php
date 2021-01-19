<?php 
namespace App\Controllers\Ajax;
use App\Controllers\BaseController;

class Dashboard extends BaseController{
	public function __construct(){
		
	}

	public function select_widget(){
		$param['title'] = $this->request->getPost('title');
		$param['catalogueid'] = $this->request->getPost('catalogueid');
		$param['keyword'] = $this->request->getPost('keyword');
		$param['css'] = $this->request->getPost('css');
		$param['html'] = $this->request->getPost('html');
		$param['script'] = $this->request->getPost('script');

		$del = $this->AutoloadModel->_delete([
			'table' => 'website_widget',
			'where' =>[
				'catalogueid' => $param['catalogueid']
			]
		]);

		$data = [
			'catalogueid' => $param['catalogueid'],
			'title' => $param['title'],
			'keyword' => $param['keyword'],
			'css' => $param['css'],
			'html' => $param['html'],
			'script' => $param['script'],
		];

		$flag = $this->AutoloadModel->_insert([
			'table' => 'website_widget',
			'data' => $data
		]);

		echo json_encode($data);die();
	}

	public function delete_widget(){
		$param['catalogueid'] = $this->request->getPost('catalogueid');

		$del = $this->AutoloadModel->_delete([
			'table' => 'website_widget',
			'where' =>[
				'catalogueid' => $param['catalogueid']
			]
		]);


		echo json_encode($del);die();
	}

	public function get_module_primary(){
		$val = $this->request->getPost('val');
		
		$flag = $this->AutoloadModel->_get_where([
			'select' => 'module_primary',
			'table' => 'attribute_translate',
			'where' => [
				'module' => 'attribute_catalogue',
				'objectid' => $val,
				'language' => $this->currentLanguage()
			]
		]);
		echo json_encode($flag);die();
	}

	public function delete_all(){
		$id = $this->request->getPost('id');
		$module = $this->request->getPost('module');
		$flag = $this->AutoloadModel->_update([
			'table' => $module,
			'data' => ['deleted_at' => 1],
			'where_in' => $id,
			'where_in_field' => 'id',
		]);
		echo $flag;die();
	}

	public function get_catalogue(){
		$id = $this->request->getPost('id');
		$module = $this->request->getPost('module');
		$module_explode = explode('_', $module);


		$data = $this->AutoloadModel->_get_where([
			'select' => 'id,lft, rgt, level',
			'table' => $module_explode[0].'_catalogue',
			'where' => [
				'id' => $id
			]
		]);
		$breadcum = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb2.title',
			'table' => $module_explode[0].'_catalogue as tb1',
			'join' => [
				[
					$module_explode[0].'_translate as tb2','tb1.id = tb2.objectid AND tb2.module= \''.$module_explode[0].'_catalogue \' AND tb2.language = \''.$this->currentLanguage().'\'', 'inner'
				]
			],
			'where' => [
				'tb1.lft <=' => $data['lft'],
				'tb1.rgt >=' => $data['rgt']
			],
			'order_by' => 'tb1.lft ASC , tb1.rgt DESC'
		],TRUE);
		$text = '';
		foreach ($breadcum as $key => $value) {
			$length = count($breadcum);
			$title = slug($value['title']);
			if($key == 0){
				$text = $title;
			}else if($key > 0 && $key < $length){
				$text = $text.'/'.$title;
			}
		}
		echo $text;die();
	}

	public function pre_select2(){
		$param['value'] = json_decode($this->request->getPost('value'));
		$param['module'] = $this->request->getPost('module');
		$param['select'] = $this->request->getPost('select');
		$param['join'] = $this->request->getPost('join');
		$param['language'] = $this->request->getPost('language');
		if(isset($param['language'])&& $param['language'] !=''){
			$language = $param['language'];
		}else{
			$language = $this->currentLanguage();
		}
		$object = [];
		
		if($param['value'] != ''){
			$object = $this->AutoloadModel->_get_where([
				'select' => 'tb1.id, tb2.'.$param['select'].'',
				'table' => $param['module'].' as tb1',
				'join' => [
						[
							$param['join'].' as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$param['module'].'\'  AND tb2.language = \''.$language.'\' ','inner'
						],
					],
				'where_in' => $param['value'],
				'where_in_field' => 'tb2.objectid',
				'order_by' => ''.$param['select'].' asc'
			], TRUE);
		}
		$temp = [];
		if(isset($object) && is_array($object) && count($object)){
			foreach($object as $index => $val){
				$temp[] = array(
					'id'=> $val['id'],
					'text' => $val[$param['select']],
				);
			}
		}
		echo json_encode(array('items' => $temp));die();

	}

	public function get_select2(){
		$param['module'] = $this->request->getPost('module');
		$param['keyword'] = $this->request->getPost('locationVal');
		$param['select'] = $this->request->getPost('select');
		$param['join'] = $this->request->getPost('join');
		$param['language'] = $this->request->getPost('language');
		if(isset($param['language'])&& $param['language'] !=''){
			$language = $param['language'];
		}else{
			$language = $this->currentLanguage();
		}
		if (isset($param['join']) && $param['join'] != ''){
			$object = $this->AutoloadModel->_get_where([
				'select' => 'tb1.id, tb2.'.$param['select'].'',
				'table' => $param['module'].' as tb1',
				'join' => [
						[
							$param['join'].' as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$param['module'].'\'  AND tb2.language = \''.$language.'\' ','inner'
						],
					],
				'keyword' => '('.$param['select'].' LIKE \'%'.$param['keyword'].'%\')',
				'order_by' => ''.$param['select'].' asc'
			], TRUE);
		}else{
			$object = $this->AutoloadModel->_get_where([
				'select' => 'id, '.$param['select'],
				'table' => $param['module'],
				'keyword' => '('.$param['select'].' LIKE \'%'.$param['keyword'].'%\')',
				'order_by' => ''.$param['select'].' asc'
			], TRUE);
		}
	

		$temp = [];
		if(isset($object) && is_array($object) && count($object)){
			foreach($object as $index => $val){
				$temp[] = array(
					'id'=> $val['id'],
					'text' => $val[$param['select']],
				);
			}
		}

		echo json_encode(array('items' => $temp));die();

	}

	public function get_multiple(){
		$param['key'] = $this->request->getPost('key');
		$param['module'] = $this->request->getPost('module');
		$param['keyword'] = $this->request->getPost('locationVal');
		$param['select'] = $this->request->getPost('select');
		$param['condition'] = $this->request->getPost('condition');
		if (isset($param['condition']) && $param['condition'] != '')
			{
				$object = $this->AutoloadModel->_get_where([
					'select' => 'tb1.id, tb2.'.$param['select'].'',
					'table' => $param['module'].' as tb1',
					'join' => [
							[
								$param['module'].'_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$param['module'].'\' '.$param['condition'].'  AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
							],
						],
					'keyword' => '('.$param['select'].' LIKE \'%'.$param['keyword'].'%\')',
					'order_by' => ''.$param['select'].' asc'
				], TRUE);
			}else{
				$object = $this->AutoloadModel->_get_where([
					'select' => 'id, '.$param['select'],
					'table' => $param['module'],
					'keyword' => '('.$param['select'].' LIKE \'%'.$param['keyword'].'%\')',
					'order_by' => ''.$param['select'].' asc'
				], TRUE);
			}
		

		$temp = [];
		if(isset($object) && is_array($object) && count($object)){
			foreach($object as $index => $val){
				$temp[] = array(
					'id'=> $val['id'],
					'text' => $val[$param['select']],
				);
			}
		}

		echo json_encode(array('items' => $temp));die();

	}

	public function getDataMultiple(){
		$param['key'] = $this->request->getPost('key');
		$param['module'] = $this->request->getPost('module');
		$param['data'] = json_decode($this->request->getPost('data'));
		$param['keyword'] = $this->request->getPost('locationVal');
		$param['select'] = $this->request->getPost('select');
		$param['condition'] = $this->request->getPost('condition');
		if (isset($param['condition']) && $param['condition'] != '')
			{

				foreach ($param['data'] as $key => $value) {
					$object[] = $this->AutoloadModel->_get_where([
						'select' => 'tb1.id, tb2.'.$param['select'].'',
						'table' => $param['module'].' as tb1',
						'join' => [
							[
								$param['module'].'_translate as tb2', 'tb2.objectid = \''.$value.'\' AND tb2.module = \''.$param['module'].'\' '.$param['condition'].'  AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
							],
						],
						'where' => [
							'tb1.id' => $value
						],
						'keyword' => '('.$param['select'].' LIKE \'%'.$param['keyword'].'%\')',
						'order_by' => ''.$param['select'].' asc'
					]);
				}
			}

		echo json_encode($object);die();

	}

	public function update_by_field(){
		$post['id'] = $this->request->getPost('id');
		$post['module'] = $this->request->getPost('module');
		$post['value'] = $this->request->getPost('value');
		$post['field'] = $this->request->getPost('field');


		$flag = $this->AutoloadModel->_update([
			'table' => $post['module'],
			'data' => [$post['field'] => $post['value']],
			'where_in' => $post['id'],
			'where_in_field' => 'id',
		]);
		echo $flag;

	}

	public function update_canonical(){
		$post['id'] = $this->request->getPost('id');
		$post['module'] = $this->request->getPost('module');
		$module = explode('_', $post['module']);

		$data = $this->AutoloadModel->_get_where([
			'select' => 'title',
			'table' => $module[0].'_translate',
			'where' => [
				'objectid' => $post['id'],
				'module' => $module[0].'_catalogue',
				'language' => $this->currentLanguage()
			]
		]);
		$data = '/'.slug($data['title']).'/';
		echo($data); die();

	}


	public function update_field(){
		$post['id'] = $this->request->getPost('id');
		$post['module'] = $this->request->getPost('module');
		$post['field'] = $this->request->getPost('field');
		$module = explode('_', $post['module']);
		$object = $this->AutoloadModel->_get_where([
			'select' => 'id, '.$post['field'],
			'table' => $post['module'],
			'where' => ['id' => $post['id']],
		]);
		if(!isset($object) || is_array($object) == false || count($object) == 0){
			echo 0;
			die();
		}
		if(isset($module) && count($module) == 2){
			$flag = $this->AutoloadModel->_update([
				'data' => ['publish' => (($object[$post['field']] == 1)?0:1)],
				'table' => current($module),
				'where' => ['catalogueid' => $post['id']],
			]);
		}
		$_update[$post['field']] = (($object[$post['field']] == 1)?0:1);
		$flag = $this->AutoloadModel->_update([
			'data' => $_update,
			'table' => $post['module'],
			'where' => ['id' => $post['id']]
		]);
		echo json_encode([
			'flag' => $flag,
			'value' => $_update[$post['field']],
		]);
		die();
	}

	public function get_location(){
		$post = $this->request->getPost('param');

		$object = $this->AutoloadModel->_get_where([
			'select' => $post['select'],
			'table' => $post['table'],
			'where' => $post['where'],
			'order_by' => 'name asc'
		], TRUE);


		$html = '<option value="0">'.$post['text'].'</option>';
		if(isset($object) && is_array($object) && count($object)){
			foreach($object as $key => $val){
				$html = $html . '<option value="'.$val['id'].'">'.$val['name'].'</option>';
			}
		}
		echo json_encode([
			'html' => $html
		]); die();
	}
}
