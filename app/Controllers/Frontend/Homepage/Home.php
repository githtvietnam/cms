<?php
namespace App\Controllers\Frontend\Homepage;
use App\Controllers\FrontendController;

class Home extends FrontendController{

	public $data = [];

	public function __construct(){
	}

	public function index(){
		$this->data['menu_header'] = get_menu([
			'keyword' => 'menu_3',
			'language' => $this->currentLanguage(),
			'output' => 'array'
		]);
		$this->data['slide_banner'] = get_slide([
			'keyword' => 'slide-banner',
			'language' => $this->currentLanguage(),
			'output' => 'html',
			'type' => 'uikit',
			'limit' => 1
		]);
		$this->data['slide_tour'] = get_slide([
			'keyword' => 'slide-tour',
			'language' => $this->currentLanguage(),
			'output' => 'array',
		]);
		$this->data['slide_company'] = get_slide([
			'keyword' => 'slide-company',
			'language' => $this->currentLanguage(),
			'output' => 'array',
		]);

		$this->data['general'] = get_general();
		$this->data['meta_title'] = $this->data['general']['seo_meta_title'];
		$this->data['meta_description'] = $this->data['general']['seo_meta_description'];
		$this->data['og_type'] = 'website';
		$this->data['canonical'] = BASE_URL;
		$panel = get_panel([
			'locate' => 'home',
			'language' => $this->currentLanguage()
		]);
		foreach ($panel as $key => $value) {
			$this->data['panel'][$value['keyword']] = $value;
		}

		$this->data['template'] = 'frontend/homepage/home/index';
		return view('frontend/homepage/layout/home', $this->data);
	}
}
