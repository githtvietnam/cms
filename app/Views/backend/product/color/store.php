<?php  
    helper('form');
    $baseController = new App\Controllers\BaseController();
    $languageTitle = [];
	if (isset($language) && is_array($language) && count($language)){
		foreach ($language as $key => $value) {
			$languageTitle[$key] = $value['title'];
		}
	}



?>
<form method="post" action="" >
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="box-body">
				<?php echo  (!empty($validate) && isset($validate)) ? '<div class="alert alert-danger">'.$validate.'</div>'  : '' ?>
			</div><!-- /.box-body -->
		</div>
		<div class="row">
			<div class="col-lg-8 clearfix">
				<div class="ibox mb20">
					<div class="ibox-title" style="padding: 9px 15px 0px;">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<h5>Thông tin cơ bản <small class="text-danger">Điền đầy đủ các thông tin được mô tả dưới đây</small></h5>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-lg-4">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Tên màu<b class="text-danger">(*)</b></span>
									</label>
									
									<?php  echo form_input('title', validate_input(set_value('title', (isset($updateColor['title'])) ? $updateColor['title'] : '')), 'class="form-control title" placeholder="" id="title" autocomplete="off"'); ?>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Mã màu<b class="text-danger">(*)</b></span>
									</label>
									<?php echo form_input('code', validate_input(set_value('code', (isset($updateColor['code'])) ? $updateColor['code'] : '')), 'class="form-control code" placeholder="" id="code" autocomplete="off"'); ?>
								</div>
							</div>
							
						</div>
					</div>
				</div>
				
				<button type="submit" name="create" value="create" id="btn-submit-slide" class=" btn btn-primary block m-b pull-right">Lưu</button>
			</div>
			<div class="col-lg-4">
				<div class="ibox mb20">
					<div class="ibox-title">
						<h5>Hiển thị </h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-row">
									<div class="text-warning mb15">Quản lý thiết lập hiển thị cho nhóm slide này.</div>
									<div class="block clearfix">
										<div class="i-checks mr30" style="width:100%;">
											<span style="color:#000;" class="uk-flex uk-flex-middle"> 
												<?php echo form_radio('publish', set_value('publish', 1), ((isset($_POST['publish']) && $_POST['publish'] == 1 || (isset($article['publish']) && $article['publish'] == 1)) ? true : (!isset($_POST['publish'])) ? true : false),'class=""  id="publish"  style="margin-top:0;margin-right:10px;" '); ?>
												<label for="publish" style="margin:0;cursor:pointer;">Cho phép hiển thị trên website</label>
											</span>
										</div>
									</div>
									<div class="block clearfix">
										<div class="i-checks" style="width:100%;">
											<span style="color:#000;" class="uk-flex uk-flex-middle"> 
												<?php echo form_radio('publish', set_value('publish', 0), ((isset($_POST['publish']) && $_POST['publish'] == 0 || (isset($article['publish']) && $article['publish'] == 0)) ? true : false),'class=""   id="no-publish" style="margin-top:0;margin-right:10px;" '); ?>
												<label for="no-publish" style="margin:0;cursor:pointer;">Không Cho phép hiển thị trên website</label>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

