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
							<div class="ibox-tools">
								<button type="submit" name="create" value="create" class="btn btn-primary block full-width m-b">Lưu</button>
							</div>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row mb15">
							<div class="col-lg-6">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Tiêu đề thuộc tính <b class="text-danger">(*)</b></span>
									</label>
									<?php echo form_input('title', validate_input(set_value('title', (isset($attribute['title'])) ? $attribute['title'] : '')), 'class="form-control title" placeholder="" id="title" autocomplete="off"'); ?>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Giá trị thuộc tính <b class="text-danger">(*)</b></span>
									</label>
									<?php echo form_input('value', validate_input(set_value('value', (isset($attribute['value'])) ? $attribute['value'] : '')), 'class="form-control value" placeholder="" id="value" autocomplete="off"'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				
				
				
			</div>
			<div class="col-lg-4">
				<div class="ibox mb20">
					<div class="ibox-title">
						<h5>Lựa chọn danh mục cha </h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-row mb10">
									<small class="text-danger">Chọn [Root] Nếu không có danh mục cha</small>
								</div>
								<div class="form-row">
									<?php echo form_dropdown('catalogueid', $dropdown, set_value('catalogueid', (isset($attribute['catalogueid'])) ? $attribute['catalogueid'] : ''), 'class="form-control m-b select2"');?>
								</div>

								<script>
									var catalogue = '<?php echo (isset($_POST['catalogue'])) ? json_encode($_POST['catalogue']) : ((isset($attribute['catalogue']) && $attribute['catalogue'] != null) ? $attribute['catalogue'] : '');  ?>';	
								</script>
								<div class="form-row mt20">
										<label class="control-label text-left">
											<span>Danh mục phụ</span>
										</label>
										
										<div class="form-row">
											<?php echo form_dropdown('catalogue[]', '', NULL, 'class="form-control selectMultiple" multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm..."  style="width: 100%;" data-join="'.$module.'_translate" data-module="'.$module.'_catalogue" data-select="title"'); ?>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>

				
				<div class="ibox mb20">
					<div class="ibox-title">
						<h5>Hiển thị </h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-row">
									<div class="text-warning mb15">Quản lý thiết lập hiển thị cho blog này.</div>
									<div class="block clearfix">
										<div class="i-checks mr30" style="width:100%;">
											<span style="color:#000;" class="uk-flex uk-flex-middle"> 
												<?php echo form_radio('publish', set_value('publish', 1), ((isset($_POST['publish']) && $_POST['publish'] == 1 || (isset($attribute['publish']) && $attribute['publish'] == 1)) ? true : (!isset($_POST['publish'])) ? true : false),'class=""  id="publish"  style="margin-top:0;margin-right:10px;" '); ?>
												<label for="publish" style="margin:0;cursor:pointer;">Cho phép hiển thị trên website</label>
											</span>
										</div>
									</div>
									<div class="block clearfix">
										<div class="i-checks" style="width:100%;">
											<span style="color:#000;" class="uk-flex uk-flex-middle"> 
												<?php echo form_radio('publish', set_value('publish', 0), ((isset($_POST['publish']) && $_POST['publish'] == 0 || (isset($attribute['publish']) && $attribute['publish'] == 0)) ? true : false),'class=""   id="no-publish" style="margin-top:0;margin-right:10px;" '); ?>
												
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

