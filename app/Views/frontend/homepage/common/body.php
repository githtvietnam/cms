<div class="bg-video-hd">
	<video loop autoplay>
		<source src="resources/img/bg/city.mp4" type="video/mp4">
	</video>

	<div class="hd-content-panel">
		<div class="uk-container uk-container-center">
			<?php require_once 'common/header-home.php'; ?>
		</div>
	</div>
</div>
<?php 
	$home = array(
		0 => array(
			'img-1' => 'resources/img/upload/company-1.jpg',
			'img-2' => 'resources/img/upload/company-2.jpg',
			'img-3' => 'resources/img/upload/company-3.jpg',
			'title' => 'Full Floor Office Condo',
			'address' => ' 190-198 West St, New York, NY 10013, USA',
			'price-old' => '$900.000',
			'price-new' => '$870.000',
			'class' => 'product-1',
			'bed' => '3',
			'bath' =>'2',
			'size' => ' 3000 ft²',
		),
		1 => array(
			'img-1' => 'resources/img/upload/company-4.jpg',
			'img-2' => 'resources/img/upload/company-5.jpg',
			'img-3' => 'resources/img/upload/company-6.jpg',
			'title' => 'Luxurious house with a swimming pool',
			'address' => ' 127-199 Walker St, New York, NY 10013, USA',
			'price-old' => '$850.000',
			'price-new' => '$820.000',
			'class' => 'product-2',
			'bed' => '3',
			'bath' =>'2',
			'size' => '2900 ft²',
		),
		2 => array(
			'img-1' => 'resources/img/upload/product-1-1.jpg',
			'img-2' => 'resources/img/upload/product-1-2.jpg',
			'img-3' => 'resources/img/upload/product-1-3.jpg',
			'title' => 'Cambridge Building',
			'address' => ' 119-131 Belmont Ave, Los Angeles, CA 90026, USA',
			'price-old' => '$800.000',
			'price-new' => '$790.000',
			'class' => 'product-3',
			'bed' => '3',
			'bath' =>'2',
			'size' => '800 ft²',
		),
		3 => array(
			'img-1' => 'resources/img/upload/product-1-4.jpg',
			'img-2' => 'resources/img/upload/product-1-5.jpg',
			'img-3' => 'resources/img/upload/product-2-1.jpg',
			'title' => 'Office property',
			'address' => ' 840-860 N LaSalle Dr, Chicago, IL 60610, USA',
			'price-old' => '$670.000',
			'price-new' => '$650.000',
			'class' => 'product-4',
			'bed' => '3',
			'bath' =>'2',
			'size' => '2000 ft²',
		),	
		4 => array(
			'img-1' => 'resources/img/upload/product-1-3.jpg',
			'img-2' => 'resources/img/upload/product-1-5.jpg',
			'img-3' => 'resources/img/upload/product-2-1.jpg',
			'title' => '19th century palace',
			'address' => ' 1523-1599 Arapahoe St, Los Angeles, CA 90006, USA',
			'price-old' => '$630.000',
			'price-new' => '$600.000',
			'class' => 'product-5',
			'bed' => '3',
			'bath' =>'2',
			'size' => '1200 ft²',
		),	
		5 => array(
			'img-1' => 'resources/img/upload/product-1-2.jpg',
			'img-2' => 'resources/img/upload/product-1-3.jpg',
			'img-3' => 'resources/img/upload/product-2-3.jpg',
			'title' => 'Rustic style villa',
			'address' => ' 726-734 Madison Ave, New York, NY 10065, USA',
			'price-old' => '$500.000',
			'price-new' => '$490.000',
			'class' => 'product-6',
			'bed' => '3',
			'bath' =>'2',
			'size' => '2100 ft²',
		),	
		6 => array(
			'img-1' => 'resources/img/upload/room-1-5.jpg',
			'img-2' => 'resources/img/upload/product-1-5.jpg',
			'img-3' => 'resources/img/upload/product-2-1.jpg',
			'title' => 'Huge office space',
			'address' => ' 122-140 N Morgan St, Chicago, IL 60607, USA',
			'price-old' => '$600.000',
			'price-new' => '$570.000',
			'class' => 'product-7',
			'bed' => '3',
			'bath' =>'2',
			'size' => '3200 ft²',
		),	
		7 => array(
			'img-1' => 'resources/img/upload/room-1-4.jpg',
			'img-2' => 'resources/img/upload/product-1-5.jpg',
			'img-3' => 'resources/img/upload/product-2-1.jpg',
			'title' => 'Bright apartment',
			'address' => '322-344 E Jackson Dr, Chicago, IL 60605, USA',
			'price-old' => '$620.000',
			'price-new' => '$600.000',
			'class' => 'product-8',
			'bed' => '3',
			'bath' =>'2',
			'size' => '1600 ft²',
		),	
		8 => array(
			'img-1' => 'resources/img/upload/room-1-2.jpg',
			'img-2' => 'resources/img/upload/product-1-5.jpg',
			'img-3' => 'resources/img/upload/product-2-1.jpg',
			'title' => 'International Towers',
			'address' => '2401-2499 E Fir St, Seattle, WA 98122, USA',
			'price-old' => '$340.000',
			'price-new' => '$330.000',
			'class' => 'product-9',
			'bed' => '3',
			'bath' =>'2',
			'size' => '1700 ft²',
		),	
		9 => array(
			'img-1' => 'resources/img/upload/room-1-1.jpg',
			'img-2' => 'resources/img/upload/product-1-5.jpg',
			'img-3' => 'resources/img/upload/product-2-1.jpg',
			'title' => 'Superior office space',
			'address' => ' 518-520 8th Ave, New York, NY 10018, USA',
			'price-old' => '$300.000',
			'price-new' => '$290.000',
			'class' => 'product-10',
			'bed' => '3',
			'bath' =>'2',
			'size' => '1500 ft²',
		),	
		
	)
