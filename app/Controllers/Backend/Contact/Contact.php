<?php 
namespace App\Controllers\Backend\Contact;
use App\Controllers\BaseController;

class Contact extends BaseController{
	protected $data;
	
	public function __construct(){
		$this->data = [];
		$this->data['module'] = 'contact';
	}

	public function index($page = 1){
		
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
						'contact_translate as tb4','tb1.catalogueid = tb4.objectid','inner'
					],
					
				],
			'group_by' => 'tb1.id',
			'count' => TRUE,
		]);
		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => 'backend/contact/contact/index','perpage' => $perpage], $config);

			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();


			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;
			$this->data['contactList'] = $this->AutoloadModel->_get_where([
				'select' => 'tb1.id, tb1.publish, tb1.fullname, tb1.phone, tb1.email, tb1.address,  tb1.content, tb1.created_at, tb4.title',
				'table' => $this->data['module'].' as tb1',
				'where' => $where,
				'keyword' => $keyword,
				'join' => [
					
					[
						'contact_translate as tb4','tb1.catalogueid = tb4.objectid','inner'
					],
					
					
				],
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'order_by'=> 'tb1.id desc',
				'group_by' => 'tb1.id'
			], TRUE);
		}
		$this->data['template'] = 'backend/contact/contact/index';
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function reply($id = 0){
		$session = session();
		$id = (int)$id;
		$explode = explode('_', $this->data['module']);
		$this->data['data'] = $this->AutoloadModel->_get_where([
			'select' => ' id',
			'table'  => 'contact',
			'where'  => ['id' => $id,'deleted_at' => 0]
		]);
		$session = session();
		if(!isset($this->data['data']) || is_array($this->data['data']) == false || count($this->data['data']) == 0){
			$session->setFlashdata('message-danger', 'Bản ghi không tồn tại');
 			return redirect()->to(BASE_URL.'backend/contact/contact/index');
		}
		
		$this->data['reply'] = $this->AutoloadModel->_get_where([
			'select' => ' tb2.title, tb2.content, tb2.fullname, tb2.email, tb2.phone, tb2.address, tb1.content as replycontent, tb3.fullname as replyname, tb2.created_at',
			'table'  => 'reply as tb1',
			'join' => [
					[
						'user as tb3','tb1.userid_created = tb3.id','inner'
					],
					[
						'contact as tb2','tb2.id = tb1.objectid','inner'
					],
				],
			'where'  => ['tb1.objectid' => $id,'tb1.deleted_at' => 0]
		]);
		
		if ($this->data['reply'] == null){
			$this->data['reply'] = $this->AutoloadModel->_get_where([
				'select' => ' tb1.title, tb1.content, tb1.fullname, tb1.email, tb1.phone, tb1.address, tb1.created_at',
				'table'  => 'contact as tb1',
				'where'  => ['tb1.id' => $id,'tb1.deleted_at' => 0]
			]);
			if($this->request->getMethod() == 'post'){
				$validate = $this->validation();
				if ($this->validate($validate['validate'], $validate['errorValidate'])){
			 		
					$dataReply = $this->store($id, ['method' => 'create']);
					$insertReply = $this->AutoloadModel->_insert([
			 			'table' => 'reply',
			 			'data' => $dataReply
			 		]);		 		

			 		if($insertReply > 0){
			 			
			 			$session->setFlashdata('message-success', 'Cập Nhật Bài Viết Thành Công!');
	 					return redirect()->to(BASE_URL.'backend/contact/contact/index');
			 		}

		        }else{
		        	$this->data['validate'] = $this->validator->listErrors();
		        }
			}

		}else{
			if($this->request->getMethod() == 'post'){
				$validate = $this->validation();
				if ($this->validate($validate['validate'], $validate['errorValidate'])){

					$dataReply = $this->store($id, ['method' => 'update']);
			 		$updateReply = $this->AutoloadModel->_update([
			 			'table' => 'reply',
			 			'where' => ['objectid' => $id],
			 			'data' => $dataReply
			 		]);

			 		if($updateReply > 0){
			 			$session->setFlashdata('message-success', 'Cập Nhật Bài Viết Thành Công!');
	 					return redirect()->to(BASE_URL.'backend/contact/contact/index');
			 		}

		        }else{
		        	$this->data['validate'] = $this->validator->listErrors();
		        }

			}

		}
		$updateContact = $this->AutoloadModel->_update([
 			'table' => 'contact',
 			'where' => ['id' => $id],
 			'data' => ['publish' => 1]
 		]);
		
		
		$this->data['template'] = 'backend/contact/contact/reply';
		return view('backend/dashboard/layout/home', $this->data);
	}

	

	private function validation(){
	
		$validate = [
			
			
			'replycontent' => 'required',
		];
		$errorValidate = [
			'replycontent' => [
				'required' => 'Bạn chưa nhập nội dung trả lời!',
			],
			
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
			$where['tb1.deleted_at'] = $deleted_at;
		}else{
			$where['tb1.deleted_at'] = 0;
		}

		return $where;
	}

	private function condition_keyword($keyword = ''): string{
		if(!empty($this->request->getGet('keyword'))){
			$keyword = $this->request->getGet('keyword');
			$keyword = '(fullname LIKE \'%'.$keyword.'%\' OR address LIKE \'%'.$keyword.'%\' OR email LIKE \'%'.$keyword.'%\' OR phone LIKE \'%'.$keyword.'%\')';
		}
		return $keyword;
	}

	private function store($objectid = 0, $param = []){
		helper(['text']);
		$store = [
 			'content' => $this->request->getPost('replycontent'),
 			'objectid' => $objectid,
 			'deleted_at' => 0,
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
