<?php 
	helper('mydatafrontend');
	$widget['data'] = widget_frontend();
 ?>
<!DOCTYPE html>
<html lang="vi-VN">
	<head>
		<!-- CONFIG -->
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index,follow" />
		<meta name="author" content="<?php echo (isset($general['homepage_company'])) ? $general['homepage_company'] : ''; ?>" />
		<meta name="copyright" content="<?php echo (isset($general['homepage_company'])) ? $general['homepage_company'] : ''; ?>" />
		<meta http-equiv="refresh" content="1800" />

		<!-- GOOGLE -->
		<title><?php echo isset($meta_title)?htmlspecialchars($meta_title):'';?></title>
		<meta name="description" charset="UTF-8" content="<?php echo isset($meta_description)?htmlspecialchars($meta_description):'';?>" />
		<?php echo isset($canonical)?'<link rel="canonical" href="'.$canonical.'" />':'';?>
		<meta property="og:locale" content="vi_VN" />

		<!-- for Facebook -->
		<meta property="og:title" content="<?php echo (isset($meta_title) && !empty($meta_title))?htmlspecialchars($meta_title):'';?>" />
		<meta property="og:type" content="<?php echo (isset($og_type) && $og_type != '') ? $og_type : 'article'; ?>" />
		<meta property="og:image" content="<?php echo (isset($meta_image) && !empty($meta_image)) ? $meta_image : base_url(isset($general['homepage_logo']) ? $general['homepage_logo'] : ''); ?>" />
		<?php echo isset($canonical)?'<meta property="og:url" content="'.$canonical.'" />':'';?>
		<meta property="og:description" content="<?php echo (isset($meta_description) && !empty($meta_description))?htmlspecialchars($meta_description):'';?>" />
		<meta property="og:site_name" content="<?php echo (isset($general['homepage_company'])) ? $general['homepage_company'] : ''; ?>" />
		<meta property="fb:admins" content=""/>
		<meta property="fb:app_id" content="" />
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:title" content="<?php echo isset($meta_title)?htmlspecialchars($meta_title):'';?>" />
		<meta name="twitter:description" content="<?php echo (isset($meta_description) && !empty($meta_description))?htmlspecialchars($meta_description):'';?>" />
		<meta name="twitter:image" content="<?php echo (isset($meta_image) && !empty($meta_image))?$meta_image:base_url((isset($general['homepage_logo'])) ? $general['homepage_logo']  : '');?>" />


		<link href="public/frontend/resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
		<link href="public/frontend/resources/uikit/css/uikit.modify.css" rel="stylesheet" />
		<link href="public/frontend/resources/library/css/general.css" rel="stylesheet" />
		<link href="public/frontend/resources/library/css/carousel.css" rel="stylesheet" />
		<?php echo view('frontend/homepage/common/style', $widget) ?>


		<?php echo view('frontend/homepage/common/head') ?>
		<link href="public/frontend/resources/style.css" rel="stylesheet" />
		<script src="public/frontend/resources/library/js/jquery.js"></script>
		<script src="public/frontend/resources/uikit/js/uikit.min.js"></script>
		<script> var BASE_URL = '<?php echo base_url(); ?>'; </script>
	</head>
	<body>
		<?php echo view('frontend/homepage/common/header') ?>
		<?php echo view((isset($template)) ? $template : '') ?>
		<?php echo view('frontend/homepage/common/footer') ?>
		<?php echo view('frontend/homepage/common/offcanvas') ?>


		<!-- Tao Widget -->

		<?php 
			foreach ($widget['data'] as $key => $value) {
				echo  str_replace("[phone]", isset($general['contact_phone']) ? $general['contact_phone'] : '', $value['html']);
				echo '<script>'.$value['script'].'</script>';
			}
		?>

		<script src="public/frontend/resources/plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
		<script src="public/frontend/resources/uikit/js/components/slideshow.min.js"></script>
		<script src="public/frontend/resources/function.js"></script>
		<script src="public/frontend/resources/plugins.js"></script>
	</body>
</html>
