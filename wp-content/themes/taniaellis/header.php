<!DOCTYPE>
<html>
	<head>
		<title>Tania Ellis</title>
		<meta charset="utf-8" />
		
		<meta name="description" content="Social megatrends :: CSR and CSI :: social responsibility and social innovation :: ethics and meaning :: sustainable business :: leadership" />
		<meta name="keywords" content="" />
		<meta name="author" content="Tania Ellis" />
		
		<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url') ?>" />
		
		<script src="<?php bloginfo('template_url') ?>/js/eCSStender.js"></script>
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
	
	<body>
		<header>
			<div id="header-top-container">
				<?php wp_nav_menu(array(
					'theme_location'		=> 'navigation-top',
					'container'				=> 'nav',
					'menu_id'				=> 'navigation-top',
					'menu_class'			=> ''
				)); ?>
				<div id="search"></div>
			</div>
			<div id="header-menu-logo-container">
				<div id="logo"></div>
				<?php wp_nav_menu(array(
					'theme_location'		=> 'navigation-pages',
					'container'				=> 'nav',
					'menu_id'				=> 'navigation-pages',
					'menu_class'			=> ''
				)); ?>
			</div>

		</header>
		
		<content>