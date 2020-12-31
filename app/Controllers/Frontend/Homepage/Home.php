<?php
namespace App\Controllers\Frontend\Homepage;
use App\Controllers\FrontendController;

class Home extends FrontendController{

	public $data = [];

	public function __construct(){
	}

	public function index(){
		$this->data['menu_header'] = get_menu('menu_3', $this->currentLanguage());
		$this->data['slide_banner'] = get_slide('slide-banner');
		$this->data['slide_tour'] = get_slide('slide-tour');
		$this->data['slide_company'] = get_slide('slide-company');

		$panel = get_panel('home', $this->currentLanguage());
		foreach ($panel as $key => $value) {
			$this->data['panel'][$value['keyword']] = $value;
		}
		// prE($this->data['slide_company']);

		$this->data['template'] = 'frontend/homepage/home/index';
		return view('frontend/homepage/layout/home', $this->data);
	}
}
