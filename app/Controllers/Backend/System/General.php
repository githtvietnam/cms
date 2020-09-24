<?php 
namespace App\Controllers\Backend\System;
use App\Controllers\BaseController;
use App\Controllers\Backend\System\Libraries\Configbie;

class General extends BaseController{
	protected $data;
	public $configbie;
	
	public function __construct(){
		$this->configbie = new ConfigBie();
		$this->data = [];
		$this->data['module'] = 'system';
		$this->data['module_2'] = 'system_catalogue';

	}

	public function _remap($method = '',$languageCurrent = ''){
		$session = session();
		if($method != 'translator'){
			$flag = $this->authentication->check_permission([
				'routes' => 'backend/system/general/'.$method
			]);
			if($flag == false){
	 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
	 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
			}else{
				if(method_exists($this, $method)){
					return $this->$method();
				}
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPagenotFound();
			}
		}else{
			$language = $this->currentLanguage();

			$count = $this->authentication->check_permission([
				'routes' => 'backend/system/general/'.$method.'/'.$language
			]); 

			if($count == false){
	 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
	 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
			}else{
				if(method_exists($this, $method)){
					return $this->$method($languageCurrent);
				}
				throw \CodeIgniter\Exceptions\PageNotFoundException::forPagenotFound();
			}
		}
		
		
	}

	public function index($page = 1){
		// pre($this->configbie->system() );
		$session = session();
		
		$this->data['systemList'] = $this->configbie->system();
		


		if($this->request->getMethod() == 'post'){
			$config  = $this->request->getPost('config');
	 		// pre($config);
			if(isset($config) && is_array($config) && count($config)){
				foreach($config as $key => $val){
					$_update = NULL;

					$delete = $this->AutoloadModel->_delete([
						'table' => 'system_translate',
						'where' => ['keyword' => $key, 'language' => $this->currentLanguage(),'deleted_at' => 0]
					]);
					// print_r($flag);

					
					$_update = [
						'language' => $this->currentLanguage(),
						'keyword' => $key,
						'content' => $val,
						'userid_updated' => $this->auth['id'],
						'deleted_at' => 0,
						'updated_at' => $this->currentTime
					];
					$flag =	$this->AutoloadModel->_insert([
						'table' => 'system_translate',
						'data' => $_update,
					]);
					
				}
			}
	 		if($flag > 0){

	 			$session->setFlashdata('message-success', 'Cập Nhật Cấu hình chung Thành Công!');
				return redirect()->to(BASE_URL.'backend/system/general/index');
	 		}

	        
		}

		$this->data['template'] = 'backend/system/general/index';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function translator($languageCurrent = ''){
		$session = session();
		$this->data['systemList'] = $this->configbie->system();
		$this->data['languageCurrent'] = $languageCurrent;

		if($this->request->getMethod() == 'post'){
			$config  = $this->request->getPost('config');
	 		// pre($config);
			if(isset($config) && is_array($config) && count($config)){
				foreach($config as $key => $val){
					$_update = NULL;

					$delete = $this->AutoloadModel->_delete([
						'table' => 'system_translate',
						'where' => ['keyword' => $key, 'language' => $this->data['languageCurrent'],'deleted_at' => 0]
					]);
					// print_r($flag);

					
					$_update = [
						'language' => $this->data['languageCurrent'],
						'keyword' => $key,
						'content' => $val,
						'userid_updated' => $this->auth['id'],
						'deleted_at' => 0,
						'updated_at' => $this->currentTime
					];
					$flag =	$this->AutoloadModel->_insert([
						'table' => 'system_translate',
						'data' => $_update,
					]);
					
				}
			}
	 		if($flag > 0){

	 			$session->setFlashdata('message-success', 'Cập Nhật Cấu hình chung Thành Công!');
				return redirect()->to(BASE_URL.'backend/system/general/translator/'.$this->data['languageCurrent']);
	 		}

	        
		}


		

		$this->data['template'] = 'backend/system/general/translate';
		return view('backend/dashboard/layout/home', $this->data);
	}
	
	
	

}
