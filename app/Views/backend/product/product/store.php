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
							<div class="col-lg-12">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Tiêu đề Sản phẩm <b class="text-danger">(*)</b></span>
									</label>
									<?php echo form_input('title', validate_input(set_value('title', (isset($product['title'])) ? $product['title'] : '')), 'class="form-control title" placeholder="" id="title" autocomplete="off"'); ?>
								</div>
							</div>
							
						</div>
						<div class="row mb15">
							<div class="col-lg-12 mb15">
								<div class="form-row">
									<div class="uk-flex uk-flex-middle uk-flex-space-between">
										<label class="control-label text-left">
											<span>Nội dung</span>
										</label>
										<a href="" title="" data-target="content" class="uploadMultiImage">Upload hình ảnh</a>
									</div>
									<?php echo form_textarea('content', htmlspecialchars_decode(html_entity_decode(set_value('content', (isset($product['content'])) ? $product['content'] : ''))), 'class="form-control ck-editor" id="content" placeholder="" autocomplete="off"');?>
								</div>
							</div>
							<div class="col-lg-12">	
								<div class="uk-flex uk-flex-middle uk-flex-space-between">
									<label class="control-label text-left ">
										<span>Nội dung mở rộng</span>
									</label>
									<a href="" title="" class="add-attr" onclick="return false;">Thêm nội dung +</a>
								</div>
							</div>
						</div>
						<div class="row attr-more">
							<?php if(isset($product['sub_title']) && is_array($product['sub_title']) && count($product['sub_title'])){ ?>
							<?php foreach ($product['sub_title'] as $key => $value) {?>
								<?php $id = slug($value) ?>
								<div class="col-lg-12 m-b desc-more">
									<div class="row m-b">
										<div class="col-lg-8">
											<input type="text" name="sub_content[title][]" class="form-control" value="<?php echo $value ?>" placeholder="Tiêu đề">
										</div>
										<div class="col-lg-4">
											<div class="uk-flex uk-flex-middle uk-flex-space-between">
												<a href="" title="" data-target="<?php echo $id ?>" class="uploadMultiImage">Upload hình ảnh</a>
												<button class="btn btn-danger delete-attr" type="button"><i class="fa fa-trash"></i></button>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12" >
											<textarea name="sub_content[description][]" class="form-control ck-editor" id="<?php echo $id ?>" placeholder="Mô tả"><?php echo $product['sub_content'][$key] ?></textarea>
										</div>
									</div>
								</div>
							<?php }} ?>
						</div>
					</div>
				</div>
				<div class="ibox mb20 album">
					<div class="ibox-title">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<h5>Album Ảnh </h5>
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<div class="edit">
									<a onclick="BrowseServerAlbum(this);return false;" href="" title="" class="upload-picture">Chọn hình</a>
								</div>
							</div>
						</div>
					</div>
					<div class="ibox-content">
						<?php
							if(isset($_POST['album'])){
								$album = $_POST['album'];
							}else if(isset($product)){
								$album = json_decode($product['album'], TRUE);
							}
							
						 ?>
						<div class="row">
							<div class="col-lg-12">
								<div class="click-to-upload" <?php echo (isset($album))?'style="display:none"':'' ?>>
									<div class="icon">
										<a type="button" class="upload-picture" onclick="BrowseServerAlbum(this);return false;">
											<svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z"></path></svg>
										</a>
									</div>
									<div class="small-text">Sử dụng nút <b>Chọn hình</b> để thêm hình.</div>
								</div>
								<div class="upload-list" <?php echo (isset($album))?'':'style="display:none"' ?> style="padding:5px;">
									<div class="row">
										<ul id="sortable" class="clearfix sortui">
											<?php if(isset($album) && is_array($album) && count($album)){ ?>
											<?php foreach($album as $key => $val){ ?>
												<li class="ui-state-default">
													<div class="thumb">
														<span class="image img-scaledown">
															<img src="<?php echo $val; ?>" alt="" /> <input type="hidden" value="<?php echo $val; ?>" name="album[]" />
														</span>
														<div class="overlay"></div>
														<div class="delete-image"><i class="fa fa-trash" aria-hidden="true"></i></div>
													</div>
												</li>
											<?php }} ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="ibox mb20 block-general-product">
					<div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
						<h5>Thông tin Chung</h5>
						<div class="ibox-tools">
							<button type="submit" name="create" value="create" class="btn btn-primary block full-width m-b">Lưu</button>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-row">
									<label class="control-label text-left">
										<span>Giá Sản phẩm <b class="text-danger">(*)</b></span>
									</label>
									<?php echo form_input('price', validate_input(set_value('price', (isset($product['price'])) ? $product['price'] : '')), 'class="form-control price int" placeholder="" id="price" autocomplete="off"'); ?>
								</div>
							</div>
							<div class="col-lg-6 m-b">
								<label class="control-label ">
									<span>Giá khuyến mại</span>
								</label>
								<?php echo form_input('promotion_price', set_value('promotion_price', (isset($product['promotion_price'])) ? $product['promotion_price'] : ''), 'class="form-control price int" placeholder="" id="promotion_price" autocomplete="off"'); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 mb15">
								<label class="control-label ">
									<span>BarCode</span>
								</label>
								<?php echo form_input('bar_code', set_value('bar_code', (isset($product['bar_code'])) ? $product['bar_code'] : ''), 'class="form-control" placeholder="VD:UPC,ISBN" id="bar_code" autocomplete="off"'); ?>
							</div>
							<div class="col-lg-4 mb15">
								<label class="control-label ">
									<span>Model</span>
								</label>
								<?php echo form_input('model', set_value('model', (isset($product['model'])) ? $product['model'] : ''), 'class="form-control" placeholder="UA50NU7400KXXV" id="model" autocomplete="off"'); ?>
							</div>
							<div class="col-lg-4 mb15">
								<label class="control-label ">
									<span>Xuất xứ</span>
								</label>
								<?php echo form_input('made_in', set_value('made_in', (isset($product['made_in'])) ? $product['made_in'] : ''), 'class="form-control" placeholder="Việt Nam" id="made_in" autocomplete="off"'); ?>
							</div>
							<div class="col-lg-6 mb15">
								<label class="control-label">
									<span class="label-title">Mã sản phẩm <b class="text-danger">(*)</b></span>
								</label>
								<script>
									var productid = '<?php echo isset($product['productid']) ? $product['productid'] : $productid ?>'
								</script>
								<?php echo form_input('productid', set_value('productid', (isset($product['productid'])) ? $product['productid'] : $productid), 'class="form-control va-uppercase productid" readonly placeholder="" autocomplete="off"');?>
							</div>
							<div class="col-lg-6 mb15">
								<label class="control-label">
									<span class="label-title"><b class="text-danger">Chỉnh sửa mã sản phẩm</b></span>
								</label>
								<div class="form-checkbox">
									<div>
										<input type="checkbox" id="toogle_readonly" name="toogle_readonly">
	  									<label for="toogle_readonly">Cho phép chỉnh sửa Mã sản phẩm</label>
									</div>
									<div>
	  									<input type="checkbox" id="id_auto" name="id_auto">
	  									<label for="id_auto">Cho phép tự động tạo Mã sản phẩm</label>
									</div>
								</div>
							</div>
							<div class="col-lg-12 mb15">
								<div class="uk-flex-space-between uk-flex-middle uk-flex">
									<label class="control-label ">
										<span>Thương hiệu</span>
									</label>
									<button type="button" name="add_brand" id="add_brand" data-toggle="modal" data-target="#product_add_brand" class="btn">Tạo thương hiệu mới</button>
									
								</div>
								<?php array_unshift($export_brand, "[Root]"); ?>
								<?php echo form_dropdown('brandid', $export_brand, set_value('brandid', (isset($product['brandid'])) ? $product['brandid'] : ''), 'class="form-control m-b brand_select select2"');?>
							</div>
						</div>
					</div>
				</div>
				<div class="ibox ibox-seo mb20">
					<div class="ibox-title">
						<div class="uk-flex uk-flex-middle uk-flex-space-between">
							<h5>Tối ưu SEO <small class="text-danger">Thiết lập các thẻ mô tả giúp khách hàng dễ dàng tìm thấy bạn.</small></h5>
							
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<div class="edit">
									<a href="#" class="edit-seo">Chỉnh sửa SEO</a>
								</div>
							</div>
						</div>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-lg-12">
								<?php  
									$metaTitle = (isset($_POST['meta_title'])) ? $_POST['meta_title'] : ((isset($product['meta_title']) && $product['meta_title'] != '') ? $product['meta_title'] : 'Bạn chưa nhập tiêu đề SEO cho Sản phẩm') ;
									$googleLink = (isset($_POST['canonical'])) ? $_POST['canonical'] : ((isset($product['canonical']) && $product['canonical'] != '') ? BASE_URL.$product['canonical'].HTSUFFIX : BASE_URL.'duong-dan-website'.HTSUFFIX) ;
									$metaDescription = (isset($_POST['meta_description'])) ? $_POST['meta_description'] : ((isset($product['meta_description']) && $product['meta_description'] != '') ? $product['meta_description'] : 'Bạn Chưa nhập mô tả SEO cho Sản phẩm') ;
								?>
								<div class="google">
									<div class="g-title"><?php echo $metaTitle; ?></div>
									<div class="g-link"><?php echo $googleLink ?></div>
									<div class="g-description" id="metaDescription">
										<?php echo $metaDescription; ?>
										
									</div>
								</div>
							</div>
						</div>
						
						<div class="seo-group hidden">
							<hr>
							<div class="row mb15">
								<div class="col-lg-12">
									<div class="form-row">
										<div class="uk-flex uk-flex-middle uk-flex-space-between">
											<label class="control-label ">
												<span>Tiêu đề SEO</span>
											</label>
											<span style="color:#9fafba;"><span id="titleCount">0</span> trên 70 ký tự</span>
										</div>
										<?php echo form_input('meta_title', htmlspecialchars_decode(html_entity_decode(set_value('meta_title', (isset($product['meta_title'])) ? $product['meta_title'] : ''))), 'class="form-control meta-title" placeholder="" autocomplete="off"');?>
									</div>
								</div>
							</div>
							<div class="row mb15">
								<div class="col-lg-12">
									<div class="form-row">
										<div class="uk-flex uk-flex-middle uk-flex-space-between">
											<label class="control-label ">
												<span>Mô tả SEO</span>
											</label>
											<span style="color:#9fafba;"><span id="descriptionCount">0</span> trên 320 ký tự</span>
										</div>
										<?php echo form_textarea('meta_description', set_value('meta_description', (isset($product['meta_description'])) ? $product['meta_description'] : ''), 'class="form-control meta-description" id="seoDescription" placeholder="" autocomplete="off"');?>
									</div>
								</div>
							</div>
							<div class="row mb15">
								<div class="col-lg-12">
									<div class="form-row">
										<div class="uk-flex uk-flex-middle uk-flex-space-between">
											<label class="control-label ">
												<span>Đường dẫn <b class="text-danger">(*)</b></span>
											</label>
										</div>
										<div class="outer">
											<div class="uk-flex uk-flex-middle">
												<div class="base-url"><?php echo base_url(); ?></div>
												<?php echo form_input('canonical', htmlspecialchars_decode(html_entity_decode(set_value('canonical', (isset($product['canonical'])) ? $product['canonical'] : ''))), 'class="form-control canonical" placeholder="" autocomplete="off" data-flag="0" ');?>
												<?php echo form_hidden('original_canonical', htmlspecialchars_decode(html_entity_decode(set_value('canonical', (isset($product['canonical'])) ? $product['canonical'] : ''))), 'class="form-control canonical" placeholder="" autocomplete="off"');?>

											</div>
										</div>
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
						<h5>Lựa chọn danh mục cha </h5>
					</div>
					<div class="ibox-content">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-row mb10">
									<small class="text-danger">Chọn [Root] Nếu không có danh mục cha</small>
								</div>
								<div class="form-row">
									<?php echo form_dropdown('catalogueid', $dropdown, set_value('catalogueid', (isset($product['catalogueid'])) ? $product['catalogueid'] : ''), 'class="form-control m-b select2 get_catalogue"');?>
								</div>
								<script>
									var catalogue = '<?php echo (isset($_POST['catalogue'])) ? json_encode($_POST['catalogue']) : ((isset($product['catalogue']) && $product['catalogue'] != null) ? $product['catalogue'] : '');  ?>';	
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
												<?php echo form_radio('publish', set_value('publish', 1), ((isset($_POST['publish']) && $_POST['publish'] == 1 || (isset($product['publish']) && $product['publish'] == 1)) ? true : (!isset($_POST['publish'])) ? true : false),'class=""  id="publish"  style="margin-top:0;margin-right:10px;" '); ?>
												<label for="publish" style="margin:0;cursor:pointer;">Cho phép hiển thị trên website</label>
											</span>
										</div>
									</div>
									<div class="block clearfix">
										<div class="i-checks" style="width:100%;">
											<span style="color:#000;" class="uk-flex uk-flex-middle"> 
												<?php echo form_radio('publish', set_value('publish', 0), ((isset($_POST['publish']) && $_POST['publish'] == 0 || (isset($product['publish']) && $product['publish'] == 0)) ? true : false),'class=""   id="no-publish" style="margin-top:0;margin-right:10px;" '); ?>
												
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


