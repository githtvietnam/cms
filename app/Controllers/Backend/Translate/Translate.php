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
					$moduleExtract[0].'_translate as tb2', 'tb1.id = tb2.objectid AND tb2.language = \''.$language.'\' ', 'inner'
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
	public function translateContact($objectid = 0, $module = '', $language = ''){
		$session = session();
		$objectid = (int)$objectid;
		$moduleExtract = explode('_', $module);
		$this->data['language'] = $language;
		$this->data['flag'] = $this->AutoloadModel->_get_where([
			'select' => 'image ',
			'table' => 'language',
		],true);
		$this->data['object'] = $this->AutoloadModel->_get_where([
			'select' => 'tb2.objectid, tb2.title,  ',
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
		$this->data['dataTrans'] = $this->AutoloadModel->_get_where([
			'select' => 'tb2.objectid, tb2.title,  ',
			'table' => $module.' as tb1',
			'join' => [
				[
					$moduleExtract[0].'_translate as tb2','tb1.id = tb2.objectid AND tb2.language = \''.$language.'\' ','inner'
				]
			],
			'where' => ['tb1.id' => $objectid,'module' => $module]
		]);
		if($this->request->getMethod() == 'post'){
			$validate = $this->validationContact();
			if ($this->validate($validate['validate'], $validate['errorValidate'])){
				$dataTrans = $this->storeContact([
		 			'objectid' => $objectid,
		 			'module' => $module,
		 			'language' => $language,
		 		]);
				$flag = 0;
		 		if(isset($this->data['dataTrans']) && is_array($this->data['dataTrans']) && count($this->data['dataTrans'])){
					$flag = $this->AutoloadModel->_update([
			 			'table' => $moduleExtract[0].'_translate',
			 			'where' => ['objectid' => $objectid,'language' => $language, 'module' => $module],
			 			'data' => $dataTrans,
			 		]);
				}else{
					$flag = $this->AutoloadModel->_insert([
			 			'table' => $moduleExtract[0].'_translate',
			 			'data' => $dataTrans,
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




		$this->data['template'] = 'backend/translate/translate/translateContact';
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
	private function storeContact($param = []){
		helper(['text']);
		$store = [
			'title' => $this->request->getPost('title'),
			'language' => $param['language'],
			'module' => $param['module'],
			'objectid' => $param['objectid'],
		];

		return $store;
	}
	private function validationContact($module = ''){
		$validate = [
			'title' => 'required',
		];
		$errorValidate = [
			'title' => [
				'required' => 'Bạn phải nhập vào trường tiêu đề'
			],
			
		];
		return [
			'validate'      => $validate,
			'errorValidate' => $errorValidate,
		];
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
			'validate'      => $validate,
			'errorValidate' => $errorValidate,
		];
	}

}
