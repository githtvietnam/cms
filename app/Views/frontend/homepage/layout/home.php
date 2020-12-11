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
		<title>Vanh Shoes</title>
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


		<link href="resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
		<link href="resources/uikit/css/uikit.modify.css" rel="stylesheet" />
		<link href="resources/library/css/reset.css" rel="stylesheet" />
		<link href="resources/library/css/library.css" rel="stylesheet" />
		<link rel="stylesheet" href="resources/plugins/OwlCarousel2-2.3.4/dist/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="resources/plugins/OwlCarousel2-2.3.4/dist/assets/owl.theme.default.min.css">


		<?php echo view('frontend/homepage/common/head') ?>
		<link href="resources/style.css" rel="stylesheet" />
		<script src="resources/library/js/jquery.js"></script>
		<script src="resources/uikit/js/uikit.min.js"></script>
	</head>
	<body>
		<?php echo view('frontend/homepage/common/header') ?>
		<?php echo view((isset($template)) ? $template : '') ?>
		<?php echo view('frontend/homepage/common/footer') ?>
		<?php echo view('frontend/homepage/common/offcanvas') ?>

		<script src="resources/function.js"></script>
		<script src="resources/plugins.js"></script>
	</body>
</html>