?>


<?php  
	$owlInit = array(
		'items' =>  1,
		'margin' => 0,
		'loop' => true,
		'nav' => true,
		'dots' => true,
		'autoplay' => false,
	);
?>
<section class="all-product-panel">
	<div class="hd-filter">
		<div class="uk-container uk-container-center">
			<?php require_once 'common/filter.php'; ?>
			<div class="product-filter mb20 uk-visible-large">
				<div class="uk-flex uk-flex-middle uk-flex-space-between">
					<div class="filter-left uk-flex uk-flex-middle">
						<div class="name-filter">
							<i class="fa fa-sort-amount-asc mr5" aria-hidden="true"></i>
							Sort by:
						</div>
						<ul class="tabs uk-list">
							<li class="tab-link btn-tab current" data-type="newest" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>">Newest</li>
							<li class="tab-link btn-tab" data-type="popular" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>">Popular</li>
							<li class="tab-link btn-tab" data-type="htol" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>">Price (High to Low)</li>
							<li class="tab-link btn-tab" data-type="ltoh" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>">Price (Low to High)</li>
						</ul>
					</div>
					<ul class="tabs-2 uk-list">
						<li class="tab-link current" data-tab="column-3"><i class="fa fa-th" aria-hidden="true"></i></li>
						<li class="tab-link" data-tab="column-2"><i class="fa fa-th-large" aria-hidden="true"></i></li>
						<li class="tab-link" data-tab="column-1"><i class="fa fa-th-list" aria-hidden="true"></i></li>
					</ul>
				</div>
				
			</div>
			<div class="product-panel" id="ajax-list">
				<ul class="tabs-content">
					<li id="tab-1" class="tab-content current">
						<div class="uk-grid uk-grid-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-3 uk-clearfix">
							<?php require 'common/product.php'; ?>
						</div>
					</li>
					<div class="loading">
						<img src="resources/img/icon/ajax-loader (1).gif" alt="">
					</div>
					<div class="data-menu-product uk-grid uk-grid-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-3 uk-clearfix"></div>
				</ul>
				
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

