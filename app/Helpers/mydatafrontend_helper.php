<?php 
use App\Models\AutoloadModel;

if (! function_exists('get_slide')){
	function get_slide($param = []){
		$model = new AutoloadModel();
	 	$object = $model->_get_where([
            'select' => 'id, title, keyword, publish, data,',
            'table' => 'slide_catalogue',
            'where' => [
            	'publish' => 1,
                'keyword' => $param['keyword']
            ],
        ]);
        if(isset($object) &&  is_array($object)  && count($object)){
            $object['data'] = json_decode($object['data'],TRUE);
            switch ($param['output']){
                case 'html':
                    switch ($param['type']){
                        case 'uikit':
                            return render_slideshow_uikit($object['data']);
                    }
                    break;
                case 'json':
                    return json_encode($object);
                    break;
                case 'array':
                    return $object;
                    break;
                default:
                    return $object;
                    break;
            }
        }
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
        if(isset($object) &&  is_array($object)  && count($object)){
            foreach ($object as $key => $value) {
                $data[$value['keyword']] = $value['content'];
            }
        }

        return $data;
    }
}

if (! function_exists('explode_price')){
    function explode_price($price = ''){
        $explode = explode(',', $price);
        $data = [];
        foreach ($explode as $key => $value) {
            $price_explode = explode('-', $value);
            $data[$key]['start'] = $price_explode[0];
            $data[$key]['end'] = $price_explode[1];
            $data[$key]['value'] = $value;
        }
        return $data;
    }
}

if(!function_exists('convertPrice')){
    function convertPrice($price = ''){
        $price = (int)$price;
        $ty = ($price / 1000000000);
        if($ty >= 1){
            return round($ty, 1).' tỷ';
        }
        $tramtrieu = ($price / 100000000);
        if($tramtrieu >= 1){
            return round($tramtrieu).' trăm triệu';
        }
        $chuctrieu = ($price / 10000000);
        if($chuctrieu >= 1){
            return round($tramtrieu).' mươi triệu';
        }
        $trieu = ($price / 1000000);
        if($trieu >= 1){
            return round($trieu).' triệu';
        }
        return $price;
    }
}


if (! function_exists('menu_header')){
    function menu_header($lang = ''){
        $menu_header = get_menu([
            'keyword' => 'header_home',
            'language' => $lang,
            'output' => 'array'
        ]);
        return $menu_header;
    }
}
if (! function_exists('location')){
    function location($lang = '', $keyword = ''){
        $model = new AutoloadModel();
         $flag = $model->_get_where([
            'select' => 'tb1.id, tb2.title, tb2.keyword',
            'table' => 'location_catalogue as tb1',
            'join' => [
                [
                    'location_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = "location_catalogue" AND tb2.language = \''.$lang.'\' AND tb2.attribute = \''.$keyword.'\'', 'inner'
                ]
            ],
            'order_by' => 'tb2.id asc'
        ],TRUE);
        return $flag;
    }
}

if (! function_exists('attribute')){
    function attribute($lang = '', $keyword = ''){
        $model = new AutoloadModel();
        $module = $model->_get_where([
            'select' => 'tb1.id, tb2.title',
            'table' => 'attribute_catalogue as tb1',
            'join' => [
                [
                    'attribute_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = "attribute_catalogue" AND tb2.canonical=\''.$keyword.'\' AND tb2.language = \''.$lang.'\'', 'inner'
                ],
            ],
            'order_by' => 'tb2.id asc'
        ]);
        $flag = $model->_get_where([
            'select' => 'tb1.id, tb2.title',
            'table' => 'attribute as tb1',
            'join' => [
                [
                    'attribute_translate as tb2', 'tb1.id = tb2.objectid AND tb2.module = "attribute" AND tb2.language = \''.$lang.'\'', 'inner'
                ],
            ],
            'where' => [
                'tb1.catalogueid' => $module['id']
            ],
            'order_by' => 'tb2.id asc'
        ],TRUE);
        return $flag;
    }
}


