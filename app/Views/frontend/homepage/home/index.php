<section class="hot-deal-panel">
	<div class="title-panel-general mb50">
		<div class="uk-flex uk-flex-middle uk-flex-center">
			<a href="" title="" class="mr10">
				<h2><?php echo ((isset($panel['hot-deals']['title'])) ? $panel['hot-deals']['title'] : '') ?></h2>
			</a>
			<span><img  class="" alt="Hot Deals" src="public/frontend/resources/img/icon/icon-tin-tuc.png"></span>
		</div>
	</div>
	<div class="uk-grid uk-grid-collapse uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-4 uk-clearfix">
		<?php
		if(isset($panel['hot-deals']['data']) && is_array($panel['hot-deals']['data']) && count($panel['hot-deals']['data'])){
		$n=0;for($i = 0; $i < count($panel['hot-deals']['data']) ; $i++){?>
			<div class="wrap-hot-deal">
				<div class="hot-deal-body">
					<div class="hot-deal-img">
						<div class="hot-deal-time-end countdown" data-time="<?php echo isset($panel['hot-deals']['data'][$n]['time_end']) ? $panel['hot-deals']['data'][$n]['time_end'] : '' ?>">
							<div class="value">Khuyến mãi còn <span></span> Ngày </div>
							<span class="status-deal">Tour Hot</span>
						</div>
						<a href="<?php echo ((isset($panel['hot-deals']['data'][$n]['canonical'])) ? $panel['hot-deals']['data'][$n]['canonical'] : '') ?>" class="img-cover image img-zoomin">
							<img src="<?php echo ((isset($panel['hot-deals']['data'][$n]['avatar'])) ? $panel['hot-deals']['data'][$n]['avatar'] : '') ?>" alt="<?php echo $panel['hot-deals']['data'][$n]['title'] ?>">
						</a>
					</div>
					<div class="hot-deal-content">
						<a href="<?php echo ((isset($panel['hot-deals']['data'][$n]['canonical'])) ? $panel['hot-deals']['data'][$n]['canonical'] : '') ?>" class="hot-deal-title mb10">
							<?php echo ((isset($panel['hot-deals']['data'][$n]['title'])) ? $panel['hot-deals']['data'][$n]['title'] : '') ?>
						</a>
						<div class="hot-deal-price">
							<?php echo ((isset($panel['hot-deals']['data'][$n]['price'])) ? $panel['hot-deals']['data'][$n]['price'] : '') ?> đ
						</div>
					</div>
				</div>
			</div>
		<?php $n++; }}  ?>
	</div>
	<button class="btn-view-all btn">
		xem đầy đủ các tour deal
	</button>
</section>

<section class="tour-category-panel">
	<div class="uk-container uk-container-center">
		<div class="title-panel-general mb50">
			<div class="uk-flex uk-flex-middle uk-flex-center">
				<a href="" title="" class="mr10">
					<h2><?php echo ((isset($panel['tour-trong-nuoc']['title'])) ? $panel['tour-trong-nuoc']['title'] : '')  ?></h2>
				</a>
				<span><img  class="" alt="Hot Deals" src="public/frontend/resources/img/icon/icon-hanh-ly.png"></span>
			</div>
		</div>
		<div class="uk-grid uk-grid-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-4 uk-clearfix">
			<?php
			if(isset($panel['tour-trong-nuoc']['data']) && is_array($panel['tour-trong-nuoc']['data']) && count($panel['tour-trong-nuoc']['data'])){
			$n=0;for($i = 0; $i < count($panel['tour-trong-nuoc']['data']) ; $i++){?>
				<div class="wrap-tour-category">
					<div class="tour-category-body">
						<div class="tour-category-img">
							<a href="<?php echo ((isset($panel['tour-trong-nuoc']['data'][$n]['canonical'])) ? $panel['tour-trong-nuoc']['data'][$n]['canonical'] : '') ?>" class="img-cover img-zoomin">
								<img src="<?php echo ((isset($panel['tour-trong-nuoc']['data'][$n]['avatar'])) ? $panel['tour-trong-nuoc']['data'][$n]['avatar'] : '') ?>" alt="">
							</a>
						</div>
						<div class="tour-category-content">
							<a href="<?php echo ((isset($panel['tour-trong-nuoc']['data'][$n]['canonical'])) ? $panel['tour-trong-nuoc']['data'][$n]['canonical'] : '') ?>" class="tour-category-title">
								<?php echo ((isset($panel['tour-trong-nuoc']['data'][$n]['title'])) ? $panel['tour-trong-nuoc']['data'][$n]['title'] : '') ?>
							</a>
							<div class="uk-flex uk-flex-middle uk-flex-space-between">
								<div class="tour-category-price">
									<?php echo ((isset($panel['tour-trong-nuoc']['data'][$n]['price'])) ? $panel['tour-trong-nuoc']['data'][$n]['price'] : '') ?>đ
								</div>
								<a class="btn btn-view" href="<?php echo ((isset($panel['tour-trong-nuoc']['data'][$n]['canonical'])) ? $panel['tour-trong-nuoc']['data'][$n]['canonical'] : '') ?>" title="Xem Ngay">
									Xem ngay
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php $n++; }}  ?>
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
			<?php if(isset($slide_tour) && is_array($slide_tour) && count($slide_tour)){
				foreach ($slide_tour['data'] as $key => $value) {
			 ?>
				<div class="slide-panel">
					<div class="slide-body">
						<a href="<?php echo $value['url'] ?>" class="img-cover">
							<img src="<?php echo $value['image'] ?>" alt="<?php echo $value['title'] ?>">
						</a>
					</div>
				</div>
			<?php }} ?>
		</div>
	</div>
