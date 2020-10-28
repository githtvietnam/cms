<?php 
namespace App\Controllers\Ajax;
use App\Libraries\Nestedsetbie;
use App\Controllers\BaseController;

class Product extends BaseController{

	public $nestedsetbie;

	public function __construct(){
		helper('mydata');
		$this->nestedsetbie = new Nestedsetbie(['table' => 'menu','language' => $this->currentLanguage()]);
		
	}

	public function general_id(){
		$param['suffix'] = $this->request->getPost('suffix');
		$param['data_0'] = $this->request->getPost('data_0');
		$param['prefix'] = $this->request->getPost('prefix');
		$param['module'] = $this->request->getPost('module');

		
		$num0 = '';
		for ($i=0; $i < $param['data_0']; $i++) { 
			$num0 = $num0.'0';
		}

		$code = $param['suffix'].'-'.$num0.'-'.$param['prefix'];

		$dataInsert = [
			'suffix' => $param['suffix'],
			'prefix' => $param['prefix'],
			'objectid' => 1,
			'num0' => $param['data_0'],
			'module' => $param['module'],
			'code' => $code,
		];
		$count = check_id_exist($param['module']);
		if($count == 0){
			$this->AutoloadModel->_insert([
				'table' => 'id_general',
				'data' => $dataInsert
			]);
		}else{
			$this->AutoloadModel->_delete([
				'table' => 'id_general',
				'where' => ['module' => $param['module']]
			]);
			$this->AutoloadModel->_insert([
				'table' => 'id_general',
				'data' => $dataInsert
			]);
		}
		
		die();		
	}

}
