<?php  
    helper('form');
    helper('nestedset');
    $baseController = new App\Controllers\BaseController();
    $language = $baseController->currentLanguage();
    $AutoloadModel = new App\Models\AutoloadModel();
    $languageList = get_full_language(['currentLanguage' => $language]);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <div class="uk-flex uk-flex-middle uk-flex-space-between">
            <div>
                <h2>Quản lý thêm mới Giao diện</h2>
                <ol class="breadcrumb mb20">
                    <li>
                        <a href="">Home</a>
                    </li>
                    <li class="active"><strong>Quản lý thêm mới Giao diện</strong></li>
                </ol>
                <div class="uk-flex uk-flex-middle" >
                    <?php if(isset($languageList) && is_array($languageList) && count($languageList)){ ?>
                        <?php foreach($languageList as $key => $val){ ?>
                            <a href="<?php echo base_url('backend/panel/panel/create/'.$val['canonical'].'') ?>" class="mr10" title="<?php echo $val['canonical'] ?>">
                                <span class="icon-flag img-cover"><img src="<?php echo getthumb($val['image']); ?>" alt=""></span>
                            </a>
                    <?php }} ?>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" action="" class="form-horizontal box">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="box-body">
        </div><!-- /.box-body -->
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="panel-head">
                    <h2 class="panel-title">Vị trí hiển thị của layout</h2>
                    <div class="panel-description">
                        <p>+ Website có các vị trí hiển thị riêng biệt cho từng layout</p>
                        <p>+ Lựa chọn vị trí mà bạn muốn layout dưới đây hiển thị</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox-content uk-clearfix">
                    <div class="row mb15">
                        <div class="col-lg-6">
                            <div class="form-row">
                                <label class="control-label text-left">
                                    <span>Tiêu đề <b class="text-danger">(*)</b></span>
                                </label>
                                <?php echo form_input('title', validate_input(set_value('title', (isset($Website_panel['title'])) ? $Website_panel['title'] : '')), 'class="form-control title" placeholder="" id="title" autocomplete="off"'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-row">
                                <label class="control-label text-left">
                                    <span>Từ khóa <b class="text-danger">(*)</b></span>
                                </label>
                                <?php echo form_input('keyword', validate_input(set_value('keyword', (isset($Website_panel['keyword'])) ? $Website_panel['keyword'] : '')), 'class="form-control keyword" placeholder="" id="keyword" autocomplete="off"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb15">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <label class="control-label text-left">
                                    <span>Chọn vị trí panel <b class="text-danger">(*)</b></span>
                                </label>
                                <?php 
                                    $locate = [
                                        0 => '-- Chọn vị trí Panel --',
                                        'home' => 'Trang chủ',
                                        'sidebar' => 'Sidebar',
                                        'footer' => 'Footer'
                                    ];  
                                ?>
                               <?php echo form_dropdown('catalogueid', $locate, set_value('catalogueid', (isset($product['catalogueid'])) ? $product['catalogueid'] : ''), 'data-module= "'.$module.'" class="form-control m-b select2 "');?>
                            </div>   
                        </div>   
                    </div>
                    <div class="row mb15">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <label class="control-label text-left">
                                    <span>Chọn Module </span>
                                </label>
                                <?php 
                                    $dropdown = [
                                        0 => '-- Chọn danh mục sản phẩm --',
                                        'product' => 'Sản phẩm',
                                        'product_catalogue' => 'Danh mục sản phẩm',
                                        'slide' => 'Slide',
                                        'slide_catalogue' => 'Danh mục slide',
                                        'brand' => 'Thương hiệu',
                                        'brand_catalogue' => 'Danh mục Thương hiệu',
                                        'article' => 'Bài viết',
                                        'article_catalogue' => 'Danh mục Bài viết',
                                        'tour' => 'Chuyến du lịch',
                                        'tour_catalogue' => 'Danh mục Chuyến du lịch',
                                    ];  
                                ?>
                               <?php echo form_dropdown('module', $dropdown, set_value('module', (isset($product['module'])) ? $product['module'] : ''), 'data-module= "'.$module.'" class="form-control m-b select2 select2_panel"');?>
                            </div>   
                        </div>   
                    </div>
                    <script>
                        var catalogue = '<?php echo (isset($_POST['catalogue'])) ? json_encode($_POST['catalogue']) : ((isset($product['catalogue']) && $product['catalogue'] != null) ? $product['catalogue'] : '');  ?>'; 
                    </script>
                    <div class="row mb15">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <label class="control-label text-left">
                                    <span>Chọn đối tượng phù hợp</span>
                                </label>
                                <?php echo form_dropdown('catalogue[]', '', NULL, 'class="form-control selectMultiplePanel" multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm..."  style="width: 100%;" data-join="" data-module="" data-select="title"'); ?>
                            </div>   
                        </div>   
                    </div>
                    <div class="pull-right"><button type="submit" class="btn btn-primary block m-b pull-right mt30 ">Lưu thay đổi</button></div>
                </div>
            </div>
        </div>
    </div>
</form>

