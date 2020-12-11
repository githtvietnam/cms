<?php 
namespace App\Controllers\Backend\Homepage;
use App\Controllers\FrontendController;

class Homepage extends FrontendController{
	
	public function __construct(){
	}

	public function index(){
		return view('frontend/homepage/layout/home', $this->data);
	}
}
