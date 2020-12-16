<section class="slide-panel">
	<div class="uk-slidenav-position" data-uk-slideshow>
		<ul class="uk-slideshow" data-uk-slideshow="{autoplay:true}" >
			<li><a href="" class="img-cover"><img src="public/frontend/resources/img/banner/boc-tham-slide.png" alt=""></a></li>
			<li><a href="" class="img-cover"><img src="public/frontend/resources/img/banner/cskh-slide.png" alt=""></a></li>
			<li><a href="" class="img-cover"><img src="public/frontend/resources/img/banner/mua5tang1-slide.png" alt=""></a></li>
			<li><a href="" class="img-cover"><img src="public/frontend/resources/img/banner/oasis-phu-quoc-silde-web.png" alt=""></a></li>
			<li><a href="" class="img-cover"><img src="public/frontend/resources/img/banner/qc112020-the-tich-diemslide.png" alt=""></a></li>
			<li><a href="" class="img-cover"><img src="public/frontend/resources/img/banner/qc112020-voucher-200k-slide.png" alt=""></a></li>
			<li><a href="" class="img-cover"><img src="public/frontend/resources/img/banner/qc122020-b-voucher-500k-slide.png" alt=""></a></li>
			<li><a href="" class="img-cover"><img src="public/frontend/resources/img/banner/qc122020-sinh-nhat-slide-1-.png" alt=""></a></li>
			<li><a href="" class="img-cover"><img src="public/frontend/resources/img/banner/slide-web-combo-vinholiday.png" alt=""></a></li>
			<li><a href="" class="img-cover"><img src="public/frontend/resources/img/banner/slide-web-con-dao-0920.png" alt=""></a></li>
			<li><a href="" class="img-cover"><img src="public/frontend/resources/img/banner/tour-mien-tay.png" alt=""></a></li>
		</ul>
		<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
		<a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
	</div>
</section>

<?php 
	$hot_deal = array(
		0 => array(
			'img' => 'public/frontend/resources/img/upload/avatar-maia-resort-quynhon.png',
			'title' => 'GÓI DỊCH VỤ MAIA RESORT QUY NHƠN 3N2Đ–NƠI TỔNG HÒA CỦA NHỮNG TRẢI NGHIỆM',
			'price' => '1.690.000 đ',
			'time' => '78',
		),
		1 => array(
			'img' => 'public/frontend/resources/img/upload/avatar-tam-chuc.png',
			'title' => 'ĐÓN TẾT SANG DU XUÂN CẦU AN NĂM MỚI CÙNG VINPEARL CONDOTEL PHỦ LÝ MÙA LỄ HỘI – XUÂN THỊNH VƯỢNG',
			'price' => '1.590.000 đ',
			'time' => '85',
		),
		2 => array(
			'img' => 'public/frontend/resources/img/upload/avatar-vinpearl-langson.png',
			'title' => 'ĐÓN TẾT SANG DU XUÂN CẦU AN NĂM MỚI CÙNG VINPEARL LẠNG SƠN MÙA LỄ HỘI – XUÂN THỊNH VƯỢNG',
			'price' => '2.990.000 đ',
			'time' => '96',
		),
		3 => array(
			'img' => 'public/frontend/resources/img/upload/chic-suite-fusion-resort-cam-ranh.jpg',
			'title' => 'GÓI DỊCH VỤ FUSION RESORT CAM RANH -THẢ HỒN VỀ BIỂN-HOÀ QUYỆN THIÊN NHIÊN',
			'price' => '3.190.000 đ',
			'time' => '45',
		),	
		4 => array(
			'img' => 'public/frontend/resources/img/upload/countdown-party.png',
			'title' => 'GÓI DỊCH VỤ RADISSON BLU RESORT PHÚ QUỐC-NĂM MỚI VÀ TẾT NGUYÊN ĐÁN 3N2Đ',
			'price' => '1.750.000 đ',
			'time' => '54',
		),	
		5 => array(
			'img' => 'public/frontend/resources/img/upload/oasis.jpg',
			'title' => 'GÓI DỊCH VỤ VINOASIS PHÚ QUỐC- ỐC ĐẢO NGẬP TRÀN CẢM HỨNG (GÓI SANG CHẢNH VÀ TẾT SUM VẦY',
			'price' => '1.650.000 đ',
			'time' => '12',
		),	
		6 => array(
			'img' => 'public/frontend/resources/img/upload/radisson-resort-tour.png',
			'title' => 'GÓI DỊCH VỤ RADISSON BLU RESORT PHÚ QUỐC-TUYỆT TÁC MỚI SỐC BẤT NGỜ',
			'price' => '1.190.000 đ',
			'time' => '44',
		),	
		7 => array(
			'img' => 'public/frontend/resources/img/upload/vinholidays-1-phu-quoc-1-.jpg',
			'title' => 'GÓI DỊCH VỤ VINHOLIDAYS PHÚ QUỐC- THẾ GIỚI GIẢI TRÍ KHÔNG NGỦ',
			'price' => '4.390.000 đ',
			'time' => '65',
		)
	)
