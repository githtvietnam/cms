<?php 
namespace App\Controllers\Backend\Property;
use App\Controllers\BaseController;
use App\Libraries\Nestedsetbie;

class Property extends BaseController{
	protected $data;
	public $nestedsetbie;
	
	
	public function __construct(){
		$this->data = [];
		$this->data['module'] = 'property';
		$this->data['module2'] = 'property_catalogue';

	}

	public function index($page = 1){
		$session = session();
		// $flag = $this->authentication->check_permission([
		// 	'routes' => 'backend/product/property/property/index'
		// ]);
		// if($flag == false){
 	// 		$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 	// 		return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		// }
		$this->data['propertyCatalogue'] = $this->AutoloadModel->_get_where([
			'select' => 'tb2.title, tb1.id',
			'table' => $this->data['module2'].' as tb1',
			'where' => ['tb1.publish' => 1, 'tb1.deleted_at' => 0],
			'join' => [
					[
						'property_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module2'].'\' AND tb2.language = \''.$this->currentLanguage().'\' ', 'inner'
					],
			],
			'order_by' => 'title asc',
		],true);

		helper(['mypagination']);
		$page = (int)$page;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
		$where = $this->condition_where();
		$keyword = $this->condition_keyword();
		$config['total_rows'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id',
			'table' => $this->data['module'].' as tb1',
			'keyword' => $keyword,
			'where' => $where,
			'join' => [
					[
						'property_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\' AND tb2.language = \''.$this->currentLanguage().'\' ', 'inner'
					],
					[
						'user as tb3','tb1.userid_created = tb3.id','inner'
					],
					
				],
			'group_by' => 'tb1.id',
			'count' => TRUE,
		]);
		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => 'backend/property/catalogue/index','perpage' => $perpage], $config);

			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();


			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$languageDetact = $this->detect_language();
			$this->data['propertyList'] = $this->AutoloadModel->_get_where([
				'select' => 'tb1.id, tb1.publish,  tb1.created_at,  tb1.updated_at, tb3.fullname as creator, tb2.title , tb2.value, '.((isset($languageDetact['select'])) ? $languageDetact['select'] : ''),
				'table' => $this->data['module'].' as tb1',
				'where' => $where,
				'keyword' => $keyword,
				'join' => [
					[
						'property_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\' AND tb2.language = \''.$this->currentLanguage().'\' ', 'inner'
					],
					[
						'user as tb3','tb1.userid_created = tb3.id','inner'
					],
					
				],
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'order_by'=> 'tb1.id desc',
				'group_by' => 'tb1.id'
			], TRUE);

		}



		$this->data['template'] = 'backend/property/property/index';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function create(){
		$session = session();
		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
		 		$insert = $this->store(['method' => 'create']);
		 		$insertid = $this->AutoloadModel->_insert([
		 			'table' => $this->data['module'],
		 			'data' => $insert,
		 		]);
		 		if($insertid > 0){
		 			$insertLang = $this->storeLanguage($insertid);

		 			$flag = $this->AutoloadModel->_insert([
			 			'table' => 'property_translate',
			 			'data' => $insertLang,
			 		]);


	 					$session->setFlashdata('message-success', 'Tạo Bài Viết Thành Công! Hãy tạo danh mục tiếp theo.');
 						return redirect()->to(BASE_URL.'backend/product/property/property/index');
		 		}
	        }else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
		}
		$this->data['propertyCatalogue'] = $this->AutoloadModel->_get_where([
			'select' => 'tb2.title, tb1.id',
			'table' => $this->data['module2'].' as tb1',
			'where' => ['tb1.publish' => 1, 'tb1.deleted_at' => 0],
			'join' => [
					[
						'property_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module2'].'\' AND tb2.language = \''.$this->currentLanguage().'\' ', 'inner'
					],
			],
			'order_by' => 'title asc',
		],true);
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['method'] = 'create';
		$this->data['template'] = 'backend/product/property/property/create';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function update($id = 0){
		$id = (int)$id;
		$this->data[$this->data['module']] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb2.title, tb2.value, tb1.publish, tb1.parentid',

			'table' => $this->data['module'].' as tb1',
			'join' => [
					[
						'property_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\' AND tb2.language = \''.$this->currentLanguage().'\' ', 'inner'
					],
					[
						'user as tb3','tb1.userid_created = tb3.id','inner'
					],
				],
			'where' => ['tb1.id' => $id,'tb1.deleted_at' => 0]
		]);
		$session = session();
		if(!isset($this->data[$this->data['module']]) || is_array($this->data[$this->data['module']]) == false || count($this->data[$this->data['module']]) == 0){
			$session->setFlashdata('message-danger', 'Bài Viết không tồn tại');
 			return redirect()->to(BASE_URL.'backend/property/property/index');
		}

		
		
		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
		 		$update = $this->store(['method' => 'update']);
		 		$updateLanguage = $this->storeLanguage($id);
		 		$flag = $this->AutoloadModel->_update([
		 			'table' => $this->data['module'],
		 			'where' => ['id' => $id],
		 			'data' => $update
		 		]);

		 		if($flag > 0){
		 			$flagLang = $this->AutoloadModel->_update([
			 			'table' => $this->data['module'].'_translate',
			 			'where' => ['objectid' => $id, 'module' => $this->data['module']],
			 			'data' => $updateLanguage,
			 		]);
		 			$session->setFlashdata('message-success', 'Cập Nhật Bài Viết Thành Công!');
 					return redirect()->to(BASE_URL.'backend/property/property/index');
		 		}

	        }else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
		}
		$this->data['propertyCatalogue'] = $this->AutoloadModel->_get_where([
			'select' => 'tb2.title, tb1.id',
			'table' => $this->data['module2'].' as tb1',
			'where' => ['tb1.publish' => 1, 'tb1.deleted_at' => 0],
			'join' => [
					[
						'property_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module2'].'\' AND tb2.language = \''.$this->currentLanguage().'\' ', 'inner'
					],
			],
			'order_by' => 'title asc',
		],true);
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['method'] = 'update';
		$this->data['template'] = 'backend/property/property/update';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function delete($id = 0){

		$id = (int)$id;
		$this->data[$this->data['module']] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb4.title ',
			'table' => $this->data['module'].' as tb1',
			'join' => [
					[
						'object_relationship as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\' ', 'inner'
					],
					[
						'user as tb3','tb1.userid_created = tb3.id','inner'
					],
					[
						'article_translate as tb4','tb1.id = tb4.objectid AND tb4.language = \''.$this->currentLanguage().'\' ','inner'
					]
				],
			'where' => ['tb1.id' => $id,'tb1.deleted_at' => 0]
		]);
		$session = session();
		if(!isset($this->data[$this->data['module']]) || is_array($this->data[$this->data['module']]) == false || count($this->data[$this->data['module']]) == 0){
			$session->setFlashdata('message-danger', 'Bài Viết không tồn tại');
 			return redirect()->to(BASE_URL.'backend/article/article/index');
		}

		if($this->request->getPost('delete')){
			// $_id = $this->request->getPost('id');
		
			// $flag = $this->AutoloadModel->_update([
			// 	'table' => $this->data['module'],
			// 	'data' => ['deleted_at' => 1],
			// 	'where' => [
			// 		'id' => $_id
			// 	]
			// ]);

			$session = session();
			if($flag > 0){
	 			$session->setFlashdata('message-success', 'Xóa bản ghi thành công!');
			}else{
				$session->setFlashdata('message-danger', 'Có vấn đề xảy ra, vui lòng thử lại!');
			}
			return redirect()->to(BASE_URL.'backend/article/article/index');
		}

		$this->data['template'] = 'backend/article/article/delete';
		return view('backend/dashboard/layout/home', $this->data);
	}

	



	private function condition_where(){
		$where = [];
		$publish = $this->request->getGet('publish');
		if(isset($publish)){
			$where['tb1.publish'] = $publish;
		}else{
			$where['tb1.publish'] = 1;
		}

		$deleted_at = $this->request->getGet('deleted_at');
		if(isset($deleted_at)){
			$where['tb1.deleted_at'] = $deleted_at;
		}else{
			$where['tb1.deleted_at'] = 0;
		}
		$parentid = $this->request->getGet('parentid');
		if(isset($parentid) && $parentid != 0){
			$where['parentid'] = $parentid;
		}

		return $where;
	}

	private function condition_keyword($keyword = ''): string{
		if(!empty($this->request->getGet('keyword'))){
			$keyword = $this->request->getGet('keyword');
			$keyword = '(tb2.title LIKE \'%'.$keyword.'%\')';
		}
		return $keyword;
	}

	private function storeLanguage($objectid = 0){
		helper(['text']);
		$store = [
			'objectid' => $objectid,
			'title' => validate_input($this->request->getPost('title')),
			'value' => validate_input($this->request->getPost('value')),
			'language' => $this->currentLanguage(),
			'module' => $this->data['module'],
		];
		return $store;
	}

	private function store($param = []){
		helper(['text']);
		$store = [
 			'parentid' => (int)$this->request->getPost('parentid'),
 			'publish' => $this->request->getPost('publish'),
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
				$select = $select.'(SELECT COUNT(objectid) FROM property_translate WHERE property_translate.objectid = tb1.id AND property_translate.module = "'.$this->data['module'].'" AND   property_translate.language = "'.$val['canonical'].'") as '.$val['canonical'].'_detect, ';
				$i++;
			}	
		}


		return [
			'select' => $select,
		];

	}

	private function validation(){
		$validate = [
			'title' => 'required',
			'parentid' => 'required',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập vào trường tiêu đề'
			],
			
			'parentid' => [
				'required' => 'Bạn Phải chọn danh mục cha cho bài viết',
			],
		];
		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
	}

}
