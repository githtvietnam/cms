<?php 
namespace App\Controllers\Ajax;
use App\Controllers\BaseController;

class Slide extends BaseController{
	
	public function __construct(){
	}
	public function delete(){
		$id = $this->request->getPost('id');
		$flag = $this->AutoloadModel->_update([
			'table' => 'slide_catalogue',
			'data' => ['deleted_at' => 1],
			'where_in' => $id,
			'where_in_field' => 'id',
		]);
		if ($flag > 0){
			$flag = $this->AutoloadModel->_update([
				'table' => 'slide',
				'data' => ['deleted_at' => 1],
				'where_in' => $id,
				'where_in_field' => 'catalogueid',
			]);
			$flag = $this->AutoloadModel->_update([
				'table' => 'slide_translate',
				'data' => ['deleted_at' => 1],
				'where_in' => $id,
				'where_in_field' => 'catalogueid',
			]);
		}
		echo $flag;die();
	}
}