<?php 
	$agent = array(
		0 => array(
			'img-1' => 'resources/img/upload/testi-1.jpg',
			'name' => 'Adam Jarod',
			'text' => 'We went down the lane, by the body of the man in black, sodden now from the overnight hail, and broke into the woods at the foot of the hill.',
			'email' => 'adam.jarod@tangibledesign.net ',
				

		),
		1 => array(
			'img-1' => 'resources/img/upload/testi-2.jpg',
			'name' => 'Truman Kenithit',
			'text' => 'We went down the lane, by the body of the man in black, sodden now from the overnight hail, and broke into the woods at the foot of the hill.',
			'email' => 'truman.kennith@tangibledesign.net',
		),
		2 => array(
			'img-1' => 'resources/img/upload/testi-3.jpg',
			'name' => 'Deniella Senior',
			'text' => 'We went down the lane, by the body of the man in black, sodden now from the overnight hail, and broke into the woods at the foot of the hill.',
			'email' => 'daniella.suzanne@tangibledesign.net ',
		),
		3 => array(
			'img-1' => 'resources/img/upload/testi-4.jpg',
			'name' => 'Vladimir Putin',
			'text' => 'We went down the lane, by the body of the man in black, sodden now from the overnight hail, and broke into the woods at the foot of the hill.',
			'email' => 'putin@tangibledesign.net ',
		),
	)
?>



<section class="our-agent-panel">
	<div class="uk-container uk-container-center">
		<div class="our-agent-title">
			<h2>our agents</h2>
		</div>
		<div class="owl-slide">
			<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
				<?php  $n=0;for($i = 1; $i <= 4 ; $i++){?>
					<div class="wrap-agent">
						<div class="agent-img">
							<a href="" class="img-cover">
								<img src="<?php echo $agent[$n]['img-1']?>" alt="">
							</a>
						</div>
						<div class="agent-content">
							<div class="name-agent mb20">
								<a href="">
									<h3><?php echo $agent[$n]['name']?></h3>
								</a>
							</div>
							<div class="text-agent mb10">
								<p><?php echo $agent[$n]['text']?></p>
							</div>
							<div class="organization mb10">
								<span>Organization:</span>
								My Home
							</div>

							<div class="mail-agent mb10">
								<a href="">
									<i class="fa fa-envelope-o mr5" aria-hidden="true"></i>
									<?php echo $agent[$n]['email']?>
								</a>
							</div>
							<div class="phone-agent mb10">
								<i class="fa fa-phone mr5" aria-hidden="true"></i>
								(123) 345-6789 	
							</div>
							<div class="uk-flex uk-flex-middle uk-flex-space-between uk-flex-wrap">
								<div class="uk-flex uk-flex-middle">
									<a href="" class="mr20">
										<i class="fa fa-facebook" aria-hidden="true"></i>
									</a>
									<a href="" class="mr20">
										<i class="fa fa-twitter" aria-hidden="true"></i>
									</a>
									<a href="" class="mr20">
										<i class="fa fa-linkedin" aria-hidden="true"></i>
									</a>
									<a href="" class="mr20">
										<i class="fa fa-instagram" aria-hidden="true"></i>
									</a>
								</div>
								<button class="btn-general btn-clear mr20">full profile</button>
							</div>
						</div>
					</div>
				<?php $n++; }  ?>
			</div>
		</div>
	</div>
</section>

