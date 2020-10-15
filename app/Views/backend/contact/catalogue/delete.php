<?php  
    helper('form');
    $baseController = new App\Controllers\BaseController();
    $language = $baseController->currentLanguage();
  
?>
<script type="text/javascript">
	var id = '<?php echo ($contact_catalogue['id']) ?>';
	var language = '<?php echo( $language) ?>';
</script>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url('admin'); ?>">Home</a>
			</li>
			<li class="active"><strong>Xóa Nhóm Liên Hệ</strong></li>
		</ol>
	</div>
</div>
<form method="post" action="" class="form-horizontal box" >
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-5">
				<div class="panel-head">
					<h2 class="panel-title">Thông tin chung</h2>
				</div>
			
				<div class="ibox m0">
					<div class="ibox-content">
						<div class="row mb15">
							<div class="col-lg-12">
								<div class="form-row">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Xóa Nhóm Liên Hệ:</span>
										</label>
										<input type="text" name="keyword" value="<?php echo (isset($contact_catalogue['title']) ? $contact_catalogue['title'] :'' ) ?>" class="form-control keyword" placeholder="" id="keyword" autocomplete="off">
									</div>
								</div>
							</div>
						</div>
						<div class="toolbox action clearfix">
						<div class="uk-flex uk-flex-middle uk-button pull-right">
							<button class="btn btn-danger btn-sm ct-button2 delete" name="delete" value="delete" type="submit">Xóa Nhóm Liên Hệ</button>
						</div>
					</div>
					</div>

				</div>

			</div>
		</div>
		
	</div>
</form>