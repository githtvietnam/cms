<?php 
	helper('mydatafrontend');
	$widget['data'] = widget_frontend();
	$system['system'] = get_general();
	$system['menu'] = $menu_header;
 ?>
<!DOCTYPE html>
<html lang="vi">
	<head>
		<!-- CONFIG -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="index,follow" />
		<meta name="copyright" content="GLEE HOME " />
		<meta name="author" content="Vanh Shoes">
		<meta http-equiv="refresh" content="1800" />

		<!-- GOOGLE -->
		<title>Kim Liên Travel</title>
		<meta name="description" content="One for all - All for one">
		<link rel="canonical" href="https://gleehome.com.vn/" />

		<!-- FACEBOOK -->
		<meta property="og:title" content="Thiết kế nội thất GleeHome - Sofa gỗ, bàn thờ đẹp tại Hà Nội" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="https://gleehome.com.vn/" />
		<meta property="og:url" content="https://gleehome.com.vn/" />
		<meta property="og:description" content="GleeHome - Công ty tư vấn thiết kế hoàn thiện nội thất. Luôn dẫn đầu về xu hướng thiết kế nội thất. Làm việc chuyên nghiệp, uy tín, chất lượng" />
		<meta property="og:site_name" content="GLEE HOME " />
		<meta property="fb:admins" content=""/>
		<meta property="fb:app_id" content="" />

		<!-- for Twitter -->
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:title" content="Thiết kế nội thất GleeHome - Sofa gỗ, bàn thờ đẹp tại Hà Nội" />
		<meta name="twitter:description" content="GleeHome - Công ty tư vấn thiết kế hoàn thiện nội thất. Luôn dẫn đầu về xu hướng thiết kế nội thất. Làm việc chuyên nghiệp, uy tín, chất lượng" />
		<meta name="twitter:image" content="https://gleehome.com.vn/" />

		<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
		<link href="public/frontend/resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
		<link href="public/frontend/resources/uikit/css/uikit.modify.css" rel="stylesheet" />
		<link href="public/frontend/resources/library/css/general.css" rel="stylesheet" />
		<link href="public/frontend/resources/library/css/carousel.css" rel="stylesheet" />
		<?php echo view('frontend/homepage/common/style', $widget) ?>


		<?php echo view('frontend/homepage/common/head') ?>
		<link href="public/frontend/resources/style.css" rel="stylesheet" />
		<script src="public/frontend/resources/library/js/jquery.js"></script>
		<script src="public/frontend/resources/uikit/js/uikit.min.js"></script>
	</head>
	<body>
		<?php echo view('frontend/homepage/common/header', $system) ?>
		<?php echo view((isset($template)) ? $template : '') ?>
		<?php echo view('frontend/homepage/common/footer') ?>
		<?php echo view('frontend/homepage/common/offcanvas') ?>


		<!-- Tao Widget -->

		<?php 
			foreach ($widget['data'] as $key => $value) {
				echo  str_replace("[phone]", isset($system['system']['contact_phone']) ? $system['system']['contact_phone'] : '', $value['html']);
				echo '<script>'.$value['script'].'</script>';
			}
		?>

		<script src="public/frontend/resources/plugins/OwlCarousel2-2.3.4/dist/owl.carousel.min.js"></script>
		<script src="public/frontend/resources/uikit/js/components/slideshow.min.js"></script>
		<script src="public/frontend/resources/function.js"></script>
		<script src="public/frontend/resources/plugins.js"></script>
	</body>
</html>
