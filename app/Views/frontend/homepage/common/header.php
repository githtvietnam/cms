<!-- PC HEADER -->
<!-- uk-visible-large -->
<header class="pc-header  uk-visible-large " >
	<div class="hd-upper">
		<div class="uk-container uk-container-center">
			<div class="hd-hotline">
				Hotline: 
				<span><?php echo $system['contact_phone'].' / '.$system['contact_hotline'] ?></span>
			</div>
		</div>
	</div>
	<div class="hd-middle">
		<div class="uk-container uk-container-center">
			<div class="uk-flex uk-flex-middle uk-flex-space-between">
				<div class="hd-logo">
					<a href="">
						<img src="public/frontend/resources/img/logo/kim-lien-travel-logo.png" alt="">
					</a>
				</div>
				<div class="hd-menu ">
					<nav id="main-nav">
						<ul class="uk-navbar-nav uk-clearfix main-menu">
							<li><a href="">trang chủ</a></li>
							<li>
								<a href="">giới thiệu</a>
								<div class="dropdown-menu">
									<ul class="uk-list submenu">
										<li><a href="" title="">Về Kim Liên Travel</a></li>
										<li><a href="" title="">Thành Tích - Giải Thưởng</a></li>
										<li><a href="" title="">Chính Sách</a></li>
										<li><a href="" title="">Quy Định Đặt Tour</a></li>
										<li><a href="" title="">Liên Hệ</a></li>
									</ul>
								</div>
							</li>
							<li><a href="">tour trong nước</a></li>
							<li><a href="">tour nước ngoài</a></li>
							<li>
								<a href="">Cẩm nang & tin tức</a>
								<div class="dropdown-menu">
									<ul class="uk-list submenu">
										<li><a href="" title="">Tin Kim Liên</a></li>
										<li><a href="" title="">Thông Tin Du Lịch</a></li>
										<li><a href="" title="">Khám Phá & Trải Nghiệm</a></li>
										<li><a href="" title="">Cẩm Nang Du Lịch</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</nav>
				</div>
				<div class="hd-cart">
					<a href=""><img src="public/frontend/resources/img/icon/icon-cart.png" alt="">
					<span class="quantity">0</span></a>
				</div>
			</div>
		</div>
	</div>
</header><!-- .header -->


<!-- MOBILE HEADER -->
<header class="mobile-header uk-hidden-large">
	<section class="upper">
		<a class="moblie-menu-btn skin-1" href="#offcanvas" class="offcanvas" data-uk-offcanvas="{target:'#offcanvas'}">
			<span>Menu</span>
		</a>
		<div class="logo"><a href="" title="Logo"><img src="public/frontend/resources/img/logo-hd.png" alt=""></a></div>
	</section>
	<!-- .upper -->
	<section class="lower">
		<div class="mobile-search">
			<form action="" method="" class="uk-form form">
				<input type="text" name="" class="uk-width-1-1 input-text" placeholder="Bạn muốn tìm gì hôm nay?" />
				<button type="submit" name="" value="" class="btn-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			</form>
		</div>
	</section>
</header>
<!-- .mobile-header -->

