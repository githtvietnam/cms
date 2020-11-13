<?php  
    helper('form');
    $baseController = new App\Controllers\BaseController();
    $language = $baseController->currentLanguage();
    $languageList = get_list_language(['currentLanguage' => $language]);
?>
<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-8">
      <h2>Quản Lý Sản phẩm</h2>
      <ol class="breadcrumb" style="margin-bottom:10px;">
         <li>
            <a href="<?php echo base_url('backend/dashboard/dashboard/index') ?>">Home</a>
         </li>
         <li class="active"><strong>Quản lý Sản phẩm</strong></li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Quản lý Sản phẩm </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form action="" method="">
                        <div class="uk-flex uk-flex-middle uk-flex-space-between mb20">
                            <div class="perpage">
                                <div class="uk-flex uk-flex-middle mb10">
                                    <select name="perpage" class="form-control input-sm perpage filter mr10">
                                        <option value="20">20 bản ghi</option>
                                        <option value="30">30 bản ghi</option>
                                        <option value="40">40 bản ghi</option>
                                        <option value="50">50 bản ghi</option>
                                        <option value="60">60 bản ghi</option>
                                        <option value="70">70 bản ghi</option>
                                        <option value="80">80 bản ghi</option>
                                        <option value="90">90 bản ghi</option>
                                        <option value="100">100 bản ghi</option>
                                    </select>
                                    
                                   <div class="uk-search uk-flex uk-flex-middle mr10">
                                        <div class="input-group">
                                            <input type="text" name="keyword" value="<?php echo (isset($_GET['keyword'])) ? $_GET['keyword'] : ''; ?>" placeholder="Nhập Từ khóa bạn muốn tìm kiếm..." class="form-control va-search"> 
                                            <span class="input-group-btn"> 
                                                <button type="submit" name="search" value="search" class="btn btn-primary mb0 btn-sm">Tìm Kiếm
                                            </button> 
                                            </span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="toolbox">
                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    
                                    <div class="uk-button mr10">
                                        <button type="button" name="general_system" id="general_system" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning m0">Thiết lập cấu hình chung</button>
                                    </div>
                                    <div class="uk-button">
                                        <a href="<?php echo base_url('backend/product/product/create') ?>" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Thêm Sản phẩm mới</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th style="width: 35px;">
                                    <input type="checkbox" id="checkbox-all">
                                    <label for="check-all" class="labelCheckAll"></label>
                                </th>
                                <th >Tiêu đề</th>
                                 <?php if(isset($languageList) && is_array($languageList) && count($languageList)){ ?>
                                <?php foreach($languageList as $key => $val){ ?>
                                <th class="text-center" style="width: 100px;">
                                    <span class="icon-flag img-cover"><img src="<?php echo getthumb($val['image']); ?>" alt=""></span>
                                </th>
                                <?php }} ?>
                                <th class="text-center" style="width: 67px;">Vị trí</th>
                                <th style="width:150px;">Người tạo</th>
                                <th style="width:150px;" class="text-center">Ngày tạo</th>
                                <th class="text-center" style="width:88px;">Tình trạng</th>
                                <th class="text-center" style="width:103px;">Thao tác</th>
                            </tr>
                        <script>
                            var _module = '<?php echo $module ?>';
                        </script>
                        <tbody>

                            <?php if(isset($articleList) && is_array($articleList) && count($articleList)){ ?>
                            <?php foreach($articleList as $key => $val){ ?>

                            <?php  
                                $image = getthumb($val['image'], true);
                                $catalogue = json_decode($val['catalogue'], TRUE);
                                $cat_list = [];
                                if(isset($catalogue) && is_array($catalogue) && count($catalogue)){
                                    $cat_list = get_catalogue_object([
                                        'module' => $module,
                                        'catalogue' => $catalogue,
                                    ]);
                                }
                                
                            ?>
                            <?php  
                                $status = ($val['publish'] == 1) ? '<span class="text-success">Active</span>'  : '<span class="text-danger">Deactive</span>';
                            ?>

                            <tr id="post-<?php echo $val['id']; ?>" data-id="<?php echo $val['id']; ?>">
                                <td>
                                    <input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" class="checkbox-item">
                                    <div for="" class="label-checkboxitem"></div>
                                </td>
                                <td> 
                                    <div class="uk-flex uk-flex-middle">
                                        <div class="image mr5">
                                            <span class="image-post img-cover"><img src="<?php echo $image; ?>" alt="<?php echo $val['article_title']; ?>" /></span>
                                        </div>
                                        <div class="main-info">
                                            <div class="title"><a class="maintitle" href="<?php echo site_url('backend/article/article/update/'.$val['id']); ?>" title=""><?php echo $val['article_title']; ?> (<?php echo $val['viewed']; ?>)</a></div>
                                            <div class="catalogue" style="font-size:10px">
                                                <span style="color:#f00000;">Nhóm hiển thị: </span>
                                                <a class="" style="color:#333;" href="<?php echo site_url('backend/article/article/index?catalogueid='.$val['cat_id']); ?>" title=""><?php echo $val['cat_title'] ?></a> 
                                                <?php if(isset($cat_list) && is_array($cat_list) && count($cat_list)){ foreach($cat_list as $keyCat => $valCat){ ?>
                                                    <a class="" style="color:#333;" href="<?php echo site_url('backend/article/article/index?catalogueid='.$valCat['id']); ?>" title=""><?php echo $valCat['title'] ?></a><?php echo ($keyCat + 1 < count($cat_list)) ? ',' : '' ?> 
                                                <?php }} ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <?php if(isset($languageList) && is_array($languageList) && count($languageList)){ ?>
                                <?php foreach($languageList as $keyLanguage => $valLanguage){ ?>
                                <td class="text-center "><a class="text-small <?php echo ($val[$valLanguage['canonical'].'_detect'] > 0 ) ? 'text-success' : 'text-danger' ?> " href="<?php echo base_url('backend/translate/translate/translateObject/'.$val['id'].'/'.$module.'/'.$valLanguage['canonical'].'') ?>">
                                    <?php echo ($val[$valLanguage['canonical'].'_detect'] > 0 ) ? 'Đã Dịch' : 'Chưa Dịch' ?>

                                </a></td>
                                <?php }} ?>
                                <td class="text-center text-primary">
                                    <?php echo form_input('order['.$val['id'].']', $val['order'], 'data-module="'.$module.'" data-id="'.$val['id'].'"  class="form-control sort-order" placeholder="Vị trí" style="width:50px;text-align:right;"');?>

                                </td>
                                <td class="text-primary"><?php echo $val['creator']; ?></td>
                                <td class="text-center text-primary"><?php echo gettime($val['created_at'],'Y-d-m') ?></td>
                                <td class="text-center td-status" data-field="publish" data-module="<?php echo $module; ?>" data-where="id"><?php echo $status; ?></td>
                                <td class="text-center">
                                    <a type="button" href="<?php echo base_url('backend/article/article/update/'.$val['id']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <a type="button" href="<?php echo base_url('backend/article/article/delete/'.$val['id']) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php }}else{ ?>
                                <tr>
                                    <td colspan="100%"><span class="text-danger">Không có dữ liệu phù hợp...</span></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div id="pagination">
                        <?php echo (isset($pagination)) ? $pagination : ''; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(isset($code) && is_array($code) && count($code)){ ?>
<div id="add_data_Modal" class="modal fade va-general">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">
                    <div class="uk-flex uk-flex-space-between uk-flex-middle" >
                        <h4 class="modal-title">Tạo cấu hình chung cho mã Sản phẩm</h4>  
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    </div>  
                </div>  
                <div class="modal-body">  
                    <form method="post" id="insert_general" class="uk-clearfix" data-max-0="<?php echo ((isset($code['num0']) ? $code['num0'] : '')) ?>">  
                        <div class="uk-grid uk-grid-width-large-1-2 uk-clearfix">
                            <div class="va-input-general">
                                <label>Tiền tố</label>  
                                <input type="text" name="suffix" id="suffix" value="<?php echo ((isset($code['suffix']) ? $code['suffix'] : '')) ?>" placeholder="VD: VA-..." class="form-control va-uppercase" />  
                            </div>
                            <div class="va-input-general">
                                <label>Hậu tố</label>  
                                <input type="text" name="prefix" id="prefix" value="<?php echo ((isset($code['prefix']) ? $code['prefix'] : '')) ?>" placeholder="VD: ...-STORE" class="form-control va-uppercase" />  
                            </div>
                        </div>
                        <br>
                        <div class="va-input-general">
                            <label class="mb10">Kết quả</label>  
                            <div class="uk-flex uk-flex-middle">
                                <span class="render_suffix text-danger va-uppercase"><?php echo ((isset($code['suffix']) ? $code['suffix'] : '')) ?></span>
                                <span>-</span>
                                <span class="render_num0 text-danger"></span>
                                <span>-</span>
                                <span class="render_prefix text-danger va-uppercase"><?php echo ((isset($code['prefix']) ? $code['prefix'] : '')) ?></span>
                            </div>
                        </div>
                        <br>
                        <input type="submit" name="insert" id="insert" value="Lưu thay đổi" class="btn btn-success  float-right" />  
                    </form>  
                </div>   
           </div>  
      </div>  
 </div> 
<?php }else{ ?>
<div id="add_data_Modal" class="modal fade va-general">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">
                    <div class="uk-flex uk-flex-space-between uk-flex-middle" >
                        <h4 class="modal-title">Tạo cấu hình chung cho mã Sản phẩm</h4>  
                        <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    </div>  
                </div>  
                <div class="modal-body">  
                    <form method="post" id="insert_general" class="uk-clearfix" data-max-0="5">  
                        <div class="uk-grid uk-grid-width-large-1-2 uk-clearfix">
                            <div class="va-input-general">
                                <label>Tiền tố</label>  
                                <input type="text" name="suffix" id="suffix" placeholder="VD: VA-..." class="form-control" />  
                            </div>
                            <div class="va-input-general">
                                <label>Hậu tố</label>  
                                <input type="text" name="prefix" id="prefix" placeholder="VD: ...-PRODUCT" class="form-control" />  
                            </div>
                        </div>
                        <br>
                        <div class="va-input-general">
                            <label class="mb10">Kết quả</label>  
                            <div class="uk-flex uk-flex-middle">
                                <span class="render_suffix text-danger va-uppercase">VA</span>
                                <span class=" text-danger va-uppercase">-</span>
                                <span class="render_num0 text-danger va-uppercase"></span>
                                <span class=" text-danger va-uppercase">-</span>
                                <span class="render_prefix text-danger va-uppercase">PRODUCT</span>
                            </div>
                        </div>
                        <br>
                        <input type="submit" name="insert" id="insert" value="Lưu thay đổi" class="btn btn-success  float-right" />  
                    </form>  
                </div>   
           </div>  
      </div>  
 </div> 
<?php } ?>