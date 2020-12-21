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
		$this->data['module'] = 'panel_translate';
		$this->nestedsetbie = new Nestedsetbie(['table' => $this->data['module'],'language' => $this->currentLanguage()]);

	}

	public function index($id = 0, $language = ''){
		$flag = $this->authentication->check_permission([
			'routes' => 'backend/product/product/index'
		]);
		if($flag == false){
 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		}
		
		$session = session();
		$this->data['id'] = $id;
		$this->data['languageSelect'] = $language;
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['template'] = 'backend/panel/panel/index';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function create($id = 0, $language = ''){
		


		$this->data['languageABC'] = $language;
		$session = session();
		

		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
				$menu = $this->request->getPost('menu');

				if(isset($menu) && is_array($menu) && count($menu)){
					$_insert = [];
					$newMenu = [];
					$idLanguageList = [];
					$count = 0;
					$id = $this->request->getPost('parentid');
					$GetdataLanguage = $this->AutoloadModel->_get_where([
						'select' => 'objectid',
						'table' => 'menu_translate',
						'where' => ['language' => $language, 'catalogueid' => $id]
					], TRUE);
					foreach ($GetdataLanguage as $key => $value) {
						$idLanguageList[] =  $value['objectid'];
					}
					// pre($idLanguageList);

					$delete = $this->AutoloadModel->_delete([
						'table' => 'menu',
						'where' => ['catalogueid' => $id],
						'where_in' => $idLanguageList,
						'where_in_field' => 'id'
					]);

					$delete_menuTranslate = $this->AutoloadModel->_delete([
						'table' => 'menu_translate',
						'where' => ['module' => 'menu', 'language' => $language, 'catalogueid' => $id],
					]);
					
					
					foreach($menu['order'] as $key => $val){
						$_insert[] = [
							'catalogueid' => $this->request->getPost('parentid'),
							'order' => $val,
							'userid_created' => $this->auth['id'],
							'created_at' => $this->currentTime
						];
						$count++;		
					}

					$flag = [];
					$flag =	$this->AutoloadModel->_create_batch([
						'table' => 'menu',
						'data' => $_insert,
					]);

					if($flag > 0){
						$getData = $this->AutoloadModel->_get_where([
							'select' => 'id',
							'table' => 'menu',
							'order_by' => 'created_at desc',
							'limit' => $count
						],TRUE);
						foreach ($getData as $key => $value) {
							$rewrite_url[] = ['id' => $value['id'],'canonical' => $menu['link'][$key]];
							$dataURL = rewrite_url($rewrite_url, 'normal', 'menu' , 'menu', '.html');
							$newMenu[] = [
								'objectid' => $getData[$key]['id'],
								'title' => $menu['title'][$key],
								'canonical'  => $dataURL[$key],
								'catalogueid' => $this->request->getPost('parentid'),
								'language' => $language,
								'module' => 'menu',
								'created_at' => $this->currentTime,
								'userid_created' => $this->auth['id']
							];		
						}
						$insertData = $this->AutoloadModel->_create_batch([
							'table' => 'menu_translate',
							'data' => $newMenu
						]);

						$this->nestedsetbie->Get('level ASC, order ASC', $language);
						$this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
						$this->nestedsetbie->Action();
						
						$session->setFlashdata('message-success', 'Tạo Menu Thành Công!');
						return redirect()->to(BASE_URL.'backend/menu/menu/index/'.$id.'/'.$language.'');
					}
		 		}
		 	}else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
	 	}
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['template'] = 'backend/panel/panel/create';
		return view('backend/dashboard/layout/home', $this->data);
	}


	private function validation(){
		$validate = [
			'parentid' => 'is_natural_no_zero',
		];
		$errorValidate = [
			'parentid' => [
				'is_natural_no_zero' => 'Bạn bắt buộc phải chọn vị trí hiển thị cho menu!'
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
