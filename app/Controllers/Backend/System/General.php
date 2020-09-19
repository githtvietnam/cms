<?php 
namespace App\Controllers\Backend\System;
use App\Controllers\BaseController;
use App\Libraries\Nestedsetbie;

class General extends BaseController{
	protected $data;
	public $nestedsetbie;
	
	
	public function __construct(){
		$this->data = [];
		$this->data['module'] = 'system';
		$this->data['module_2'] = 'system_catalogue';

	}

	public function index($page = 1){

		$session = session();
	

		$flag = $this->authentication->check_permission([
			'routes' => 'backend/system/general/index'
		]);
		if($flag == false){
 			$this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		}

		$config['total_rows'] = $this->AutoloadModel->_get_where([
			'select' => 'id',
			'table' => $this->data['module_2'],
			'where' => ['publish' => 0],
			'count' => TRUE
		]);
		if($config['total_rows'] > 0){
			$languageDetact = $this->detect_language();
			$this->data['systemCatalogueList'] = $this->AutoloadModel->_get_where([
				'select' => 'tb1.id,  tb2.title, tb2.module, tb2.description,tb2.keyword,'.((isset($languageDetact['select'])) ? $languageDetact['select'] : ''),
				'table' => $this->data['module_2'].' as tb1',
				'join' =>  [
					[
						'system_translate as tb2','tb1.id = tb2.objectid AND tb2.module = "system_catalogue" AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
					]
				],
				'where' => [
					'tb2.deleted_at' => 0,
				],
				'order_by'=> 'tb2.title asc'
			], TRUE);
			$this->data['systemList'] = $this->AutoloadModel->_get_where([
				'select' => 'tb1.id, tb1.catalogueid, tb2.title, tb2.module,tb2.attention, tb2.start_text, tb2.end_text, tb2.title_link, tb2.link, tb2.type, tb2.content, tb2.keyword',
				'table' => $this->data['module'].' as tb1',
				'join' =>  [
					[
						'system_translate as tb2','tb1.id = tb2.objectid AND tb2.module = "system" AND tb2.language = \''.$this->currentLanguage().'\' ','inner',
					]
				],
				'where' => [
					'tb2.deleted_at' => 0,
				],
			], TRUE);

			$this->data['systemSelectList'] = $this->AutoloadModel->_get_where([
				'select' => 'tb1.id, tb1.catalogueid, tb2.title, tb2.module,tb2.attention,tb2.select_title, tb2.select_value,tb2.user_select, tb2.title_link, tb2.link, tb2.type, tb2.keyword',
				'table' => $this->data['module'].' as tb1',
				'join' =>  [
					[
						'system_select as tb2','tb1.id = tb2.objectid AND tb2.module = "system" AND tb2.language = \''.$this->currentLanguage().'\' ','inner',
					]
				],
				'where' => [
					'tb2.deleted_at' => 0,
				],
			], TRUE);
		}


		if($this->request->getMethod() == 'post'){
			$config  = $this->request->getPost('config');
			$select  = $this->request->getPost('select');
	 		// pre($select);
			if(isset($config) && is_array($config) && count($config)){
				foreach($config as $key => $val){
					$_update = NULL;
					$_update['keyword'] = $key;
					$_update['content'] = $val;
					$_update['userid_updated'] = $this->auth['id'];
					$_update['updated_at'] = $this->currentTime;
					
					$flag =	$this->AutoloadModel->_update([
						'where' => ['keyword' => $key],
						'table' => 'system_translate',
						'data' => $_update,
					]);
				}
			}
			if(isset($select) && is_array($select) && count($select)){
				foreach($select as $key => $val){
					$_update = NULL;
					$_update['keyword'] = $key;
					$_update['user_select'] = $val;
					$_update['userid_updated'] = $this->auth['id'];
					$_update['updated_at'] = $this->currentTime;
					
					$count =	$this->AutoloadModel->_update([
						'where' => ['keyword' => $key],
						'table' => 'system_select',
						'data' => $_update,
					]);
				}
			}

	 		if($flag > 0 || $count > 0){

	 			$session->setFlashdata('message-success', 'Cập Nhật Cấu hình chung Thành Công!');
				return redirect()->to(BASE_URL.'backend/system/general/index');
	 		}

	        
		}

		$this->data['template'] = 'backend/system/general/index';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function translator($language = ''){
		$session = session();

		$languageDetact = $this->detect_language();
		$this->data['systemCatalogueList'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id,  tb2.title, tb2.module, tb2.description,tb2.keyword,'.((isset($languageDetact['select'])) ? $languageDetact['select'] : ''),
			'table' => $this->data['module_2'].' as tb1',
			'join' =>  [
				[
					'system_translate as tb2','tb1.id = tb2.objectid AND tb2.module = "system_catalogue" AND tb2.language = \''.$language.'\' ','inner'
				]
			],
			'where' => [
				'tb2.deleted_at' => 0,
			],
			'order_by'=> 'tb2.title asc'
		], TRUE);

		$this->data['systemList'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb1.catalogueid, tb2.title, tb2.module,tb2.attention, tb2.start_text, tb2.end_text, tb2.title_link, tb2.link, tb2.type, tb2.content, tb2.keyword',
			'table' => $this->data['module'].' as tb1',
			'join' =>  [
				[
					'system_translate as tb2','tb1.id = tb2.objectid AND tb2.module = "system" AND tb2.language = \''.$language.'\' ','inner',
				]
			],
			'where' => [
				'tb2.deleted_at' => 0,
			],
		], TRUE);

