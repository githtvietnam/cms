<?php 
namespace App\Controllers\Ajax\Frontend;
use App\Controllers\BaseController;

class Dashboard extends BaseController{
	public function __construct(){
		
	}

	public function get_select2(){
		$id = $this->request->getPost('id');
		$end = $this->AutoloadModel->_get_where([
            'select' => 'tb1.id, tb2.title',
            'table' => 'location as tb1',
            'join' => [
                [
                    'location_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = "location" AND tb2.language = \''.$this->currentLanguage().'\'', 'inner'
                ]
            ],
            'where' => [
            	'catalogueid' => $id,
            	'deleted_at' => 0
            ],
            'order_by' => 'tb1.catalogueid asc'
        ],TRUE);
        if(isset($end) && is_array($end) && count($end)){
            $data = convert_array([
                'data' => $end,
                'field' => 'id',
                'value' => 'title',
                'text' => 'điểm đến',
            ]);
        }
        $html = '';
        foreach ($data as $key => $value) {
        	$html = $html.'<option value="'.$key.'">'.$value.'</option>';
        }
		echo json_encode([
			'html' => $html
		]); die();
	}

    public function language(){
        $keyword = $this->request->getPost('keyword');
        setcookie('language', $keyword , time() + 1*24*3600, "/");
        pre($keyword);
    }

    public function contact(){
        $data = $this->request->getPost('data');
        $param = [];
        if(isset($data) && is_array($data)&& count($data)){
            foreach ($data as $key => $value) {
                $param[$value['name']] = $value['value'];
            }
        }

        $store = [
            'phone' => $param['phone'],
            'email' => $param['email'],
            'publish' => 1,
            'deleted_at' => 0,
            'created_at' => $this->currentTime
        ];
        $flag = $this->AutoloadModel->_insert([
            'table' => 'contact',
            'data' => $store
        ]);
        if($flag > 0){
            $storeLanguage = [
                'objectid' => $flag,
                'module' => 'contact',
                'language' => $this->currentLanguage(),
                'fullname' => $param['fullname'],
                'title' => $param['title'],
                'content' => $param['message'],
                'deleted_at' => 0,
                'created_at' => $this->currentTime
            ];
            $insert = $this->AutoloadModel->_insert([
                'table' => 'contact_translate',
                'data' => $storeLanguage
            ]);
            if($insert> 0){
                echo 1;die();
            }
        }
        echo 0;die();
    }
}
