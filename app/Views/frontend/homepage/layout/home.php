<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Vanh Shoes</title>

		<link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
		<link href="resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
		<link href="resources/uikit/css/uikit.modify.css" rel="stylesheet" />
		<link href="resources/library/css/reset.css" rel="stylesheet" />
		<link href="resources/library/css/ionicons.min.css" rel="stylesheet" />
		<link href="resources/library/css/library.css" rel="stylesheet" />

		<?php echo view('frontend/homepage/common/head') ?>

		<link href="resources/style.css" rel="stylesheet" />
		<script src="resources/library/js/jquery.js"></script>
		<script src="resources/uikit/js/uikit.min.js"></script>
	</head>
	<body>
		<?php echo view('frontend/homepage/common/header') ?>


		<?php echo view('frontend/homepage/common/body') ?>




		<?php echo view('frontend/homepage/common/footer') ?>
		<?php echo view('frontend/homepage/common/offcanvas') ?>
		<?php echo view('frontend/homepage/common/script') ?>
		<script src="resources/function.js"></script>
		<script src="resources/plugins.js"></script>
		<script src="resources/library/js/library.js"></script>
	</body>
</html>