<section class="featured-panel" class=" bg-white">
	<div class="uk-container uk-container-center">
		<div class="our-agent-title">
			<h2>FEATURED</h2>
		</div>

		<div class="uk-grid uk-grid-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-3 uk-clearfix mb30">
			<?php  $m=0;for($i = 1; $i <= 6 ; $i++){?>
				<div class="wrap-product <?php echo $home[$m]['class']?>">
					<div class="img-product">
						<div class="img-product-overlay">
							<a href="" class="img-cover">
								<img src="<?php echo $home[$m]['img-1']?>" alt="">
							</a>
						</div>
						<a href="#modal-signin" class="btn-heart btn-modal-general">
							<i class="fa fa-heart-o" aria-hidden="true"></i>		
						</a>
						<div class="for-rent">
							For rent
						</div>
					</div>
					<div class="product-content">
						<div class="product-title mb10">
							<a href="" title="">
								<h2><?php echo $home[$m]['title']?></h2>
							</a>
						</div>
						<div class="product-address mb10 italics">
							<i class="fa fa-street-view normal" aria-hidden="true"></i>
							<?php echo $home[$m]['address']?>
						</div>
						<div class="price uk-flex uk-flex-wrap mb10">
							<div class="old-price mr20">
								<?php echo $home[$m]['price-old']?>
							</div>
							<div class="new-price key-color">
								<?php echo $home[$m]['price-new']?>
							</div>
						</div>
						<div class="uk-flex uk-flex-middle uk-flex-wrap mb20">
							<div class="info-item mr20">
								<span>
									Bedroom: 

								</span>
								<?php echo $home[$m]['bed']?>
							</div>
							<div class="info-item mr20">
								<span>
									Bathroom:

								</span>
								<?php echo $home[$m]['bath']?>
							</div>
							<div class="info-item mr20">
								<span>
									Property size:
								</span>
								<?php echo $home[$m]['size']?>
							</div>
						</div>
						<div class="uk-flex uk-flex-middle uk-flex-space-between uk-flex-wrap uk-clearfix">
							<div class="product-time">
								3 years ago
							</div>
							<div class="product-compare">
								<a href="#compare" class="btn-modal-general">
									<i class="fa fa-files-o" aria-hidden="true"></i>
									COMPARE
								</a>
								
							</div>
							<button class="btn-general btn-clear">detail <i class="fa fa-angle-right ml5" aria-hidden="true"></i></button>
						</div>
					</div>
				</div>
				
			<?php  $m++; } ?>
		</div>
		<div class="wrap-btn text-center">	
			<button class="btn-key-color center white " >view all</button>
		</div>
	</div>
</section>

<section class="our-agent-panel">
	<div class="uk-container uk-container-center">
		<div class="our-agent-title">
			<h2>blog</h2>
		</div>
		<div class="owl-slide">
			<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
				<div class="wrap-blog ">
					<div class="img-product">
						<a href="" class="img-cover">
							<img src="resources/img/upload/city-1.jpg" alt="">
						</a>
						<div class="for-rent">
							September 30, 2017
						</div>
					</div>
					<div class="product-content bg-white uk-clearfix">
						<div class="product-title mb10">
							<a href="" title="">
								<h2>Renovating a Living Room? Experts Share Their Secrets </h2>
							</a>
						</div>
						<p>	We went down the lane, by the body of the man in black, sodden now from the overnight hail, and broke into the woods at the foot of the hill. We pushed through these towards...
						</p>
						<button class="btn-general btn-clear float-right">read more <i class="fa fa-angle-right ml5" aria-hidden="true"></i></button>
					</div>
				</div>
				<div class="wrap-blog ">
					<div class="img-product">
						<a href="" class="img-cover">
							<img src="resources/img/upload/city-2.jpg" alt="">
						</a>
						<div class="for-rent">
							September 30, 2017
						</div>
					</div>
					<div class="product-content bg-white uk-clearfix">
						<div class="product-title mb10">
							<a href="" title="">
								<h2>Interior design books for beginners </h2>
							</a>
						</div>
						<p>	We went down the lane, by the body of the man in black, sodden now from the overnight hail, and broke into the woods at the foot of the hill. We pushed through these towards...
						</p>
						<button class="btn-general btn-clear float-right">read more <i class="fa fa-angle-right ml5" aria-hidden="true"></i></button>
					</div>
				</div>
				<div class="wrap-blog ">
					<div class="img-product">
						<a href="" class="img-cover">
							<img src="resources/img/upload/city-3.jpg" alt="">
						</a>
						<div class="for-rent">
							September 30, 2017
						</div>
					</div>
					<div class="product-content bg-white uk-clearfix">
						<div class="product-title mb10">
							<a href="" title="">
								<h2>The Most Inspiring Interior Design Of 2016  </h2>
							</a>
						</div>
						<p>	We went down the lane, by the body of the man in black, sodden now from the overnight hail, and broke into the woods at the foot of the hill. We pushed through these towards...
						</p>
						<button class="btn-general btn-clear float-right">read more <i class="fa fa-angle-right ml5" aria-hidden="true"></i></button>
					</div>
				</div>
				<div class="wrap-blog ">
					<div class="img-product">
						<a href="" class="img-cover">
							<img src="resources/img/upload/room-1-4.jpg" alt="">
						</a>
						<div class="for-rent">
							September 30, 2017
						</div>
					</div>
					<div class="product-content bg-white uk-clearfix">
						<div class="product-title mb10">
							<a href="" title="">
								<h2>7 Instagram accounts for interior design enthusiasts  </h2>
							</a>
						</div>
						<p>	We went down the lane, by the body of the man in black, sodden now from the overnight hail, and broke into the woods at the foot of the hill. We pushed through these towards...
						</p>
						<button class="btn-general btn-clear float-right">read more <i class="fa fa-angle-right ml5" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="wrap-btn text-center">	
			<button class="btn-key-color center white " >visit blog</button>
		</div>
	</div>
