<form method="post" action="" class="form-horizontal box" >
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="box-body">
				<?php echo  (!empty($validate) && isset($validate)) ? '<div class="alert alert-danger">'.$validate.'</div>'  : ''; ?>
			</div>
		</div>
		<script type="text/javascript">
			var k = 0;
		</script>
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
							<div class="col-lg-6">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Tên nhóm Slide<b class="text-danger">(*)</b></span>
									</label>
									
									<?php  echo form_input('title', validate_input(set_value('title', (isset($slide_catalogue['title'])) ? $slide_catalogue['title'] : '')), 'class="form-control title" placeholder="" id="title" autocomplete="off"'); ?>
								</div>
							</div>
						
							<div class="col-lg-6">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Từ khóa<b class="text-danger">(*)</b></span>
									</label>
									<?php echo form_input('keyword', validate_input(set_value('keyword', (isset($slide_catalogue['keyword'])) ? $slide_catalogue['keyword'] : '')), 'class="form-control keyword" placeholder="" id="keyword" autocomplete="off"'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="ibox mb20 data">
					<div class="ibox-title">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<h5>Slide Ảnh </h5>

							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<!-- <form class="js_upload_now" action="" method="post" enctype="multipart/form-data">
									<input data-result="" class="m-r " type="file" name="a" multiple>
									<input type="submit" name="abx" value="Add">
								</form> -->
								<div class="edit">
									<a onclick="BrowseServerAlbum(this);return false;" href="" title="" class="upload-picture tv-button">Thêm ảnh Slide</a>
								</div>
							</div>
						</div>
					</div>
					<div class="ibox-content">
						<?php
							$data = [];
							if(isset($_POST['data'])){
								$data = $_POST['data'];
							}else if(isset($slide_catalogue)){
								$data = json_decode($slide_catalogue['data'], TRUE);
							}

							//pre($data);
						 ?>
						<div class="row">
							<div class="col-lg-12">
								<div class="click-to-upload" <?php echo (isset($slide_catalogue['data']))?'style="display:none"':'' ?>>
									<div class="icon">
										<a type="button" class="upload-picture" onclick="BrowseServerAlbum(this);return false;">
											<svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z"></path></svg>
										</a>
									</div>
									<div class="small-text">Sử dụng nút <b>Chọn hình</b> để thêm hình.</div>
								</div>
								<div class="upload-list" <?php echo (isset($slide_catalogue['data']))?'':'style="display:none"' ?> style="padding:5px;">
									<div class="row"> 
										<ul id="sortable" class="clearfix sortui">
											<?php if(isset($data) && is_array($data) && count($data)){ ?>
											<?php foreach($data as $key => $val){ ?>
												<script type="text/javascript">
													var k = <?php echo $key+1 ?>;
												</script>
												<li class="tv-block ui-state-default">
													<div class="tv-slide-container">
														<div class="col-sm-3">
															<div class="thumb tv">
																<span class="image img-cover">
																	<img src="<?php echo isset($data[$key]['image'])? $data[$key]['image']: '' ?>" alt="" /> 
																	<input type="hidden" value="<?php echo isset($data[$key]['image'])? $data[$key]['image']: '' ?>" name="data[<?php echo $key ?>][image]" />
																</span>
																<div class="overlay"></div>
																<div class="delete-image"><i class="fa fa-trash" aria-hidden="true"></i></div>
																<div class="tv order"><input  value="<?php echo isset($data[$key]['order'])? $data[$key]['order']: 0 ?>" type="text"  class=" tv-input" name="data[<?php echo $key ?>][order]"></div>
															</div>
														</div>
														<div class="col-lg-9">
															<div class="tabs-container tv">
																<ul class="nav nav-tabs tv-nav-tabs">
																	<li class=" tab-0 tab-pane active"><a href=".tab-0" aria-expanded="true"> Thông tin chung</a></li>
																	<li class="tab-1 tab-pane"><a href=".tab-1" aria-expanded="false">SEO</a></li>
																</ul>
																<div class="tab-content">
																	<div  class="tab-0 tab-pane active">
																		<div class="panel-body">
																			<div class="row mb5">
																				<input  placeholder="Tên Slide..." type="text"  class="form-control m-b" name="data[<?php echo $key ?>][title]" value="<?php echo isset($data[$key]['title'])? $data[$key]['title']: '' ?>">
																			</div>
																			<div class="row ">
																				<?php  $url= isset($data[$key]['url'])? $data[$key]['url']: '' ?>
																				<textarea  placeholder="URL..."  class="form-control m-b"  name="data[<?php echo $key ?>][url]"><?php echo $url  ?></textarea>
																			</div>
																		</div>
																	</div>
																	<div  class="tab-1 tab-pane">
																		<div class="panel-body">
																			<div class="row mb5">
																				<div class="form-row">
																					<input  placeholder="Mô tả..." type="text"  class="form-control m-b" name="data[<?php echo $key ?>][description]" value="<?php echo isset($data[$key]['description'])? $data[$key]['description']: ''; ?>">

																				</div>
																			</div>
																			<div class="row mb18">
																				<div class="form-row">
																					<?php $content = isset($data[$key]['content'])? $data[$key]['content']: '' ?>
																					<textarea  placeholder="Nội dung..."  class="form-control m-b"   name="data[<?php echo $key ?>][content]"><?php echo $content?></textarea>
																				</div>
																				
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</li>
        
											<?php }}   ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<button type="submit" name="create" value="create" class="btn btn-primary block m-b pull-right">Lưu</button>
				
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


