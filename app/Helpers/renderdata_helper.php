<?php 
use App\Models\AutoloadModel;

if (! function_exists('render_menu_frontend')){
    function render_menu_frontend(array $param = []){
        $html = '';
        if(isset($param) && is_array($param) && count($param)){
            foreach ($param as $key => $val) {
                $class = '';
                $html = $html.'<li>';
                $html = $html.'<a href="'.$val['canonical'].'" title="'.$val['title'].'">'.$val['title'].'</a>';
                if($val['level'] >= 2){
                    $class = 'css_submenu';
                }

                if($val['children'] != []){
                    $html = $html.'<div class="dropdown-menu '.$class.'">';
                        $html = $html.'<ul class="uk-list submenu">';
                            $html = $html.render_menu_frontend($val['children']);
                        $html = $html.'</ul>';
                    $html = $html.'</div>';
                }
            }
        }
        return $html;
    }
}

?>

