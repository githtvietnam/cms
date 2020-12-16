<?php 
	if(isset($version) && is_array($version) && count($version)){
		$list_attribute['catalogue'] = json_decode($version[0]['attribute_catalogue']);
		$list_attribute['value'] = json_decode($version[0]['attribute']);
	}
?>
<script>
	var count_catalogue = '<?php echo ((isset($attribute_catalogue)) ? count($attribute_catalogue) : '') ?>'
</script>
<div class="ibox mb20 block-version" data-countattribute_catalogue="2">	
	<div class="ibox-title" style="padding-bottom: 15px;">
		<div class="uk-flex uk-flex-middle uk-flex-space-between">
			<h5 class="mb0">Sản phẩm có nhiều phiên bản <span class="text-danger">(Chọn tối đa 3)</span></h5>
			<div class="ibox-tools">
				<button class="btn version_setting btn-success full-width m-b m0" style="<?php echo isset($list_attribute['catalogue']) ? ((count($list_attribute['catalogue']) >= 1) ? 'display: none;' : '') : ''; ?>">Thêm phiên bản</button>
			</div>
		</div>
	</div>
	<?php 
		$select_catalogue = [];
		foreach ($attribute_catalogue as $key => $value) {
			$select_catalogue[$key] = [
				'title' => $value['title'],
				'value' => $value['objectid']
			];
		}
		$encode_catalogue = json_encode($select_catalogue);
	?>
	
	<script>
		var attribute_cat = '<?php echo $encode_catalogue ?>';
	</script>
	<div class="ibox-content" <?php echo ((isset($version) && is_array($version) && count($version)) ? '' : 'style="display: none;"') ?>>
		<input type="text" name="checked[]" value="<?php echo isset($version[0]['checked']) ? $version[0]['checked'] : '' ?>" class="hidden checked_value">
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
								$checked = explode(",", $version[0]['checked']);
								$index = 0;
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
						<tr class="<?php echo ((($value['catalogue'] == $checked[0]) || ($value['catalogue'] == $checked[1]) || ($value['catalogue'] == $checked[2])) ? 'bg-active' : '') ?>">
							<td data-index="<?php echo $index; ?>">
								<input type="checkbox" name="checkbox[]" <?php echo ((($value['catalogue'] == $checked[0]) || ($value['catalogue'] == $checked[1]) || ($value['catalogue'] == $checked[2])) ? 'checked=""' : '') ?> value="1" class="checkbox-item">
								<input type="text" name="checkbox_val[]" value="1" class="hidden">
								<div for="" class="label-checkboxitem <?php echo ((($value['catalogue'] == $checked[0]) || ($value['catalogue'] == $checked[1]) || ($value['catalogue'] == $checked[2])) ? 'checked' : '') ?>"></div>
							</td>
							<td>
								<?php echo form_dropdown('attribute_catalogue[]', $catList, set_value('attribute_catalogue[]', (isset($value['catalogue'])) ? $value['catalogue'] : ''), 'class="form-control select2 trigger-select2"');?>
								
							</td>
							<td>
								
								<div class="form-row">
									
									<script>
										var get_data<?php echo $index; ?> = '<?php echo (isset($_POST['attribute[<?php echo $index; ?>]'])) ? json_encode($_POST['attribute[<?php echo $index; ?>]']) : ((isset($value['value']) && $value['value'] != null) ? json_encode($value['value']) : '');  ?>';	
									</script>
									<select name="attribute[<?php echo $index; ?>][]" class="form-control selectAttribute" data-condition="AND catalogueid = <?php echo $value['catalogue'] ?>" multiple="multiple" data-title="Nhập 2 kí tự để tìm kiếm..." style="width: 100%;" data-join="attribute_translate" data-catalogueid="<?php echo $value['catalogue'] ?>" data-module="attribute" data-select="title"></select>
								</div>
							<td>
								<a type="button" class="btn btn-default delete-attribute" ><i class="fa fa-trash"></i></a>
							</td>
						</tr>
						<?php $index++;}} ?>
					</tbody>
				</table>
			</div>

			<div class="col-lg-12">
				<div class="uk-flex uk-flex-middle uk-flex-space-between">
					<div class="ibox-tools">
						<button class="btn add_version  full-width m-b m0" style="<?php echo isset($list_attribute['catalogue']) ? ((count($list_attribute['catalogue']) >= (count($attribute_catalogue)+1) ) ? 'display: none;' : '') : ''; ?>">Thêm Phiên bản</button>
					</div>
					<div class="uk-flex uk-flex-middle uk-flex-space-between">
						<button type="button" name="add_attribute" id="add_attribute" data-toggle="modal" data-target="#product_add_attribute" class="btn mt20 mb20">Tạo thuộc tính cho sản phẩm</button>
					</div>
				</div>
			</div>
		</div>

		<table class="table <?php echo isset($version) ? 'show' : '' ?>" style="display: none">
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
				<tr id="<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>">
					<td>
						<input type="text" name="attribute1[]" value="<?php echo isset($value['content']['attribute1']) ? $value['content']['attribute1'] : '' ?>" class="hidden">
						<input type="text" name="attribute2[]" value="<?php echo isset($value['content']['attribute2']) ? $value['content']['attribute2'] : '' ?>" class="hidden">
						<input type="text" name="attribute3[]" value="<?php echo isset($value['content']['attribute3']) ? $value['content']['attribute3'] : '' ?>" class="hidden">
						<input type="text" name="barcode_version[]"  value="<?php echo isset($value['content']['barcode_version']) ? $value['content']['barcode_version'] : '' ?>" class="hidden barcode_version">
						<input type="text" name="model_version[]" value="<?php echo isset($value['content']['model_version']) ? $value['content']['model_version'] : '' ?>" class="hidden model_version">
						<div class="img_version img-scaledown" style="cursor: pointer;">
							<img src="<?php echo (isset($img)) ? $img[0] : 'public/select-img.png' ?>" class="img_version_select" alt="" data-target="#<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>">
							<?php echo form_input('img_version[]', validate_input(set_value('img_version[]', (isset($value['content']['img_version'])) ? $value['content']['img_version'] : '')), 'class="form-control input_img_version" placeholder="Đường dẫn của ảnh"    autocomplete="off" style="display:none; "');?>
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
					<td><button type="button" class=" product_edit" data-toggle="modal" data-id="#<?php echo isset($value['content']['code_version']) ? $value['content']['code_version'] : '' ?>" data-target="#openModalDetail" >Chỉnh sửa</button></td>
				</tr>

				<?php }} ?>
			</tbody>
		</table>
	</div>
</div>