<?php 
namespace App\Controllers\Ajax;
use App\Libraries\Nestedsetbie;
use App\Controllers\BaseController;

class Menu extends BaseController{

	public $nestedsetbie;

	public function __construct(){

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

	public function add_menu(){
		$param['title_menu'] = $this->request->getPost('title_menu');
		$param['value_menu'] = $this->request->getPost('value_menu');


		$dataInsert = [
			'value' => $param['value_menu'],
			'created_at' => $this->currentTime,
			'title' => $param['title_menu'],
			'userid_created' => $this->auth['id'],
		];

		$flag = $this->AutoloadModel->_insert([
			'table' => 'menu_catalogue',
			'data' => $dataInsert
		]);

		
		$param['data'] = [
			'title_menu' => $param['title_menu'],
			'value_menu' => $param['value_menu'],
		];
		echo json_encode($param['data']);die();		
	}

	public function search_article(){
		$param['val'] = $this->request->getPost('value');
		$keyword = $this->condition_keyword($param['val']);
		$search_article = $this->AutoloadModel->_get_where([
			'select' => 'title, canonical, objectid',
			'table' => 'article_translate',
			'keyword' => $keyword,
			'where' => ['language' => $this->currentLanguage(), 'module' => 'article'],
			'group_by' => 'title'
		]);
		
		$param['data'] =  $search_article;


		echo json_encode($param['data']);die();		
	}

	public function search_article_catalogue(){
		$param['val'] = $this->request->getPost('value');
		$keyword = $this->condition_keyword($param['val']);
		$search_article = $this->AutoloadModel->_get_where([
			'select' => 'title, canonical, objectid',
			'table' => 'article_translate',
			'keyword' => $keyword,
			'where' => ['language' => $this->currentLanguage(), 'module' => 'article_catalogue'],
			'group_by' => 'title'
		], TRUE);
		
		$param['data'] =  $search_article;
		// pre($param['data']);

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
