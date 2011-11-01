<?php get_header(); 
/*
Template Name: All Events
*/
?>

<div id="header">
	<p id="sub-heading">The <span>Social</span> Business Company &reg;</p>
	<p id="language-picker">
		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
	</p>

	<div class="clearer"></div>

	<div id="header-container">
		<?php wp_nav_menu(array(
				'theme_location'		=> 'events-menu',
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
			if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Events Single Left");
			?>
		</section>
		<section class="right-sidebar-single">
			<div class="sidebar-background">
				<div class="post-header">
					<h2 class="first-line">All</h2>
					<h2 class="second-line">Events</h2>
				</div>
				
				<?php 
				query_posts(array(
					'post_type'		=> 'te_event',
					'orderby'			=> 'meta_value',
					'meta_key'		=>'te_event-options-start-date',
					'order'				=> 'DESC',
					'post_status' => 'publish',
					'paged' => $paged,
				)); ?>
 				<?php if(have_posts()): ?>
 					<?php while(have_posts()): the_post(); ?>                                
   					<div class="post-feed event">
     					<?php if(has_post_thumbnail(get_the_ID())) : ?>
					      <div class="thumb-wrapper">
					        <div class="thumb-container">
										<a href="<?php the_permalink(); ?>">
					          	<?php the_post_thumbnail('post-square-thumbnail', array('class' => 'featured-image')); ?>
										</a>
					        </div>
					      </div>
					    <?php endif; ?>

       			<p class="date">
							<?php
								$start = get_event_start(get_the_ID());
								$end = get_event_end(get_the_ID());
							?>
							<span>Event Date:</span>
							<?php 
								
								if($start != '' && $end != '')
									echo date_format($start, 'j M Y H:i') . " - " . date_format($end, 'j M Y H:i'); 
							
							?>
       			</p>

						<p class="byline">&nbsp;</p>
       
     				<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
     				
						<div class="entry">
       				<?php the_excerpt(); ?>
     				</div>

     				<p class="read-more">
							<a href="<?php echo te_get_article_url($post->ID); ?>">Read more</a>                              
			      </p> 
   				</div>
 				<?php endwhile; ?>
				<div class="posts-nav-links">
          <?php posts_nav_link(' ', '« Previous Page', 'Next Page »'); ?>
        </div>
 			<?php endif; ?>
 		</div>
		
	</section>
		
	<div class="clearer"></div>
</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>
