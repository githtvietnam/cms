<?php 
namespace App\Controllers\Backend\Tour;
use App\Controllers\BaseController;
use App\Libraries\Nestedsetbie;

class Tour extends BaseController{
	protected $data;
	public $nestedsetbie;
	
	
	public function __construct(){
		$this->data = [];
		$this->data['module'] = 'tour';
		$this->nestedsetbie = new Nestedsetbie(['table' => $this->data['module'].'_catalogue','language' => $this->currentLanguage()]);

	}

	public function index($page = 1){
		$session = session();
		$flag = $this->authentication->check_permission([
			'routes' => 'backend/tour/tour/index'
		]);
		if($flag == false){
 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		}
		$this->data['code'] = $this->AutoloadModel->_get_where([
			'select' => 'id, suffix, prefix, module, num0',
			'table' => 'id_general',
			'where' => ['module' => $this->data['module']]
		]);
		helper(['mypagination']);
		$page = (int)$page;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
		$where = $this->condition_where();
		$keyword = $this->condition_keyword();
		$config['total_rows'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id',
			'table' => $this->data['module'].' as tb1',
			'join' =>  [
				[
					'tour_translate as tb2','tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\'   AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
				],
			],
			'keyword' => $keyword,
			'where' => $where,
			'count' => TRUE
		]);

		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => 'backend/tour/tour/index','perpage' => $perpage], $config);

			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;

			$catalogue = $this->condition_catalogue();
			$languageDetact = $this->detect_language();
			$this->data['tourList'] = $this->AutoloadModel->_get_where([
				'select' => 'tb1.id, tb1.catalogueid as cat_id, tb1.price,tb1.order, tb1.price_promotion, tb1.album,  tb2.catalogueid, tb1.publish, tb3.title as tour_title, tb1.catalogue, tb2.objectid, tb3.content, tb3.sub_title, tb3.sub_content, tb3.canonical, tb3.meta_title, tb3.meta_description,  tb4.title as cat_title ,'.((isset($languageDetact['select'])) ? $languageDetact['select'] : ''),
				'table' => $this->data['module'].' as tb1',
				'where' => $where,
				'where_in' => $catalogue['where_in'],
				'where_in_field' => $catalogue['where_in_field'],
				'keyword' => $keyword,
				'join' => [
					[
						'object_relationship as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\' ', 'inner'
					],
					[
						'tour_translate as tb3','tb1.id = tb3.objectid AND tb3.module = "tour" AND tb3.language = \''.$this->currentLanguage().'\' ','inner'
					],
					[
						'tour_translate as tb4','tb1.catalogueid = tb4.objectid AND tb4.module = "tour_catalogue" AND tb3.language = \''.$this->currentLanguage().'\' ','inner'
					],
					
				],
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'order_by'=> 'tb1.id desc',
				'group_by' => 'tb1.id'
			], TRUE);
		}
		// pre($this->data['tourList']);

		$this->data['dropdown'] = $this->nestedsetbie->dropdown();
		$this->data['template'] = 'backend/tour/tour/index';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function create(){
		$session = session();
		$flag = $this->authentication->check_permission([
			'routes' => 'backend/tour/tour/create'
		]);
		if($flag == false){
 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		}
		$this->data['attribute_catalogue'] = get_attribute_catalogue($this->currentLanguage(), $this->data['module']);
		$this->data['check_code'] = $this->AutoloadModel->_get_where([
			'select' => 'code,objectid',
			'table' => 'id_general',
			'where' => ['module' => $this->data['module']],
		]);
		if(!isset($this->data['check_code']) && !is_array($this->data['check_code'])){
			$session->setFlashdata('message-danger', 'Bạn chưa tạo phần cấu hình chung cho mã Chuyến du lịch!');
 			return redirect()->to(BASE_URL.'backend/tour/tour/index');
		}else{
			$this->data['export_brand'] = $this->export_brand();
			$this->data['tourid'] = convert_code($this->data['check_code']['code'], $this->data['module']);
			if($this->request->getMethod() == 'post'){
				$validate = $this->validation();
				if($this->validate($validate['validate'], $validate['errorValidate'])){
					$sub_content = $this->request->getPost('sub_content');
					$wholesale = $this->request->getPost('wholesale');
			 		$insert = $this->store(['method' => 'create']);

			 		$resultid = $this->AutoloadModel->_insert([
			 			'table' => $this->data['module'],
			 			'data' => $insert,
			 		]);
		 			$this->insert_attribute($resultid, $insert['catalogueid'], $this->currentLanguage());

			 		if($resultid > 0){
			 			$storeLanguage = $this->storeLanguage($resultid);
			 			$storeLanguage = $this->convert_content($sub_content, $storeLanguage);
						$this->version($resultid, 'create');
						$this->AutoloadModel->_insert([
							'table' => 'tour_translate',
							'data' => $storeLanguage 
						]);
				 		$this->AutoloadModel->_update([
	 						'table' => 'id_general',
	 						'data' => [
	 							'objectid' => $this->data['check_code']['objectid'] + 1
	 						],
	 						'where' => ['module' => $this->data['module']]
	 					]);

		 				$this->insert_router(['method' => 'create','id' => $resultid]);
	 					$flag = $this->create_relationship($resultid);

			 			$this->nestedsetbie->Get('level ASC, order ASC');
						$this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
						$this->nestedsetbie->Action();
			 			$session->setFlashdata('message-success', 'Tạo Chuyến du lịch Thành Công! Hãy tạo danh mục tiếp theo.');
	 					return redirect()->to(BASE_URL.'backend/tour/tour/create');
			 		}
		        }else{
		        	$this->data['validate'] = $this->validator->listErrors();
		        }
			}
		}

		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['dropdown'] = $this->nestedsetbie->dropdown();
		$this->data['method'] = 'create';
		$this->data['template'] = 'backend/tour/tour/create';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function update($id = 0){
		$session = session();
		$id = (int)$id;
		$this->data['export_brand'] = $this->export_brand();
		$this->data['attribute_catalogue'] = get_attribute_catalogue($this->currentLanguage(), $this->data['module']);
		$this->data[$this->data['module']] = $this->get_data_module($id);
		if($this->data[$this->data['module']] == false){
			$session->setFlashdata('message-danger', 'Chuyến du lịch không tồn tại!');
 			return redirect()->to(BASE_URL.'backend/tour/tour/index');
		}
		$this->data['version'] = $this->get_data_version($id);
		$this->data['wholesale_list'] = $this->get_list_wholesale($id);
		

		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
				$sub_content = $this->request->getPost('sub_content');
				$wholesale = $this->request->getPost('wholesale');
		 		$update = $this->store(['method' => 'update']);
		 		$updateLanguage = $this->storeLanguage($id);
		 		$updateLanguage = $this->convert_content($sub_content, $updateLanguage);
		 		$flag = $this->AutoloadModel->_update([
		 			'table' => $this->data['module'],
		 			'where' => ['id' => $id],
		 			'data' => $update
		 		]);

		 		$this->insert_attribute($id,$update['catalogueid'], $this->currentLanguage());
		 		if($flag > 0){
		 			$this->AutoloadModel->_update([
			 			'table' => 'tour_translate',
			 			'where' => ['objectid' => $id, 'module' => $this->data['module']],
			 			'data' => $updateLanguage
			 		]);
			 		if($wholesale != []){
						insert_wholesale($wholesale, $this->data['module'],'update', $id);
			 		}
					$this->version($id, 'update');
		 			$this->insert_router(['method' => 'update','id' => $id]);
		 			$this->nestedsetbie->Get('level ASC, order ASC');
					$this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
					$this->nestedsetbie->Action();

		 			$session->setFlashdata('message-success', 'Cập Nhật Chuyến du lịch Thành Công!');
 					return redirect()->to(BASE_URL.'backend/tour/tour/index');
		 		}

	        }else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
		}
		
		$this->data['fixWrapper'] = 'fix-wrapper';
		$this->data['dropdown'] = $this->nestedsetbie->dropdown();
		$this->data['method'] = 'update';
		$this->data['template'] = 'backend/tour/tour/update';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function delete($id = 0){
		$session = session();
		$id = (int)$id;
		$this->data[$this->data['module']] = $this->get_data_module($id);
		if($this->data[$this->data['module']] == false){
			$session->setFlashdata('message-danger', 'Chuyến du lịch không tồn tại!');
 			return redirect()->to(BASE_URL.'backend/tour/tour/index');
		}
		

		if($this->request->getPost('delete')){
			$_id = $this->request->getPost('id');
		
			$flag = $this->AutoloadModel->_update([
				'table' => $this->data['module'],
				'data' => ['deleted_at' => 1],
				'where' => [
					'id' => $_id
				]
			]);

			$session = session();
			if($flag > 0){
				$this->nestedsetbie->Get('level ASC, order ASC');
				$this->nestedsetbie->Recursive(0, $this->nestedsetbie->Set());
				$this->nestedsetbie->Action();
	 			$session->setFlashdata('message-success', 'Xóa bản ghi thành công!');
			}else{
				$session->setFlashdata('message-danger', 'Có vấn đề xảy ra, vui lòng thử lại!');
			}
			return redirect()->to(BASE_URL.'backend/tour/tour/index');
		}

		$this->data['template'] = 'backend/tour/tour/delete';
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

	private function create_relationship($objectid = 0, $catalogue = []){
		if($this->request->getPost('catalogue') != ''){
			$catalogue = $this->request->getPost('catalogue');
		}
		$catalogueid = $this->request->getPost('catalogueid');
		$relationshipId = 	array_unique(array_merge($catalogue, [$catalogueid]));
		$insert = [];
		if(isset($relationshipId) && is_array($relationshipId) && count($relationshipId)){
			foreach($relationshipId as $key => $val){
				$insert[] = array(
					'objectid' => $objectid,
					'catalogueid' => $val,
					'module' => $this->data['module'],
				);
			}
		}
		if(isset($insert) && is_array($insert) && count($insert)){
			$flag = $this->AutoloadModel->_create_batch([
				'data' => $insert,
				'table' => 'object_relationship'
			]);
		}
		return $flag;
	}

	private function condition_keyword($keyword = ''): string{
		if(!empty($this->request->getGet('keyword'))){
			$keyword = $this->request->getGet('keyword');
			$keyword = '(title LIKE \'%'.$keyword.'%\')';
		}
		return $keyword;
	}

	private function storeLanguage($objectid = 0){
		helper(['text']);
		$store = [
			'objectid' => $objectid,
			'title' => validate_input($this->request->getPost('title')),
			'canonical' => slug($this->request->getPost('canonical')),
			'content' => base64_encode($this->request->getPost('content')),
			'description' => base64_encode($this->request->getPost('description')),
			'meta_title' => validate_input($this->request->getPost('meta_title')),
			'meta_description' => validate_input($this->request->getPost('meta_description')),
			'language' => $this->currentLanguage(),
			'module' => $this->data['module'],
		];
		return $store;
	}

	private function store($param = []){
		helper(['text']);
		$catalogue = $this->request->getPost('catalogue');
		$attributeid = $this->request->getPost('attributeid');
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
		if(isset($attributeid) && is_array($attributeid) && count($attributeid)){
			$attributeid = array_values($attributeid);
		}

		$store = [
 			'catalogueid' => (int)$this->request->getPost('catalogueid'),
 			'catalogue' => json_encode($catalogue),
 			'tourid' => $this->request->getPost('tourid'),
 			'album' => json_encode($this->request->getPost('album'), TRUE),
 			'publish' => $this->request->getPost('publish'),
 			'price' => $this->request->getPost('price'),
 			'price_promotion' => $this->request->getPost('promotion_price'),
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
	
	private function insert_router($param = []){
		helper(['text']);
		$view = view_cells($this->data['module']);
		$data = [
			'canonical' => $this->request->getPost('canonical'),  
			'module' => $this->data['module'],
			'objectid' => $param['id'],  
			'language' => $this->currentLanguage(),  
			'view' => $view
		];
 		if($param['method'] == 'create' && isset($param['method'])){	
 			$insertRouter = $this->AutoloadModel->_insert([
	 			'table' => 'router',
	 			'data' => $data,
	 		]);
 		}else{
 			$this->AutoloadModel->_update([
	 			'table' => 'router',
	 			'where' => ['objectid' => $param['id'], 'module' => $this->data['module'], 'language' => $this->currentLanguage()],
	 			'data' => [
	 				'canonical' => $data['canonical']
	 			]
	 		]);
 		}
 		return true;
	}

	private function detect_language(){
		$languageList = $this->AutoloadModel->_get_where([
			'select' => 'id, canonical',
			'table' => 'language',
			'where' => ['publish' => 1,'deleted_at' => 0,'canonical !=' => $this->currentLanguage()]
		], TRUE);

		
		$select = '';
		$i = 3;
		if(isset($languageList) && is_array($languageList) && count($languageList)){
			foreach($languageList as $key => $val){
				$select = $select.'(SELECT COUNT(objectid) FROM tour_translate WHERE tour_translate.objectid = tb1.id AND tour_translate.module = "tour" AND tour_translate.language = "'.$val['canonical'].'") as '.$val['canonical'].'_detect, ';
				$i++;
			}	
		}


		return [
			'select' => $select,
		];
	}

	private function convert_content($content = [], $store = []){
		$count_1 = 0;
		$count_2 = 0;
		if($content != []){
			foreach ($content['title'] as $key => $value) {
	 			$title[] = $content['title'][$count_1];
	 			$count_1++;
	 		}
	 		foreach ($content['title'] as $key => $value) {
	 			$description[] = $content['description'][$count_2];
	 			$count_2++;
	 		}
	 		$title = base64_encode(json_encode($title));
	 		$description = base64_encode(json_encode($description));
	 		$store['sub_title'] = $title;
	 		$store['sub_content'] = $description;
			return $store;
		}else{
			return $store;
		}
	}

	private function export_brand(){
		$brand = $this->AutoloadModel->_get_where([
			'select' => 'tb2.id, tb2.title',
			'table' => 'brand as tb1',
			'join' =>  [
				[
					'brand_translate as tb2','tb1.id = tb2.objectid AND tb2.module = "brand" AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
				],
			],
			'where' => [
				'tb1.deleted_at' => 0,
				'tb1.publish' => 1
			]
		],TRUE);
		$new_array= [];
		foreach ($brand as $key => $value) {
			$new_array[$value['id']] = $value['title'];
		}

		return $new_array;
	}

	private function version($id = '', $method = ''){
		$get = [
			'attribute_catalogue' => $this->request->getPost('attribute_catalogue'),
			'attribute' => $this->request->getPost('attribute'),
			'attribute1' => $this->request->getPost('attribute1'),
			'attribute2' => $this->request->getPost('attribute2'),
			'attribute3' => $this->request->getPost('attribute3'),
			'checked' => $this->request->getPost('checked'),
			'img_version' => $this->request->getPost('img_version'),
			'title_version' => $this->request->getPost('title_version'),
			'price_version' => $this->request->getPost('price_version'),
			'code_version' => $this->request->getPost('code_version'),
		];
		if($get['attribute1'] != []){
			$flag = insert_version($get , $id, $this->currentLanguage(), $method, $this->data['module']);
		}else{
			$flag = insert_version([] , $id, $this->currentLanguage(), $method, $this->data['module']);
		}

		return $flag;
	}

	private function insert_attribute($id = '', $catalogueid = '', $language = ''){
		$insert = [
			'attribute_catalogue' => $this->request->getPost('attribute_catalogue'),
			'attribute' => $this->request->getPost('attribute'),
		];
		// prE($insert);
		if($insert['attribute_catalogue'] != [] && $insert['attribute'] != []){
			$flag = insert_attribute($insert , $id, $language, $catalogueid, $this->data['module']);
		}

		return true;
	}

	private function get_data_module($id = 0){
		$flag = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb1.catalogue,tb1.catalogueid,  tb1.price_promotion, tb1.price, tb1.tourid, tb1.id, tb2.title, tb2.objectid, tb2.sub_title, tb2.sub_content, tb2.description, tb2.canonical,  tb2.content, tb2.meta_title, tb2.meta_description, tb1.album, tb1.publish',
			'table' => $this->data['module'].' as tb1',
			'join' =>  [
					[
						'tour_translate as tb2','tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\' AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
					]
				],
			'where' => ['tb1.id' => $id,'tb1.deleted_at' => 0]
		]);
		if(!isset($flag) || is_array($flag) == false || count($flag) == 0){
 			return false;
		}else{
			$flag['content'] = base64_decode($flag['content']);
			$flag['description'] = base64_decode($flag['description']);
			$flag['sub_title'] = json_decode(base64_decode($flag['sub_title']));
			$flag['sub_content'] = json_decode(base64_decode($flag['sub_content']));
		}

		return $flag;
	}

	private function get_data_version($id = ''){
		$flag = $this->AutoloadModel->_get_where([
			'select' => 'id, objectid, content, attribute, attribute_catalogue, checked',
			'table' => 'tour_version',
			'where' => ['objectid' => $id]
		],TRUE);
		foreach ($flag as $key => $value) {
			
			$flag[$key]['content'] = json_decode($flag[$key]['content'], TRUE);
		}

		return $flag;
	}

	private function get_list_wholesale($id = 0){
		$check = $this->AutoloadModel->_get_where([
			'select' => 'number_start, number_end, price',
			'table' => 'tour_wholesale',
			'where' => ['objectid' => $id]
		]);
		if(isset($check) && is_array($check) && count($check)){
			$array = [
				'number_start' => json_decode($check['number_start']),
				'number_end' => json_decode($check['number_end']),
				'price_wholesale' => json_decode($check['price']),
			];
			$data = [];
			foreach ($array as $key => $value) {
				foreach ($value as $keyChild => $valChild) {
					$data[$keyChild][$key] = $valChild;
				}
			}
		}
		return $data;
	}

	public function condition_catalogue(){
		$catalogueid = $this->request->getGet('catalogueid');
		$id = [];	
		if($catalogueid > 0){
			$catalogue = $this->AutoloadModel->_get_where([
				'select' => 'tb1.id, tb1.lft, tb1.rgt, tb3.title',
				'table' => $this->data['module'].'_catalogue as tb1',
				'join' =>  [
					[
						'tour_translate as tb3','tb1.id = tb3.objectid AND tb3.language = \''.$this->currentLanguage().'\' ','inner'
					],
									],
				'where' => ['tb1.id' => $catalogueid],
			]);

			$catalogueChildren = $this->AutoloadModel->_get_where([
				'select' => 'id',
				'table' => $this->data['module'].'_catalogue',
				'where' => ['lft >=' => $catalogue['lft'],'rgt <=' => $catalogue['rgt']],
			], TRUE);

			$id = array_column($catalogueChildren, 'id');
		}
		return [
			'where_in' => $id,
			'where_in_field' => 'tb2.catalogueid'
		];

	}

	private function validation(){
		$validate = [
			'title' => 'required',
			'price' => 'required',
			'tourid' => 'required|check_id['.$this->data['module'].']',
			'canonical' => 'required|check_canonical['.$this->data['module'].']',
			'catalogueid' => 'is_natural_no_zero',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập tên Chuyến du lịch!'
			],
			'tourid' => [
				'required' => 'Bạn phải nhập mã Chuyến du lịch!',
				'check_id' => 'Mã Chuyến du lịch đã tồn tại, vui lòng chọn mã Chuyến du lịch khác!',
			],
			'price' => [
				'required' => 'Bạn phải nhập giá Chuyến du lịch!'
			],
			'canonical' => [
				'required' => 'Bạn phải nhập giá trị cho trường đường dẫn!',
				'check_canonical' => 'Đường dẫn đã tồn tại, vui lòng chọn đường dẫn khác!',
			],
			'catalogueid' => [
				'is_natural_no_zero' => 'Bạn Phải chọn danh mục cha cho Chuyến du lịch!',
			],
		];

		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
	}


}
