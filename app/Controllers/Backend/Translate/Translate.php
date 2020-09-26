<?php 
namespace App\Controllers\Backend\Translate;
use App\Controllers\BaseController;
use App\Libraries\Nestedsetbie;

class Translate extends BaseController
{
		protected $data;
		public function __construct(){
		$this->data = [];
	}
	public function translateArticle($objectid = 0, $module = '', $language = ''){
		$session = session();
		$objectid = (int)$objectid;
		$moduleExtract = explode('_', $module);
		$this->data['object'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb2.title, tb2.canonical, tb2.description, tb2.content, tb2.meta_title, tb2.meta_description',
			'table' => $module.' as tb1',
			'join' => [
				[
					$moduleExtract[0].'_translate as tb2','tb1.id = tb2.objectid AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
				]
			],
			'where' => ['tb1.id' => $objectid,'module' => $module]
		]);
		if(!isset($this->data['object']) || is_array($this->data['object']) == false || count($this->data['object']) == 0){
			$session->setFlashdata('message-danger', 'Bản ghi không tồn tại!');
			return redirect()->to(BASE_URL.'backend/'.$moduleExtract[0].'/'.((count($moduleExtract) == 1) ? $moduleExtract[0] : $moduleExtract[1]).'/index');
		}
		$this->data['translate'] = $this->AutoloadModel->_get_where([
			'select' => 'tb1.id, tb2.title, tb2.canonical, tb2.description, tb2.content, tb2.meta_title, tb2.meta_description',
			'table' => $module.' as tb1',
			'join' => [
				[
					$moduleExtract[0].'_translate as tb2','tb1.id = tb2.objectid AND tb2.language = \''.$language.'\' ','inner'
				]
			],
			'where' => ['tb1.id' => $objectid]
		]);
		if($this->request->getMethod() == 'post'){
			$validate = $this->validation($module);
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
				$store = $this->storeLanguage([
		 			'objectid' => $objectid,
		 			'module' => $module,
		 			'language' => $language,
		 		]);
				if(isset($this->data['translate']) && is_array($this->data['translate']) && count($this->data['translate'])){
					$flag = $this->AutoloadModel->_update([
			 			'table' => $moduleExtract[0].'_translate',
			 			'where' => ['objectid' => $objectid,'language' => $language],
			 			'data' => $store,
			 		]);
				}else{
					$flag = $this->AutoloadModel->_insert([
			 			'table' => $moduleExtract[0].'_translate',
			 			'data' => $store,
			 		]);
					
				}
		 		if($flag > 0){
		 			$session->setFlashdata('message-success', 'Tạo Bản Dịch Thành Công! Hãy tạo danh mục tiếp theo.');
 					return redirect()->to(BASE_URL.'backend/'.$moduleExtract[0].'/'.((count($moduleExtract) == 1) ? $moduleExtract[0] : $moduleExtract[1]).'/index');
		 		}
	        }else{
	        	$this->data['validate'] = $this->validator->listErrors();
	        }
		}
		$this->data['template'] = 'backend/translate/translate/translateArticle';
		return view('backend/dashboard/layout/home', $this->data);
	}
	public function translateSlide($catalogue_id = 0, $module = '', $language = ''){
		$session = session();
		$catalogue_id = (int)$catalogue_id;
		$moduleExtract = explode('_', $module);
		$dataTrans=[];
		$this->data['object'] = $this->AutoloadModel->_get_where([
		 	'select' => 'tb2.id, tb3.title, tb3.url,tb3.language, tb3.content, tb3.description ',
			'table' => $module.'_catalogue as tb1',
			'join' => [
				[
		 			$moduleExtract[0].' as tb2','tb1.id = tb2.catalogue_id','inner'
				],
				[
		 			$moduleExtract[0].'_translate as tb3','tb2.id = tb3.object_id AND tb3.language = \''.$this->currentLanguage().'\' ','inner'
				],
			],
			'where' => ['tb1.id'=>$catalogue_id, 'tb3.language' => $this->currentLanguage() ],
		],true);
		if(!isset($this->data['object']) || is_array($this->data['object']) == false || count($this->data['object']) == 0){
		 	$session->setFlashdata('message-danger', 'Bản ghi không tồn tại!');
		 	return redirect()->to(BASE_URL.'backend/'.$moduleExtract[0].'/'.((count($moduleExtract) == 1) ? $moduleExtract[0] : $moduleExtract[1]).'/index');
		 }
			$idTrans=[];
			$idTrans = $this->AutoloadModel->_get_where([
		 		'table' => 'slide',
		 		'select' => 'id',
		 		'where' => ['catalogue_id' => $catalogue_id ],
		 	],true);
		 	foreach ($idTrans as $key => $val) {
		 		$check[] = $this->AutoloadModel->_get_where([
		 			'table' => 'slide_translate',
		 			'select' => 'id, language, content, description, title, url',
		 			'where' => ['language' => $language, 'object_id' => $val['id']]
		 		]);
		 	}
			$this->data['value'] = $check;
			if(isset($check) && is_array($check) && $check[0] != null){
				if($this->request->getMethod() == 'post'){
					$check = array_column($check, 'id');
					foreach ($check as $key => $value) {
						$store = $this->storeSlide([
				  			'object_id' => $value,
				  			'language' => $language,
				  			'method' => 'update',
					 	]);
						$dataTrans = $this->dataTranslate($store, $idTrans , 'update');
			 		}
			 		$flag = 0;
			 		if (isset($dataTrans) && is_array($dataTrans) && count($dataTrans)){
						foreach ($dataTrans as $key => $val) {
							$deleteAll = $this->AutoloadModel->_delete([
				 				'table' => $moduleExtract[0].'_translate',
				 				'where' => ['object_id' => $idTrans[$key]['id'], 'language' => $language],
					 			'data' => $val,
					 		]);
						}
					 	foreach ($dataTrans as $key => $val) {
				 			$flag = $this->AutoloadModel->_insert([
					 			'table' => $moduleExtract[0].'_translate',
					 			'data' => $dataTrans[$key],
					 		]);
			 			}
			 			
			 		}
			 		
			 		if($flag > 0){
		 			$session->setFlashdata('message-success', 'Tạo Bản Dịch Thành Công! Hãy tạo danh mục tiếp theo.');
 	 				return redirect()->to(BASE_URL.'backend/'.$moduleExtract[0].'/'.((count($moduleExtract) == 1) ? $moduleExtract[0] : $moduleExtract[1]).'/index');
		  			}
				}
			}else{
				if($this->request->getMethod() == 'post'){
					$store = $this->storeSlide([
			  			'object_id' => $catalogue_id,
			  			'language' => $language,
			  			'method' => 'create',
				 	]);
				 	$dataTrans = $this->dataTranslate($store, $idTrans , 'create');
			 		$flag = 0;
			 		foreach ($dataTrans as $key => $val) {
			 			$flag = $this->AutoloadModel->_insert([
				 			'table' => $moduleExtract[0].'_translate',
				 			'data' => $dataTrans[$key],
				 		]);
			 		}
					$this->data['dataTrans'] = $dataTrans;
		 		if($flag > 0){
		 			$session->setFlashdata('message-success', 'Tạo Bản Dịch Thành Công! Hãy tạo danh mục tiếp theo.');
 	 				return redirect()->to(BASE_URL.'backend/'.$moduleExtract[0].'/'.((count($moduleExtract) == 1) ? $moduleExtract[0] : $moduleExtract[1]).'/index');
		  			}
		  		}
	         }
		$this->data['template'] = 'backend/translate/translate/translateSlide';
		return view('backend/dashboard/layout/home', $this->data);
	}
	private function storeLanguage($param = []){
		helper(['text']);
		$store = [
			'objectid' => $param['objectid'],
			'title' => validate_input($this->request->getPost('title')),
			'canonical' => $this->request->getPost('canonical'),
			'description' => base64_encode($this->request->getPost('description')),
			'content' => base64_encode($this->request->getPost('content')),
			'meta_title' => validate_input($this->request->getPost('meta_title')),
			'meta_description' => validate_input($this->request->getPost('meta_description')),
			'language' => $param['language'],
			'module' => $param['module'],
		];
		return $store;
	}
	private function storeSlide($param = []){
		helper(['text']);
		$store = [
			'object_id' => $param['object_id'],
			'dataTrans' => $this->request->getPost('dataTrans'),
			'language' => $param['language'],
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
	private function dataTranslate($store = [], $idTrans = [], $method = ''){
		$dataTrans = [];
		foreach ($store['dataTrans'] as $key => $val) {
 			$dataTrans[$key]['title'] = $val['title'];
 			$dataTrans[$key]['url'] = $val['url'];
 			$dataTrans[$key]['description'] = $val['description'];
 			$dataTrans[$key]['content'] = $val['content'];
 			$dataTrans[$key]['language'] = $store['language'];
 			if (isset($idTrans) && is_array($idTrans) && count($idTrans)){
 				$dataTrans[$key]['object_id'] = $idTrans[$key]['id'];
 			}
 			if ($method == 'create'){
 				$dataTrans[$key]['created_at'] = $store['created_at'];
 				$dataTrans[$key]['userid_created'] = $store['userid_created'];
 			}else{
 				$dataTrans[$key]['updated_at'] = $store['updated_at'];
 				$dataTrans[$key]['userid_updated'] = $store['userid_updated'];
 			}
 		}
 		return $dataTrans;
	}
	private function validation($module = ''){
		$validate = [
			'title' => 'required',
			'canonical' => 'required|check_canonical['.$module.']',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập vào trường tiêu đề'
			],
			'canonical' => [
				'required' => 'Bạn phải nhập giá trị cho trường đường dẫn',
				'check_canonical' => 'Đường dẫn đã tồn tại, vui lòng chọn đường dẫn khác',
			],
		];
		return [
			'validate' => $validate,
			'errorValidate' => $errorValidate,
		];
	}

}
