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


		$dataInsert = [
			'suffix' => $param['suffix'],
			'prefix' => $param['prefix'],
			'num0' => $param['data_0'],
			'module' => $param['module'],
		];

		$flag = $this->AutoloadModel->_insert([
			'table' => 'id_general',
			'data' => $dataInsert
		]);

		
		$param['data'] = [
			'data_0' => $param['data_0'],
			'suffix' => $param['suffix'],
			'prefix' => $param['prefix'],
			'module' => $param['module'],
		];
		echo json_encode($param['data']);die();		
	}

}
