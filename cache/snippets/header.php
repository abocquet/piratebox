<!DOCTYPE html>
<html manifest="pirate.appcache">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="css/style.css"> 
		<title><?php echo $config["h1"]; ?></title>
	</head>
	<body>

		<script src="js/jquery.min.js"></script>
		<!-- <script src="js/tinynav.min.js"></script> -->
		<script src="js/tinynav.js"></script>

		<header>
			<div>
				<h1><?php echo $config["h1"]; ?></h1>
				<h2><?php echo $config["h2"]; ?></h2>
			</div>

			<nav><?php echo $navbar; ?></nav>
		</header>

		<section>