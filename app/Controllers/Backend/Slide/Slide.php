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
		$session = session();
		//$flag = $this->authentication->check_permission([
		//	'routes' => 'backend/slide/slide/index'
		//]);
		//if($flag == false){
 		//	$this->session->setFlashdata('message-danger', 'Bạn không có quyền truy cập vào chức năng này!');
 			//return redirect()->to(BASE_URL.'backend/dashboard/dashboard/index');
		//}


		helper(['mypagination']);
		$page = (int)$page;
		$perpage = ($this->request->getGet('perpage')) ? $this->request->getGet('perpage') : 20;
		$where = $this->condition_where();

		$keyword = $this->condition_keyword();
		
		$config['total_rows'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id,tb1.name, tb1.canonical',
			'table' => $this->data['module'].' as tb1',
			'keyword' => $keyword,
			'where' => $where,
			'join' => [
				[
					'slide_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\' ', 'inner'
				],
			],
			'group_by' => 'tb1.id',
			'count' => TRUE
		]);

		


		if($config['total_rows'] > 0){
			$config = pagination_config_bt(['url' => 'backend/article/article/index','perpage' => $perpage], $config);

			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();


			$totalPage = ceil($config['total_rows']/$config['per_page']);
			$page = ($page <= 0)?1:$page;
			$page = ($page > $totalPage)?$totalPage:$page;
			$page = $page - 1;

			$languageDetact = $this->detect_language();

			$this->data['slideList'] = $this->AutoloadModel->_get_where([
				'select' => 'tb1.id, tb1.name, tb1.canonical, '.((isset($languageDetact['select'])) ? $languageDetact['select'] : ''),
				'table' => $this->data['module'].' as tb1',
				'where' => $where,
				
				'keyword' => $keyword,
				'join' => [
					[
					'slide_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\' ', 'inner'
					],
				],
				'limit' => $config['per_page'],
				'start' => $page * $config['per_page'],
				'order_by'=> 'tb1.id desc',
				'group_by' => 'tb1.id'
			], TRUE);
		}
		
		$this->data['template'] = 'backend/slide/slide/index';
		
		return view('backend/dashboard/layout/home', $this->data);
	}

	public function create(){
		
		$session = session();
		if($this->request->getMethod() == 'post'){
		 		
			
			$validate = $this->validation();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){

				$data= [];
		 		$insert = $this->store(['method' => 'create']);
				$data['name'] = $insert['name'];
				$data['canonical'] = $insert['canonical'];
	 			
		 		$insert = json_decode($insert['album'],TRUE);
		 		
		 		foreach ($insert as $key => $val) {
		 			$data['image'][]= $val['image'];
		 		}
		 		
		 		$data['image']= json_encode($data['image']);

		 		$insert = $this->dataEncode($insert);

		 		
		 		$resultid = $this->AutoloadModel->_insert([
		 			'table' => $this->data['module'],
		 			'data' => $data,
		 		]);
		 		
 
		 		if($resultid > 0){

		 			$storeLanguage = $this->storeLanguage($resultid);
		 			
		 			$storeLanguage['title'] = $insert['dataTranslate']['title'];
		 			$storeLanguage['number'] =$insert['dataTranslate']['number'];
		 			$storeLanguage['description'] = $insert['dataTranslate']['description'];
		 			$storeLanguage['meta_title'] = $insert['dataTranslate']['meta_title'];
		 			$storeLanguage['meta_description'] = $insert['dataTranslate']['meta_description'];

		 			$insertTranslate = $this->AutoloadModel->_insert([
			 			'table' => 'slide_translate',
			 			'data' => $storeLanguage,
			 		]);
			 		


	 				
	 					$session->setFlashdata('message-success', 'Tạo Bài Viết Thành Công! Hãy tạo danh mục tiếp theo.');
 						return redirect()->to(BASE_URL.'backend/slide/slide/index');
	 				
		 		}

	        }else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
		}
		
		$this->data['method'] = 'create';
		$this->data['template'] = 'backend/slide/slide/create';
		return view('backend/dashboard/layout/home', $this->data);
	}



	public function update($id = 0)
	{
		$id = (int)$id;

		$this->data[$this->data['module']] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id,tb2.number, tb2.title, tb1.name, tb1.canonical, tb1.album, tb2.description, tb2.meta_title, tb2.meta_description, tb1.image,',
			'table' => $this->data['module'].' as tb1',
			'join' => [
					[
					'slide_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = \''.$this->data['module'].'\' ', 'inner'
					],
				],
			'where' => ['tb1.id' => $id,'tb1.deleted_at' => 0]
		]);

		$dataDecode =$this->dataDecode($this->data[$this->data['module']]);
		



		$this->data['value'] = $dataDecode['value'];
		$this->data['valueTranslate'] = $dataDecode['valueTranslate'];
		
		$session = session();
		if(!isset($this->data[$this->data['module']]) || is_array($this->data[$this->data['module']]) == false || count($this->data[$this->data['module']]) == 0){
			$session->setFlashdata('message-danger', 'Bài Viết không tồn tại');
 			return redirect()->to(BASE_URL.'backend/slide/slide/index');
		}

		if($this->request->getMethod() == 'post')
			{
				$validate = $this->validation();
					if ($this->validate($validate['validate'], $validate['errorValidate']))
					{
				 		$catchData = $this->store(['method' => 'update']);
				 		
				 		
				 		$update['album'] = json_decode($catchData['album'],true);
				 		 
				 		
				 		$update = $this->dataEncode($update['album']);
				 		$update['data']['canonical']=$catchData['canonical']; 
				 		$update['data']['name']=$catchData['name']; 
			 			

			 			
			 			
				 		 $flag = $this->AutoloadModel->_update([
				 			'table' => $this->data['module'],
				 			'where' => ['id' => $id],
				 			'data' => $update['data'],
				 		]);
			 		
				 		
						$updateTranslate = $this->AutoloadModel->_update([
							'table'=>'slide_translate',
							'data'=> $update['dataTranslate'],
							'where' => ['objectid' =>$id],
						]);

		 			$session->setFlashdata('message-success', 'Cập Nhật Bài Viết Thành Công!');
 					return redirect()->to(BASE_URL.'backend/slide/slide/index');
				 		
			 		}else
			        {
			        	$this->data['validate'] = $this->validator->listErrors();
			        }

	        }
	        
	
		
		
		$this->data['method'] = 'update';
		$this->data['template'] = 'backend/slide/slide/update';
		return view('backend/dashboard/layout/home', $this->data);
	}
	
	public function delete($id = 0){

		$id = (int)$id;
		// $flag = $this->authentication->check_permission([
		// 	'routes'=>'backend/article/article/delete',
		// ]);
		// if ($flag == false){
		// 	$session = session();
		// 	$session->setFlashdata('message-danger', 'Bạn không có quyeenff truy cập chức năng này!');
			
		// 	return redirect()->to(BASE_URL.'Backend/dashboard/dashboard/index');
		// }
			$this->data[$this->data['module']] = $this->AutoloadModel->_get_where([
				'table' => $this->data['module'].' as tb1',
				'select' => 'tb1.id, tb2.title',
				'join' => [
			 		[
			 		'slide_translate as tb2',  'tb1.id = tb2.objectid AND tb2.language = \''.$this->currentLanguage().'\'', 'inner']
			 	],
			 	'where' =>['tb1.id'=>$id,'tb1.deleted_at' =>0],

			]);
			
			$session = session();
			if (!isset($this->data[$this->data['module']])|| !is_array($this->data[$this->data['module']]) ||count($this->data[$this->data['module']])==0){
				$session->setFlashdata('message-danger', 'Cập nhật thất bại! Thành viên không tồn tại');
					
				return redirect()->to(BASE_URL.'Backend/slide/article/index');

			}	
			
			if ($this->request->getPost('delete'))
			{
				$flag = $this->AutoloadModel->_update([
					'data' =>['deleted_at' => 1],
					'table'=> $this->data['module'],
					
					'where' => ['id' =>$id,'deleted_at' =>0] 
				]);
				$session = session();
					if ($flag > 0)
				{		
					 $session->setFlashdata('message-success', 'Xóa slide thành công!');
				}else
				{
					 $session->setFlashdata('message-danger', 'Có lỗi xảy ra. Vui lòng thử lại!');
				}

				return redirect()->to(BASE_URL.'Backend/slide/slide/index');
			


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
				$select = $select.'(SELECT COUNT(objectid) FROM slide_translate WHERE slide_translate.objectid = tb1.id AND slide_translate.language = "'.$val['canonical'].'") as '.$val['canonical'].'_detect, ';
				$i++;
			}	
		}
		//pre($select);


		return [
			'select' => $select,
		];

	}

	private function validation(){
		
		$validate = [
			'name' => 'required',
			
		];
		$errorValidate = [
			
			'name' => [
				'required' => 'Bạn phải nhập vào tên của slide'
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
			$where['tb1.deleted_at'] = $deleted_at;
		}else{
			$where['tb1.deleted_at'] = 0;
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
 			'album' => json_encode($this->request->getPost('album')),
 			'image' => json_encode($this->request->getPost('image')),
 			'canonical' => $this->request->getPost('canonical'),
 			'name' => $this->request->getPost('name'),

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
	private function storeLanguage($objectid = 0){
		helper(['text']);
		$store = [
			'objectid' => $objectid,
			'title' => json_encode($this->request->getPost('title')),
			'description' => json_encode($this->request->getPost('description')),
			'meta_title' => json_encode($this->request->getPost('meta_title')),
			'meta_description' => json_encode($this->request->getPost('meta_description')),
			'language' => $this->currentLanguage(),
			'module' => $this->data['module'],
		];

		return $store;
	}
	private function dataDecode($param = []){
		$value = [];
		$valueTranslate= [];
		$value['image'] = json_decode($param['image']);
		$valueTranslate['title'] = json_decode($param['title']);
		$valueTranslate['number'] = json_decode($param['number']);
		$valueTranslate['description'] = json_decode($param['description']);
		$valueTranslate['meta_title'] = json_decode($param['meta_title']);
		$valueTranslate['meta_description'] = json_decode($param['meta_description']);

		return [
			'value' => $value,
			'valueTranslate' => $valueTranslate
		];
	}

	private  function dataEncode($param = []){
				$data = [];
		 		$dataTranslate = [];
		 		if (isset($param) && is_array($param) && count($param))
		 		{

		 			foreach ($param as $key => $val) {
		 				$data['image'][] = $val['image'];
		 				$dataTranslate['title'][] = $val['title'];
		 				$dataTranslate['number'][] = $val['number'];
		 				$dataTranslate['description'][] = $val['description'];
		 				$dataTranslate['meta_title'][] = $val['meta_title'];
		 				$dataTranslate['meta_description'][] = $val['meta_description'];
		 			}
		 			
		 			$data['image']= json_encode($data['image']);
		 			$dataTranslate['title']= json_encode($dataTranslate['title']);
		 			$dataTranslate['number']= json_encode($dataTranslate['number']);
		 			$dataTranslate['description']= json_encode($dataTranslate['description']);
		 			$dataTranslate['meta_title']= json_encode($dataTranslate['meta_title']);
		 			$dataTranslate['meta_description']= json_encode($dataTranslate['meta_description']);
		 		}

		 			return [
		 				'data' => $data,
		 				'dataTranslate' =>$dataTranslate
		 			];
	}

}
