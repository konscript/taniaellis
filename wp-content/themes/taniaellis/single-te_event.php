<?php get_header(); ?>

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
		<div id="social-bar">
			<ul>
				<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_youtube.png" alt="YouTube" title="YouTube" /></a></li>
				<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_rss.png" alt="RSS" title="RSS" /></a></li>
				<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_twitter.png" alt="Twitter" title="Twitter" /></a></li>
				<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_facebook.png" alt="Facebook" title="Facebook" /></a></li>
				<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_fairpages.png" alt="Fairpages" title="Fairpages" /></a></li>
			</ul>
		</div>
		<section class="left-sidebar">
			<?php 
			if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Events Single Left");
			?>
		</section>
		<section class="right-sidebar-single">
			
<div class="sidebar-background">
	<?php if(have_posts()): ?>
		<?php while(have_posts()): the_post(); ?>
			<div class="post-header">
				<h2 class="first-line">Upcoming</h2>
				<h2 class="second-line">Events</h2>
			</div>
     
			<div class="post">
				<p class="date">
				
				<?php the_post_thumbnail('post-wide-image', array('class' => 'featured-image')); ?>
					<?php
						
						$id = get_the_ID();
						$start_date = get_post_meta($id, 'te_event-options-start-date', true);
						$start_time = get_post_meta($id, 'te_event-options-start-time', true);
						
						$start =  new DateTime($start_date . ' ' . $start_time);
						
						$end_date = get_post_meta($id, 'te_event-options-end-date', true);
						$end_time = get_post_meta($id, 'te_event-options-end-time', true);
						
						if($end_date != "" && $end_time != "")
							$end = new DateTime($end_date . ' ' . $end_time);
						else
							$end = NULL;
						
						echo date_format($start, 'j M Y H:i');
						
						if($end)
							echo " - " . date_format($end, 'j M Y H:i');
					
					?>
				</p>
				<div class="meta">
					<p class="byline">
						<?php echo $category[0]->cat_name; ?>
					</p>
				</div>    
				<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<div class="entry">
					<?php the_content(); ?>
				</div>
			</div>
			
			<div class="clearer"></div>

			<?php if(has_category() || has_tag()) : ?>
				<div class="post-identification">
					<?php if(has_category()) : ?>
						<p class="post-categories">
							Posted in | <?php the_category('&nbsp;|&nbsp;'); ?>
						</p>
					<?php endif; ?>
						<?php if(has_tag()) : ?>
							<p class="post-tags">
								<?php the_tags('Tagged |&nbsp;', '&nbsp;|&nbsp;'); ?>
							</p>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			
			<?php 
			//if(function_exists('the_ratings')) { the_ratings(); } 
			?>
                                                                
			<?php endwhile; ?>
    <?php endif; ?>
     
     <div class="clearer"></div>
     
     <?php comments_template(); ?>
 </div>
</section>

		<div class="clearer"></div>

	</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>
