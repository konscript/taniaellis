		<?php

/*
		    Template Name: Home
*/
		    get_header(); 
		?>
	
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
	            <p id="header-quote-text">
	Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
	            </p>
	            <div id="read-more-signature">
	                <a href="javascript:void(0)">Read more</a>
	            </div>
	        </div>
	        <div id="newsletter-signup-box">
	            <p id="header">
	                <span id="social-business-trends">Social business trends</span>
	                <span id="newsletter">Newsletter</span>
	            </p>
	            <p id="content">
	                Sign up for my newsletter and get the FREE bonus guide along with monthly inspiration on social business and heartcore value. Sign up and I will email you the guide.            
	            </p>
	            <a id="newsletter-signup-button" href="javascript:void(0)">Subscribe</a>
	        </div>
	    </div>
	</div>
	<div class="clearer"></div>
</div>

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
		    Hej
		</section>
		<div class="clearer"></div>
	</div>
</div>

<?php get_footer(); ?>



































































