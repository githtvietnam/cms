<?php
namespace App\Controllers\Frontend\Homepage;
use App\Controllers\FrontendController;

class Router extends FrontendController{

	public $data = [];

    public function silo($segment_1 = '', $segment_2 = ''){
        $canonical = $segment_1.'/'.$segment_2;
        $this->index($canonical);
    }

    public function list($page = 0){
        $page = (int)$page;
        $router = '\App\Controllers\Frontend\Tour\ListTour::index';
        return view_cell($router, 'page='.$page.'');
    }


	public function index($canonical = '', $page = 1){

        $count = $this->AutoloadModel->_get_where([
            'select' => '*',
            'table' => 'router',
            'where' => ['canonical' => $canonical],
            'count' => TRUE
        ]);

        if($count > 0){
            $router = $this->AutoloadModel->_get_where([
                'select' => '*',
                'table' => 'router',
                'where' => ['canonical' => $canonical],
            ]);

            if(isset($router) && is_array($router) && count($router)){
                return view_cell($router['view'], 'id='.$router['objectid'].', page='.$page.'');
            }

        }else{
            return redirect()->to('notfound');
        }
	}
}
