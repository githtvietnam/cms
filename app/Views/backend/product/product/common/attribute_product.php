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
								<input type="checkbox" name="checkbox[]" class="checkbox-item">
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
				?>
				<tr>
					<td>
						<input type="text" name="attribute1[]" value="<?php echo isset($value['content']['attribute1']) ? $value['content']['attribute1'] : '' ?>" class="hidden">
						<input type="text" name="attribute2[]" value="<?php echo isset($value['content']['attribute2']) ? $value['content']['attribute2'] : '' ?>" class="hidden">
						<input type="text" name="attribute3[]" value="<?php echo isset($value['content']['attribute3']) ? $value['content']['attribute3'] : '' ?>" class="hidden">
						<div class="img_version img-scaledown" style="cursor: pointer;">
							<img src="public/select-img.png" class="img_version_select" alt="">
						</div>
						<?php echo form_input('img_version[]', htmlspecialchars_decode(html_entity_decode(set_value('image'))), 'class="form-control hide_img_version" placeholder="Đường dẫn của ảnh"  id="img_version"  autocomplete="off" style="display:none;"');?>
					</td>
					<td>
						<input type="text" name="title_version[]" readonly="" value="<?php echo isset($value['content']['title_version']) ? $value['content']['title_version'] : '' ?>" class="form-control" autocomplete="off">
					</td>
					<td>
						<input type="text" name="price_version[]" value="<?php echo isset($value['content']['price_version']) ? $value['content']['price_version'] : '' ?>" class="form-control int" autocomplete="off">
					</td>
					<td>
						<input type="text" name="code_version[]" value="<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>" class="form-control" autocomplete="off">
					</td>
					<td><a href="" class="product_edit">Chỉnh sửa</a></td>
				</tr>
				<?php }} ?>
			</tbody>
		</table>
	</div>
</div>