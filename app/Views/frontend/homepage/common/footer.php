<?php
    $baseController = new App\Controllers\FrontendController();
    $language = $baseController->currentLanguage();
    $menu_footer = get_menu([
        'keyword' => 'menu_footer',
        'language' => $language,
        'output' => 'array'
    ]);
?>
<footer class="footer-pc">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-medium uk-clearfix">
            <div class="uk-width-medium-1-1 uk-width-large-2-5">
                <div class="ft-row-panel">
                    <div class="ft-title mb20"><a href="." title="">KIM LIEN TRAVEL</a></div>
                    <div class="ft-information mb30">
                        <p>Người đại diện: <?php  echo (isset($general['contact_representative']) ? $general['contact_representative'] : '') ?></p>
                        <p>Mã số thuế / Giấy phép kinh doanh: 0102683524</p>
                        <p>Giấy phép lữ hành quốc tế: 01-098/2016/TCDL-GP LHQT</p>

                        <p>Địa chỉ trụ sở: <?php  echo (isset($general['contact_address']) ? $general['contact_address'] : '') ?></p>
                        <p>Điện thoại : <?php  echo (isset($general['contact_phone']) ? $general['contact_phone'] : '') ?></p>
                        <p>Email : <?php  echo (isset($general['contact_email']) ? $general['contact_email'] : '') ?></p>
                        <p>Bản quyền KIM LIEN TRAVEL</p>
                    </div>
                    <div id="bocongthuong"><a href="<?php  echo (isset($general['contact_bct']) ? $general['contact_bct'] : '') ?>" title="" class="image img-scaledown"><img src="public/frontend/resources/img/logo/bocongthuong.png" alt=""></a></div>
                </div>
            </div>
            <div class="uk-width-medium-1-1 uk-width-large-3-5">
                <div class="uk-grid uk-grid-small uk-grid-width-medium-1-1 uk-grid-width-large-1-2 uk-clearfix">
                    <div class="ft-grid-row">
                        <div class="uk-grid uk-grid-medium uk-grid-width-1-2 uk-clearfix">
                            <?php if(isset($menu_footer) && is_array($menu_footer) && count($menu_footer)){
                                foreach ($menu_footer['data'] as $key => $value) {
                                ?>
                                <div class="ft-grid-row mb20">
                                    <div class="ft-row-panel">
                                        <div class="ft-menu-title">
                                            <?php  echo (isset($value['title']) ? $value['title'] : '') ?>
                                        </div>
                                        <?php if(isset($value['children']) && is_array($value['children']) && count($value['children'])){
                                            foreach ($value['children'] as $keyChild => $valChild) {
                                            ?>
                                        <ul class="uk-list ft-menu">
                                            <li><a href="<?php echo base_url((isset($valChild['canonical']) ? $valChild['canonical'] : '')) ?>"><?php echo (isset($valChild['title']) ? $valChild['title'] : '') ?></a></li>
                                        </ul>
                                        <?php }} ?>
                                    </div>
                                </div>
                            <?php }} ?>
                        </div>
                    </div>
                    <div class="ft-grid-row">
                        <div class="ft-row-panel">
                            <div class="ft-map mb30">
                                <img src="public/frontend/resources/img/banner/map.png" alt="map">
                            </div>
                            <div class="ft-send-email">
                                <div class="send-email-title">
                                    Đăng ký nhận thông tin
                                </div>
                                <form action="" method="" id="emailForm" class="ft-form">
                                    <div class="form-row import uk-position-relative">
                                        <input type="text" name="" id="email" class="uk-width-1-1 ft-input-text" placeholder="Email của bạn">
                                        <button type="submit" name="" class="btn-submit ft-submit">Gửi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
