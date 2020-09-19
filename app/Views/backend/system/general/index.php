<?php  
    helper('form');
    $baseController = new App\Controllers\BaseController();
    $language = $baseController->currentLanguage();
    $languageList = get_list_language(['currentLanguage' => $language]);
    // pre($languageList);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cấu hình hệ thống</h2>
        <ol class="breadcrumb">
            <li>
                <a href="http://ipanel.thegioiweb.org/admin.html">Home</a>
            </li>
            <li class="active"><strong>Cấu hình hệ thống</strong></li>
        </ol>
    </div>
</div>
<form method="post" action="" class="form-horizontal box">
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div id="system-catalogue">
            <?php 
                // pre($systemCatalogueList);
                if(isset($systemCatalogueList) && is_array($systemCatalogueList) && count($systemCatalogueList)){
                    foreach ($systemCatalogueList as $key => $valCatalogue) {
                        $valCatalogue['description'] = base64_decode($valCatalogue['description']);
            ?>
                <div class="row" id="<?php echo $valCatalogue['keyword'] ?>">
                    <div class="col-lg-4">
                        <div class="panel-head">
                            <h2 class="panel-title"><?php echo $valCatalogue['title'] ?></h2>
                            <div class="panel-description mb20">
                                <?php echo $valCatalogue['description']; ?>                    
                            </div>
                            <div class="va-box-content">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr>

                                        
                                        <th class="text-center" style="width:88px;">Ngôn ngữ</th>
                                        <th class="text-center" style="width:88px;">Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if(isset($languageList) && is_array($languageList) && count($languageList)){
                                     ?>
                                        <tr>
                                            <?php foreach($languageList as $key => $val){ 
                                                ?>
                                                <td class="text-center" style="width: 100px;">
                                                    <span class="icon-flag img-cover"><img src="<?php echo getthumb($val['image']); ?>" alt=""></span>
                                                </td>
                                                <?php if(isset($languageList) && is_array($languageList) && count($languageList)){ ?>
                                                    <td class="text-center "><a class="text-small <?php echo ($valCatalogue[$val['canonical'].'_detect'] > 0 ) ? 'text-success' : 'text-danger' ?> " href="<?php echo base_url('backend/system/general/translator/'.$val['canonical'].'') ?>">
                                                        <?php echo ($valCatalogue[$val['canonical'].'_detect'] > 0 ) ? 'Đã Dịch' : 'Chưa Dịch' ?> 
                                                    </a></td>
                                                <?php } ?>
                                        </tr>
                                    <?php }} ?>
                                    </tbody>
                                </table>
                                <button type="button" name="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-danger mt20">Thêm cấu hình</button>
                            </div>

                        </div>
                    </div>
                    <?php 
                        if(isset($systemList) && is_array($systemList) && count($systemList)){
                            
                    ?>
                    <div class="col-lg-8">
                        <div class="ibox m0">
                            <div class="ibox-content">
                                <?php 
                                    foreach ($systemList as $key => $valList) {
                                        $cut_catalogue = explode("-", $valCatalogue['keyword']);
                                        $keyword = 'config['.$valList['keyword'].']';
                                        // pre($valList['attention']);
                                        if($valList['catalogueid'] == $cut_catalogue[1]){
                                ?>
                                    <?php 
                                        if($valList['type'] == 'text'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $valList['title'] ?></span>
                                                            <span style="color: red"><?php echo isset($valList['attention']) ? $valList['attention'] : '' ?></span>
                                                            <a href="<?php echo $valList['link'] ?>" target="_blank"><?php echo $valList['title_link'] ?></a>
                                                        </label>
                                                        <?php 
                                                            if($valList['end_text'] != 0){
                                                        ?>
                                                        <span style="color:#9fafba;" class="va-highlight" data-start="<?php echo $valList['start_text']; ?>" data-end="<?php echo $valList['end_text'] ?>"><span class="titleCount"><?php echo $valList['start_text'] ?></span>  trên <?php echo $valList['end_text'] ?> kí tự</span>
                                                        <?php } ?>
                                                    </div>
                                                    <input type="text" name="<?php echo $keyword; ?>" value="<?php echo (isset($valList['content']) ? $valList['content'] : '') ?>" class="form-control " autocomplete="off" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        if($valList['type'] == 'img'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $valList['title'] ?></span>
                                                            <span style="color: red"><?php echo isset($valList['attention']) ? $valList['attention'] : '' ?></span>
                                                            <a href="<?php echo $valList['link'] ?>" target="_blank"><?php echo $valList['title_link'] ?></a>
                                                        </label>
                                                    </div>
                                                    <input type="text" name="<?php echo $keyword; ?>" value="<?php echo (isset($valList['content']) ? $valList['content'] : '') ?>" class="form-control img-thumbnail" autocomplete="off" placeholder="" onclick="BrowseServerInput(this)">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        if($valList['type'] == 'textarea'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $valList['title'] ?></span>
                                                            <span style="color: red"><?php echo isset($valList['attention']) ? $valList['attention'] : '' ?></span>
                                                            <a href="<?php echo $valList['link'] ?>" target="_blank"><?php echo $valList['title_link'] ?></a>
                                                        </label>
                                                        <?php 
                                                            if($valList['end_text'] != 0){
                                                        ?>
                                                        <span style="color:#9fafba;" class="va-highlight" data-start="<?php echo $valList['start_text']; ?>" data-end="<?php echo $valList['end_text'] ?>"><span class="titleCount"><?php echo $valList['start_text'] ?></span>  trên <?php echo $valList['end_text'] ?> kí tự</span>
                                                        <?php } ?>
                                                    </div>
                                                    <textarea name="<?php echo $keyword; ?>" cols="40" rows="10" value="<?php echo (isset($valList['content']) ? $valList['content'] : '') ?>" class="form-control "  autocomplete="off" style="height:108px;" placeholder="" autocomplete="off"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        if($valList['type'] == 'files'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $valList['title'] ?></span>
                                                            <span style="color: red"><?php echo isset($valList['attention']) ? $valList['attention'] : '' ?></span>
                                                            <a href="<?php echo $valList['link'] ?>" target="_blank"><?php echo $valList['title_link'] ?></a>
                                                        </label>
                                                    </div>
                                                    <input type="text" name="<?php echo $keyword; ?>" value="<?php echo (isset($valList['content']) ? $valList['content'] : '') ?>" class="form-control" placeholder="" onclick="BrowseServerAlbum(this, 'files')">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        if($valList['type'] == 'ckeditor'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $valList['title'] ?></span>
                                                            <span style="color: red"><?php echo isset($valList['attention']) ? $valList['attention'] : '' ?></span>
                                                            <a href="<?php echo $valList['link'] ?>" target="_blank"><?php echo $valList['title_link'] ?></a>
                                                        </label>
                                                        <?php 
                                                            if($valList['end_text'] != 0){
                                                        ?>
                                                        <span style="color:#9fafba;" class="va-highlight" data-start="<?php echo $valList['start_text']; ?>" data-end="<?php echo $valList['end_text'] ?>"><span class="titleCount"><?php echo $valList['start_text'] ?></span>  trên <?php echo $valList['end_text'] ?> kí tự</span>
                                                        <?php } ?>
                                                    </div>
                                                    <?php echo form_textarea($keyword, (isset($valList['content']) ? $valList['content'] : ''), 'class="form-control ck-editor" id="'.$keyword.'" placeholder="" autocomplete="off"');?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                <?php }} ?>


                                <?php 
                                    // pre($systemSelectList);
                                    foreach ($systemSelectList as $key => $valSelect) {
                                        $cut_catalogue = explode("-", $valCatalogue['keyword']);
                                        $keyword = 'select['.$valSelect['keyword'].']';
                                        $select_title = json_decode($valSelect['select_title']);
                                        $select_value = json_decode($valSelect['select_value']);
                                        $dropdown = [];
                                        if(isset($select_value) && is_array($select_value) && count($select_value)){
                                            foreach ($select_value as $key => $value) {
                                                $dropdown[$value] = $select_title[$key];
                                        }}
                                        // pre($dropdown);
                                        if($valSelect['catalogueid'] == $cut_catalogue[1]){
                                ?>
                                    <?php 
                                        if($valSelect['type'] == 'select'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $valSelect['title'] ?></span>
                                                            <span style="color: red"><?php echo isset($valSelect['attention']) ? $valSelect['attention'] : '' ?></span>
                                                            <a href="<?php echo $valSelect['link'] ?>" target="_blank"><?php echo $valSelect['title_link'] ?></a>
                                                        </label>
                                                        <a href="" name="add" data-toggle="modal" class="va-btn-select" data-select="<?php echo $valSelect['keyword']; ?>" data-target="#add_select">Thêm lựa chọn</a>
                                                    </div>
                                                    <?php echo form_dropdown($keyword, $dropdown, set_value($keyword, (isset($valSelect['user_select'])) ? $valSelect['user_select'] : ''), 'class="form-control m-b select"');?>

                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <?php 
                                        if($valSelect['type'] == 'select2'){
                                    ?>
                                        <div class="row mb15">
                                            <div class="col-lg-12">
                                                <div class="form-row">
                                                    <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                                        <label class="control-label text-left">
                                                            <span><?php echo $valSelect['title'] ?></span>
                                                            <span style="color: red"><?php echo isset($valSelect['attention']) ? $valSelect['attention'] : '' ?></span>
                                                            <a href="<?php echo $valSelect['link'] ?>" target="_blank"><?php echo $valSelect['title_link'] ?></a>
                                                        </label>
                                                        <a href="" name="add" data-toggle="modal" class="va-btn-select" data-select="<?php echo $valSelect['keyword']; ?>" data-target="#add_select">Thêm lựa chọn</a>
                                                    </div>
                                                    <select name="<?php echo $keyword; ?>" class="form-control select2" style="width: 100%;">
                                                        <option value="open" selected="selected">Mở cửa website</option>
                                                        <option value="close">Đóng cửa website</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    
                                <?php }} ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
                <hr>    

            <?php }}else{ ?>
                <button type="button" name="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-danger mt20">Thêm cấu hình</button>
                <?php } ?>
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