</section>


<!-- ============================================================================ -->



<section>
	<?php  
		$owlInit = array(
			'items' =>  1,
			'margin' => 0,
			'loop' => true,
			'nav' => true,
			'dots' => true,
			'autoplay' => false,
		);
	?>
	<div id="modal-signin" class="modal">
		<div class="modal-content-review ">
			<div class="form-modal">
				<div class="title-signin bg-grey">
					Login
				</div>
				<div class="modal-signin-content">

					<div class="form-input-signin">
						<div class="text-input">
							USER NAME
						</div>
						<div class="input-signin">
							<input type="text" placeholder="Please enter Username...">
						</div>
					</div>
					<div class="form-input-signin">
						<div class="text-input">
							PASSWORD
						</div>
						<div class="input-signin">
							<input type="password" placeholder="Please enter Password...">
						</div>
					</div>
					<div class="g-recaptcha uk-flex uk-flex-center mb20" data-sitekey="6Lc746oZAAAAAL4lGVf3KucGdGQCBxUE90MZC3Ab"></div>
					<div class="btn btn-login mb10">
						<button class="btn-general btn-clear">Login </button>
					</div>
					<div class="forgot-pass">
						<a href="" class="sub-color">

							<i class="fa fa-question-circle" aria-hidden="true"></i>
							Forgot Password?
						</a>
					</div>
				</div>
			</div>

		</div>
	</div>
	<div id="compare" class="modal-full-width">
		<div class="modal-content-panel">
			<div class="uk-flex">

				<div class="compare-text mr20">
					COMPARE
				</div>
				<a href="#show-compare" class="btn-modal-general mr20">
					SHOW
				</a>
				<div class="btn-cancel">
					<button>
						CLEAR
					</button>
				</div>
			</div>
		</div>
	</div>
	<div id="show-compare" class="modal-full-width">
		<div class="modal-zoom-panel">
			<div class="uk-flex mb30">

				<div class="compare-text mr20">
					COMPARE
				</div>
				<a href="#compare" class="btn-hide mr20">
					HIDE
				</a>
				<div class="btn-cancel">
					<button>
						CLEAR
					</button>
				</div>
			</div>
			<div class="uk-grid uk-grid-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-2 uk-grid-width-large-1-3 uk-clearfix">
				<div class="wrap-product ">
					<div class="img-product">
						<div class="owl-slide">
							<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
								<a href="" class="img-cover">
									<img src="resources/img/upload/company-1.jpg" alt="">
								</a>
								<a href="" class="img-cover">
									<img src="resources/img/upload/company-2.jpg" alt="">
								</a>
								<a href="" class="img-cover">
									<img src="resources/img/upload/company-3.jpg" alt="">
								</a>
							</div>
						</div>
						<a href="#modal-signin" class="btn-heart btn-modal-general">
							<i class="fa fa-heart-o" aria-hidden="true"></i>		
						</a>
						
					</div>
					<div class="product-content">
						<div class="product-title mb10">
							<a href="" title="">
								<h2>Scandinavian style apartment</h2>
							</a>
						</div>
						<div class="product-address mb10 italics">
							<i class="fa fa-street-view normal" aria-hidden="true"></i>
							94-98 Ingraham St, Brooklyn, NY 11237, USA
						</div>
						<button class="btn-key-color white w100 mb10">$9.000 /month</button>
						
						<div class="info-item mr20 mb5">
							<span>
								Property type: 
							</span>
							<a href=""> Apartment</a>
						</div>
						<div class="info-item mr20 mb5">
							<span>
							Offer type:
							</span>
							<a href=""> For Rent</a>
						</div>
						<div class="info-item mr20 mb5">
							<span>
							City:
							</span>
							<a href="">New York</a>
						</div>
						<div class="info-item mr20 mb5">
							<span>
							Zip Code:
							</span>
							<a href="">10002</a>
						</div>
						<div class="info-item mr20 mb5">
							<span>
							Neighborhood:
							</span>
							<a href=""> Soho</a>
						</div>
						<div class="info-item mr20 mb5">
							<span>
							Street: 
							</span>
							<a href=""> NY Soho Street #2</a>
						</div>
						<div class="info-item mr20 mb5">
							<span>
							Bedrooms:
							</span>
							<a href=""> 3</a>
						</div>
						<div class="info-item mr20 mb5">
							<span>
							Bathrooms:
							</span>
							<a href=""> 3</a>
						</div>
						<div class="info-item mr20 mb5">
							<span>
							Property size: 
							</span>
							<a href=""> 2000 ft²</a>
						</div>
						<div class="info-item mr20 mb5">
							<span>
							Year:
							</span>
							<a href=""> 2017</a>
						</div>
						<div class="info-item mr20 mb5">
							<span>
							Features:
							</span>
							Air Conditioning , Attic , Balcony , Ceiling Fan , Garbage disposal , High ceilings , Patio , Porch , WiFi
						</div>
						<div class="detail">
							<a href="" class="text-center"><h4>DETAILS</h4></a>
						</div>
						<p>How the adventure ended will be seen anon. Aouda was anxious, though she said nothing. As for Passepartout, he thought Mr....</p>
						<div class="product-time text-right">
							3 years ago
						</div>
						<button class="btn-general btn-clear">more <i class="fa fa-angle-right ml5" aria-hidden="true"></i></button>
						
					
				</div>

			</div>
		</div>
	</div>

