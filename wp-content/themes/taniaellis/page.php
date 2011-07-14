<?php

/*
    Template Name: Page
*/
    get_header(); 
?>

<div id="header">
	<p id="sub-heading">The <span>Social</span> Business Company &reg;</p>
	<p id="language-picker">
		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
	</p>
	
	<div class="clearer"></div>

	<div id="header-container">
		
		<?php wp_nav_menu(array(
	        'theme_location' 	=> 'blog-menu',
			'menu_class'		=> 'navigation-header',
			'menu_id'			=> 'navigation-header-standard',
			'link_before'		=> '<span>&nbsp;</span>'
	        )); 
	    ?>
		<div class="header-content">
			<div class="left-column">
				<div class="header-title">
		            <h2 class="first-line"></h2>
			        <h2 class="second-line"></h2>
		        </div>
		

			</div>
			<div class="right-column">
				<div class="header-right-box">
					<h2>In the reading room you can sit back and read about lorem ipsum</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>

					<a class="join" href="#">Read more</a>
				</div>
			</div>

		</div> <!-- .header-content -->
	</div> <!-- #.header-container -->
	
	
</div> <!-- #header -->

<div class="clearer"></div>

<div id="page">
	<section id="left-sidebar">
	</section>
	<section id="right-sidebar">

	</section>
</div>


<?php get_footer(); ?>