?>

<section class="hot-deal-panel">
	<div class="uk-container uk-container-center">
		<div class="title-panel-general mb50">
			<div class="uk-flex uk-flex-middle uk-flex-center">
				<a href="" title="" class="mr10">
					<h2>Hot Deals</h2>
				</a>
				<span><img  class="" alt="Hot Deals" src="public/frontend/resources/img/icon/icon-tin-tuc.png"></span>
			</div>
		</div>
		<div class="uk-grid uk-grid-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-4 uk-clearfix">
			<?php  $n=0;for($i = 0; $i < 8 ; $i++){?>
				<div class="wrap-hot-deal">
					<div class="hot-deal-body">
						<div class="hot-deal-img">
							<div class="hot-deal-time-end">
								Khuyến mãi còn <?php echo $hot_deal[$n]['time']?> Ngày
								<span class="status-deal">Tour Hot</span>
							</div>
							<a href="" class="img-cover">
								<img src="<?php echo $hot_deal[$n]['img']?>" alt="">
							</a>
						</div>
						<div class="hot-deal-content">
							<a href="" class="hot-deal-title mb10">
								<?php echo $hot_deal[$n]['title']?>
							</a>
							<div class="hot-deal-price">
								<?php echo $hot_deal[$n]['price']?>
							</div>
						</div>
					</div>
				</div>
			<?php $n++; }  ?>
		</div>
		<button class="btn-view-all btn">
			xem đầy đủ các tour deal 
		</button>
	</div>
</section>

<section class="tour-category-panel">
	<div class="uk-container uk-container-center">
		<div class="title-panel-general mb50">
			<div class="uk-flex uk-flex-middle uk-flex-center">
				<a href="" title="" class="mr10">
					<h2>tour trong nước</h2>
				</a>
				<span><img  class="" alt="Hot Deals" src="public/frontend/resources/img/icon/icon-hanh-ly.png"></span>
			</div>
		</div>
		<div class="uk-grid uk-grid-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-4 uk-clearfix">
			<?php  $n=0;for($i = 0; $i < 8 ; $i++){?>
				<div class="wrap-tour-category">
					<div class="tour-category-body">
						<div class="tour-category-img">
							<a href="" class="img-cover">
								<img src="<?php echo $hot_deal[$n]['img']?>" alt="">
							</a>
						</div>
						<div class="tour-category-content">
							<a href="" class="tour-category-title">
								<?php echo $hot_deal[$n]['title']?>
							</a>
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<div class="tour-category-price">
									<?php echo $hot_deal[$n]['price']?>
								</div>
								<button class="btn btn-view">
									Xem ngay
								</button>
							</div>
						</div>
					</div>
				</div>
			<?php $n++; }  ?>
		</div>
		<button class="btn-view-all btn">
			xem đầy đủ các tour hot 
		</button>
	</div>
</section>

