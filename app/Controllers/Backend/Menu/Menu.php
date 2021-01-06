<?php 
namespace App\Controllers\Backend\Menu;
use App\Controllers\BaseController;
use App\Controllers\Backend\Menu\Libraries\Configbie;
use App\Libraries\Nestedsetbie;

class Menu extends BaseController{
	protected $data;
	public $nestedsetbie;
	public $configbie;


	public function __construct(){
		$this->configbie = new ConfigBie();
		$this->data = [];
		$this->data['module'] = 'menu';
		$this->nestedsetbie = new Nestedsetbie(['table' => $this->data['module'],'language' => $this->currentLanguage()]);

	}

	// public function _remap($method = '',$languageCurrent = ''){
	// 	$session = session();
	// 	if($method != 'translator'){
	// 		$flag = $this->authentication->check_permission([
	// 			'routes' => 'backend/system/general/'.$method
	// 		]);
	// 		if($flag == false){
	//  			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
	//  			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
	// 		}else{
	// 			if(method_exists($this, $method)){
	// 				return $this->$method();
	// 			}
	// 			throw \CodeIgniter\Exceptions\PageNotFoundException::forPagenotFound();
	// 		}
	// 	}else{
	// 		$language = $this->currentLanguage();

	// 		$count = $this->authentication->check_permission([
	// 			'routes' => 'backend/system/general/'.$method.'/'.$language
	// 		]); 

	// 		if($count == false){
	//  			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
	//  			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
	// 		}else{
	// 			if(method_exists($this, $method)){
	// 				return $this->$method($languageCurrent);
	// 			}
	// 			throw \CodeIgniter\Exceptions\PageNotFoundException::forPagenotFound();
	// 		}
	// 	}
		
		
	// }

	public function index($id = 0, $language = ''){
		if($language == ''){
			$language = $this->currentLanguage();
		}
		$session = session();
		$this->data['id'] = $id;
		$this->data['languageSelect'] = $language;
		$this->data['menuCatalogue'] = $this->menuCatalogue($id);
		$this->data['menuList'] = $this->menuList($id, $language);
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['template'] = 'backend/menu/menu/index';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function createmenu($language = ''){
		$configbie = $this->configbie->menu();
		$configbieList = [];
		foreach ($configbie as $key => $value) {
			$configbieList[] = $this->ObjectList($language, $key, $value); 
		}

		foreach ($configbieList as $key => $value) {
			foreach ($configbieList[$key] as $keyChild => $valChild) {
				$configbieList[$key][$keyChild]['name'] =  $configbie[$value[$key]['module']]['title'];
				$configbieList[$key][$keyChild]['translate'] =  $configbie[$value[$key]['module']]['translate'];
			}
		}
		$this->data['languageABC'] = $language;
		$this->data['object'] = $configbieList;
		$session = session();
		$this->data['menuCatalogue'] = $this->AutoloadModel->_get_where([
			'select' => ' value, title, id',
			'table' => 'menu_catalogue',
			'where' => ['deleted_at' => 0],
			'order_by' => 'title asc'
		], TRUE);

		$object = $this->AutoloadModel->_get_where([
			'select' => '*',
			'table' => 'system_translate',
			'where' => ['language' => $this->currentLanguage()],
		], TRUE);
		$this->data['general']= [];
        if(isset($object) &&  is_array($object)  && count($object)){
            foreach ($object as $key => $value) {
                $this->data['general'][$value['keyword']] = $value['content'];
            }
        }


		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
				$menu = $this->request->getPost('menu');
				$catalogueid = $this->request->getPost('parentid');

				if(isset($menu) && is_array($menu) && count($menu)){
					$_insert = [];
					$newMenu = [];
					$count = 0;
					
					$delete = $this->AutoloadModel->_delete([
						'table' => 'menu',
						'where' => ['catalogueid' => $catalogueid]
					]);

					$delete_menuTranslate = $this->AutoloadModel->_delete([
						'table' => 'menu_translate',
						'where' => ['module' => 'menu', 'language' => $this->currentLanguage(), 'catalogueid' => $catalogueid],
					]);
					
					
					foreach($menu['order'] as $key => $val){
						$_insert[] = [
							'catalogueid' => $catalogueid,
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

							$newMenu[] = [
								'objectid' => $getData[$key]['id'],
								'title' => $menu['title'][$key],
								'canonical'  => $menu['link'][$key],
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

						$this->nestedsetbie->Get('level ASC, order ASC');
						$this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
						$this->nestedsetbie->Action();
						
						$session->setFlashdata('message-success', 'Tạo Menu Thành Công!');
						return redirect()->to(BASE_URL.'backend/menu/menu/index/'.$catalogueid.'/'.$language.'');
					}
		 		}
		 	}else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
	 	}
		
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['template'] = 'backend/menu/menu/store';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function listmenu($page = 1){

		$session = session();

		helper(['mypagination']);
		$page = (int)$page;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
		$where = $this->condition_where();
		$keyword = $this->condition_keyword();
		$config['total_rows'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id',
			'table' => $this->data['module'].'_catalogue as tb1',
			'keyword' => $keyword,
			'where' => $where,
			'group_by' => 'tb1.id',
			'count' => TRUE
		]);
		// pre($config['total_rows']);


		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => 'backend/menu/menu/listmenu','perpage' => $perpage], $config);

			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();


			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;

