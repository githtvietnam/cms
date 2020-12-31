<?php

namespace App\Controllers\Backend\Panel\Libraries;
use App\Controllers\BaseController;

class ConfigBie{

	function __construct($params = NULL){
		$this->params = $params;
	}
	public function panel(){
		$data['locate'] =  array(
			0 => '-- Chọn vị trí Panel --',
            'home' => 'Trang chủ',
            'sidebar' => 'Sidebar',
            'footer' => 'Footer'
		);
		$data['dropdown'] =  array(
			0 => '-- Chọn danh mục sản phẩm --',
            'product' => 'Sản phẩm',
            'product_catalogue' => 'Danh mục sản phẩm',
            'brand' => 'Thương hiệu',
            'brand_catalogue' => 'Danh mục Thương hiệu',
            'article' => 'Bài viết',
            'article_catalogue' => 'Danh mục Bài viết',
            'tour' => 'Chuyến du lịch',
            'tour_catalogue' => 'Danh mục Chuyến du lịch',
		);

		return $data;
	}
}
