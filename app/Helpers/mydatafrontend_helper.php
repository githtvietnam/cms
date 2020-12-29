<?php 
use App\Models\AutoloadModel;

if (! function_exists('get_slide')){
	function get_slide( $keyword = ''){
		$model = new AutoloadModel();
	 	$object = $model->_get_where([
            'select' => 'id, title, keyword, publish, data,',
            'table' => 'slide_catalogue',
            'where' => [
            	'publish' => 1,
                'keyword' => $keyword
            ],
        ]);
        $object['data'] = json_decode($object['data'],TRUE);
	 	return $object;
	}
}

if (! function_exists('get_general')){
    function get_general( $keyword = ''){
        $model = new AutoloadModel();
        $object = $model->_get_where([
           'select' => 'keyword, content',
            'table' => 'system_translate',
            'where' => ['language' => 'vi' ]
        ],TRUE);
        $data= [];
        foreach ($object as $key => $value) {
            $data[$value['keyword']] = $value['content'];
        }
        return $data;
    }
}

if (! function_exists('widget_frontend')){
    function widget_frontend(){
        $model = new AutoloadModel();
        $object = $model->_get_where([
            'select' => 'id, html, css, script, title, keyword',
            'table' => 'website_widget',
        ],TRUE);
        foreach ($object as $key => $value) {
            $object[$key]['css'] = base64_decode($value['css']);
            $object[$key]['html'] = base64_decode($value['html']);
            $object[$key]['script'] = base64_decode($value['script']);
        }
        return $object;
    }
}

if (! function_exists('get_menu')){
    function get_menu($keyword = '', $language = ''){
        $model = new AutoloadModel();
        $catalogue = $model->_get_where([
            'select' => ' tb1.id,tb1.value, tb1.title as titleCatalogue',
            'table' => 'menu_catalogue as tb1',
            'where' => [
                'tb1.deleted_at' => 0
            ]
        ],TRUE);

        $menu = $model->_get_where([
            'select' => ' tb1.id, tb1.catalogueid, tb1.parentid, tb1.lft, tb1.rgt, tb1.level, tb1.order, tb2.title,tb2.objectid, tb2.canonical, tb2.catalogueid as dataid',
            'table' => 'menu as tb1',
            'join' => [
                [
                    'menu_translate as tb2','tb1.id = tb2.objectid AND tb2.language = \''.$language.'\' ','inner'
                ]
            ],
            'order_by' => 'order desc'
        ], TRUE);

        $data = [];

        foreach ($catalogue as $key => $value) {
            $data[$value['id']] = ['title' => $value['titleCatalogue'],'keyword' =>  $value['value']];
        }

        foreach ($data as $key => $value) {
            $data[$key]['data'] = [];
            foreach ($menu as $keyMenu => $valMenu) {
                if($valMenu['catalogueid'] == $key){
                    $new = array_push($data[$key]['data'], $valMenu);
                }
            }
        }

        foreach ($data as $key => $value) {
            $data[$key]['data'] = menu_recursive($value['data']);
        }

        foreach ($data as $key => $value) {
            if($value['keyword'] == $keyword){
                $select = $value;
            }else{
                $select = [];
            }
        }

        return $select;
    }
}

if (! function_exists('menu_recursive')){
    function menu_recursive($array = '', $parentid = 0){
        $temp = [];
        if(isset($array) && is_array($array) && count($array)){
            foreach($array as $key => $val){
                if($val['parentid'] == $parentid){
                    $temp[] = $val;
                    if(isset($temp) && is_array($temp) && count($temp)){
                        foreach($temp as $keyTemp => $valTemp){
                            $temp[$keyTemp]['children'] = menu_recursive($array, $valTemp['id']);
                        }
                    }

                }
            }
        }
        return $temp;
    }
}

?>