		$this->data['systemSelectList'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb1.catalogueid, tb2.title, tb2.module,tb2.attention,tb2.select_title, tb2.select_value,tb2.user_select, tb2.title_link, tb2.link, tb2.type, tb2.keyword',
			'table' => $this->data['module'].' as tb1',
			'join' =>  [
				[
					'system_select as tb2','tb1.id = tb2.objectid AND tb2.module = "system" AND tb2.language = \''.$language.'\' ','inner',
				]
			],
			'where' => [
				'tb2.deleted_at' => 0,
			],
		], TRUE);


		if($this->request->getMethod() == 'post'){
			$config  = $this->request->getPost('config');
			$select  = $this->request->getPost('select');
	 		// pre($select);
			if(isset($config) && is_array($config) && count($config)){
				foreach($config as $key => $val){
					$_update = NULL;
					$_update['keyword'] = $key;
					$_update['content'] = $val;
					$_update['userid_updated'] = $this->auth['id'];
					$_update['updated_at'] = $this->currentTime;
					
					$flag =	$this->AutoloadModel->_update([
						'where' => ['keyword' => $key,'language' => $language],
						'table' => 'system_translate',
						'data' => $_update,
					]);
				}
			}
			if(isset($select) && is_array($select) && count($select)){
				foreach($select as $key => $val){
					$_update = NULL;
					$_update['keyword'] = $key;
					$_update['user_select'] = $val;
					$_update['userid_updated'] = $this->auth['id'];
					$_update['updated_at'] = $this->currentTime;
					
					$count =	$this->AutoloadModel->_update([
						'where' => ['keyword' => $key,'language' => $language],
						'table' => 'system_select',
						'data' => $_update,
					]);
				}
			}

	 		if($flag > 0 || $count > 0){

	 			$session->setFlashdata('message-success', 'Cập Nhật Cấu hình chung Thành Công!');
				return redirect()->to(BASE_URL.'backend/system/general/index');
	 		}
	 	}

		$this->data['template'] = 'backend/system/general/index';
		return view('backend/dashboard/layout/home', $this->data);
	}
	
	private function detect_language(){
		$languageList = $this->AutoloadModel->_get_where([
			'select' => 'id, canonical',
			'table' => 'language',
			'where' => ['publish' => 1,'deleted_at' => 0,'canonical !=' =>  $this->currentLanguage()]
		], TRUE);

		
		$select = '';
		$i = 3;
		if(isset($languageList) && is_array($languageList) && count($languageList)){
			foreach($languageList as $key => $val){
				$select = $select.'(SELECT COUNT(objectid) FROM system_translate INNER JOIN system_catalogue ON system_catalogue.id = system_translate.objectid AND system_translate.module = "system_catalogue" AND system_translate.language  = "'.$val['canonical'].'") as '.$val['canonical'].'_detect , ';
				$i++;
			}	
		}
		// pre($select);


		return [
			'select' => $select,
		];

	}
	

}
