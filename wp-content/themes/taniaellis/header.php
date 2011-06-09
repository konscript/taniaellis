<!DOCTYPE>
<html>
	<head>
		<title>Tania Ellis</title>
		<meta charset="utf-8" />
		
		<meta name="description" content="Social megatrends :: CSR and CSI :: social responsibility and social innovation :: ethics and meaning :: sustainable business :: leadership" />
		<meta name="keywords" content="" />
		<meta name="author" content="Tania Ellis" />
		
		<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url') ?>" />
		
		<script src="<?php bloginfo('template_url') ?>/js/jquery.min.js"></script>
		<script src="<?php bloginfo('template_url') ?>/js/jquery.corner.js"></script>
		<script src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
		
		<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<script type="text/javascript">
		if(!Modernizr.borderradius) {
			$("#social-business-menu li a").corner("round 10px");
			$("#frontpage-header-content").corner("round 10px");
			$("#newsletter-signup-box").corner("round top 10px");
			$("#newsletter-signup-box").corner("round br 10px cc:#fff");
			$("#social-bar").corner("round bl 10px cc:#fff");
			$("#newsletter-signup-button").corner("round 5px");
			
		}
		</script>
	</head>
	
	<body>
	    <div id="page-wrapper">
    		<header>
    			<div id="header-top-container">
					<form method="get" action="<?php bloginfo('siteurl') ?>/search/">
						<input type="submit" value="" />    			    	
						<input type="text" name="searchbar" value="" id="searchbar" />
						
					</form>
    				<?php wp_nav_menu(array(
    					'theme_location'		=> 'navigation-top',
    					'container'				=> 'nav',
    					'menu_id'				=> 'navigation-top',
    					'menu_class'			=> ''
    				)); ?>
    			</div>
    			
    			<div id="header-menu-logo-container">
    			    
                    <?php wp_nav_menu(array(
                        'theme_location'        => 'navigation-pages',
                        'container'             => 'nav',
                        'menu_id'               => 'navigation-pages',
                        'menu_class'            => ''
                    )); ?>
    				<img id="logo" src="<?php bloginfo('template_url')?>/images/logo.png" />
    				<a id="shop-link" href="javascript:void(0)">Shop</a>
    			</div>

    		</header>