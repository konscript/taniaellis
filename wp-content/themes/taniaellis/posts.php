<?php
/*
	Template Name: All Blog Posts
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
	  	'theme_location' 	=> 'blog-menu',
			'menu_class'		=> 'navigation-header',
			'menu_id'			=> 'navigation-header-standard',
			'link_before'		=> '<span>&nbsp;</span>'
		)); ?>
		
	</div> <!-- #header-container -->
</div> <!-- #header -->

<div class="clearer"></div>

<div id="page-content-single">
	<div id="page">
	  
		<?php @include("partials/social-bar.php"); ?>
	  
		<section class="left-sidebar">
			<?php if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Blog Category Left"); ?>
		</section>
	
		<section class="right-sidebar-single">
			<div class="sidebar-background">
				<div class="post-header">
          <h2 class="first-line">Blog</h2>
          <h2 class="second-line">All Blog Posts</h2>
        </div>
				<?php if(have_posts()): ?>
					<div class="widget widget-blog noicon">
						<?php query_posts(array('post_type' => 'post', 'post_status' => 'publish', 'paged' => $paged)); ?>
						<?php while(have_posts()): the_post(); ?>                                
							<div class="item blog">
								<div class="item-content">
									<?php if(has_post_thumbnail($post->ID)): ?>
										<div class="thumb-wrapper">
											<div class="thumb-container">
												<?php the_post_thumbnail('post-wide-thumbnail', array('class' => 'featured-image')); ?>
											</div>
										</div> <!-- .thumb-cotnainer //-->
									<?php endif; // #if has_post_thumbnail ?>
								
									<p class="meta-data"><?php the_time('j M Y'); ?></p>

									<span class="by-line">
										<?php
											$categories = get_the_category();
											if(count($categories) > 0) {
												echo $categories[0]->name;
											}
										?>
									</span>

									<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<p class="excerpt"><?php the_excerpt_rss(); ?></p>

									<div class="options">
										<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
									</div>

									<div class="clearer"></div>
								</div> <!-- .item.content //-->
							</div> <!-- .item .blog //-->
						 <?php endwhile; // # while have_posts() ?>
					</div> <!- .widget .widget-blog //-->
					<div class="posts-nav-links">
            <?php posts_nav_link(' ', '« Previous Page', 'Next Page »'); ?>
          </div>
				<?php endif; // # if have_posts() ?>
				 
			</div> <!-- .sidebar-background //-->
		</section> <!-- .right-sidebar-single //-->
	
		<div class="clearer"></div>
	</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>