<div class="ibox mb20 block-general-tour">
	<div class="ibox-title uk-flex uk-flex-middle uk-flex-space-between">
		<h5>Thông tin Chung</h5>
		<div class="ibox-tools">
			<button type="submit" name="create" value="create" class="btn btn-primary block full-width m-b">Lưu</button>
		</div>
	</div>
	<div class="ibox-content">
		<div class="row">
			<div class="col-lg-4">
				<div class="form-row">
					<label class="control-label text-left">
						<span>Giá Chuyến du lịch <b class="text-danger">(*)</b></span>
					</label>
					<?php echo form_input('price', validate_input(set_value('price', (isset($tour['price'])) ? $tour['price'] : '')), 'class="form-control price int" placeholder="" id="price" autocomplete="off"'); ?>
				</div>
			</div>
			<div class="col-lg-4 m-b">
				<label class="control-label ">
					<span>Giá khuyến mại</span>
				</label>
				<?php echo form_input('promotion_price', set_value('promotion_price', (isset($tour['price_promotion'])) ? $tour['price_promotion'] : ''), 'class="form-control price int" placeholder="" id="promotion_price" autocomplete="off"'); ?>
			</div>
			<div class="col-lg-4 mb15 ">
				<label class="control-label ">
					<span class="label-title">Mã Chuyến du lịch <b class="text-danger">(*)</b></span>
				</label>
				<script>
					var tourid = '<?php echo isset($tour['tourid']) ? $tour['tourid'] : $tourid ?>'
				</script>
				<div class="dd-item">
					<?php echo form_input('tourid', set_value('tourid', (isset($tour['tourid'])) ? $tour['tourid'] : $tourid), 'class="form-control va-uppercase tourid" readonly placeholder="" autocomplete="off"');?>
					<input type="checkbox" id="toogle_readonly" name="toogle_readonly">
				</div>
			</div>
			<script>
				var start_at = '<?php echo (isset($_POST['start_at'])) ? $_POST['start_at'] : ((isset($tour['start_at'])) ? $tour['start_at'] : ''); ?>';
				var end_at = '<?php echo (isset($_POST['end_at'])) ? $_POST['end_at'] : ((isset($tour['end_at'])) ? $tour['end_at'] : ''); ?>';
			</script>
			<div class="col-lg-6  ">
				<div class="form-row">
					<label class="control-label text-left">
						<span>Chọn điểm xuất phát</span>
					</label>
					<?php 
						$city = get_data(['select' => 'provinceid, name','table' => 'vn_province','order_by' => 'order desc, name asc']);
						$city = convert_array([
							'data' => $city,
							'field' => 'provinceid',
							'value' => 'name',
							'text' => 'Thành Phố',
						]);
					?>
					<?php echo form_dropdown('start_at', $city, set_value('start_at', (isset($tour['start_at'])) ? $tour['start_at'] : 0), 'class="form-control select2 m-b start_at"  id="start_at"');?>
				</div>
			</div>
			<div class="col-lg-6  ">
				<div class="form-row">
					<label class="control-label text-left">
						<span>Chọn điểm kết thúc</span>
					</label>
					<?php echo form_dropdown('end_at', $city, set_value('end_at', (isset($tour['end_at'])) ? $tour['end_at'] : 0), 'class="form-control select2 m-b end_at"  id="end_at"');?>
				</div>
			</div>
		</div>
	</div>
</div>