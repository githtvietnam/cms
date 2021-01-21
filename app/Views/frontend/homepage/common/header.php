<!-- PC HEADER -->
<!-- uk-visible-large -->

<?php
	helper(['mydatafrontend','mydata']);
	$baseController = new App\Controllers\FrontendController();
    $language = $baseController->currentLanguage();
	$menu_header =  menu_header($language);
	$slide_banner =  slide($language);
	$languageList = get_data([
		'select' => 'id, title, image, canonical',
		'table' => 'language',
		'where' => [
			'deleted_at' => 0,
			'publish' => 1
		],
		'order_by' => 'order desc, id desc'
	], TRUE);
 ?>
<header class="pc-header  uk-visible-large " >
	<div class="hd-upper">
		<div class="uk-container uk-container-center">
			<div class="uk-flex uk-flex-middle uk-flex-space-between">
				<div class="hd-hotline">
					Hotline:
					<span><?php echo ((isset($general['contact_phone'])) ? $general['contact_phone'] : '').((isset($general['contact_hotline'])) ? ' / '.$general['contact_hotline'] : '') ?></span>
				</div>
				<?php if(isset($languageList) && is_array($languageList) && count($languageList)){ ?>
				<div class="language-widget">
					<?php foreach($languageList as $key => $val){ ?>
					<a href="" data-keyword="<?php echo $val['canonical'] ?>" class="language_widget" onclick="return false;" title="<?php echo $val['title'] ?>"><img src="<?php echo $val['image']; ?>"  style="max-width:25px;height:15px;" alt="<?php echo $val['title'] ?>"></a>
					<?php } ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="hd-middle">
		<div class="uk-container uk-container-center">
			<div class="uk-flex uk-flex-middle uk-flex-space-between">
				<<?php echo ((isset($home)) ? 'h1' : 'div') ?> class="hd-logo">
					<a href="" title="logo">
						<?php echo render_img($general['homepage_logo'],$general['homepage_brand']) ?>
					</a>
				</<?php echo ((isset($home)) ? 'h1' : 'div') ?>>
				<div class="hd-menu ">
					<nav id="main-nav">
						<ul class="uk-navbar-nav uk-clearfix main-menu">
							<?php if(isset($menu_header) && is_array($menu_header) && count($menu_header)){ ?>
								<?php echo render_menu_frontend($menu_header['data']); ?>
							<?php } ?>
						</ul>
					</nav>
				</div>

			</div>
		</div>
	</div>

	<section class="slide-panel">
		<?php if(isset($slide_banner)){
			echo $slide_banner;
		} ?>
	</section>

</header><!-- .header -->


<!-- MOBILE HEADER -->
<header class="mobile-header uk-hidden-large">
	<section class="upper">
		<a class="moblie-menu-btn skin-1" href="#offcanvas" class="offcanvas" data-uk-offcanvas="{target:'#offcanvas'}">
			<span>Menu</span>
		</a>
		<div class="logo"><a href="" title="Logo"><?php echo render_img($general['homepage_logo'],$general['homepage_brand']) ?></a></div>
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
