<form method="post" action="" class="form-horizontal box" >
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="box-body">
				<?php echo  (!empty($validate) && isset($validate)) ? '<div class="alert alert-danger">'.$validate.'</div>'  : '' ?>
			</div><!-- /.box-body -->
		</div>
		<div class="row">
			<div class="col-lg-6">
				<div class="ibox m0">
					<div class="ibox-content">
						<div class="row mb15">
							<div class="col-lg-12">
								<div class="tv-title">
									<h3>Thông Tin Chung</h3>
									<div>Một số thông tin chung của nhóm liên hệ</div>
								</div>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Tên NHóm Hiển Thị <b class="text-danger">(*)</b></span>
										</label>
										<input type="text" name="title" value="<?php echo (isset($contact_catalogue['title']) ? $contact_catalogue['title'] : '') ?>" class="form-control title" placeholder="Nhập vào tên nhóm liên hệ..." id="title" autocomplete="off">
									</div>
									
								</div>
								<div class="col-lg-6">
									<div class="form-row">
										<label class="control-label text-left">
											<span>Quản lý thiết lập hiển thị cho blog này.</b></span>
										</label>
										<div class="ct-form-container clearfix">
											<div class="block clearfix">
												<div class="i-checks mr30" style="width:100%;">
													<span style="color:#000;" class="uk-flex uk-flex-middle">
													<?php $publish = (isset($contact_catalogue['publish']) ? "checked" : 'no-publish') ?> 
														<input type="radio" name="publish" value="1" checked="<?php echo $publish ?>" class="" id="publish" style="margin-top:0;margin-right:10px;">
														<label for="publish" style="margin:0;cursor:pointer;">Hiển thị</label>
													</span>
												</div>
											</div>
											<div class="block clearfix">
												<div class="i-checks" style="width:100%;">
													<span style="color:#000;" class="uk-flex uk-flex-middle"> 
														<input type="radio" name="publish" value="0" class="" id="<?php echo $publish ?>" style="margin-top:0;margin-right:10px;">
														
														<label for="no-publish" style="margin:0;cursor:pointer;">Tắt</label>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="toolbox action clearfix">
									<div class="uk-flex uk-flex-middle uk-button pull-right">
										<button class="btn btn-primary btn-sm ct-button" name="create" value="delete" type="submit">Lưu Lại</button>
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