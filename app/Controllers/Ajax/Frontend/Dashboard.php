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

}
