<?php
namespace App\Controllers\Frontend\Contact;
use App\Controllers\FrontendController;

class Contact extends FrontendController{

	public $data = [];

	public function __construct(){
		$this->data = [];
		$this->data['module'] = 'article';
	}

	public function index($id = ''){

		$module_extract = explode("_", $this->data['module']);

        $this->data['meta_title'] = 'Contact us - KIMLIEN TRAVEL';
        $this->data['meta_description'] = 'Liên hệ với chúng tôi, Kim Liên Travel sẽ liên lạc với bạn trong thời gian sớm nhất';
        $this->data['canonical'] = BASE_URL.'contact-us'.HTSUFFIX;
		$this->data['slide_company'] = get_slide([
			'keyword' => 'slide-company',
			'language' => $this->currentLanguage(),
			'output' => 'array',
		]);
		$this->data['general'] = $this->general;
		$this->data['template'] = 'frontend/contact/contact/index';
		return view('frontend/homepage/layout/home', $this->data);
	}
}
