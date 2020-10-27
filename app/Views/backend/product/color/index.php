<?php  
    helper('form');
    $baseController = new App\Controllers\BaseController();
    $language = $baseController->currentLanguage();
    $languageList = get_list_language(['currentLanguage' => $language]);
?>

<div class="row wrapper border-bottom white-bg page-heading">
   <div class="col-lg-8">
      <h2>Quản Màu sắc</h2>
      <ol class="breadcrumb" style="margin-bottom:10px;">
         <li>
            <a href="<?php echo base_url('backend/dashboard/dashboard/index') ?>">Home</a>
         </li>
         <li class="active"><strong>Quản Màu Sắc</strong></li>
      </ol>
   </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Quản lý màu sắc </h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                         <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#" class="delete-all">Xóa tất cả</a>
                            </li>
                        </ul>
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
                                </div>
                            </div>
                            <div class="toolbox">
                                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                                    <div class="uk-search uk-flex uk-flex-middle mr10 ml10">
                                        <div class="input-group">
                                            <input type="text" name="keyword" value="<?php echo (isset($_GET['keyword'])) ? $_GET['keyword'] : ''; ?>" placeholder="Nhập Từ khóa bạn muốn tìm kiếm..." class="form-control"> 
                                            <span class="input-group-btn"> 
                                                <button type="submit" name="search" value="search" class="btn btn-primary mb0 btn-sm">Tìm Kiếm
                                            </button> 
                                            </span>
                                        </div>
                                    </div>
                                    <div class="uk-button">
                                        <a href="#" class="tv-button update btn btn-danger btn-sm"> Cập nhật</a>
                                    </div>
                                    <div class="uk-button">
                                        <a href="<?php echo base_url('backend/product/color/color/create') ?>" class="btn btn-danger btn-sm"><i class="fa fa-plus"></i> Thêm Màu Sắc</a>
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
                                <th  style="width: 35px;">Màu</th>
                                <th >Tên Màu</th>
                                 <?php if(isset($languageList) && is_array($languageList) && count($languageList)){ ?>
                                <?php foreach($languageList as $key => $val){ ?>
                                <th class="text-center" style="width: 200px;">
                                    <span class="icon-flag img-cover"><img src="<?php echo getthumb($val['image']); ?>" alt=""></span>
                                </th>
                                <?php }} ?>
                                <th >Mã màu</th>
                                <th class="text-center" style="width:103px;">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($colorList) && is_array($colorList) && count($colorList)){ ?>
                            <?php foreach($colorList as $key => $val){ ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" name="checkbox[]" value="<?php echo $val['id']; ?>" class="checkbox-item">
                                        <div for="" class="label-checkboxitem"></div>
                                    </td>
                                    <td class="text-center">
                                        <div style="width:15px; height: 15px; background: <?php echo '#'.$val['code']; ?>"></div>
                                    </td>
                                    <td>
                                        <div><?php echo $val['title']; ?></div> 
                                    </td>
                                    <?php if(isset($languageList) && is_array($languageList) && count($languageList)){?>
                                    <?php foreach($languageList as $keyLanguage => $valLanguage){ ?>
                                        <?php if ($valLanguage['canonical'] == 'en') { ?>
                                            <td class="text-right price">
                                                <span style="display: none;"><?php echo $val['en_title']; ?></span>
                                                <input type="text" lang = "<?php echo $valLanguage['canonical'] ?>" name="colorTrans" value="<?php echo isset($val['en_title'])? $val['en_title'] :''; ?>" code = "<?php echo $val['code'] ?>"  class="int form-control colorTrans" style="text-align: right; padding: 6px 3px;">
                                            </td>
                                        <?php } ?>
                                         <?php if ($valLanguage['canonical'] == 'jp'){ ?>
                                            <td class="text-right price">
                                                <span style="display: none;"><?php echo $val['jp_title']; ?></span>
                                                <input type="text" lang = "<?php echo $valLanguage['canonical'] ?>" code = "<?php echo $val['code'] ?>" name="colorTrans" value="<?php echo isset($val['jp_title'])? $val['jp_title'] :''; ?>" data-id="1"  class="int form-control colorTrans" style="text-align: right; padding: 6px 3px;">
                                            </td>
                                        <?php } ?>
                                         <?php if ($valLanguage['canonical'] == 'vi') { ?>
                                            <td class="text-right price">
                                                <span style="display: none;"><?php echo $val['vi_title']; ?></span>
                                                <input type="text" lang = "<?php echo $valLanguage['canonical'] ?>" code = "<?php echo $val['code'] ?>" name="colorTrans" value="<?php echo isset($val['vi_title'])? $val['vi_title'] :''; ?>" data-id="1"  class="int form-control colorTrans" style="text-align: right; padding: 6px 3px;">
                                            </td>
                                        <?php } ?>

                                    <?php }} ?>
                                    <td>
                                        <div><?php echo $val['code']; ?></div> 
                                    </td>
                                    
                            
                                    <td class="text-center">
                                        <a type="button" href="<?php echo base_url('backend/product/color/color/update/'.$val['id']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        <!-- link controller -->
                                       <a type="button" href="<?php echo base_url('backend/product/color/color/delete/'.$val['code']) ?>" code = "<?php echo $val['code']; ?>" class="deleteColor btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php }} ?>
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