<?php  
	$owlInit = array(
		'items' =>  3,
		'margin' => 0,
		'loop' => true,
		'nav' => false,
		'dots' => true,
		'autoplay' => true,
		'autoplayTimeout' => 5000,
		'responsiveClass' =>true,
		'responsive' => array(
			0 => array(
				'items' => 1,
				'nav' => false
			),
			500 => array(
				'items' => 2,
				'nav' => false
			),
			1024 => array(
				'items' => 3,
				'nav' => false
			),
		)
	);
?>

<section class="slide-tour-panel">
	<div class="owl-slide">
		<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
			<div class="slide-panel">
				<div class="slide-body">
					<a href="" class="img-cover">
						<img src="public/frontend/resources/img/banner/tour-khoi-hanh-hanoi.png" alt="">
					</a>
				</div>
			</div>
			<div class="slide-panel">
				<div class="slide-body">
					<a href="" class="img-cover">
						<img src="public/frontend/resources/img/banner/tour-khoi-hanh-hochiminh.png" alt="">
					</a>
				</div>
			</div>
			<div class="slide-panel">
				<div class="slide-body">
					<a href="" class="img-cover">
						<img src="public/frontend/resources/img/banner/khoi-hanh.png" alt="">
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php 
	$blog = array(
		0 => array(
			'img' => 'public/frontend/resources/img/upload/berlin-city.jpg',
			'view' => '251 ',
			'title' => 'Mẹo tiết kiệm khi du lịch Berlin - Đức',
			'time' => '22/07/2020',
		),
		1 => array(
			'img' => 'public/frontend/resources/img/upload/nui-thai-son-trung-quoc-02.png',
			'view' => '189 ',
			'title' => 'Tìm hiểu ngọn núi thiêng Thái Sơn khi du lịch Trung Quốc',
			'time' => '30/07/2020',
		),
		2 => array(
			'img' => 'public/frontend/resources/img/upload/tour-myanmar-4.png',
			'view' => '174 ',
			'title' => 'DU LỊCH YANGON - VÙNG ĐẤT THẤT LẠC',
			'time' => '05/08/2020 ',
		),
	)
?>

<?php  
	$owlInit = array(
		'items' =>  3,
		'margin' => 30,
		'loop' => true,
		'nav' => false,
		'dots' => true,
		'autoplay' => false,
		'autoplayTimeout' => 5000,
		'responsiveClass' =>true,
		'responsive' => array(
			0 => array(
				'items' => 1,
				'nav' => false
			),
			500 => array(
				'items' => 2,
				'nav' => false
			),
			1024 => array(
				'items' => 3,
				'nav' => false
			),
		)
	);
?>

<section class="blog-panel">
	<div class="uk-container uk-container-center">
		<div class="title-panel-general mb50">
			<div class="uk-flex uk-flex-middle uk-flex-center">
				<a href="" title="" class="mr10">
					<h2>CẨM NANG & TIN TỨC</h2>
				</a>
				<span><img  class="" alt="Hot Deals" src="public/frontend/resources/img/icon/icon-hanh-ly.png"></span>
			</div>
		</div>
		<div class="blog-slide">
			<div class="owl-slide">
				<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
					<?php  $m=0;for($i = 0; $i < 3 ; $i++){?>
						<div class="wrap-blog-slide">
							<div class="blog-slide-body">
								<div class="blog-overlay"></div>
								<a href="" class="blog-img img-cover">
									<img src="<?php echo $blog[$m]['img']?>" alt="">
								</a>
								<div class="blog-time">
									<?php echo $blog[$m]['time']?> 
								</div>										
								<div class="blog-slide-content">
									<a href="" class="blog-slide-title ">
										<?php echo $blog[$m]['title']?>
									</a>
									<hr>
									<div class="uk-flex uk-flex-middle uk-flex-space-between">
										<div class="blog-slide-view">
											<i class="fa fa-eye mr10" aria-hidden="true"></i><?php echo $blog[$m]['view']?> lượt xem
										</div>
										<a href="" class="btn-rating">
											<i class="fa fa-heart-o" aria-hidden="true"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php $m++; }  ?>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="video-panel" style="background:url(public/frontend/resources/img/banner/banner-trafic-4.png)">
	<div class="uk-container uk-container-center">
		<div class="uk-grid uk-grid-medium uk-grid-width-medium-1-1 uk-grid-width-large-1-2 uk-clearfix">
			<div class="wrap-video-content">
				<div class="video-content">
					<h3 class="heading-2">KIM LIEN TRAVEL VINH DỰ ĐẠT GIẢI THƯỞNG  TOP TEN HÃNG LỮ HÀNH INBOUND TỐT NHẤT VIỆT NAM NĂM 2019</h3>
					<div class="description">
						KIM LIEN TRAVEL VINH DỰ ĐẠT GIẢI THƯỞNG TOP TEN HÃNG LỮ HÀNH INBOUND TỐT NHẤT VIỆT NAM NĂM 2019				
					</div>
					<div class="readmore">
						<a href="" title="">Xem thêm</a>
					</div>
				</div>
			</div>
			<div class="wrap-video">
				<div class="video-popup">
					<a class="btn-modal-general" href="#modal-video">
						<img src="public/frontend/resources/img/banner/youtube-image.png" alt="">
					</a>
				</div>
			</div>
		</div>
	</div>
