<?php
/*
Template Name: All Clients
*/
?>

<?php get_header(); ?>

<div id="header">
	<p id="sub-heading">The <span>Social</span> Business Company &reg;</p>
	<p id="language-picker">
		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
	</p>

	<div class="clearer"></div>

	<div id="header-container">
		<?php wp_nav_menu(array(
			'theme_location'	=> 'cases-menu',
			'container'				=> '',
			'menu_id'					=> 'navigation-cases',
			'menu_class'			=> 'navigation-header',
			'link_before'			=> '<span>&nbsp;</span>'
		)); ?>
	</div> <!-- #header-container -->

</div> <!-- #header --> 

<div class="clearer"></div>

<div id="page-content-single">
	<div id="page">
		<?php @include("partials/social-bar.php"); ?>
		<section class="left-sidebar">
			<?php if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Left Sidebar"); ?>
		</section>

		<section class="right-sidebar-single">
			<div class="sidebar-background">
  
				<div class="post-header" id="clients">
					<h2 class="first-line">Clients</h2>
					<h2 class="second-line">All Clients</h2>
				</div>
				
				<?php query_posts(array('post_type' => 'te_client', 'post_status' => 'publish')); ?>
				<?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>
					<div class="client">
						<div class="thumb-wrapper">
							<div class="thumb-container">
								<?php the_post_thumbnail(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php endif; ?>
  
				<div class="clearer"></div>
      
			</div>
		</section>

		<div class="clearer"></div>

	</div> <!-- #page -->

</div> <!-- #page-content -->

<?php get_footer(); ?>