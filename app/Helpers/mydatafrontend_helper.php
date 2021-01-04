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

if (! function_exists('get_panel')){
    function get_panel( $locate = '', $language = ''){
        $model = new AutoloadModel();
        $object = $model->_get_where([
           'select' => 'keyword, title, locate, module, catalogue',
            'table' => 'website_panel',
            'where' => ['language' => $language,'locate' => $locate, 'deleted_at' => 0 ]
        ],TRUE);

        foreach ($object as $key => $value) {
            $module_explode = explode("_", $value['module']);
            $select  = '';
            if($module_explode[0] == 'tour' || $module_explode[0] == 'product'){
                $select = 'tb1.price, tb1.price_promotion,';
            }
            if(isset($module_explode[1]) && $module_explode[1] != ''){
                $value['catalogue'] = json_decode($value['catalogue']);
                $data = $model->_get_where([
                    'select' => 'tb1.id, tb1.image, tb1.catalogueid, tb1.album,'.$select.'  tb2.title, tb2.meta_description, tb2.canonical',
                    'table' => $module_explode[0].' as tb1',
                    'join' => [
                        [
                            $module_explode[0].'_translate as tb2','tb1.id = tb2.objectid AND tb2.language = \''.$language.'\' AND tb2.module = \''.$module_explode[0].'\'','inner'
                        ]
                    ],
                    'where' => ['tb1.deleted_at' => 0],
                    'where_in_field' => 'tb1.catalogueid',
                    'where_in' => $value['catalogue'],
                ],TRuE);
                foreach ($data as $keyData => $valData) {
                    $data[$keyData]['canonical'] = fix_canonical(slug($valData['canonical']));
                    $data[$keyData]['album'] = json_decode($valData['album']);
                    if(isset($data[$keyData]['image']) && $data[$keyData]['image'] != ''){
                        $data[$keyData]['avatar'] = $data[$keyData]['image'];
                    }else{
                        $data[$keyData]['avatar'] = $data[$keyData]['album'][0];
                    }
                }
                $object[$key]['data'] = $data;
            }else if($value['module'] == '0'){
                $object[$key]['data'] = [];
            }else{
                $value['catalogue'] = json_decode($value['catalogue']);
                $data = $model->_get_where([
                    'select' => 'tb1.id, tb1.image, tb1.catalogueid, tb1.album,'.$select.'  tb2.title, tb2.meta_description, tb2.canonical',
                    'table' => $module_explode[0].' as tb1',
                    'join' => [
                        [
                            $module_explode[0].'_translate as tb2','tb1.id = tb2.objectid AND tb2.language = \''.$language.'\' AND tb2.module = \''.$module_explode[0].'\'','inner'
                        ]
                    ],
                    'where' => ['tb1.deleted_at' => 0],
                    'where_in_field' => 'tb1.id',
                    'where_in' => $value['catalogue'],
                ],TRuE);
                foreach ($data as $keyData => $valData) {
                    $data[$keyData]['canonical'] = fix_canonical(slug($valData['canonical']));
                    $data[$keyData]['album'] = json_decode($valData['album']);
                    if(isset($data[$keyData]['image']) && $data[$keyData]['image'] != ''){
                        $data[$keyData]['avatar'] = $data[$keyData]['image'];
                    }else{
                        $data[$keyData]['avatar'] = $data[$keyData]['album'][0];
                    }
                }
                $object[$key]['data'] = $data;
            }
        }
        
        return $object;
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
    function get_menu($param = []){
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
                    'menu_translate as tb2','tb1.id = tb2.objectid AND tb2.language = \''.$param['language'].'\' ','inner'
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
            if($value['keyword'] == $param['keyword']){
                $select = $value;
            }else{
                $select = [];
            }
        }

        switch ($param['output']){
            case 'html':
                return render_menu_frontend($select['data']);
                break;
            case 'json':
                return json_encode($select);
                break;
            case 'array':
                return $select;
                break;
            default:
                return $select;
                break;
        }
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