</section>


<?php  
	$owlInit = array(
		'items' =>  5,
		'margin' => 30,
		'loop' => true,
		'nav' => false,
		'dots' => false,
		'autoplay' => true,
		'autoplayTimeout' => 5000,
		'responsiveClass' =>true,
		'responsive' => array(
			0 => array(
				'items' => 2,
				'nav' => false
			),
			500 => array(
				'items' => 3,
				'nav' => false
			),
			768 => array(
				'items' => 4,
				'nav' => false
			),
			1024 => array(
				'items' => 5,
				'nav' => false
			),
		)
	);
?>
<section class="featured-panel" class=" bg-white">
	
	<div class="uk-container uk-container-center">
		<div class="our-agent-title">
			<h2>CLIENTS</h2>
		</div>
		<div class="owl-slide">
			<div class="owl-carousel owl-theme" data-owl="<?php echo base64_encode(json_encode($owlInit)); ?>" data-disabled="0">
				<div class="wrap-img-logo">
					<a href="" class="img-scaledown">
						<img src="resources/img/logo/audiojungle.webp" alt="">
					</a>
				</div>
				<div class="wrap-img-logo">
					<a href="" class="img-scaledown">
						<img src="resources/img/logo/codecanyon.webp" alt="">
					</a>
				</div>
				<div class="wrap-img-logo">
					<a href="" class="img-scaledown">
						<img src="resources/img/logo/graphicriver.webp" alt="">
					</a>
				</div>
				<div class="wrap-img-logo">
					<a href="" class="img-scaledown">
						<img src="resources/img/logo/photodune.webp" alt="">
					</a>
				</div>
				<div class="wrap-img-logo">
					<a href="" class="img-scaledown">
						<img src="resources/img/logo/themeforest.webp" alt="">
					</a>
				</div>
			</div>
		</div>
		
		
	</div>
</section>