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
            </div>
        </div>
    </div>
</div>
<?php echo view('backend/panel/panel/store') ?>