</section>

<?php  
	$owlInit = array(
		'items' =>  3,
		'margin' => 30,
		'loop' => true,
		'nav' => false,
		'dots' => false,
		'autoplay' => false,
		'autoplayTimeout' => 5000,
		'responsiveClass' =>true,
		'responsive' => array(
			0 => array(
				'items' => 3,
				'nav' => false
			),
			500 => array(
				'items' => 5,
				'nav' => false
			),
			1024 => array(
				'items' => 8,
				'nav' => false
			),
		)
	);
?>

<section class="slide-company-panel p30">
	<div class="uk-container uk-container-center">
		<div class="owl-slide">
			<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
				<div class="slide-company">
					<div class="slide-company-body">
						<a href="" class="img-cover">
							<img src="public/frontend/resources/img/customerlogo/abbott.png" alt="">
						</a>
					</div>
				</div>
				<div class="slide-company">
					<div class="slide-company-body">
						<a href="" class="img-cover">
							<img src="public/frontend/resources/img/customerlogo/als-logo.png" alt="">
						</a>
					</div>
				</div>
				<div class="slide-company">
					<div class="slide-company-body">
						<a href="" class="img-cover">
							<img src="public/frontend/resources/img/customerlogo/exedy.png" alt="">
						</a>
					</div>
				</div>
				<div class="slide-company">
					<div class="slide-company-body">
						<a href="" class="img-cover">
							<img src="public/frontend/resources/img/customerlogo/jwe.png" alt="">
						</a>
					</div>
				</div>
				<div class="slide-company">
					<div class="slide-company-body">
						<a href="" class="img-cover">
							<img src="public/frontend/resources/img/customerlogo/lien-viet-postbank-logo.png" alt="">
						</a>
					</div>
				</div>
				<div class="slide-company">
					<div class="slide-company-body">
						<a href="" class="img-cover">
							<img src="public/frontend/resources/img/customerlogo/novus.png" alt="">
						</a>
					</div>
				</div>
				<div class="slide-company">
					<div class="slide-company-body">
						<a href="" class="img-cover">
							<img src="public/frontend/resources/img/customerlogo/pmc-logo.png" alt="">
						</a>
					</div>
				</div>
				<div class="slide-company">
					<div class="slide-company-body">
						<a href="" class="img-cover">
							<img src="public/frontend/resources/img/customerlogo/udic-logo-1-.png" alt="">
						</a>
					</div>
				</div>
				<div class="slide-company">
					<div class="slide-company-body">
						<a href="" class="img-cover">
							<img src="public/frontend/resources/img/customerlogo/vinamilk-logo.png" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div id="modal-video" class="modal">
	<div class="modal-content-review ">
		<iframe width="630" height="321" src="https://www.youtube.com/embed/n2G_J0r7RmQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
</div>