			$languageDetact = $this->detect_language();
			$this->data['menuCatalogue'] = $this->AutoloadModel->_get_where([
				'select' => '  tb1.title, tb1.id, tb1.value, tb1.created_at, tb1.userid_created,tb2.fullname as creator, '.((isset($languageDetact['select'])) ? $languageDetact['select'] : ''),
				'table' => $this->data['module'].'_catalogue as tb1',
				'where' => $where,
				'keyword' => $keyword,
				'join' => [
					[
						'user as tb2','tb1.userid_created = tb2.id','inner'
					]
				],
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'order_by'=> 'tb1.id desc',
				'group_by' => 'tb1.id'
			], TRUE);

		}
		
		$this->data['template'] = 'backend/menu/menu/listmenu';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function create($id = 0, $language = ''){
		$configbie = $this->configbie->menu();
		$configbieList = [];
		foreach ($configbie as $key => $value) {
			$configbieList[] = $this->ObjectList($language, $key, $value); 
		}
		$object = $this->AutoloadModel->_get_where([
			'select' => '*',
			'table' => 'system_translate',
			'where' => ['language' => $this->currentLanguage()],
		], TRUE);
		$this->data['general']= [];
        if(isset($object) &&  is_array($object)  && count($object)){
            foreach ($object as $key => $value) {
                $this->data['general'][$value['keyword']] = $value['content'];
            }
        }
		foreach ($configbieList as $key => $value) {
			if($value == []){

				$configbieList[$key][$key]['name'] =  $configbie['article']['title'];
				$configbieList[$key][$key]['translate'] =  $configbie['article']['translate'];
				$configbieList[$key][$key]['module'] =  'article';

			}else{
				foreach ($configbieList[$key] as $keyChild => $valChild) {
					$configbieList[$key][$keyChild]['name'] =  $configbie[$value[$keyChild]['module']]['title'];
					$configbieList[$key][$keyChild]['translate'] =  $configbie[$value[$keyChild]['module']]['translate'];
				}
			}
		}

		$this->data['languageABC'] = $language;
		$this->data['object'] = $configbieList;
		$session = session();
		$this->data['id'] = $id;
		$this->data['menuList'] = $this->menuList($id, $language);


		$this->data['menuCatalogue'] = $this->AutoloadModel->_get_where([
			'select' => ' value, title, id',
			'table' => 'menu_catalogue',
			'order_by' => 'title asc'
		], TRUE);

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
							$newMenu[] = [
								'objectid' => $getData[$key]['id'],
								'title' => $menu['title'][$key],
								'canonical'  => $menu['link'][$key],
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
		$this->data['template'] = 'backend/menu/menu/store';
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
	
	private function menuCatalogue($id = 0){
		$menuCatalogue = $this->AutoloadModel->_get_where([
			'select' => ' value, title, id',
			'table' => 'menu_catalogue',
			'where' => ['id' => $id] ,
			'order_by' => 'title asc'
		], TRUE);

		return $menuCatalogue;
	}


	private function menuList($id = 0, $language = ''){
		$menuList = $this->AutoloadModel->_get_where([
			'select' => ' tb1.id, tb1.catalogueid, tb1.parentid, tb1.lft, tb1.rgt, tb1.level, tb1.order, tb2.title,tb2.objectid, tb2.canonical, tb2.catalogueid as dataid',
			'table' => 'menu as tb1',
			'join' => [
				[
					'menu_translate as tb2','tb1.id = tb2.objectid AND tb2.language = \''.$language.'\' ','inner'
				]
			],
			'where' => ['tb1.catalogueid' => $id],
			'order_by' => 'order desc'
		], TRUE);

		return $menuList;
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

	private function ObjectList($language = '', $module = '' , $params = []){
		$moduleExplode = explode('_',  $module);
		if(isset($params['translate']) && $params['translate'] == 0){
			$ObjectList = $this->AutoloadModel->_get_where([
				'select' => 'title, canonical, id',
				'table' => $module,
				'order_by' => 'created_at desc',
				'limit' => 5
			],TRUE);
		}else{
			$ObjectList = $this->AutoloadModel->_get_where([
				'select' => 'title, canonical, id, module',
				'table' => $moduleExplode[0].'_translate',
				'where' => [
					'module' => $module,
					'language' => $language,
				],
				'order_by' => 'created_at desc',
				'limit' => 5
			],TRUE);
			// $ObjectList[] = ['name' => $params['title']];
		}
		return $ObjectList;
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
