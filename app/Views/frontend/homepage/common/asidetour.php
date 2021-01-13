<?php
	helper(['mydatafrontend','mydata']);
	$baseController = new App\Controllers\FrontendController();
    $language = $baseController->currentLanguage();
    $location = location($language,'end');
    $vehicle = attribute($language, 'phuong-tien');
    $time = attribute($language, 'thoi-gian');
    $price = explode_price($general['another_price']);
?>
<div class="aside-tour">
	<div class="aside-search mb30">
		<form action="" method="" class="uk-form va-form">
			<input type="text" name="keyword" id="keyword" class="uk-width-1-1 input-text" placeholder="Tìm kiếm">
			<button type="submit" name="" class="va-btn-submit"><i class="fa fa-search"></i></button>
		</form>
		<div class="searchResult"></div>
	</div>
	<div class="aside-list">
		<div class="aside-list-title">
			<h3>Khu vực</h3>
		</div>
		<ul class="uk-list">
			<?php if(isset($location) && is_array($location) && count($location)){
                foreach ($location as $key => $value) {
             ?>
                <li>
                    <label class="check-aside check-area uk-flex uk-flex-middle mb10" data-select="<?php echo check_isset($value['keyword']) ?>" >
		                <input type="checkbox" name="area[]"  value="<?php echo check_isset($value['id']) ?>">
		                <?php echo check_isset($value['title']) ?>
		            </label>
                </li>
            <?php }} ?>
		</ul>
	</div>
	<div class="aside-list">
		<div class="aside-list-title">
			<h3>Khoảng giá</h3>
		</div>
		<ul class="uk-list">
			<?php if(isset($price) && is_array($price) && count($price)){
				foreach ($price as $key => $value) {
			 ?>
	            <li>
	                <label class="check-aside check-price uk-flex uk-flex-middle mb10">
		                <input type="checkbox" data-start="<?php echo check_isset($value['start']) ?>" data-end="<?php echo check_isset($value['end']) ?>" name="price[]" class="about-price" value="<?php echo check_isset($value['value']) ?>">
		                <?php 
		                	if(check_isset($value['start']) == 'min'){
		                		echo 'Dưới '.convertPrice($value['end']);
		                	}else if(check_isset($value['end']) == 'max'){
		                		echo 'Trên '.convertPrice($value['start']);
		                	}else{
		                		echo 'Từ '.convertPrice($value['start']).' - '.convertPrice($value['end']);
		                	}
		                ?>
		            </label>
	            </li>
        	<?php }} ?>
		</ul>
	</div>
	<div class="aside-list">
		<div class="aside-list-title">
			<h3>Phương tiện</h3>
		</div>
		<ul class="uk-list">
			<?php if(isset($vehicle) && is_array($vehicle) && count($vehicle)){
                foreach ($vehicle as $key => $value) {
             ?>
                <li>
                    <label class="check-aside check-vehicle uk-flex uk-flex-middle mb10">
		                <input type="checkbox" name="vehicle[]"  value="<?php echo check_isset($value['id']) ?>">
		                <?php echo check_isset($value['title']) ?>
		            </label>
                </li>
            <?php }} ?>
		</ul>
	</div>
	<div class="aside-list">
		<div class="aside-list-title">
			<h3>Thời gian</h3>
		</div>
		<ul class="uk-list">
			<?php if(isset($time) && is_array($time) && count($time)){
                foreach ($time as $key => $value) {
             ?>
                <li>
                    <label class="check-aside check-time uk-flex uk-flex-middle mb10">
		                <input type="checkbox" name="time[]"  value="<?php echo check_isset($value['id']) ?>">
		                <?php echo check_isset($value['title']) ?>
		            </label>
                </li>
            <?php }} ?>
		</ul>
	</div>
</div>

