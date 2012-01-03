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
					<h2 class="second-line"><?php echo $wp_query->queried_object->name; ?></h2>
				</div>
				
				<?php $clients = get_posts(array('post_type' => 'te_client', 'post_status' => 'publish', 'numberposts' => -1)); ?>
				
				<?php foreach($clients as $key => $client): ?>
					<div class="client">
						<div class="thumb-wrapper">
							<div class="thumb-container">
								<?php echo get_the_post_thumbnail($client->ID); ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
  
				<div class="clearer"></div>
      
			</div>
		</section>

		<div class="clearer"></div>

	</div> <!-- #page -->

</div> <!-- #page-content -->

<?php get_footer(); ?>