<?php 
namespace App\Controllers\Ajax;
use App\Controllers\BaseController;

class Property extends BaseController{
	
	public function __construct(){
	}
	public function deleteCatalogue(){
		$id = $this->request->getPost('id');
		$flag = $this->AutoloadModel->_update([
			'table' => 'property_catalogue',
			'data' => ['deleted_at' => 1],
			'where' => ['id' => $id],
		]);
		
		
		
		echo $flag;die();
	}
	public function deleteProperty(){
		$id = $this->request->getPost('id');
		$flag = $this->AutoloadModel->_update([
			'table' => 'property',
			'data' => ['deleted_at' => 1],
			'where' => ['id' => $id],
		]);
		
		
		
		echo $flag;die();
	}
	
	

	
}
