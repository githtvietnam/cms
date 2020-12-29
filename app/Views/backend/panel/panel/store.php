<?php  
    helper('form');
    helper('mydata');
    $baseController = new App\Controllers\BaseController();
    $language = $baseController->currentLanguage();
    $AutoloadModel = new App\Models\AutoloadModel();
    $languageList = get_full_language(['currentLanguage' => $language]);
?>
<form method="post" action="" class="form-horizontal box">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="box-body">
                <?php echo  (!empty($validate) && isset($validate)) ? '<div class="alert alert-danger">'.$validate.'</div>'  : '' ?>
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
                                <?php echo form_input('title', validate_input(set_value('title', (isset($website_panel['title'])) ? $website_panel['title'] : '')), 'class="form-control title" placeholder="" id="title" autocomplete="off"'); ?>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-row">
                                <label class="control-label text-left">
                                    <span>Từ khóa <b class="text-danger">(*)</b></span>
                                </label>
                                <?php echo form_input('keyword', validate_input(set_value('keyword', (isset($website_panel['keyword'])) ? $website_panel['keyword'] : '')), 'class="form-control keyword" placeholder="" id="keyword" autocomplete="off"'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb15">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <label class="control-label text-left">
                                    <span>Chọn vị trí panel </span>
                                </label>
                               <?php echo form_dropdown('locate', $locate, set_value('locate', (isset($website_panel['locate'])) ? $website_panel['locate'] : ''), 'data-module= "'.$module.'" class="form-control m-b select2 "');?>
                            </div>   
                        </div>   
                    </div>
                    <div class="row mb15">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <label class="control-label text-left">
                                    <span>Chọn Module </span>
                                </label>
                               <?php echo form_dropdown('module', $dropdown, set_value('module', (isset($website_panel['module'])) ? $website_panel['module'] : ''), 'data-module= "'.$module.'" class="form-control m-b select2 select2_panel"');?>
                            </div>   
                        </div>   
                    </div>
                    <script>
                        var catalogue = '<?php echo (isset($_POST['catalogue'])) ? json_encode($_POST['catalogue']) : ((isset($website_panel['catalogue']) && $website_panel['catalogue'] != null) ? $website_panel['catalogue'] : '');  ?>'; 
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