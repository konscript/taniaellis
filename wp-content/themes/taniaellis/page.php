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
		<?php
		
		$menu_id = get_post_meta($post->ID, 'te_page-menu-id', true);
		?>
		<?php wp_nav_menu(array(
				'menu'							=> $menu_id,
				'container'				  => '',
				'menu_id'				    => 'navigation-header-standard',
				'menu_class'			  => 'navigation-header',
				'link_before'       => '<span>&nbsp;</span>'
				)); ?>
	</div> <!-- #header-container -->
</div> <!-- #header --> 

<div class="clearer"></div>

<div id="page-content-single">
	<div id="page">
		<?php @include("partials/social-bar.php"); ?>
		<section class="left-sidebar">
			<?php 
			generated_dynamic_sidebar("Left Sidebar");
			?>
		</section>
		<section class="right-sidebar-single">
			<div class="sidebar-background">
				<?php generated_dynamic_sidebar("Right Sidebar"); ?>
			</div>
		</section>
		<div class="clearer"></div>
	</div>
</div>
<?php get_footer(); ?>