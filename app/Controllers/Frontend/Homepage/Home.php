<?php
namespace App\Controllers\Frontend\Homepage;
use App\Controllers\FrontendController;

class Home extends FrontendController{

	public $data = [];

	public function __construct(){
	}

	public function index(){
		$this->data['menu_header'] = get_menu('menu_3', $this->currentLanguage());
		// pre($this->data['menu_header']);
		$this->data['slide_banner'] = get_slide('slide-banner');
		// pre($this->data['slide_banner']);

		$this->data['template'] = 'frontend/homepage/home/index';
		return view('frontend/homepage/layout/home', $this->data);
	}
}
