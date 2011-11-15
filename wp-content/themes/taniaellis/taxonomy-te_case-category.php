<?php get_header(); ?>

<div id="header">
	
	<p id="sub-heading">The <span>Social</span> Business Company &reg;</p>
	<p id="language-picker">
		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
	</p>

	<div class="clearer"></div>

	<div id="header-container">
		<?php wp_nav_menu(array(
			'theme_location'		=> 'cases-menu',
			'container'				  => '',
			'menu_id'				    => 'navigation-header-standard',
			'menu_class'			  => 'navigation-header',
			'link_before'       => '<span>&nbsp;</span>'
			)); 
		?>
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

				<div class="post-header" id="case">
					<h2 class="first-line">Cases</h2>
					<h2 class="second-line"><?php echo $wp_query->queried_object->name; ?></h2>
				</div>
					
				<?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>                                
					<div class="post-feed">
    
						<!-- Fetch the client ID -->
						<?php $client_id = get_post_meta($post->ID, 'te_case-options-client-id', true); ?>
    
						<?php if(has_post_thumbnail($client_id)): ?>
							<div class="thumb-wrapper">
								<div class="thumb-container">
									<a href="<?php the_permalink(); ?>"><?php echo get_the_post_thumbnail($client_id, 'post-square-thumbnail', array("class" => "featured-image")); ?></a>
								</div>
							</div>
						<?php endif; ?>

						<p class="byline"><?php echo get_the_title($client_id); ?></p>
						<p class="date"><?php the_time('j F Y'); ?></p>

						<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            
						<div class="entry">
							<?php the_excerpt(); ?>
						</div>
            
						<div class="options">
							<a class="add-comment" href="<?php echo get_permalink($post->ID) . '#respond'; ?>">Add comment (<?php comments_number('0', '1', '%'); ?>)</a>
							<a class="read-more" href="<?php echo te_get_article_url($post->ID); ?>">Read more</a>                              
						</div>

					</div>
				<?php endwhile; ?>
    
				<div class="posts-nav-links">
					<?php posts_nav_link(' ', '« Previous Page', 'Next Page »'); ?>
				</div>
    
				<?php endif; ?>
          
				<div class="clearer"></div>
          
			</div>
		</section>

		<div class="clearer"></div>

	</div> <!-- #page -->

</div> <!-- #page-content -->

<?php get_footer(); ?>