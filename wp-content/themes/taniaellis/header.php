<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<title>Tania Ellis</title>
		<meta charset="utf-8" />
		
		<meta name="description" content="Social megatrends :: CSR and CSI :: social responsibility and social innovation :: ethics and meaning :: sustainable business :: leadership" />
		<meta name="keywords" content="" />
		<meta name="author" content="Tania Ellis" />
		
		<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url') ?>" />
		<link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/images/favicon.ico">
		<link rel="apple-touch-icon" href="<?php bloginfo('template_url') ?>/images/apple-touch.png" />
		
		<script src="<?php bloginfo('template_url') ?>/js/jquery.min.js"></script>
		<script src="<?php bloginfo('template_url') ?>/js/jquery.corner.js"></script>
		<script src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
		<!-- // <script src="<?php bloginfo('template_url') ?>/js/jquery.innerfade.js"></script> -->
		<script src="<?php bloginfo('template_url') ?>/js/rollfade.js"></script>
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
	
		
		
		
		<?php
			/* Always have wp_head() just before the closing </head>
			* tag of your theme, or you will break many plugins, which
			* generally use this hook to add elements to <head> such
			* as styles, scripts, and meta tags.
			*/
			wp_head();

		?>
	</head>
	
	<body>
	    <div id="page-wrapper">
    		<header>
    			<div id="header-top-container">
    			
            <!-- Retreive the searchbar from searchform.php -->
						<?php get_search_form(); ?>
					
    				<?php wp_nav_menu(array(
    					'theme_location'		=> 'navigation-top',
    					'container'				=> 'nav',
    					'menu_id'				=> 'navigation-top',
    					'menu_class'			=> ''
    				)); ?>
    				
            
    				<!-- <ul id="shop-link">
							<li>
    						<a href="javascript:void(0)">Shop</a>
    					</li>
						</ul> -->
						
						<?php
							wp_nav_menu(array(
								'theme_location'	=> 'shop-menu',
								'container'				=> 'false',
								'menu_id'					=> 'shop-link',
								'menu_class'			=> ''
							));
						?>
    			
					</div>
    			
    			<div id="header-menu-logo-container">
    			    
                    <?php wp_nav_menu(array(
                        'theme_location'        => 'navigation-pages',
                        'container'             => 'nav',
                        'menu_id'               => 'navigation-pages',
                        'menu_class'            => ''
                    )); ?>
    				<a href="<?php bloginfo('siteurl') ?>" id="logo"><img src="<?php bloginfo('template_url')?>/images/logo.png" /></a>
    				
            <!-- <a id="shop-link" href="javascript:void(0)">Shop</a> -->
    			</div>

    		</header>