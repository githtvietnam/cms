<?php  
    helper('form');
    $baseController = new App\Controllers\BaseController();
    $language = $baseController->currentLanguage();
    $AutoloadModel = new App\Models\AutoloadModel();
    $languageList = get_full_language(['currentLanguage' => $language]);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cấu hình hệ thống</h2>
        <ol class="breadcrumb mb20">
            <li>
                <a href="http://ipanel.thegioiweb.org/admin.html">Home</a>
            </li>
            <li class="active"><strong>Cấu hình hệ thống</strong></li>
        </ol>
        <div class="uk-flex uk-flex-middle" >
            <?php if(isset($languageList) && is_array($languageList) && count($languageList)){ ?>
                <?php foreach($languageList as $key => $val){ ?>
                    <a href="<?php echo base_url('backend/system/general/translator/'.$val['canonical'].'') ?>" class="mr10" title="<?php echo $val['canonical'] ?>">
                        <span class="icon-flag img-cover"><img src="<?php echo getthumb($val['image']); ?>" alt=""></span>
                    </a>
            <?php }} ?>
        </div>
    </div>
</div>
<form method="post" action="" class="form-horizontal box">
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div id="system-catalogue">
            <?php 
                // pre($systemCatalogueList);
                if(isset($systemList) && is_array($systemList) && count($systemList)){
                    foreach ($systemList as $key => $value) {
                        // pre($key);
                        // pre($value);
            ?>
                <div class="row" id="<?php echo $key ?>">
                    <div class="col-lg-4">
                        <div class="panel-head">
                            <h2 class="panel-title"><?php echo $value['label'] ?></h2>
                            <div class="panel-description mb20">
                                <?php echo $value['description']; ?>                    
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="ibox m0">
                            <div class="ibox-content">
                                <?php 
                                    foreach ($value['value'] as $keyVal => $val) {
                                        if(isset($val['extend'])){
                                            $extend = explode(' ', $val['extend']);
                                        }
                                        $val['content'] = $AutoloadModel->_get_where([
                                            'select' => 'content',
                                            'table' => 'system_translate',
                                            'where' => ['keyword' => $key.'_'.$keyVal,'language' => $language]
                                        ]);
                                        $val['content'] = $val['content']['content'];
                                ?>
                                    <?php 
                                        if($val['type'] == 'text'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $val['label'] ?></span>
                                                            <span style="color: red"><?php echo isset($val['attention']) ? $val['attention'] : '' ?></span>
                                                            <a href="<?php echo isset($val['link']) ? $val['link'] : '' ?>" target="_blank"><?php echo isset($val['title']) ? $val['title'] :'' ?></a>
                                                        </label>
                                                        <?php if(isset($val['extend'])){ ?>
                                                        <span style="color:#9fafba;" class="va-highlight" data-start="0" data-end="<?php echo $extend[2] ?>"><span class="titleCount">0</span>  trên <?php echo $val['extend'] ?> kí tự</span>
                                                        <?php } ?>
                                                    </div>
                                                    <input type="text" name="<?php echo 'config['.$key.'_'.$keyVal.']'; ?>" value="<?php echo (isset($val['content']) ? $val['content'] : '') ?>" class="form-control " autocomplete="off" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        if($val['type'] == 'images'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $val['label'] ?></span>
                                                            <span style="color: red"><?php echo isset($val['attention']) ? $val['attention'] : '' ?></span>
                                                            <a href="<?php echo isset($val['link']) ? $val['link'] : '' ?>" target="_blank"><?php echo isset($val['title']) ? $val['title'] :'' ?></a>
                                                        </label>
                                                    </div>
                                                    <input type="text" name="<?php echo 'config['.$key.'_'.$keyVal.']'; ?>" value="<?php echo (isset($val['content']) ? $val['content'] : '') ?>" class="form-control va-img-click" autocomplete="off" placeholder="" onclick="BrowseServerInput(this)">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        if($val['type'] == 'textarea'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $val['label'] ?></span>
                                                            <span style="color: red"><?php echo isset($val['attention']) ? $val['attention'] : '' ?></span>
                                                            <a href="<?php echo isset($val['link']) ? $val['link'] : '' ?>" target="_blank"><?php echo isset($val['title']) ? $val['title'] :'' ?></a>
                                                        </label>
                                                        <?php if(isset($val['extend'])){ ?>
                                                        <span style="color:#9fafba;" class="va-highlight" data-start="0" data-end="<?php echo $val['extend'] ?>"><span class="titleCount">0</span>  trên <?php echo $val['extend'] ?> kí tự</span>
                                                        <?php } ?>
                                                    </div>
                                                    <textarea name="<?php echo 'config['.$key.'_'.$keyVal.']'; ?>" cols="40" rows="10" value="" class="form-control "  autocomplete="off" style="height:108px;" placeholder="" autocomplete="off"><?php echo (isset($val['content']) ? $val['content'] : '') ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        if($val['type'] == 'files'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $val['label'] ?></span>
                                                            <span style="color: red"><?php echo isset($val['attention']) ? $val['attention'] : '' ?></span>
                                                            <a href="<?php echo isset($val['link']) ? $val['link'] : '' ?>" target="_blank"><?php echo isset($val['title']) ? $val['title'] :'' ?></a>
                                                        </label>
                                                    </div>
                                                    <input type="text" name="<?php echo 'config['.$key.'_'.$keyVal.']'; ?>" value="<?php echo (isset($val['content']) ? $val['content'] : '') ?>" class="form-control" placeholder="" onclick="BrowseServerAlbum(this, 'files')">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        if($val['type'] == 'editor'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $val['label'] ?></span>
                                                            <span style="color: red"><?php echo isset($val['attention']) ? $val['attention'] : '' ?></span>
                                                            <a href="<?php echo isset($val['link']) ? $val['link'] : '' ?>" target="_blank"><?php echo isset($val['title']) ? $val['title'] :'' ?></a>
                                                        </label>
                                                        <?php if(isset($val['extend'])){ ?>
                                                        <span style="color:#9fafba;" class="va-highlight" data-start="0" data-end="<?php echo $val['extend'] ?>"><span class="titleCount">0</span>  trên <?php echo $val['extend'] ?> kí tự</span>
                                                        <?php } ?>
                                                    </div>
                                                    <?php echo form_textarea('config['.$key.'_'.$keyVal.']', (isset($val['content']) ? $val['content'] : ''), 'class="form-control ck-editor" id="'.'config['.$key.'_'.$keyVal.']'.'" placeholder="" autocomplete="off"');?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        if($val['type'] == 'select'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $val['label'] ?></span>
                                                            <span style="color: red"><?php echo isset($val['attention']) ? $val['attention'] : '' ?></span>
                                                            <a href="<?php echo isset($val['link']) ? $val['link'] : '' ?>" target="_blank"><?php echo isset($val['title']) ? $val['title'] :'' ?></a>
                                                        </label>
                                                    </div>
                                                    <select class="form-control" style="width: 100%;" name="<?php echo 'config['.$key.'_'.$keyVal.']'; ?>" id="<?php echo 'config['.$key.'_'.$keyVal.']'; ?>">
                                                        <?php foreach ($val['select'] as $keySelect => $valSelect) { ?>
                                                            <option value="<?php echo $keySelect ?>" <?php echo ($keySelect == $val['content'] ? 'selected' :'') ?>><?php echo $valSelect ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        if($val['type'] == 'select2'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $val['label'] ?></span>
                                                            <span style="color: red"><?php echo isset($val['attention']) ? $val['attention'] : '' ?></span>
                                                            <a href="<?php echo isset($val['link']) ? $val['link'] : '' ?>" target="_blank"><?php echo isset($val['title']) ? $val['title'] :'' ?></a>
                                                        </label>
                                                    </div>
                                                    <select name="<?php echo 'config['.$key.'_'.$keyVal.']'; ?>" class="form-control select2" style="width: 100%;">
                                                        <?php foreach ($val['select'] as $keySelect => $valSelect) { ?>
                                                            <option value="<?php echo $keySelect ?>" <?php echo ($keySelect == $val['content'] ? 'selected' :'') ?>><?php echo $valSelect ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>    

            <?php }} ?>
        </div>
        <div class="clearfix">
            <button type="submit" name="save" value="save" class="btn btn-success block m-b pull-right">Lưu thay đổi</button>
        </div>
    </div>
</form>

<div id="add_data_Modal" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content">  
            <div class="modal-header">  
                <div class="uk-flex uk-flex-space-between uk-flex-middle">
                   <h4 class="modal-title uk-center">Thêm Cấu hình cho Website.</h4>  
                   <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    
                </div>
            </div>  
            <div class="modal-body">  
                <form method="post" id="insert_form">  
                    <div class="va-form-input">
                        
                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                            <label>Chọn nhóm cấu hình</label>  
                            <a href="" title="" data-toggle="modal" id="new_system" data-target="#add_new_system">Tạo nhóm cấu hình mới</a>
                        </div>
                        <select name="select-catalogue" id="select-catalogue" class="form-control select2">
                            <option value="0">-- Chọn nhóm cấu hình --</option>
                            <?php 
                                if(isset($systemCatalogueList) && is_array($systemCatalogueList) && count($systemCatalogueList)){
                                    foreach ($systemCatalogueList as $key => $value) {
                                        $cut_keyword = explode("-", $value['keyword']);
                                        echo '<option value="'.$cut_keyword[1].'">'.$value['title'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <br />  
                        <label class="mt15">Tên cấu hình</label>  
                        <input type="text" name="name_system" autocomplete="off" id="name_system" class="form-control" />  
                        <br />  
                        
                        <div class="uk-grid uk-grid-small uk-grid-width-1-2 uk-clearfix">
                            <div class="va-wrap-grid">
                                <label>Từ khóa</label>  
                                <input type="text" name="keyword" autocomplete="off" id="keyword" class="form-control" />   
                            </div>
                            <div class="va-wrap-grid">
                                <label>Chú ý</label>  
                                <input type="text" name="attention" autocomplete="off" id="attention" class="form-control" />
                            </div>
                        </div>
                        <br />  
                        <div class="uk-grid uk-grid-small uk-grid-width-1-2 uk-clearfix">
                            <div class="va-wrap-grid">
                                <label>Tiêu đề đường dẫn</label>  
                                <input type="text" name="title_link" autocomplete="off" id="title_link" class="form-control" />     
                            </div>
                            <div class="va-wrap-grid">
                                <label>Đường dẫn</label>  
                                <input type="text" name="link_canonical" autocomplete="off" id="link_canonical" class="form-control" /> 
                            </div>
                        </div>
                        <br />  
                        <label>Kiểu dữ liệu</label>  
                        <select name="type_input" id="type_input" class="form-control">  
                            <option value="0">-- Chọn kiểu dữ liệu --</option>  
                            <option value="text">Text</option>  
                            <option value="textarea">Textare</option>  
                            <option value="img">Image</option>  
                            <option value="files">Files</option>  
                            <option value="ckeditor">CK Editor</option>  
                            <option value="select">Select normal</option>  
                            <option value="select2">Select 2</option>  
                        </select>  
                        <div class="va-box"></div>
                    </div>
                    <br/> 
                    <input type="submit" name="insert" id="insert" value="Thêm cấu hình" class="btn btn-primary" />  
                </form>
            </div>
        </div>  
    </div>  
</div> 

<div id="add_new_system" class="modal fade">  
    <div class="modal-dialog">  
        <div class="modal-content">  
            <div class="modal-header">  
                <div class="uk-flex uk-flex-space-between uk-flex-middle">
                   <h4 class="modal-title uk-center">Tạo nhóm cấu hình mới.</h4>  
                   <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    
                </div>
            </div>  
            <div class="modal-body">  
                <form method="post" id="create_new_system"> 
                    <label>Tên nhóm Cấu hình</label>  
                    <input type="text" name="name_system_catalogue" autocomplete="off" id="name_system_catalogue" class="form-control" />  
                    <br />  
                    <label>Từ khóa</label>  
                    <input type="text" name="keyword_system_catalogue" autocomplete="off" id="keyword_system_catalogue" class="form-control" />   
                    <br /> 
                    <label>Mô tả</label>  
                    <textarea name="description_system_catalogue" cols="40" rows="10" class="form-control " id="description_system_catalogue" style="height:108px;" placeholder=""></textarea>  
                    <br />  
                    <input type="submit" name="insert_catalogue" id="insert_catalogue" value="Thêm nhóm Cấu hình" class="btn btn-primary" />  
                </form>
            </div>
        </div>  
    </div>  
</div> 



<div id="add_select" class="modal fade">
    <div class="modal-dialog">  
        <div class="modal-content">  
            <div class="modal-header">  
                <div class="uk-flex uk-flex-space-between uk-flex-middle">
                   <h4 class="modal-title uk-center">Tạo những mục cần lựa chọn.</h4>  
                   <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    
                </div>
            </div>  
            <div class="modal-body">  
                <form method="post" id="create_select"> 
                    <label>Mã thẻ select</label>  
                    <input type="text" name="name_select" autocomplete="off" readonly="" class="form-control name_select" id="name_select"/>  
                    <br /> 
                    <div class="wrap-add-select">
                        <div class="va-none"></div>
                        <div class="va-form-box">
                            <div class="uk-flex uk-flex-middle">
                                <div class="va-width-flex mr10">
                                    <label>Giá trị in ra màn hình</label>  
                                    <input type="text" name="title_item" autocomplete="off" class="title_item form-control" />     
                                </div>
                                <div class="va-width-flex mr10">
                                    <label>Giá trị trong database</label>  
                                    <input type="text" name="value_item" class="form-control value_item"  placeholder="">
                                </div>
                                <div class="va-width-auto">
                                    <a href="" class="va-close-add ">Xóa bỏ</a>
                            </div>
                        </div>
                        <br />              
                    </div>
                    <div class="va-btn-add mb10 mt10">
                        <a href="" class="btn btn-warning va-select-add">Thêm lựa chọn mới</a>
                    </div>
                    <input type="submit" name="insert_select" id="insert_select" value="Lưu" class="btn btn-primary" />  
                </form>
            </div>
        </div>  
    </div>  
</div> 