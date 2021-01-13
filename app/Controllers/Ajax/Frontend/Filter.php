<?php 
namespace App\Controllers\Ajax\Frontend;
use App\Controllers\BaseController;

class Filter extends BaseController{
    public function __construct(){
        
    }
    
    public function render_tour($page = 1){
        helper(['mypagination']);
        $param['cat'] = $this->request->getPost('cat');
        $param['vehicle'] = $this->request->getPost('vehicle');
        $param['time'] = $this->request->getPost('time');
        $param['price'] = $this->request->getPost('price');
        $param['page'] = $this->request->getPost('page');
        $param['url'] = $this->request->getPost('url');
        $param['module'] = $this->request->getPost('module');
        $explode = explode('_', $param['module']);
        $importSQL = $this->create_query($param);
        
        $flag  = $this->AutoloadModel->_get_where([
            'select' => 'tb1.id, tb1.viewed,tb1.tourid, tb1.image,tb1.price, tb1.price_promotion,tb2.number_days, tb2.title, tb2.canonical, tb2.meta_title, tb2.meta_description, tb2.description, tb2.content, tb2.day_start',
            'table' => $explode[0].' as tb1',
            'join' => $importSQL['join'],
            'where' => [
                'tb1.deleted_at' => 0,
                'tb1.publish' => 1,
            ],
            'query' => $importSQL['query'],
            'group_by' => 'tb1.id',
            'order_by' => 'tb1.catalogueid asc'
        ],TRUE);

        
            
        $html = '';
        $page = (int)$param['page'];
        $config['base_url'] = $param['url'];
        $config['base_url'] = str_replace('.html', '', $config['base_url']);
        $config['per_page'] = 1;
        $config['total_rows'] = count($flag);
        if(count($flag) > 0){
            $config = pagination_frontend(['url' => $config['base_url'],'perpage' => $config['per_page']], $config, $page);
            $this->pagination->initialize($config);
            $pagination = $this->pagination->create_links();
            $totalPage = ceil($config['total_rows']/$config['per_page']);
            $page = ($page <= 0)?1:$page;
            $page = ($page > $totalPage)?$totalPage:$page;
            if($page >= 2){
                $canonical = $config['base_url'].'/trang-'.$page.HTSUFFIX;
            }
            $page = $page - 1;
            $flag  = $this->AutoloadModel->_get_where([
                'select' => 'tb1.id, tb1.viewed,tb1.tourid, tb1.image, tb1.album ,tb1.price, tb1.price_promotion,tb2.number_days, tb2.title, tb2.canonical, tb2.meta_title, tb2.meta_description, tb2.description, tb2.content, tb2.day_start',
                'table' => $explode[0].' as tb1',
                'join' => $importSQL['join'],
                'where' => [
                    'tb1.deleted_at' => 0,
                    'tb1.publish' => 1,
                ],
                'query' => $importSQL['query'],
                'limit' => $config['per_page'],
                'start' => $page * $config['per_page'],
                'group_by' => 'tb1.id',
                'order_by' => 'tb1.catalogueid asc'
            ],TRUE);
            if(isset($flag) && is_array($flag) && count($flag)){
                foreach ($flag as $key => $value) {
                    $flag[$key]['description'] = base64_decode($value['description']);
                    $flag[$key]['content'] = base64_decode($value['content']);
                }
            }

            $html = $html.'<ul class="list-tour" >';
                if(isset($flag) && is_array($flag) && count($flag)){
                    foreach ($flag as $key => $value) {
                    $html = $html.'<li class="mb15">';
                        $html = $html.'<article class="uk-flex tour">';
                            $html = $html.'<div class="thumb img-zoomin mr20">';
                                $html = $html.'<a class="image img-cover" href="  '.check_isset($value['canonical']).HTSUFFIX.' " title="  '.check_isset($value['title']).' "><img src="  '.check_isset(json_decode($value['album'])[0]).' " alt="  '.check_isset($value['title']).' "></a>';
                            $html = $html.'</div>';
                            $html = $html.'<div class="infor uk-flex">';
                                $html = $html.'<div class="wrap-content-tour mr50">';
                                    $html = $html.'<h3 class="title mb10"><a href="  '.check_isset($value['canonical']).HTSUFFIX.' " title="  '.check_isset($value['title']).' ">  '.check_isset($value['title']).'  </a></h3>';
                                    $html = $html.'<div class="star">';
                                        $html = $html.'<i class="fa fa-star"></i>';
                                        $html = $html.'<i class="fa fa-star"></i>';
                                        $html = $html.'<i class="fa fa-star"></i>';
                                        $html = $html.'<i class="fa fa-star"></i>';
                                        $html = $html.'<i class="fa fa-star"></i>';
                                    $html = $html.'</div>';
                                    
                                    $html = $html.'<div class="wrap-price isprice">';
                                        $html = $html.'<span class="old">  '.number_format(check_isset($value['price']),0,',','.').'  đ</span>';
                                        $html = $html.'<span class="new">  '.((check_isset($value['price_promotion']) == '') ? number_format(check_isset($value['price']),0,',','.') : number_format(check_isset($value['price_promotion']),0,',','.')).'  đ</span>';
                                    $html = $html.'</div>';
                                $html = $html.'</div>  ';
                                $html = $html.'<div class="order">';
                                    $html = $html.'<ul class="uk-list excerpt mb20">';
                                        $html = $html.'<li>Mã tour:   '.check_isset($value['tourid']).'  </li>';
                                        $html = $html.'<li><i class="fa fa-clock-o"></i> Thời gian :  '.check_isset($value['number_days']).' </li>';
                                        $html = $html.'<li><i class="fa fa-calendar"></i>   '.check_isset($value['day_start']).' </li>';
                                        $html = $html.'<li><i class="fa fa-user"></i> Số chỗ: 20</li>';
                                    $html = $html.'</ul>';
                                    $html = $html.'<div class="viewmore">';
                                        $html = $html.'<a href="  '.check_isset($value['canonical']).HTSUFFIX.' " title="  '.check_isset($value['title']).' ">Chi tiết <i class="fa fa-angle-right"></i></a>';
                                    $html = $html.'</div>';
                               $html = $html.' </div>';
                            $html = $html.'</div>';
                        $html = $html.'</article>';
                    $html = $html.'</li>';
                 }}else{ 
                    $html = $html.'<span class="text-danger mt30">Không có dữ liệu để hiển thị...</span>';
                 } 
            $html = $html.'</ul>';
            $html = $html.'<div id="pagination_ajax" class="va-num-page pagination_ajax">';
            $html = $html.'</div>';
            return json_encode([
                'html' => base64_encode($html),
                'pagination' => (isset($pagination) ? $pagination : '')
            ]);die();
        }
    }
    private function create_query($param = []){
        $find = [];
        $querySQL = '';
        $explode = explode('_', $param['module']);
        if(isset($param['cat']) && is_array($param['cat']) && count($param['cat'])){
            $find['location'] = $this->find_by_location($param);
        }
        if(isset($param['price']) && is_array($param['price']) && count($param['price'])){
            $find['price'] = $this->find_by_price($param);
        }
        if(isset($param['vehicle']) && is_array($param['vehicle']) && count($param['vehicle']) || isset($param['time']) && is_array($param['time']) && count($param['time'])){
            $find['attribute'] = $this->find_by_attribute($param);
        }
        if(isset($find) && is_array($find) && count($find)){
            $count = 1;
            foreach ($find as $key => $value) {
                $querySQL = $querySQL.$value.(($count == count($find) ? '' : ' AND '));
                $count++;
            }
        }
        $join = $this->query_join($find, $explode[0]);

        return [
            'query' => $querySQL,
            'join' => $join
        ];
    }
    private function find_by_location($param = []){
        $explode = explode('_', $param['module']);
        $query = '( ';
        foreach ($param['cat'] as $key => $value) {
            $query = $query.(($key == 0) ? '' : 'OR').' location_relationship.catalogueid = \''.$value.'\' ';
        }
        $query = $query.' )';
        return $query;
    }
    private function find_by_price($param = []){
        $explode = explode('_', $param['module']);
        $query = '( ';
        foreach ($param['price'] as $key => $value) {
            $price_explode = explode('-', $value);
            $query = $query.(($key == 0) ? '' : ' OR ').(($price_explode[0] == 'min') ? '( ' : '( tb1.price >= '.$price_explode[0]).(($price_explode[1] == 'max') ? ' )' : (($price_explode[0] == 'min') ? '' : ' AND ').' tb1.price <= '.$price_explode[1].' )');
        }
        $query = $query.' )';
        return $query;
    }
    private function find_by_attribute($param = []){
        $explode = explode('_', $param['module']);
        $query = '( ';
        if(isset($param['vehicle']) && is_array($param['vehicle']) && count($param['vehicle'])){
            foreach ($param['vehicle'] as $key => $value) {
                $query = $query.(($key == 0) ? '' : 'OR').' attribute_relationship.attributeid = \''.$value.'\' ';
            }
            $query = $query.' ) ';
        }
        if(isset($param['time']) && is_array($param['time']) && count($param['time'])){
            $query = $query.' AND ( ';
            foreach ($param['time'] as $key => $value) {
                $query = $query.(($key == 0) ? '' : 'OR').' attribute_relationship.attributeid = \''.$value.'\' ';
            }
            $query = $query.' ) ';
        }
        return $query;
    }
    private function query_join($param = [], $module = ''){
        $join = [
            [
                $module.'_translate as tb2','tb1.id = tb2.objectid AND tb2.module = \''.$module.'\' AND tb2.language = \''.$this->currentLanguage().'\' ','inner'
            ]
        ];
        $param_join = [];
        if(isset($param) && is_array($param) && count($param)){
            foreach ($param as $key => $value) {
                if($key == 'location'){
                    $param_join = [
                        'location_relationship', 'tb1.id = location_relationship.objectid AND location_relationship.module ="location_catalogue" AND location_relationship.attribute = "end"', 'inner'
                    ];
                    array_push($join,$param_join );
                }
                if($key == 'attribute'){
                    $param_join = [
                        'attribute_relationship', 'tb1.id = attribute_relationship.objectid', 'inner'
                    ];
                    array_push($join,$param_join );
                }
            }
        }
        return $join;
    }
}
