<?php 
namespace App\Controllers\Ajax;
use App\Libraries\Nestedsetbie;
use App\Controllers\BaseController;

class Product extends BaseController{

	public $nestedsetbie;

	public function __construct(){
		helper('mydata');
		$this->nestedsetbie = new Nestedsetbie(['table' => 'menu','language' => $this->currentLanguage()]);
		
	}

	public function delete_all(){
		$id = $this->request->getPost('id');
		$flag = $this->AutoloadModel->_update([
			'table' => 'menu_catalogue',
			'data' => ['deleted_at' => 1],
			'where_in' => $id,
			'where_in_field' => 'id',
		]);
		echo $flag;die();
	}
	public function delete(){
		$id = $this->request->getPost('id');
		$flag = $this->AutoloadModel->_update([
			'table' => 'menu_catalogue',
			'data' => ['deleted_at' => 1],
			'where' => ['id' => $id],
		]);
		echo $flag;die();
	}

	public function render_link(){
		$param = [];
		$param['canonical'] = json_decode($this->request->getPost('canonical'));
		$param['title'] = json_decode($this->request->getPost('title'));
		$param['catid'] = json_decode($this->request->getPost('catid'));
		$param['id'] = json_decode($this->request->getPost('id'));
		$param['module'] = $this->request->getPost('module');
		$param['lang'] = $this->request->getPost('lang');
		$data = [];
		$url = [];
		foreach ($param['canonical'] as $key => $value) {
			$data[$key] = ['canonical' => $param['canonical'][$key]];
			$data[$key]['id'] = $param['id'][$key];
			$data[$key]['module'] = $param['module'];
			$data[$key]['lang'] = $param['lang'];
			$data[$key]['catid'] = $param['catid'][$key];
		}
		foreach ($data as $key => $value) {
			$data[$key]['url'] = silo($value['id'], $value['canonical'], $value['module'], $value['catid'], $value['lang']);
			$data[$key]['title'] = $param['title'][$key];
		}
		// pre($data);
		
		echo json_encode($data);die();		
	}

	public function general_id(){
		$param['suffix'] = $this->request->getPost('suffix');
		$param['data_0'] = $this->request->getPost('data_0');
		$param['prefix'] = $this->request->getPost('prefix');
		$param['module'] = $this->request->getPost('module');


		// $dataInsert = [
		// 	'value' => $param['value_menu'],
		// 	'created_at' => $this->currentTime,
		// 	'title' => $param['title_menu'],
		// 	'userid_created' => $this->auth['id'],
		// ];

		// $flag = $this->AutoloadModel->_insert([
		// 	'table' => 'menu_catalogue',
		// 	'data' => $dataInsert
		// ]);

		
		$param['data'] = [
			'data_0' => $param['data_0'],
			'suffix' => $param['suffix'],
			'prefix' => $param['prefix'],
			'module' => $param['module'],
		];
		echo json_encode($param['data']);die();		
	}

	public function search_general(){
		$param['val'] = $this->request->getPost('value');
		$param['module'] = $this->request->getPost('module');
		$param['translate'] = $this->request->getPost('translate');
		$param['language'] = $this->request->getPost('language');
		$moduleExplode = explode('_', $param['module']);
		$keyword = $this->condition_keyword($param['val']);
		if($param['translate'] == 1){
			$search_general = $this->AutoloadModel->_get_where([
				'select' => 'title, canonical, objectid',
				'table' => $moduleExplode[0].'_translate',
				'keyword' => $keyword,
				'where' => ['language' => $param['language'], 'module' => $param['module']],
				'limit' => 5,
				'group_by' => 'title'
			],TRUE);
		}else{
			$search_general = $this->AutoloadModel->_get_where([
				'select' => 'title, canonical, id',
				'table' => $moduleExplode[0],
				'keyword' => $keyword,
				'limit' => 5,
				'where' => ['deleted_at' => 0],
				'group_by' => 'title'
			],TRUE);
		}
		
		$param['data'] =  $search_general;


		echo json_encode($param['data']);die();		
	}

	public function drag(){
		$post = json_decode($this->request->getPost('post'), TRUE);
		$catalogueid = $this->request->getPost('catalogueid');

		if(isset($post) && is_array($post) && count($post)){
			foreach ($post as $key => $value) {
				$_update_1_st['order'] = count($post) - $key;
				$_update_1_st['catalogueid'] = $catalogueid;
				$_update_1_st['parentid'] = 0;
				$flag_1_st = $this->AutoloadModel->_update([
					'where' => ['id' => $value['id']],
					'table' => 'menu',
					'data' => $_update_1_st
				]);

				if(isset($value['children']) && is_array($value['children']) && count($value['children'])){
					$this->menu_recursive($value['children'] , $value['id'], $catalogueid);
				}
			}
		}

		$this->nestedsetbie->Get('level ASC, order ASC');
		$this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
		$this->nestedsetbie->Action();
	}



	private function condition_keyword($keyword = ''): string{
		$keyword = '(title LIKE \'%'.$keyword.'%\')';


		return $keyword;
	}


	public function menu_recursive($array = '', $parentid = 0, $catalogueid = 0){
		if(isset($array) && is_array($array) && count($array)){
			foreach ($array as $key => $value) {
				$_update_1_st['order'] = count($array) - $key;
				$_update_1_st['catalogueid'] = $catalogueid;
				$_update_1_st['parentid'] = $parentid;
				$flag_1_st = $this->AutoloadModel->_update([
					'where' => ['id' => $value['id']],
					'table' => 'menu',
					'data' => $_update_1_st
				]);

				if(isset($value['children']) && is_array($value['children']) && count($value['children'])){
					$this->menu_recursive($value['children'] , $value['id'], $catalogueid);
				}
			}
		}
		return 1;
	}

}
