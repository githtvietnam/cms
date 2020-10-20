<?php

namespace App\Controllers\Backend\Menu\Libraries;
use App\Controllers\BaseController;

class ConfigBie{

	function __construct($params = NULL){
		$this->params = $params;
	}
	public function menu(){
		$data['article'] =  array(
			'title' => 'Bài viết',
			'translate' => true
		);
		$data['article_catalogue'] =  array(
			'title' => 'Chuyên mục',
			'translate' => true
		);

		return $data;
	}
}
