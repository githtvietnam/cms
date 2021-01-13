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
			<div class="col-lg-6  mb15">
				<div class="form-row">
					<label class="control-label text-left">
						<span>Chọn điểm xuất phát <b class="text-danger">(*)</b></span>
					</label>
					<?php echo form_dropdown('start_at', $location_start, set_value('start_at', (isset($tour['start_at'])) ? $tour['start_at'] : 0), 'class="form-control select2 m-b start_at"  id="start_at"');?>
				</div>
			</div>
			<div class="col-lg-6  mb15">
				<div class="form-row">
					<label class="control-label text-left">
						<span>Chọn điểm kết thúc <b class="text-danger">(*)</b></span>
					</label>
					<?php echo form_dropdown('end_at', $location_end, set_value('end_at', (isset($tour['end_at'])) ? $tour['end_at'] : 0), 'class="form-control select2 m-b end_at"  id="end_at"');?>
				</div>
			</div>
			<div class="col-lg-6  ">
				<div class="form-row">
					<label class="control-label text-left">
						<span>Thời gian <b class="text-danger">(*) số ngày</b></span>
					</label>
					<?php echo form_input('number_days', validate_input(set_value('number_days', (isset($tour['number_days'])) ? $tour['number_days'] : '')), 'class="form-control number_days " placeholder="" id="number_days" autocomplete="off"'); ?>
				</div>
			</div>
			<div class="col-lg-6  ">
				<div class="form-row">
					<label class="control-label text-left">
						<span>Ngày đi <b class="text-danger">(*)</b></span>
					</label>
					<?php echo form_input('day_start', validate_input(set_value('day_start', (isset($tour['day_start'])) ? $tour['day_start'] : '')), 'class="form-control day_start" placeholder="" id="day_start" autocomplete="off"'); ?>
				</div>
			</div>
		</div>
	</div>
</div>