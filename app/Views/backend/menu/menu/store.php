<?php  
    helper('form');
    $baseController = new App\Controllers\BaseController();
    $language = $baseController->currentLanguage();
    $AutoloadModel = new App\Models\AutoloadModel();
    $languageList = get_full_language(['currentLanguage' => $language]);
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Thêm mới Menu</h2>
        <ol class="breadcrumb mb20">
            <li>
                <a href="">Home</a>
            </li>
            <li class="active"><strong>Thêm mới Menu</strong></li>
        </ol>
        <div class="uk-flex uk-flex-middle" >
            <?php if(isset($languageList) && is_array($languageList) && count($languageList)){ ?>
                <?php foreach($languageList as $key => $val){ ?>
                    <a href="<?php echo isset($id) ? base_url('backend/menu/menu/create/'.$id.'/'.$val['canonical'].'') : base_url('backend/menu/menu/createmenu/'.$val['canonical'].'') ?>" class="mr10" title="<?php echo $val['canonical'] ?>">
                        <span class="icon-flag img-cover"><img src="<?php echo getthumb($val['image']); ?>" alt=""></span>
                    </a>
            <?php }} ?>
        </div>
    </div>
</div>
<form method="post" action="" class="form-horizontal box pb20">
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="box-body">
                <?php echo  (!empty($validate) && isset($validate)) ? '<div class="alert alert-danger">'.$validate.'</div>'  : '' ?>
            </div><!-- /.box-body -->
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="panel-head">
                    <h2 class="panel-title">Vị trí hiển thị của menu</h2>
                    <div class="panel-description">
                        <p>+ Website có các vị trí hiển thị riêng biệt cho từng menu</p>
                        <p>+ Lựa chọn vị trí mà bạn muốn menu dưới đây hiển thị </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ibox m0" >
                    <div class="ibox-content" >
                        <div class="row mb15" >
                            <div class="col-lg-12" >
                                <div class="form-row" >
                                    <label class="control-label text-left w100">
                                        <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                            <span>Menu Cha <b class="text-danger">(*)</b></span>
                                            <button type="button" name="add_menu" id="add_menu" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Tạo vị trí hiển thị</button>
                                        </div>
                                    </label>
                                    <select name="parentid" class="form-control m-b select2 " aria-hidden="true">
                                        <option value="0">-- Chọn vị trí hiển thị --</option>
                                        <?php if(isset($menuCatalogue) && is_array($menuCatalogue) && count($menuCatalogue)){ ?>
                                            <?php foreach ($menuCatalogue as $key => $value){ ?>
                                            <option value="<?php echo $value['id'] ?>" <?php echo ((isset($_POST['parentid']) || (isset($id) ? ( $value['id'] == $id) : '')) ? 'selected' : '') ?>><?php echo $value['title'] ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox-content va-content" style="">
                    <div class="panel-body va-panel-body">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading va-panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="collapsed va-collapse">Bài viết</a>
                                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in relative" aria-expanded="true" style="">
                                    <div class="panel-body va-panel-body">
                                        <ul class="tabs">
                                            <li class="tab-link current" data-tab="tab-2">Mới nhất</li>
                                            <li class="tab-link" data-tab="tab-3">Tìm kiếm</li>
                                        </ul>
                                        <ul class="tabs-content">
                                            <li id="tab-2" class="tab-content current">
                                                <div class="menu_newest">
                                                    <?php if(isset($articleList) && is_array($articleList) && count($articleList)){ ?>
                                                        <?php foreach ($articleList as $key => $val) { ?>
                                                        <div class="uk-flex mb5 va_select_all">
                                                            <input type="checkbox" data-title="<?php echo $val['title'] ?>" name="check[check_select]" id="<?php echo $val['canonical'] ?>" value="<?php echo $val['canonical'] ?>" > 
                                                            <label for="<?php echo $val['canonical'] ?>" class="ml15 va-checkbox va-label"><?php echo $val['title'] ?></label>
                                                        </div>
                                                    <?php }} ?>
                                                    <div class="uk-flex uk-flex-middle">
                                                        <input type="checkbox" name="newest" id="newest" class="newest" value="all"> 
                                                        <label for="newest" class="ml15">Chọn tất cả</label>
                                                    </div>
                                                    <a href="" class="btn btn-default va-search va_select_checkbox right block m-b" name="add_menu_item">Thêm vào Menu</a>
                                                </div>
                                            </li>
                                            <li id="tab-3" class="tab-content">
                                                <input type="text" placeholder="Nhập để tìm kiếm ..." class="typeahead_2 mb20 search_article form-control">
                                                <div class="va-list-article">
                                                </div>
                                                
                                                <a href="" class="btn btn-default va-search va_select_checkbox right block m-b" name="add_menu_item">Thêm vào Menu</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading va-panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed va-collapse" aria-expanded="false">Liên kết tự tạo</a>
                                    <i class="fa fa-caret-up va-arrow" aria-hidden="true"></i>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body va-panel-body">
                                        <h2 class="panel-title">Tạo menu</h2>
                                        <div class="panel-description">
                                            <p>+ Cài đặt Menu mà bạn muốn hiển thị</p>
                                            <p><small class="text-danger">* Khi khởi tạo menu bạn phải chắc chắn rằng đường dẫn của menu có hoạt động. Đường dẫn trên website được khởi tạo tại các module: Bài viết, Sản phẩm, Dự án, ...</small></p>
                                            <p><small class="text-danger">* Tiêu đề và đường dẫn của menu không được bỏ trống.</small></p>
                                            <p><small class="text-danger">* Hệ Thống chỉ hỗ trợ tối đa 5 cấp menu.</small></p>
                                            <a style="color:#000;border-color:#c4cdd5;display:inline-block !important;" href="" title="" class="btn btn-default add-menu m-b m-r right">Thêm đường dẫn</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading va-panel-heading">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed va-collapse" aria-expanded="false">Chuyên mục</a>
                                    <i class="fa fa-caret-up va-arrow" aria-hidden="true"></i>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                                    <div class="panel-body va-panel-body">
                                        <ul class="tabs-2">
                                            <li class="tab-link current" data-tab="tab_2_1">Dùng nhiều nhất</li>
                                            <li class="tab-link" data-tab="val_3">Tìm kiếm</li>
                                        </ul>
                                        <ul class="tabs-content-2">
                                            <li id="tab_2_1" class="tab-content-2 current">
                                                <div class="menu_all">
                                                    <?php if(isset($articleCatalogueList) && is_array($articleCatalogueList) && count($articleCatalogueList)){ ?>
                                                        <?php foreach ($articleCatalogueList as $key => $val) { ?>
                                                        <div class="uk-flex mb5 va_select_all">
                                                            <input type="checkbox" data-title="<?php echo $val['title'] ?>" name="check[check_select]" id="<?php echo $val['canonical'] ?>" value="<?php echo $val['canonical'] ?>" > 
                                                            <label for="<?php echo $val['canonical'] ?>" class="ml15 va-checkbox va-label"><?php echo $val['title'] ?></label>
                                                        </div>
                                                    <?php }} ?>
                                                     <div class="uk-flex uk-flex-middle">
                                                        <input type="checkbox" name="select_all" id="select_all" class="select_all" value="all"> 
                                                        <label for="select_all" class="ml15">Chọn tất cả</label>
                                                    </div>
                                                    <a href="" class="btn btn-default va-search va_select_checkbox right block m-b" name="add_menu_item">Thêm vào Menu</a>
                                                </div>
                                            </li>
                                            <li id="val_3" class="tab-content-2">
                                                <input type="text" placeholder="Nhập để tìm kiếm ..." class="typeahead_2 mb20 search_article_catalogue form-control">
                                                <div class="va-list-article">
                                                </div>
                                                
                                                <a href="" class="btn btn-default va-search right block m-b va_select_checkbox" name="add_menu_item">Thêm vào Menu</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ibox m0">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label style="margin:0;">Tiêu đề</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label style="margin:0;">Đường dẫn</label>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-row">
                                    <label style="margin:0;">Thứ tự</label>
                                </div>
                            </div>
                        </div>
                        <div class="hr-line-dashed" style="margin:10px 0;"></div>
                        <div class="menu-list">
                            <?php if(isset($menuList) && is_array($menuList) && count($menuList)){ ?>
                                <?php foreach ($menuList as $key => $value) { ?>
                               <div class="row mb15">
                                   <div class="col-lg-4">
                                       <div class="form-row"> 
                                           <input type="text" placeholder="" value="<?php echo $value['title'] ?>" name="menu[title][]" class="form-control" >
                                       </div>
                                   </div>
                                   <div class="col-lg-4">
                                       <div class="form-row">
                                           <input type="text" placeholder="" value="<?php echo $value['canonical'] ?>" name="menu[link][]" class="form-control" >
                                       </div>
                                   </div>
                                   <div class="col-lg-2">
                                       <div class="form-row">
                                           <input type="text" value="<?php echo $value['order'] ?>" style="text-align:right;" name="menu[order][]" class="form-control" >
                                       </div>
                                   </div>
                                   <div class="col-lg-2">
                                       <div class="form-row" style="text-align:right;margin-top:10px;">
                                           <a class="delete-menu image img-scaledown" data-node="0" style="height:12px;"><img src="/public/backend/img/close.png" /></a>
                                       </div>
                                   </div>
                               </div>
                            <?php }}else{ ?>
                                <div class="menu-notification" style="text-align:center;"><h4 style="font-weight:500;font-size:16px;color:#000">Danh sách liên kết này chưa có bất kì đường dẫn nào.</h4><p style="color:#555;margin-top:10px;">Hãy nhấn vào <span style="color:blue;">"Thêm đường dẫn"</span> để băt đầu thêm.</p></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="toolbox action clearfix">
            <div class="uk-flex uk-flex-middle uk-button pull-right">
                <button class="btn btn-primary btn-sm" name="create" value="create" type="submit">Lưu thay đổi</button>
            </div>
        </div>
    </div>
</form>


<div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">
                    <div class="uk-flex uk-flex-space-between uk-flex-middle" >
                       <h4 class="modal-title">Tạo vị trí hiển thị cho Menu</h4>  
                       <button type="button" class="close" data-dismiss="modal">&times;</button>  
                        
                    </div>  
                </div>  
                <div class="modal-body">  
                     <form method="post" id="insert_form">  
                          <label>Tiêu đề Menu</label>  
                          <input type="text" name="title_menu" id="title_menu" class="form-control" />  
                          <br />  
                          <label>Giá trị Menu</label>  
                          <input type="text" name="value_menu" id="value_menu" class="form-control" />  
                          <br />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success " />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div> 