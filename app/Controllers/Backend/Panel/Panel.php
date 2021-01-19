<?php 
namespace App\Controllers\Backend\Panel;
use App\Controllers\BaseController;
use App\Controllers\Backend\Panel\Libraries\Configbie;
use App\Libraries\Nestedsetbie;

class Panel extends BaseController{
	protected $data;
	public $nestedsetbie;
	public $configbie;


	public function __construct(){
		$this->configbie = new ConfigBie();
		$this->data = [];
		$this->data['module'] = 'website_panel';
		$this->nestedsetbie = new Nestedsetbie(['table' => $this->data['module'],'language' => $this->currentLanguage()]);

	}

	public function index($language = ''){
		$flag = $this->authentication->check_permission([
			'routes' => 'backend/panel/panel/index'
		]);
		if($flag == false){
 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		}
		if($language == ''){
			$language = $this->currentLanguage();
		}
		$this->data['languageSelect'] = $language;
		$select = $this->configbie->panel();
		$this->data['locate'] = $select['locate'];
		
		$this->data['panel'] = $this->AutoloadModel->_get_where([
			'select' => 'keyword, title, module, catalogue, locate,id',
			'table' => $this->data['module'],
			'where' => [
				'language' => $language,
				'deleted_at' => 0
			]
		], TRUE);
		
		$session = session();
		$this->data['languageSelect'] = $language;
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['template'] = 'backend/panel/panel/index';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function create($language = ''){
		$flag = $this->authentication->check_permission([
			'routes' => 'backend/panel/panel/index'
		]);
		if($flag == false){
 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		}
		if($language == ''){
			$language = $this->currentLanguage();
		}
		$this->data['languageSelect'] = $language;
		$session = session();
		$select = $this->configbie->panel();
		$this->data['locate'] = $select['locate'];
		$this->data['dropdown'] = $select['dropdown'];
		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
				$store = $this->store(['method' => 'create','language' => $language]);
				$resultid = $this->AutoloadModel->_insert([
		 			'table' => $this->data['module'],
		 			'data' => $store,
		 		]);
		 		if($resultid > 0){

		 			$session->setFlashdata('message-success', 'Tạo Giao diện Thành Công! Hãy tạo danh mục tiếp theo.');
 					return redirect()->to(BASE_URL.'backend/panel/panel/index');
		 		}
		 	}else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
	 	}
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['template'] = 'backend/panel/panel/create';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function update($id = 0, $language = ''){
		$flag = $this->authentication->check_permission([
			'routes' => 'backend/panel/panel/index'
		]);
		if($flag == false){
 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		}
		$session = session();
		$select = $this->configbie->panel();
		$this->data['locate'] = $select['locate'];
		$this->data['dropdown'] = $select['dropdown'];
		if($language == ''){
			$language = $this->currentLanguage();
		}
		$this->data['languageSelect'] = $language;
		$this->data[$this->data['module']] = $this->AutoloadModel->_get_where([
			'select' => 'keyword, title, module, catalogue, locate,id',
			'table' => $this->data['module'],
			'where' => [
				'language' => $language,
				'id' => $id
			]
		]);
		// pre($this->data[$this->data['module']]);

		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
				$store = $this->store(['method' => 'update','language' => $language]);
				$resultid = $this->AutoloadModel->_update([
		 			'table' => $this->data['module'],
		 			'data' => $store,
		 			'where' => ['id' => $id],
		 		]);
		 		if($resultid > 0){

		 			$session->setFlashdata('message-success', 'Cập nhật Giao diện Thành Công! Hãy cập nhật danh mục tiếp theo.');
 					return redirect()->to(BASE_URL.'backend/panel/panel/index');
		 		}
		 	}else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
	 	}
		$this->data['id'] = $id;
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['template'] = 'backend/panel/panel/update';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function delete($id = 0){
		$flag = $this->authentication->check_permission([
			'routes' => 'backend/panel/panel/index'
		]);
		if($flag == false){
 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		}
		$id = (int)$id;
		if($language == ''){
			$language = $this->currentLanguage();
		}
		$this->data['languageSelect'] = $language;
		$this->data[$this->data['module']] = $this->AutoloadModel->_get_where([
			'select' => 'id, title',
			'table' => $this->data['module'],
			'where' => ['id' => $id,'deleted_at' => 0,'language' => $language]
		]);
		$session = session();
		if(!isset($this->data[$this->data['module']]) || is_array($this->data[$this->data['module']]) == false || count($this->data[$this->data['module']]) == 0){
			$session->setFlashdata('message-danger', 'Giao diện không tồn tại');
 			return redirect()->to(BASE_URL.'backend/panel/panel/index');
		}

		if($this->request->getPost('delete')){
		
			$flag = $this->AutoloadModel->_update([
				'table' => $this->data['module'],
				'data' => ['deleted_at' => 1],
				'where' => [
					'id' => $id,
				]
			]);

			$session = session();
			if($flag > 0){
	 			$session->setFlashdata('message-success', 'Xóa bản ghi thành công!');
			}else{
				$session->setFlashdata('message-danger', 'Có vấn đề xảy ra, vui lòng thử lại!');
			}
			return redirect()->to(BASE_URL.'backend/panel/panel/index');
		}

		$this->data['template'] = 'backend/panel/panel/delete';
		return view('backend/dashboard/layout/home', $this->data);
	}


	private function validation(){
		$validate = [
			'title' => 'required',
			'keyword' => 'required|check_keyword['.$this->data['module'].']',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập Tiêu đề giao diện!',
			],
			'keyword' => [
				'required' => 'Bạn phải nhập Từ khóa giao diện!',
				'check_keyword' => 'Từ khóa đã tồn tại, vui lòng chọn từ khóa khác!'
			]
		];
		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
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
				$select = $select.'(SELECT COUNT(objectid) FROM menu_translate WHERE menu_translate.objectid = tb1.id AND menu_translate.language = "'.$val['canonical'].'") as '.$val['canonical'].'_detect, ';
				$i++;
			}	
		}


		return [
			'select' => $select,
		];

	}

	private function store($param = []){
		helper(['text']);
		$catalogue = $this->request->getPost('catalogue');
		if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
			foreach($catalogue as $key => $val){
				if($val == (int)$this->request->getPost('catalogueid')){
					unset($catalogue[$key]);
				}
			}
		}
		if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
			$catalogue = array_values($catalogue);
		}


		$store = [
 			'module' => $this->request->getPost('module'),
 			'catalogue' => json_encode($catalogue),
 			'keyword' => slug($this->request->getPost('keyword')),
 			'title' => $this->request->getPost('title'),
 			'locate' => $this->request->getPost('locate'),
 			'language' => $param['language']
 		];
 		if($param['method'] == 'create' && isset($param['method'])){	
 			$store['created_at'] = $this->currentTime;
 			$store['userid_created'] = $this->auth['id'];
 			
 		}else{
 			$store['updated_at'] = $this->currentTime;
 			$store['userid_updated'] = $this->auth['id'];
 		}
 		return $store;
	}

	private function condition_keyword($keyword = ''): string{
		if(!empty($this->request->getGet('keyword'))){
			$keyword = $this->request->getGet('keyword');
			$keyword = '(tb1.title LIKE \'%'.$keyword.'%\')';
		}
		return $keyword;
	}

	private function condition_where(){
		$where = [];

		$deleted_at = $this->request->getGet('deleted_at');
		if(isset($deleted_at)){
			$where['tb1.deleted_at'] = $deleted_at;
		}else{
			$where['tb1.deleted_at'] = 0;
		}

		return $where;
	}

}
