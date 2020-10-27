<?php 
namespace App\Controllers\Backend\Product\Color;
use App\Controllers\BaseController;


class Color extends BaseController{
	protected $data;
	public function __construct(){
		$this->data = [];
		$this->data['module'] = 'color';
	}
	public function index($page = 1){
		helper(['mypagination']);
		$session = session();
		

		// $flag = $this->authentication->check_permission([
		// 	'routes' => 'backend/slide/slide/index'
		// ]);
		// if($flag == false){
 	// 		$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 	// 		return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		// }
		


		$languageList = get_list_language(['currentLanguage' => $this->currentLanguage()]);
		$join = [];
		$select = '';
		foreach ($languageList as $key => $val) {
			$select = $select.'tb00'.$key.'.title as '.$val['canonical'].'_title, ';
			$join[] = [
				'color as tb00'.$key, 'tb1.code = tb00'.$key.'.code AND tb00'.$key.'.language = \''.$val['canonical'].'\' ', 'inner'
			];
		}




		$page = (int)$page;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
		$where = $this->condition_where();

		$keyword = $this->condition_keyword();
		$config['total_rows'] = $this->AutoloadModel->_get_where([
			'select'   => 'tb1.id',
			'table'    => $this->data['module'].' as tb1',
			'join' 	   => $join,
			'keyword'  => $keyword,
			'where'    => $where,
			'group_by' => 'tb1.id',
			'count'    => TRUE
		]);

		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => 'backend/product/color/index','perpage' => $perpage], $config);
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$languageDetact = $this->detect_language();
			$this->data['colorList'] = $this->AutoloadModel->_get_where([
				'select' => $select.'tb1.id, tb1.title, tb1.language, tb1.code '.((isset($languageDetact['select'])) ? ','.$languageDetact['select'] : ''),
				'table'    => $this->data['module'].'  as tb1',
				'join' => $join,
				'where'    => $where,
				'keyword'  => $keyword,
				'limit'    => $config['per_page'],
				'start'    => $page * $config['per_page'],
				
				'group_by' => 'tb1.code',
			], TRUE);


			
		}		
		
		$this->data['template'] = 'backend/product/color/index';//view
		return view('backend/dashboard/layout/home', $this->data);
	}
	public function create(){
		$session = session();
		$this->data['language'] = $this->AutoloadModel->_get_where([
			'select' => 'title',
			'table' => 'language',
			'where' => ['publish' => 1, 'deleted_at' => 0],
		],true);
		$languageList = get_list_language(['currentLanguage' => $this->currentLanguage()]);

		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
		 		$insert = $this->store(['method' => 'create']);

		 		$insertCatId = $this->AutoloadModel->_insert([
		 			'table' => $this->data['module'],
		 			'data'  => $insert,
		 		]);


		 		if($insertCatId > 0){
		 			$insertTrans = [];
		 			foreach ($languageList as $key => $value) {
		 				$insertTrans[$key]['code'] = $insert['code'];
		 				$insertTrans[$key]['publish'] = $insert['publish'];
		 				$insertTrans[$key]['created_at'] = $insert['created_at'];
		 				$insertTrans[$key]['userid_created'] = $insert['userid_created'];
		 				$insertTrans[$key]['language'] = $value['canonical'];


		 			}
		 			$insertTransId =  $this->AutoloadModel->_create_batch([
		 					'table' => $this->data['module'],
			 		 		'data'  => $insertTrans,
		 				]);
		 			if($insertTransId > 0){
	 					$session->setFlashdata('message-success', 'Tạo Bản Ghi Thành Công! Hãy tạo danh mục tiếp theo.');
 						return redirect()->to(BASE_URL.'backend/product/color/color/index');
	 				}else{
	 					$session->setFlashdata('message-danger', 'Có vấn đề xảy ra, vui lòng thử lại!');
	 					return redirect()->to(BASE_URL.'backend/product/color/color/index');
	 				}
		 		}
	        else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
	    }
	}



		$this->data['method'] = 'create';
		$this->data['template'] = 'backend/product/color/create';
		return view('backend/dashboard/layout/home', $this->data);
	}
	public function update($id = 0){
		$id = (int)$id;
		$this->data['language'] = $this->AutoloadModel->_get_where([
			'select' => 'title',
			'table' => 'language',
			'where' => ['publish' => 1, 'deleted_at' => 0],
		],true);
		$session = session();
		$this->data['updateColor'] = $this->AutoloadModel->_get_where([
			'select' => 'title, code, language',
			'table' => 'color',
			'where' => ['id' => $id, 'deleted_at' => 0, 'language' => $this->currentLanguage()],
		]);
		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
		 		$update = $this->store(['method' => 'update']);
		 		$flagUpdate = $this->AutoloadModel->_update([
		 			'table' => $this->data['module'],
		 			'data'  => $update,
		 			'where' => ['id' => $id],
		 		]);


		 		if($flagUpdate > 0){
	 					$session->setFlashdata('message-success', 'Tạo Bản Ghi Thành Công! Hãy tạo danh mục tiếp theo.');
 						return redirect()->to(BASE_URL.'backend/product/color/color/index');
	 				}else{
	 					$session->setFlashdata('message-danger', 'Có vấn đề xảy ra, vui lòng thử lại!');
	 					return redirect()->to(BASE_URL.'backend/product/color/color/index');
	 				}
		 		}
	        else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
	    }
	


		$this->data['method'] = 'update';
		$this->data['template'] = 'backend/product/color/update';
		return view('backend/dashboard/layout/home', $this->data);
	}
	public function delete($id = 0){
		$session = session();
		

		$this->data['template'] = 'backend/product/color/delete';
		return view('backend/dashboard/layout/home', $this->data);
	}
	private function detect_language($param = []){
		$languageList = $this->AutoloadModel->_get_where([
			'select' => 'id, canonical',
			'table'  => 'language',
			'where'  => ['publish' => 1,'deleted_at' => 0,'canonical !=' =>  $this->currentLanguage()]
		], TRUE);
		$select = '';
		$i = 3;
		if(isset($languageList) && is_array($languageList) && count($languageList)){
			foreach($languageList as $key => $val){
				$select = $select.'(SELECT  COUNT(id) FROM color WHERE language = "'.$val['canonical'].'") as '.$val['canonical'].'_detect, ';
				$i++;
			}
		}
		// pre($select);
		return [
			'select' => $select,
		];
	}
	private function validation(){
		$validate = [
			'title'   => 'required',
			'code' => 'required',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập vào tên của màu'
			],
			'code' => [
				'required' => 'Bạn phải nhập vào mã màu'
			]
		];
		return [
			'validate'      => $validate,
			'errorValidate' => $errorValidate,
		];
	}
	private function condition_where(){
		$where = [];
		$deleted_at = $this->request->getGet('deleted_at');
		$publish = $this->request->getGet('publish');
		if(isset($deleted_at)){
			$where['tb1.deleted_at'] = $deleted_at;
		}else{
			$where['tb1.deleted_at'] = 0;
		}
		if(isset($publish)){
			$where['tb1.publish'] = $publish;
		}else{
			$where['tb1.publish'] = 1;
		}
		
		return $where;
	}
	private function condition_keyword($keyword = ''): string{
		if(!empty($this->request->getGet('keyword'))){
			$keyword = $this->request->getGet('keyword');
			$keyword = '(tb1.title LIKE \'%'.$keyword.'%\' OR tb1.keyword LIKE \'%'.$keyword.'%\' )';
		}
		return $keyword;
	}
	private function store($param = []){
		helper(['text']);
		$canonical = $this->currentLanguage();

		
		$store = [
 			'title'   => $this->request->getPost('title'),
 			'code' => $this->request->getPost('code'),
 			'publish' => $this->request->getPost('publish'),
 			'language' => $canonical,
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
	
	
	
}
