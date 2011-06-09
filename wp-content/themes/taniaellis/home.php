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
		
    		<div id="header-content">
				<p id="sub-heading">The <span>Social</span> Business Company</p>
				<p id="language-picker">
		    		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
				</p>
				
				<div class="clearer"></div>

				<div id="frontpage-header-container">    
				    <?php wp_nav_menu(array(
				        'theme_location' => 'social-business-menu',
				        'container' => false,
				        'menu_id' => 'social-business-menu',
				        'menu-class' => false,
				        'link_before' => '<span class="social">Social</span> Business <br><span class="term">',
				        'link_after' => '</span>'
				        )); 
				    ?>
    
	    			<div id="frontpage-header-content">
	        			<img id="intro-movie" src="<?php bloginfo('template_url'); ?>/images/header_frontpage_tania_telly.png" />
	        			<!-- Video goes here! -->
        
	        			<div class="header-quote">
	            			<h6>Heartcore business for social and economic value!</h6>
	            			<p id="header-quote-text">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
	
	            			<div id="read-more-signature">
	                			<a href="javascript:void(0)">Read more</a>
	            			</div>
	        			</div>
	
	        			<div id="newsletter-signup-box">
	            			<p id="header">
	                			<span id="social-business-trends">Social business trends</span>
	                			<span id="newsletter">Newsletter</span>
	            			</p>
	            			
							<p id="content">Sign up for my newsletter and get the FREE bonus guide along with monthly inspiration on social business and heartcore value. Sign up and I will email you the guide.</p>
	            			<a id="newsletter-signup-button" href="javascript:void(0)">Subscribe</a>
	        			</div>
	    			</div> <!-- #frontpage-header-content -->
				</div> <!-- #frontpage-header-container -->
				
				
			</div> <!-- #header-content -->
			
			<div class="clearer"></div>

			<div id="page-content">
				<div id="page">
					<section class="left-sidebar">
		    			<div class="widget-container">
		        			<div class="header-container">
		            			<h2 class="first-line">My Books</h2>
    		        			<h2 class="second-line">On Social Business</h2>
		        			</div>
		    			</div>
					</section>
					
					<section class="right-sidebar">
		    			Hej<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		    			Hej<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		    			Hej<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		    			Hej<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		    			Hej<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
					</section>
					
					<div class="clearer"></div>
					
				</div> <!-- #page -->
				
			</div> <!-- #page-content -->
			
		</div> <!-- #page-wrapper -->
		
    	<footer>
  			<ul id="footer-bar">
  			    <li>Address: Larsbjornsstraede 13, 1454 Copenhagen</li>
  			    <li>T: +45 3214 2295</li>
  			    <li>M: +45 2625 2295</li>
  			    <li>E-mail: te[at]taniaellis[dot]dk</li>
  			    <li>www.taniaellis.dk</li>
  			</ul>
  			<a href="http://www.ingenco2.dk/" target="_blank" id="co2-link"><img src="<?php bloginfo('template_url') ?>/images/co2_neutral_website.png" alt="CO2 neutral hjemmeside" /></a>
      	</footer>
	</body>
</html>