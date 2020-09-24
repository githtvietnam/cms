<?php 
namespace App\Controllers\Backend\Slide;
use App\Controllers\BaseController;


class Slide extends BaseController{
	protected $data;
	public function __construct(){
		$this->data = [];
		$this->data['module'] = 'slide';
	}
	public function index($page = 1){
		helper(['mypagination']);
		$session = session();
		$flag = $this->authentication->check_permission([
			'routes' => 'backend/slide/slide/index'
		]);
		if($flag == false){
 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		}

		$page = (int)$page;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
		$where = $this->condition_where();
		$keyword = $this->condition_keyword();
		$config['total_rows'] = $this->AutoloadModel->_get_where([
			'select' => 'id',
			'table' => $this->data['module'].'_catalogue',
			'keyword' => $keyword,
			'where' => $where,
			'group_by' => 'id',
			'count' => TRUE
		]);
		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => 'backend/slide/slide/index','perpage' => $perpage], $config);
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$languageDetact = $this->detect_language();
			$this->data['slideList'] = $this->AutoloadModel->_get_where([
				'select' => 'id,title, keyword, userid_created, userid_updated, created_at, updated_at,'.((isset($languageDetact['select'])) ? $languageDetact['select'] : ''),
				'table' => $this->data['module'].'_catalogue',
				'where' => $where,
				'keyword' => $keyword,
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'order_by'=> 'id desc',
				'group_by' => 'id'
			], TRUE);
		}
		$this->data['template'] = 'backend/slide/slide/index';
		return view('backend/dashboard/layout/home', $this->data);
	}
	public function create(){
		$session = session();
		$flag = $this->authentication->check_permission([
				'routes' => 'backend/slide/slide/create'
			]);
		if($flag == false){
 			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		}
		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			$language = $this->currentLanguage();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
		 		$insert = $this->store(['method' => 'create']);
		 		$insertResultId = $this->AutoloadModel->_insert([
		 			'table' => $this->data['module'].'_catalogue',
		 			'data' => $insert,
		 		]);
		 		if($insertResultId > 0){
		 			$insert['data']= json_decode($insert['data'],true);
		 			$data1=[];
		 			$data2=[];
		 			$data1 = $this->separateArray($insert['data'],['order', 'image']);
		 			if (isset($insert['data']) && is_array($insert['data']) && count($insert['data'])){
		 				foreach ($insert['data'] as $key => $val) {
		 					$data1[$key]['catalogue_id'] = $insertResultId; 
		 					$data1[$key]['created_at']=$insert['created_at'];
		 					$data1[$key]['userid_created']=$insert['userid_created'];
		 				}
		 			}
		 			$imageId=[];
		 			foreach ($data1 as $key => $val){
		 				$insertid =  $this->AutoloadModel->_insert([
		 					'table' => $this->data['module'],
			 		 		'data' => $data1[$key],
		 				]);
		 				$imageId[$key] = $insertid;
		 			}
		 				if(isset($imageId) && is_array($imageId) && count($imageId)){
				 			$data2 = $this->separateArray($insert['data'],['title','url', 'content','description']);
			 				foreach ($insert['data'] as $key => $val) {
			 					$data2[$key]['object_id'] = $imageId[$key];
			 					$data2[$key]['language']=$language;
			 					$data2[$key]['created_at']=$insert['created_at'];
			 					$data2[$key]['userid_created']=$insert['userid_created'];
			 				}
				 			foreach ($data2 as $key => $val){
					 			$insertResult = $this->AutoloadModel->_insert([
						 		 	'table' => $this->data['module'].'_translate',
						 		 	'data' => $data2[$key],
						 		]);
				 			}
			 			}
					if($insertResult > 0){
	 					$session->setFlashdata('message-success', 'Tạo Bài Viết Thành Công! Hãy tạo danh mục tiếp theo.');
 						return redirect()->to(BASE_URL.'backend/slide/slide/index');
	 				}else{
	 					$session->setFlashdata('message-danger', 'Có vấn đề xảy ra, vui lòng thử lại!');
	 					return redirect()->to(BASE_URL.'backend/slide/slide/index');
	 				}
		 		}
	        }else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
		}
		$this->data['method'] = 'create';
		$this->data['template'] = 'backend/slide/slide/create';
		return view('backend/dashboard/layout/home', $this->data);
	}
	public function update($id = 0){
		$id = (int)$id;
		$this->data[$this->data['module'].'_catalogue'] = $this->AutoloadModel->_get_where([
			'select' => 'id, title, keyword,data',
			'table' => $this->data['module'].'_catalogue',
			'where' => ['id' => $id,'deleted_at' => 0]
		]);
		$session = session();
		if(!isset($this->data[$this->data['module'].'_catalogue']) || is_array($this->data[$this->data['module'].'_catalogue']) == false || count($this->data[$this->data['module'].'_catalogue']) == 0){
			$session->setFlashdata('message-danger', 'Slide không tồn tại');
 			return redirect()->to(BASE_URL.'backend/slide/slide/index');
		}
		if($this->request->getMethod() == 'post'){
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
		 		$update = $this->store(['method' => 'update']);
		 		$updateResultId = $this->AutoloadModel->_update([
			 			'table' => $this->data['module'].'_catalogue',
			 			'data' => $update,
			 		]);
		 		$update['data']= json_decode($update['data'],true);
		 		if($updateResultId > 0){
		 			$data1=[];
		 			$data1 = $this->separateArray($update['data'],['image','order']); 
		 			if (isset($update['data']) && is_array($update['data']) && count($update['data'])){
		 				foreach ($update['data'] as $key => $val) {
		 					$data1[$key]['catalogue_id'] = $id; 
		 					$data1[$key]['updated_at']=$update['updated_at'];
		 					$data1[$key]['userid_updated']=$update['userid_updated'];
		 				}
		 				$updateImage = [];
			 			$updateImage = $this->AutoloadModel->_get_where([
			 				'table' => 'slide',
			 				'select' =>'id',
			 				'where' => ['catalogue_id' => $id],
			 			],true);
			 			$object_id = [];
			 			$object_id = $this->AutoloadModel->_get_where([
			 				'table' => 'slide',
			 				'select' => 'id',
			 				'where' => ['catalogue_id' => $id],
			 			],true);//cu
			 			$oldId = $object_id;
			 			foreach ($updateImage as $key => $val){
			 				$delete =  $this->AutoloadModel->_delete([
			 					'table' => $this->data['module'],
				 		 		'where' => ['id' => $val],
			 				]);
			 			}
			 			foreach ($object_id as $key => $val){
			 				$delete =  $this->AutoloadModel->_delete([
			 					'table' => $this->data['module'].'_translate',
				 		 		'where' => ['object_id' => $val, 'language' => $this->currentLanguage()],
			 				]);
			 			}
			 			foreach ($data1 as $key => $val){
			 				$delete =  $this->AutoloadModel->_insert([
			 					'table' => $this->data['module'],
				 		 		'data' => $data1[$key],
			 				]);
			 			}
			 			$object_id = $this->AutoloadModel->_get_where([
			 				'table' => 'slide',
			 				'select' => 'id',
			 				'where' => ['catalogue_id' => $id],
			 			],true);//moi
			 			foreach ($oldId as $key => $val) {
			 				foreach ($object_id as $keyob => $valob) {
			 					$deleteCatalogue = $this->AutoloadModel->_update([
									'table' => $this->data['module'].'_translate',
									'data' => ['object_id' => $valob['id']],
									'where' => ['object_id' => $val['id']],
									]);
			 				}
			 			}
			 			$data2=[];
			 			$data2 = $this->separateArray($update['data'],['title','url','content','description']);
		 				foreach ($update['data'] as $key => $val) {
		 					{
		 						foreach ($object_id as $keyob => $valob) {
				 					$data2[$key]['object_id'] = $valob['id'];
				 					$data2[$key]['updated_at']=$update['updated_at'];
				 					$data2[$key]['userid_updated']=$update['userid_updated'];
				 					$data2[$key]['language']=$this->currentLanguage();
		 						}
		 					}
		 					
		 				}
			 			foreach ($data2 as $key => $val){
			 			$insertResult = $this->AutoloadModel->_insert([
					 		 	'table' => $this->data['module'].'_translate',
					 		 	'data' => $data2[$key],
					 		]);
			 			}
			 		}
				$session->setFlashdata('message-success', 'Cập nhật Slide Thành Công! Hãy tạo danh mục tiếp theo.');
						return redirect()->to(BASE_URL.'backend/slide/slide/index');
 				}else{
 					$session->setFlashdata('message-danger', 'Có vấn đề xảy ra, vui lòng thử lại!');
 					return redirect()->to(BASE_URL.'backend/slide/slide/index');
 				}
	        }else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
		}
		$this->data['method'] = 'update';
		$this->data['template'] = 'backend/slide/slide/update';
		return view('backend/dashboard/layout/home', $this->data);
	}
	public function delete($id = 0){
		$session = session();
		$flag = $this->authentication->check_permission([
				'routes'=>'backend/article/article/delete',
			]);
		if ($flag == false){
			$session = session();
			$session->setFlashdata('message-danger', 'Bạn không có quyền truy cập chức năng này!');
			return redirect()->to(BASE_URL.'Backend/dashboard/dashboard/index');
		}
		$id = (int)$id;
		$this->data[$this->data['module']] = $this->AutoloadModel->_get_where([
			'select' => 'id, title',
			'table' => $this->data['module'].'_catalogue',
			'where' => ['id' => $id,'deleted_at' => 0]
		]);
		if($this->request->getPost('delete')){
			$deleteCatalogue = $this->AutoloadModel->_update([
				'table' => $this->data['module'].'_catalogue',
				'data' => ['deleted_at' => 1],
				'where' => ['id' => $id],
				]);
			if ($deleteCatalogue>0){
				$deleteSlide = $this->AutoloadModel->_update([
				'table' => $this->data['module'],
				'data' => ['deleted_at' => 1],
				'where' => ['catalogue_id' => $id],
				]);
				$DeleteTranslate = $this->AutoloadModel->_get_where([
					'select' => 'id',
					'table' => $this->data['module'],
					'where' => ['catalogue_id' => $id,]
				],true);//lay ra id cua cac anh da xoa
				if (isset($DeleteTranslate) && is_array($DeleteTranslate) &&count($DeleteTranslate)){
					foreach ($DeleteTranslate as $key => $val) {
						$deleteTranslate = $this->AutoloadModel->_update([
							'table' => $this->data['module'].'_translate',
							'data' => ['deleted_at' => 1],
							'where' => ['object_id' => $val,]
						]);
					}
				}
	 		$session->setFlashdata('message-success', 'Xóa bản ghi thành công!');
			}else{
				$session->setFlashdata('message-danger', 'Có vấn đề xảy ra, vui lòng thử lại!');
			}
			return redirect()->to(BASE_URL.'backend/slide/slide/index');
		}
		$this->data['template'] = 'backend/slide/slide/delete';
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
				$select = $select.'(SELECT COUNT(object_id) FROM slide_translate, slide WHERE slide_translate.object_id = slide.id AND slide_translate.language = "'.$val['canonical'].'") as '.$val['canonical'].'_detect, ';
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
			'keyword' => 'required',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập vào tên của slide'
			],
			'keyword' => [
				'required' => 'Bạn phải nhập vào từ khóa của slide'
			]
		];
		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
	}
	private function condition_where(){
		$where = [];
		$deleted_at = $this->request->getGet('deleted_at');
		if(isset($deleted_at)){
			$where['deleted_at'] = $deleted_at;
		}else{
			$where['deleted_at'] = 0;
		}
		return $where;
	}
	private function condition_keyword($keyword = ''): string{
		if(!empty($this->request->getGet('keyword'))){
			$keyword = $this->request->getGet('keyword');
			$keyword = '(title LIKE \'%'.$keyword.'%\' OR name LIKE \'%'.$keyword.'%\' )';
		}
		return $keyword;
	}
	private function store($param = []){
		helper(['text']);
		$store = [
 			'title' => $this->request->getPost('title'),
 			'keyword' => $this->request->getPost('keyword'),
 			'publish' => $this->request->getPost('publish'),
 			'data' => json_encode($this->request->getPost('data'), TRUE),
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
	private function separateArray($param= [], $target=[])
	{
		$data=[];
		for ($i=0; $i<count($param);$i++){
			if (isset($param[$i]))
				for ($j=0; $j<count($target);$j++){
					$data[$i][$target[$j]] = $param[$i][$target[$j]]; 
				}
			}
		return $data;
	} 
	
	
}
