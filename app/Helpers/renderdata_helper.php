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

if (! function_exists('render_slideshow_uikit')){
    function render_slideshow_uikit(array $param = []){
        $html = '';
        if(isset($param) && is_array($param) && count($param)){
            $html = $html.'<div class="uk-slidenav-position">';
                $html = $html.'<ul class="uk-slideshow" data-uk-slideshow="{autoplay:true}" >';
                    foreach ($param as $key => $value) {
                        $html = $html.'<li><a href="'.$value['url'].'" title="'.$value['title'].'" class="img-cover"><img src="'.$value['image'].'" alt="'.(($value['title'] != '') ? $value['title'] : $value['image']).'"></a></li>';
                    }
                $html = $html.'</ul>';
                $html = $html.'<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>';
                $html = $html.'<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>';
            $html = $html.'</div>';
        }
        return $html;
    }
}


?>

