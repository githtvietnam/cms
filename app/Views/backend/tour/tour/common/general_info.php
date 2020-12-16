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
		</div>
	</div>
</div>