</section>

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
					<h2><?php echo ((isset($panel['tin-tuc']['title'])) ? $panel['tin-tuc']['title'] : '')  ?></h2>
				</a>
				<span><img  class="" alt="Hot Deals" src="public/frontend/resources/img/icon/icon-hanh-ly.png"></span>
			</div>
		</div>
		<div class="blog-slide">
			<div class="owl-slide">
				<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
					<?php
					if(isset($panel['tin-tuc']['data']) && is_array($panel['tin-tuc']['data']) && count($panel['tin-tuc']['data'])){
					$m=0;for($i = 0; $i < count($panel['tin-tuc']['data']) ; $i++){?>
						<div class="wrap-blog-slide">
							<div class="blog-slide-body">
								<div class="blog-overlay"></div>
								<a href="<?php echo ((isset($panel['tin-tuc']['data'][$m]['canonical'])) ? $panel['tin-tuc']['data'][$m]['canonical'] : '') ?>" class="blog-img img-cover">
									<img src="<?php echo ((isset($panel['tin-tuc']['data'][$m]['avatar'])) ? $panel['tin-tuc']['data'][$m]['avatar'] : '') ?>" alt="">
								</a>
								<div class="blog-time">
									2020
								</div>
								<div class="blog-slide-content">
									<a href="<?php echo ((isset($panel['tin-tuc']['data'][$m]['canonical'])) ? $panel['tin-tuc']['data'][$m]['canonical'] : '') ?>" class="blog-slide-title ">
										<?php echo ((isset($panel['tin-tuc']['data'][$m]['title'])) ? $panel['tin-tuc']['data'][$m]['title'] : '') ?>
									</a>
									<hr>
									<div class="uk-flex uk-flex-middle uk-flex-space-between">
										<div class="blog-slide-view">
											<i class="fa fa-eye mr10" aria-hidden="true"></i>123 lượt xem
										</div>
										<a href="" class="btn-rating">
											<i class="fa fa-heart-o" aria-hidden="true"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php $m++; }}  ?>
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
				<?php if(isset($slide_company) && is_array($slide_company) && count($slide_company)){
					foreach ($slide_company['data'] as $key => $value) {
				 ?>
					<div class="slide-company">
						<div class="slide-company-body">
							<a href="<?php echo $value['url'] ?>" class="img-scaledown image">
								<img src="<?php echo $value['image'] ?>" alt="<?php echo $value['title'] ?>">
							</a>
						</div>
					</div>
				<?php }} ?>
			</div>
		</div>
	</div>
</section>

<div id="modal-video" class="modal">
	<div class="modal-content-review ">
		<iframe width="630" height="321" src="https://www.youtube.com/embed/n2G_J0r7RmQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
</div>
