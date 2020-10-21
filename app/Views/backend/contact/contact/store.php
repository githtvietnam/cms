<form action="" method="post">	
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-lg-2"></div>
	        <div class="col-lg-8">
				<div class=" animated fadeInRight">
					<div class="mail-box-header">
						<div class="pull-right tooltip-demo">
										<!-- <a href="http://congdoanbackan.org.vn/contact/backend/contact/create.html" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a> -->
						</div>
						<h2>Thông tin chi tiết yêu cầu của khách</h2>
						<hr>
						<div class="mail-tools tooltip-demo">
							<h3 class="contact-viewdetail-subject">
							<span class="font-normal">Tiêu đề: </span><?php echo $reply['title'] ?>															</h3>
							<h5 class="contact-box-info tv">
								<span class="pull-right font-normal"><?php echo $reply['created_at'] ?></span>
								<p><span class="font-normal">Họ tên: </span><?php echo $reply['fullname'] ?></p>
								<p><span class="font-normal">Email: </span><?php echo $reply['email'] ?></p>
								<p><span class="font-normal">Điện thoại: </span><?php echo $reply['phone'] ?></p>
								
								<p><span class="font-normal">Địa chỉ: </span><?php echo $reply['address'] ?></p>
							</h5>
						</div>
						<hr>
						<div class="mail-box-content">
							<h2>Nội dung thư:</h2>
							<p><?php echo $reply['content'] ?></p>
						</div>
						<hr>
						<div class="rely-custumer">
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<h3>Trả lời:</h3>
								<a href="" title="" data-target="content" class="uploadMultiImage">Upload hình ảnh</a>
							</div>
							<?php echo form_textarea('replycontent', htmlspecialchars_decode(html_entity_decode(set_value('content', (isset($reply['replycontent'])) ? $reply['replycontent'] : ''))), 'class="form-control ck-editor" id="content" placeholder="" autocomplete="off"');?>
						</div>
						<div class="mail-body tooltip-demo">
								<button type="submit" name="create" value="post" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i> Lưu lại</button>
								
							</div>
					</div>

				</div>
			</div>
			<div class="col-lg-2"></div>
		</div>
	</div>
</form>
