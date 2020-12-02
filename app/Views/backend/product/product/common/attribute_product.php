<?php 
	if(isset($version) && is_array($version) && count($version)){
		$list_attribute['catalogue'] = json_decode($version[0]['attribute_catalogue']);
		$list_attribute['value'] = json_decode($version[0]['attribute']);
	}
?>
<div class="ibox mb20 block-version" data-countattribute_catalogue="2">	
	<div class="ibox-title" style="padding-bottom: 15px;">
		<div class="uk-flex uk-flex-middle uk-flex-space-between">
			<h5 class="mb0">Sản phẩm có nhiều phiên bản <span class="text-danger">(Chọn tối đa 3)</span></h5>
			<div class="ibox-tools">
				<button class="btn add_version btn-success  full-width m-b m0" style="<?php echo isset($list_attribute['catalogue']) ? ((count($list_attribute['catalogue']) >= 3) ? 'display: none;' : '') : ''; ?>">Thêm Phiên bản</button>
			</div>
		</div>
	</div>
	<?php 
		$select_catalogue = [];
		$color = [
			'title' => 'Màu sắc',
			'value' => 'color'
		];
		foreach ($attribute_catalogue as $key => $value) {
			$select_catalogue[$key] = [
				'title' => $value['title'],
				'value' => $value['objectid']
			];
		}
		array_unshift($select_catalogue, $color);

		$encode_catalogue = json_encode($select_catalogue);
		// prE($version)
	?>
	
	<script>
		var attribute_cat = '<?php echo $encode_catalogue ?>';
	</script>
	<div class="ibox-content" <?php echo (isset($version) ? '' : 'style="display: none;"') ?>>
		<div class="row block-attribute">
			<div class="col-lg-12">
				<table class="show_attribute table">
					<thead>
						<tr>
							<td></td>
							<td style="width: 200px;">Tên thuộc tính</td>
							<td>Giá trị thuộc tính (Các giá trị cách nhau bởi dấu phẩy)</td>
							<td style="width: 50px;"></td>
						</tr>
					</thead>
					<tbody class="select_attribute">
						<?php 
							if(isset($version) && is_array($version) && count($version)){
								$index = 1;
								foreach ($list_attribute as $key => $value) {
									foreach ($value as $keyChild => $valChild) {
										$list[$keyChild][$key] = $list_attribute[$key][$keyChild];
									}
								}
								
								$catalogue_list = [
									'title' => '-- Chọn thuộc tính --',
									'value' => 'root'
								];
								array_unshift($select_catalogue, $catalogue_list);
								foreach ($select_catalogue as $key => $value) {
									$catList[$value['value']] = $value['title'];
								}

								$dropdown_attr = $list_attribute['catalogue'];
								foreach ($list as $key => $value) {
						 ?>
						<tr class="bg-active">
							<td data-index="<?php echo $index; ?>">
								<input type="checkbox" name="checkbox[]" checked="" value="1" class="checkbox-item">
								<input type="text" name="checkbox_val[]" value="1" class="hidden">
								<div for="" class="label-checkboxitem checked"></div>
							</td>
							<td>
								
								<?php echo form_dropdown('attribute_catalogue[]', $catList, set_value('attribute_catalogue[]', (isset($value['catalogue'])) ? $value['catalogue'] : ''), 'class="form-control select2 trigger-select2"');?>
								
							</td>
							<td>
								
								<div class="form-row">
									<?php if($value['catalogue'] == 'color'){ ?>
										<input name="attribute[<?php echo $index; ?>][]" class="tagsinput form-control" type="text" value="<?php echo $value['value'][0] ?>"/>
									<?php }else{ ?>
										<script>
											var get_data<?php echo $index; ?> = '<?php echo (isset($_POST['attribute[<?php echo $index; ?>]'])) ? json_encode($_POST['attribute[<?php echo $index; ?>]']) : ((isset($value['value']) && $value['value'] != null) ? json_encode($value['value']) : '');  ?>';	
										</script>
										<select name="attribute[<?php echo $index; ?>][]" class="form-control selectAttribute" data-condition="AND catalogueid = <?php echo $value['catalogue'] ?>" multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm..." style="width: 100%;" data-join="attribute_translate" data-catalogueid="<?php echo $value['catalogue'] ?>" data-module="attribute" data-select="title"></select>
									<?php } ?>
								</div>
							<td>
								<a type="button" class="btn btn-default delete-attribute" data-id=""><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<?php $index++;}} ?>
					</tbody>
				</table>
			</div>
			<div class="col-lg-12">
				<div class="uk-flex uk-flex-middle uk-flex-space-between">
					<button type="button" name="add_attribute" id="add_attribute" data-toggle="modal" data-target="#product_add_attribute" class="btn mt20 mb20">Tạo thuộc tính cho sản phẩm</button>
				</div>
			</div>
		</div>

		<table class="table <?php echo isset($version) ? 'show' : '' ?>" style="display: block !important;">
			<thead>
				<tr>
					<th></th>
					<th style="width:150px">Tên thuộc tính</th>
					<th>Giá</th>
					<th>Mã sản phẩm</th>
					<th class="text-center" style="width:100px">Tác vụ</th>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($version) && is_array($version) && count($version)){ 
					foreach ($version as $key => $value) {
					$img = json_decode(validate_input($value['content']['img_version']), TRUE);

				?>
				<tr>
					<td>
						<input type="text" name="attribute1[]" value="<?php echo isset($value['content']['attribute1']) ? $value['content']['attribute1'] : '' ?>" class="hidden">
						<input type="text" name="attribute2[]" value="<?php echo isset($value['content']['attribute2']) ? $value['content']['attribute2'] : '' ?>" class="hidden">
						<input type="text" name="attribute3[]" value="<?php echo isset($value['content']['attribute3']) ? $value['content']['attribute3'] : '' ?>" class="hidden">
						<div class="img_version img-scaledown" style="cursor: pointer;">
							<img src="<?php echo (isset($img)) ? $img[0] : 'public/select-img.png' ?>" class="img_version_select" alt="" data-target="#<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>">
						</div>
						
					</td>
					<td>
						<input type="text" name="title_version[]" readonly="" value="<?php echo isset($value['content']['title_version']) ? $value['content']['title_version'] : '' ?>" class="form-control" autocomplete="off" >
					</td>
					<td>
						<input type="text" name="price_version[]" value="<?php echo isset($value['content']['price_version']) ? $value['content']['price_version'] : '' ?>" class="form-control int" autocomplete="off">
					</td>
					<td>
						<input type="text" name="code_version[]" value="<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>" class="form-control" autocomplete="off">
					</td>
					<td><button type="button" class=" product_edit" data-toggle="modal" data-target="#<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>" >Chỉnh sửa</button></td>
					<!-- ==================================================== Modal ============================================================ -->

					<div class="modal fade" id="<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>">
					  	<div class="modal-dialog" role="document">
						    <div class="modal-content">
						      	<div class="modal-header ">
						      		<div class="uk-flex uk-flex-middle uk-flex-space-between">
							        	<h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa chi tiết phiên bản sản phẩm</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          	<span aria-hidden="true">&times;</span>
								        </button>
						      		</div>
						      	</div>
						      	<div class="modal-body">
						      		<div class="row mb15">
						      			<div class="col-lg-6">
						      				<div class="form-row">
						      					<label class="control-label ">
													<span>BarCode</span>
												</label>
												<input type="text" name="barcode_version[]" value="<?php echo isset($value['content']['barcode_version']) ? $value['content']['barcode_version'] : '' ?>" class="form-control" autocomplete="off">
						      				</div>
						      			</div>
						      			<div class="col-lg-6">
						      				<div class="form-row">
						      					<label class="control-label ">
													<span>Model</span>
												</label>
												<input type="text" name="model_version[]" value="<?php echo isset($value['content']['model_version']) ? $value['content']['model_version'] : '' ?>" class="form-control" autocomplete="off">
						      				</div>
						      			</div>
						      		</div>	
						      		<div class="row">
						      			<div class="col-lg-12">
						      				<div class="form-row">
						      					
												<div class="uk-flex uk-flex-middle uk-flex-space-between">
													<label class="control-label ">
														<span>Album sản phẩm</span>
													</label>
													<div class="uk-flex uk-flex-middle uk-flex-space-between">
														<div class="edit">
															<a onclick="BrowseServerAlbumModal($(this), '<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>');return false;" href="" title="" class="upload-picture">Chọn hình</a>
														</div>
													</div>
												</div>
												
												<div class="click-to-upload" <?php echo (isset($img))?'style="display:none"':'' ?>>
													<div class="icon">
														<a type="button" class="upload-picture" onclick="BrowseServerAlbumModal($(this), '<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>');return false;">
															<svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z"></path></svg>
														</a>
													</div>
													<div class="small-text">Sử dụng nút <b>Chọn hình</b> để thêm hình.</div>
												</div>
												<div class="upload-list" <?php echo (isset($img))?'':'style="display:none"' ?> style="padding:5px;">
													<div class="row">
														<ul class="clearfix sortui sort-modal">
															<?php if(isset($img) && is_array($img) && count($img)){ ?>
															<?php foreach($img as $key => $val){ ?>
																<li class="ui-state-default">
																	<div class="thumb">
																		<span class="image img-scaledown img-model">
																			<img src="<?php echo $val; ?>" alt="" /> 
																		</span>
																		<div class="overlay"></div>
																		<div class="delete-image del_img_modal" data-id="#<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>"><i class="fa fa-trash" aria-hidden="true"></i></div>
																	</div>
																</li>
															<?php }} ?>
														</ul>
														<?php echo form_input('img_version[]', validate_input(set_value('img_version[]', (isset($value['content']['img_version'])) ? $value['content']['img_version'] : '')), 'class="form-control hide_img_version input_img_version" placeholder="Đường dẫn của ảnh"  id="img_version"  autocomplete="off" style="display:none;"');?>
													</div>
												</div>
						      				</div>
						      			</div>
						      		</div>
						      	</div>
					    	</div>
					  	</div>
					</div>
				</tr>

				<?php }} ?>
			</tbody>
		</table>
	</div>
</div>