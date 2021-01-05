<?php
namespace App\Controllers\Frontend\Article;
use App\Controllers\FrontendController;

class Catalogue extends FrontendController{

	public $data = [];
    private  $table = 'article_catalogue';

	public function __construct(){
	}

	public function index($id = 0, $page = 1){
        $id = (int)$id;
		$detailCatalogue = $this->AutoloadModel->_get_where([
            'select' => '*',
            'table' => $this->table,
            'where' => ['id' => $id]
        ]);

        

        pre($detailCatalogue);die();
	}
}
