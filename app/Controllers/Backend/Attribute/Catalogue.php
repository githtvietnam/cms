<?php 
namespace App\Controllers\Backend\Attribute;
use App\Controllers\BaseController;
use App\Libraries\Nestedsetbie;

class Catalogue extends BaseController{
	protected $data;
	public $nestedsetbie;
	
	
	public function __construct(){
		$this->data = [];
		$this->data['module'] = 'attribute_catalogue';
		$this->nestedsetbie = new Nestedsetbie(['table' => $this->data['module'],'language' => $this->currentLanguage()]);

	}

	public function index($page = 1){
		$session = session();
		// $flag = $this->authentication->check_permission([
		// 	'routes' => 'backend/attribute/catalogue/index'
		// ]);
		// if($flag == false){
 	// 		$this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 	// 		return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		// }

		helper(['mypagination']);
		$page = (int)$page;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
		$where = $this->condition_where();
		$keyword = $this->condition_keyword();
		$config['total_rows'] = $this->AutoloadModel->_get_where([
			'select' => 'id',
			'table' => $this->data['module'].' as tb1',
			'keyword' => $keyword,
			'where' => $where,
			'count' => TRUE
		]);
		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => 'backend/attribute/catalogue/index','perpage' => $perpage], $config);

			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;


			$languageDetact = $this->detect_language();
			$this->data['attributeCatalogueList'] = $this->AutoloadModel->_get_where([
				'select' => 'tb1.id, tb2.title, tb1.lft, tb1.rgt, tb1.level, (SELECT fullname FROM user WHERE user.id = tb1.userid_created) as creator, tb1.publish, tb1.order, tb1.created_at, tb1.updated_at,'.((isset($languageDetact['select'])) ? $languageDetact['select'] : ''),
				'table' => $this->data['module'].' as tb1',
				'join' =>  [
					[
						'attribute_translate as tb2','tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\'   AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
					],
				],
				'where' => $where,
				'keyword' => $keyword,
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'order_by'=> 'lft asc'
			], TRUE);

		}

		$this->data['template'] = 'backend/attribute/catalogue/index';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function create(){

		$session = session();
		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
		 		$insert = $this->store(['method' => 'create']);
		 		$resultid = $this->AutoloadModel->_insert([
		 			'table' => $this->data['module'],
		 			'data' => $insert,
		 		]);
		 		if($resultid > 0){
		 			$storeLanguage = $this->storeLanguage($resultid);
		 			$insertid = $this->AutoloadModel->_insert([
			 			'table' => 'attribute_translate',
			 			'data' => $storeLanguage,
			 		]);

		 			$this->nestedsetbie->Get('level ASC, order ASC');
					$this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
					$this->nestedsetbie->Action();

		 			$session->setFlashdata('message-success', 'Tạo Nhóm Bài Viết Thành Công! Hãy tạo danh mục tiếp theo.');
 					return redirect()->to(BASE_URL.'backend/attribute/catalogue/index');
		 		}

	        }else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
		}
		$this->data['dropdown'] = $this->nestedsetbie->dropdown();
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['method'] = 'create';
		$this->data['template'] = 'backend/attribute/catalogue/create';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function update($id = 0){
		$id = (int)$id;
		$this->data[$this->data['module']] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb2.title, tb1.parentid, tb1.publish',

			'table' => $this->data['module'].' as tb1',
			'join' =>  [
					[
						'attribute_translate as tb2','tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\'   AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
					],
				],
			'where' => ['tb1.id' => $id,'tb1.deleted_at' => 0]
		]);
		$session = session();
		if(!isset($this->data[$this->data['module']]) || is_array($this->data[$this->data['module']]) == false || count($this->data[$this->data['module']]) == 0){
			$session->setFlashdata('message-danger', 'Nhóm thuộc tính không tồn tại');
 			return redirect()->to(BASE_URL.'backend/attribute/catalogue/index');
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
		 			$flag = $this->AutoloadModel->_update([
			 			'table' => 'attribute_translate',
			 			'where' => ['objectid' => $id],
			 			'data' => $updateLanguage
			 		]);

		 			$this->nestedsetbie->Get('level ASC, order ASC');
					$this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
					$this->nestedsetbie->Action();

		 			$session->setFlashdata('message-success', 'Cập Nhật Nhóm Thuộc Tính Thành Công!');
 					return redirect()->to(BASE_URL.'backend/attribute/catalogue/index');
		 		}

	        }else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
		}
		$this->data['dropdown'] = $this->nestedsetbie->dropdown();
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['method'] = 'update';
		$this->data['template'] = 'backend/attribute/catalogue/update';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function delete($id = 0){

		$id = (int)$id;
		// $this->data[$this->data['module']] = $this->AutoloadModel->_get_where([
		// 	'select' => 'tb1.id, tb2.title, tb1.lft, tb1.rgt',
		// 	'table' => $this->data['module'].' as tb1',
		// 	'join' =>  [
		// 			[
		// 				'article_translate as tb2','tb1.id = tb2.objectid AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
		// 			]
		// 		],
		// 	'where' => ['tb1.id' => $id,'tb1.deleted_at' => 0]
		// ]);
		// $session = session();
		// if(!isset($this->data[$this->data['module']]) || is_array($this->data[$this->data['module']]) == false || count($this->data[$this->data['module']]) == 0){
		// 	$session->setFlashdata('message-danger', 'Nhóm Bài Viết không tồn tại');
 	// 		return redirect()->to(BASE_URL.'backend/article/catalogue/index');
		// }

		// if($this->request->getPost('delete')){
		// 	$_id = $this->request->getPost('id');
		
			// $flag = $this->AutoloadModel->_update([
			// 	'table' => $this->data['module'],
			// 	'data' => ['deleted_at' => 1],
			// 	'where' => [
			// 		'lft >=' => $this->data[$this->data['module']]['lft'],
			// 		'rgt <=' => $this->data[$this->data['module']]['rgt'],
			// 	]
			// ]);

			// $session = session();
			// if($flag > 0){
			// 	$this->nestedsetbie->Get('level ASC, order ASC');
			// 	$this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
			// 	$this->nestedsetbie->Action();
	 	// 		$session->setFlashdata('message-success', 'Xóa bản ghi thành công!');
			// }else{
			// 	$session->setFlashdata('message-danger', 'Có vấn đề xảy ra, vui lòng thử lại!');
			// }
			// return redirect()->to(BASE_URL.'backend/article/catalogue/index');
		//}

		$this->data['template'] = 'backend/attribute/catalogue/delete';
		return view('backend/dashboard/layout/home', $this->data);
	}

	private function condition_where(){
		$where = [];

		$publish = $this->request->getGet('publish');
		if(isset($publish)){
			$where['tb1.publish'] = $publish;
		}

		$deleted_at = $this->request->getGet('deleted_at');
		if(isset($deleted_at)){
			$where['tb1.deleted_at'] = $deleted_at;
		}else{
			$where['tb1.deleted_at'] = 0;
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
				$select = $select.'(SELECT COUNT(objectid) FROM attribute_translate WHERE attribute_translate.objectid = tb1.id AND attribute_translate.module = "'.$this->data['module'].'" AND attribute_translate.language = "'.$val['canonical'].'") as '.$val['canonical'].'_detect, ';
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
			
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập vào trường tiêu đề'
			],
			
		];
		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
	}

}
