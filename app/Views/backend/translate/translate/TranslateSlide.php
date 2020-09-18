<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-10">
		<h2>Bản Dịch</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo site_url('admin'); ?>">Home</a>
			</li>
			
		</ol>
	</div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
		
	<div class="row">
		<div class="col-lg-6  clearfix">
			<div class="ibox-content">
					<?php
						
						$album = [];
						$album=$valueTranslate;
						
						if(isset($_POST['album'])){
							$album = $_POST['album'];

						}
						$album=$valueTranslate;
						
						// pre($album);
					 ?>
					<div class="row">
						<div class="col-lg-12">
							<div class="upload-list" <?php echo (isset($album['title']))?'':'style="display:none"' ?> style="padding:5px;">
								<div class="row">
									<ul id="sortable" class="clearfix sortui">
										<?php if(isset($album['title']) && is_array($album['title']) && count($album['title'])){  ?>
										<?php foreach($album['title'] as $key => $val){ 
											  
										?>
											<li class="tv-block ui-state-default ">
												<div class="tv-slide-container">
													<div class="col-lg-3">Ảnh <?php echo $key+1 ?></div>
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
																			<input  placeholder="Tiêu đề Slide" type="text"  class="form-control m-b" name="title[]" value="<?php echo isset($album['title'][$key])? $album['title'][$key]: '' ?>">
																		</div>
																		<div class="row ">
																			<?php $description = $album['description'][$key] ?>
																			<textarea  placeholder="Mô tả Slide"  class="form-control m-b"  name="description[]"><?php echo $description  ?></textarea>
																		</div>
																	</div>
																</div>
																<div  class="tab-1 tab-pane">
																	<div class="panel-body">
																		<div class="row mb5">
																			<div class="form-row">
																				<input  placeholder="Tiêu đề SEO" type="text"  class="form-control m-b" name="meta_title[]" value="<?php echo isset($album['meta_title'][$key])? $album['meta_title'][$key]: ''; ?>">

																			</div>
																		</div>
																		<div class="row mb18">
																			<div class="form-row">
																				<?php $meta_description = $album['meta_description'][$key] ?>
																				<textarea  placeholder="Mô tả SEO"  class="form-control m-b"   name="meta_description[]"><?php echo $meta_description?></textarea>
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
		<form method="post" action="" class="form-horizontal box">
			<div class="col-lg-6 clearfix">
				<div class="ibox-content">
						<?php
						$album = [];
						$album1 = [];
						if (isset($valueTranslate))
							{
								$album1=$valueTranslate;

								
								if(isset($_POST['album'])){
									$album1 = $_POST['album'];

								}
								$album1=$valueTranslate;
								
							}
						if (isset($Translated))
							{
								$album=$Translated;
								
								
								if(isset($_POST['album'])){
									$album = $_POST['album'];

								}
								$album=$Translated;
								
							}	
							 
						 ?>
						<div class="row">
							<div class="col-lg-12">
								<div class="upload-list" <?php echo (isset($album1['title']))?'':'style="display:none"' ?> style="padding:5px;">
									<div class="row">
										<ul id="sortable" class="clearfix sortui">
											<?php if(isset($album1['title']) && is_array($album1['title']) && count($album1['title'])){  ?>
											<?php foreach($album1['title'] as $key => $val){ 
												  
											?>
												<li class="tv-block ui-state-default">
													<div class="tv-slide-container">
														<div class="col-lg-3">Bản dịch ảnh <?php echo $key+1 ?></div>
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
																				<input  placeholder="Tiêu đề Slide" type="text"  class="form-control m-b" name="title[]"  value="<?php echo isset($album['title'][$key])? $album['title'][$key]: '' ?>">
																			</div>
																			<div class="row ">
																				<?php $description = $album['description'][$key] ?>
																				<textarea  placeholder="Mô tả Slide"  class="form-control m-b"  name="description[]"><?php echo $description  ?></textarea>
																			</div>
																		</div>
																	</div>
																	<div  class="tab-1 tab-pane">
																		<div class="panel-body">
																			<div class="row mb5">
																				<div class="form-row">
																					<input  placeholder="Tiêu đề SEO" type="text"  class="form-control m-b" name="meta_title[]" value="<?php echo isset($album['meta_title'][$key])? $album['meta_title'][$key]: ''; ?>">

																				</div>
																			</div>
																			<div class="row mb18">
																				<div class="form-row">
																					<?php $meta_description = $album['meta_description'][$key] ?>
																					<textarea  placeholder="Mô tả SEO"  class="form-control m-b"   name="meta_description[]"><?php echo $meta_description ?></textarea>
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

				
				<button type="submit" name="create" value="create" class="btn btn-primary block m-b pull-right">Lưu</button>
			</div>
		</form>

			
	</div>
</div>
