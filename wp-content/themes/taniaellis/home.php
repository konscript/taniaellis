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



	<?php wp_nav_menu(array(
	    'theme_location' => 'social-business-menu',
	    'container' => false,
	    'menu_id' => 'social-business-menu',
	    'menu-class' => false,
	    'link_before' => '<span class="social">Social</span> Business <br><span class="term">',
	    'link_after' => '</span>'
	    )); 
	?>

</div>
<div class="clearer"></div>

<div id="page-content">
	<div id="page">
		<section id="right-sidebar">
			<?php if(function_exists('dynamic_sidebar')) dynamic_sidebar(1); ?>
		</section>
		<section id="left-sidebar">
			<?php if(function_exists('dynamic_sidebar')) dynamic_sidebar(2); ?>
		</section>
	</div>
</div>

<?php get_footer(); ?>