<?php if(isset($object) && is_array($object) && count($object)){ ?>
<section class="address-tourdetail-panel">
			
	<div class="uk-container uk-container-center">
		<ul class="uk-breadcrumb uk-clearfix">
			<li><a href="">Trang chủ</a></li>
			<?php if(isset($breadcrumb) && is_array($breadcrumb) && count($breadcrumb)){
				foreach ($breadcrumb as $key => $value) {
			 ?>
				<li class=""><a href="<?php echo BASE_URL.check_isset($value['canonical']).HTSUFFIX ?>" style="color: #333"><span><?php echo check_isset($value['title']) ?></span></a></li>
			<?php }} ?>
			<li class="uk-active"><span><?php echo check_isset($object['title'])?></span></li>
		</ul>
	</div>
</section>
<?php  
	$owlInit = array(
		'items' =>  1,
		'margin' => 20,
		'loop' => true,
		'nav' => true,
		'dots' =>true,
	);
?>
<section class="tour-detail-panel">
	<div class="uk-container uk-container-center">
		<div class="tour-detail-title">
			<h1>
				<?php echo check_isset($object['title'])?>
			</h1>
		</div>
		<div class="title-action mb30">
			<div class="uk-flex uk-flex-middle uk-flex-wrap">
				<div class="btn-like mr5">
					<a href="" title="like"><i class="fa fa-thumbs-o-up mr5" aria-hidden="true"></i>Thích <span>0</span></a>
				</div>
				<div class="btn-share mr10">
					<a href="" title="share"><i class="fa mr5 fa-share-square-o" aria-hidden="true"></i>Chia sẻ</a>
				</div>
				<div class="rating-info">
					<div class="uk-flex uk-flex-middle">
						<div class="rating-star-info uk-flex uk-flex-middle">
							<span>
								Đánh giá: 
							</span>
							<div class="rate">
								<i class="fa fa-star color-star" aria-hidden="true"></i>
								<i class="fa fa-star color-star" aria-hidden="true"></i>
								<i class="fa fa-star color-star" aria-hidden="true"></i>
								<i class="fa fa-star-o color-star" aria-hidden="true"></i>
								<i class="fa fa-star-o color-star" aria-hidden="true"></i>
							</div>
						</div>
						<div class="rating-result">
							<span>3/5</span>trong <span>0</span> đánh giá
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="uk-grid uk-gird-medium uk-clearfix">
			<div class="uk-width-medium-1-1 uk-width-large-3-4">
				<div class="tour-detail-wrapp mb20">
					<div class="uk-grid uk-grid-medium uk-clearfix">
						<div class="uk-width-medium-1-1 uk-width-large-1-4">
							<aside class="aside-tour-detail-left">
								<ul class="tabs tab-aside uk-list">
									<li class="btn-tab-aside tab-link current" data-tab="tab-1">
										
											<i class="fa fa-picture-o" aria-hidden="true"></i>Thắng cảnh
										
									</li>
									<li class="btn-tab-aside tab-link" data-tab="tab-2">
										
											<i class="fa fa-male" aria-hidden="true"></i>Du khách
										
									</li>
									<li class="btn-tab-aside tab-link" data-tab="tab-3"> 
										
											<i class="fa fa-cutlery" aria-hidden="true"></i>Ẩm thực
										
									</li>
									<li class="btn-tab-aside tab-link" data-tab="tab-4"> 
										
											<i class="fa fa-play-circle" aria-hidden="true"></i>Video
										
									</li>
									
								</ul>
							</aside>
						</div>
						<div class="uk-width-medium-1-1 uk-width-large-3-4">
							<div class="wrap-carousel">

								<ul class=" uk-list tabs-content tabs-content-aside">
									<li id="tab-1" class="tab-content current">
										<div class="owl-slide">
											<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
												<?php if(isset($object['album']) && is_array($object['album']) && count($object['album'])){
													foreach ($object['album'] as $key => $value) {
												 ?>
													<div class="wrap-img-tour-detail">
														<a href="" class="img-cover">
															<img src="<?php echo check_isset($value) ?>" alt="">
														</a>
													</div>
												<?php }} ?>
											</div>
										</div>
									</li>
									<li id="tab-2" class="tab-content">
										<div class="owl-slide">
											<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
												<?php if(isset($object['album']) && is_array($object['album']) && count($object['album'])){
													foreach ($object['album'] as $key => $value) {
												 ?>
													<div class="wrap-img-tour-detail">
														<a href="" class="img-cover">
															<img src="<?php echo check_isset($value) ?>" alt="">
														</a>
													</div>
												<?php }} ?>
											</div>
										</div>
									</li>
									<li id="tab-3" class="tab-content">
										<div class="owl-slide">
											<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
												<?php if(isset($object['album']) && is_array($object['album']) && count($object['album'])){
													foreach ($object['album'] as $key => $value) {
												 ?>
													<div class="wrap-img-tour-detail">
														<a href="" class="img-cover">
															<img src="<?php echo check_isset($value) ?>" alt="">
														</a>
													</div>
												<?php }} ?>
											</div>
										</div>
									</li>
									<li id="tab-4" class="tab-content">
										<div class="owl-slide">
											<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
												<div class="wrap-video-tour-detail">
													<iframe width="590" height="449" src="https://www.youtube.com/embed/8JXnqMp44Bw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
												</div>
											</div>
										</div>
									</li>
									
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="info-tour mb30">
					<div class="info-tour-title mb20">
						<h2>Thông tin tour:</h2>
					</div>
					<div class="info-tour-content">
						<div class="uk-grid uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-clearfix uk-grid-medium">
							<div class="wrap-info-tour">
								<div class="uk-flex">
									<div class="info-tour-text">
										<i class="fa fa-qrcode" aria-hidden="true"></i>Mã tour:
										<span>
											<?php echo check_isset($object['tourid'])?>
										</span>
									</div>
								</div>
							</div>
							<div class="wrap-info-tour">
								<div class="uk-flex">
									<div class="info-tour-text">
									<i class="fa fa-clock-o" aria-hidden="true"></i>Thời gian:

										<span>
										<?php echo check_isset($object['number_days'])?> Ngày
										</span>
									</div>
								</div>
							</div>
							<div class="wrap-info-tour">
								<div class="uk-flex">
									<div class="info-tour-text">
									<i class="fa fa-map-marker" aria-hidden="true"></i>Điểm khởi hành:
										<span>
										<?php echo check_isset($object['start'])?>
										</span>
									</div>
								</div>
							</div>
							<div class="wrap-info-tour">
								<div class="uk-flex">
									<div class="info-tour-text">
									<i class="fa fa-male" aria-hidden="true"></i>Phương tiện:


										<span>
										Bay Vietjet Air
										</span>
									</div>
								</div>
							</div>
							<div class="wrap-info-tour">
								<div class="uk-flex">
									<div class="info-tour-text">
									<i class="fa fa-map-marker" aria-hidden="true"></i>Điểm đến:


										<span>
										<?php echo check_isset($object['end'])?>
										</span>
									</div>
								</div>
							</div>
							<div class="wrap-info-tour">
								<div class="uk-flex">
									<div class="info-tour-text">
									<i class="fa fa-user" aria-hidden="true"></i>Số chỗ trống:
										<span>
										20
										</span>
									</div>
								</div>
							</div>
							<div class="wrap-info-tour">
								<div class="uk-flex">
									<div class="info-tour-text">
									<i class="fa fa-calendar" aria-hidden="true"></i>Ngày khởi hành:

										<span>
										<?php echo check_isset($object['day_start'])?>
										</span>
									</div>
								</div>
							</div>
							
							<div class="wrap-info-tour">
								<div class="uk-flex">
									<div class="info-tour-text">
									<i class="fa fa-clock-o" aria-hidden="true"></i>Thời gian:

										<span>
										<?php echo check_isset($object['number_days'])?>
										</span>
									</div>
								</div>
							</div>
							<div class="wrap-info-tour">
								<div class="uk-flex">
									<div class="info-tour-text">
									<i class="fa fa-clock-o" aria-hidden="true"></i>Thời gian:

										<span>
										<?php echo check_isset($object['end'])?>
										</span>
									</div>
								</div>
							</div>
							<div class="wrap-info-tour">
								
								<div class="info-tour-text">
									<i class="fa fa-briefcase" aria-hidden="true"></i>Lịch trình:

									<span>
									HÀ NỘI - QUẢNG BÌNH - QUẢNG TRỊ - ĐỘNG THIÊN ĐƯỜNG - SUỐI MỌOC - ĐỒNG HƠI - HÀ NỘI
									</span>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<div class="tab-detail-tour-panel mb30">
					<ul class="tabs-detail tab-detail-tour uk-list" >
						<?php if(isset($object['sub_title']) && is_array($object['sub_title']) && count($object['sub_title'])){ 
							$count = 1;
							foreach ($object['sub_title'] as $key => $value) {
							?>
						<li class="tab-link  <?php echo ($count == 1) ? 'current' : '' ?>" style="text-transform: uppercase;" data-tab="detail-tab-<?php echo $count ?>"><?php echo check_isset($value) ?></li>
						<?php $count++;}} ?>
					</ul>
					<ul class="tabs-content tab-content-detail-tour">
						<?php if(isset($object['sub_content']) && is_array($object['sub_content']) && count($object['sub_content'])){ 
							$count = 1;
							foreach ($object['sub_content'] as $key => $value) {
							?>
							<li id="detail-tab-<?php echo $count ?>" class="tab-content-detail <?php echo ($count == 1) ? 'current' : '' ?>" >
								<p class="tab-detail-text mb20">
									<?php echo check_isset($value) ?>
								</p>
							</li>
						<?php $count++;}} ?>
					</ul>
				</div>
				<div class="comment-panel">
					
					<div class="cmt-content">
						
						<div class="fb-comments" data-href="http://tourist.com.va/home.php" data-numposts="5" data-width="100%"></div>
					</div>
				</div>
			</div>
			<div class="uk-width-medium-1-1 uk-width-large-1-4">
				<aside class="aside-tour-detail-right">
					<div class="wrap-aside">
						<p class="key-price">Giá chỉ
							<span><?php echo check_isset($object['price']) ?>đ</span>
						</p>
						<button class="btn-keep">
							giữ chỗ
						</button>
						<a href="#create-helpper" class="create-help btn-modal-general">
							Đăng kí tư vấn <span>Hotline: <?php echo check_isset($general['contact_phone']) ?></span>
						</a>
					</div>
					<div class="wrap-aside">
						<p class="tab-detail-text center mb20">
							<span>
							MỌI THẮC MẮC XIN VUI LÒNG LIÊN HỆ						
							</span>
						</p>
						<div class="info-contact">
							<i class="fa fa-phone-square" aria-hidden="true"></i>Hotline:
							<a href="" title=""><?php echo check_isset($general['contact_phone']) ?></a>
						</div>
						<div class="info-contact mb30">
							<i class="fa fa-envelope" aria-hidden="true"></i>Email:
							<a href="" title=""><?php echo check_isset($general['contact_email']) ?></a>
						</div>
						<p class="tab-detail-text center mb20">
							<span>
							HOẶC ĐỂ LẠI THÔNG TIN				
							</span>
						</p>
						<div class="name-input mb10	">
							Họ và tên: 
						</div>
						<div class="input-general mb20">
							<input type="text" placeholder="Nhập họ và tên bạn">
						</div>
						<div class="name-input mb10	">
							Email hoặc số điện thoại
						</div>
						<div class="input-general mb20">
							<input type="text" placeholder="Nhập email hoặc số điện thoại">
						</div>
						<div class="btn-send">
							<button>
								GỬI
							</button>
						</div>
					</div>


					<!-- ===================================================== -->
					<div id="create-helpper" class="modal">
						<div class="modal-content-review  w50">
							<div class="modal-title center">
								ĐĂNG KÝ TƯ VẤN
							</div>
							<div class="modal-content-panel">
								<div class="wrap-modal">
									<p class="tab-detail-text mb20 center">
										<span>
										MỌI THẮC MẮC XIN VUI LÒNG LIÊN HỆ						
										</span>
									</p>
									<div class="info-contact">
										<i class="fa fa-phone-square" aria-hidden="true"></i>Hotline:
										<a href="" title="">19004518</a>
									</div>
									<div class="info-contact mb30">
										<i class="fa fa-envelope" aria-hidden="true"></i>Email:
										<a href="" title="">sales@hanoitourist.vn</a>
									</div>
									<p class="tab-detail-text center mb20 center">
										<span>
										HOẶC ĐỂ LẠI THÔNG TIN				
										</span>
									</p>
									<div class="name-input mb10	">
										Họ và tên: 
									</div>
									<div class="input-general mb20">
										<input type="text" placeholder="Nhập họ và tên bạn">
									</div>
									<div class="name-input mb10	">
										Email hoặc số điện thoại
									</div>
									<div class="input-general mb20">
										<input type="text" placeholder="Nhập email hoặc số điện thoại">
									</div>
									<div class="btn-send">
										<button>
											GỬI
										</button>
									</div>

								</div>
							</div>
							<div class="modal-close">
								<img src="resources/img/icon/ios7-close-empty.png" alt="">
							</div>
						</div>
					</div>
				</aside>
			</div>
		</div>
	</div>
</section>
<?php } ?>