if (! function_exists('slide')){
    function slide($lang = ''){
       $slide_banner = get_slide([
            'keyword' => 'slide-banner',
            'language' => $lang,
            'output' => 'html',
            'type' => 'uikit',
            'limit' => 1
        ]);

        return $slide_banner;
    }
}

if (! function_exists('get_panel')){
    function get_panel( $param = []){
        $model = new AutoloadModel();
        $object = $model->_get_where([
           'select' => 'keyword, title, locate, module, catalogue',
            'table' => 'website_panel',
            'where' => ['language' => $param['language'],'locate' => $param['locate'], 'deleted_at' => 0 ]
        ],TRUE);
        if(isset($object) &&  is_array($object)  && count($object)){
            foreach ($object as $key => $value) {
                $module_explode = explode("_", $value['module']);
                $select  = '';$select_cat='';
                if($module_explode[0] == 'tour' || $module_explode[0] == 'product'){
                    $select = 'tb1.price, tb1.price_promotion';
                    $select_cat = 'tb3.price, tb3.price_promotion';
                }
                if($module_explode[0] == 'tour'){
                    $select = $select . ', tb1.time_end, tb2.start_at, tb2.end_at,';
                }
                if(isset($module_explode[1]) && $module_explode[1] != ''){
                    $value['catalogue'] = json_decode($value['catalogue']);
                    $data = $model->_get_where([
                        'select' => 'tb1.catalogueid, tb3.id, '.$select_cat.', tb2.title, tb2.content, tb2.canonical, tb3.album, tb3.image',
                        'table' => 'object_relationship as tb1',
                        'join' =>[
                            [
                                $module_explode[0].'_translate as tb2','tb2.module = \''.$module_explode[0].'\' AND tb2.objectid = tb1.objectid AND tb2.language = \''.$param['language'].'\'','inner'
                            ],
                            [
                                $module_explode[0].' as tb3', 'tb1.objectid = tb3.id','inner'
                            ]

                        ],
                        'where' => ['tb1.module' => $module_explode[0]],
                        'where_in_field' => 'tb1.catalogueid',
                        'where_in' => $value['catalogue'],
                        'group_by' => 'tb3.id'
                    ],TRuE);
                    if(isset($data) &&  is_array($data)  && count($data)){
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
                }else if($value['module'] == '0'){
                    $object[$key]['data'] = [];
                }else{
                    $value['catalogue'] = json_decode($value['catalogue']);
                    $data = $model->_get_where([
                        'select' => 'tb1.id, tb1.image, tb1.catalogueid, tb1.album,'.$select.'  tb2.title, tb2.meta_description, tb2.canonical',
                        'table' => $module_explode[0].' as tb1',
                        'join' => [
                            [
                                $module_explode[0].'_translate as tb2','tb1.id = tb2.objectid AND tb2.language = \''.$param['language'].'\' AND tb2.module = \''.$module_explode[0].'\'','inner'
                            ]
                        ],
                        'where' => ['tb1.deleted_at' => 0],
                        'where_in_field' => 'tb1.id',
                        'where_in' => $value['catalogue'],
                    ],TRuE);
                    if(isset($data) &&  is_array($data)  && count($data)){
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
        if(isset($object) &&  is_array($object)  && count($object)){
            foreach ($object as $key => $value) {
                $object[$key]['css'] = base64_decode($value['css']);
                $object[$key]['html'] = base64_decode($value['html']);
                $object[$key]['script'] = base64_decode($value['script']);
            }
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
        if(isset($catalogue) && is_array($catalogue)   && count($catalogue)){
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
            if(isset($data) && is_array($data) && count($data)){
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
                $select = [];
                foreach ($data as $key => $value) {
                    if($value['keyword'] == $param['keyword']){
                        $select = $value;
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
        }else{
            return $catalogue;
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