<div id="product_add_brand" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">
                    <div class="uk-flex uk-flex-space-between uk-flex-middle" >
                       <h4 class="modal-title">Tạo Thương hiệu mới cho Sản phẩm</h4>  
                       <button type="button" class="close" data-dismiss="modal">&times;</button>  
                    </div>  
                </div>  
                <div class="modal-body">  
                    <form method="post" id="insert_form"> 
                    	<div class="uk-flex uk-flex-middle ">
                    		<div class="brand-avatar">
                    			<div class="form-row">
									<div class="avatar" style="cursor: pointer;"><img src="public/not-found.png" class="img-thumbnail" alt=""></div>
									<?php echo form_input('brand_img', htmlspecialchars_decode(html_entity_decode(set_value('image'))), 'class="form-control " placeholder="Đường dẫn của ảnh"  id="brand_img"  autocomplete="off" style="display:none;" ');?>
								</div>
                    		</div>
                    		<div class="brand-content">
                    			<label>Tiêu đề Thương hiệu</label>  
		                        <input type="text" name="brand_title" id="brand_title" class="form-control" />  
		                        <input type="hidden" name="brand_canonical" id="brand_canonical" class="form-control" />  
		                        <br />  
		                        <label>Nhãn hiệu</label>  
		                        <input type="text" name="keyword" id="keyword" class="form-control" />  
		                        <br />  
		                        <input type="submit" name="insert" id="insert" value="Thêm mới" class="btn btn-success " /> 
                    		</div>
                    	</div>
                    </form>  
                </div>  
           </div>  
      </div>  
 </div> 