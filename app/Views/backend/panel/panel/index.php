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
                <h2>Quản lý Giao diện</h2>
                <ol class="breadcrumb mb20">
                    <li>
                        <a href="">Home</a>
                    </li>
                    <li class="active"><strong>Quản lý Giao diện</strong></li>
                </ol>
                <div class="uk-flex uk-flex-middle" >
                    <?php if(isset($languageList) && is_array($languageList) && count($languageList)){ ?>
                        <?php foreach($languageList as $key => $val){ ?>
                            <a href="<?php echo base_url('backend/panel/panel/index/'.$val['canonical'].'') ?>" class="mr10" title="<?php echo $val['canonical'] ?>">
                                <span class="icon-flag img-cover"><img src="<?php echo getthumb($val['image']); ?>" alt=""></span>
                            </a>
                    <?php }} ?>
                </div>
            </div>
            <div class="uk-button">
                <a href="<?php echo base_url('backend/panel/panel/create') ?>" class="btn btn-success "><i class="fa fa-plus"></i> Thêm Giao diện Mới</a>
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
                    <h2 class="panel-title">Danh sách giao diện</h2>
                    <div class="panel-description">
                        <p>+ Danh sách giao diện giúp bạn dễ dàng kiểm soát bố cục trang web của mình. Bạn có thể thêm các khối vào giao diện trong phần thiết lập giao diện</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="ibox-content">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th style="width:80px;" class="text-center">Từ khóa</th>
                                <th>Tiêu đề</th>
                                <th class="text-center">Vị trí</th>
                                <th style="width:100px;" class="text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody id="ajax-content">
                            <tr class="gradeX" id="cat-1">
                                <td class="text-center">1</td>
                                <td><a class="" href="<?php echo base_url('backend/panel/panel/update/'.$val['id']) ?>" title="">Danh mục sản phẩm ( Chỉ chọn 1 danh mục sản phẩm )</a></td>
                                <td class="text-center">Trang chủ</td>
                                <td class="text-center" >
                                    <a type="button" href="<?php echo base_url('backend/panel/panel/update/'.$val['id']) ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <a type="button" href="<?php echo base_url('backend/panel/panel/delete/'.$val['id']) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>

