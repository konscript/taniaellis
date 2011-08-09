<?php get_header(); ?>

<div id="header">
	<p id="sub-heading">The <span>Social</span> Business Company</p>
	<p id="language-picker">
		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
	</p>

	<div class="clearer"></div>

	<div id="header-container">
		<?php wp_nav_menu(array(
			'theme_location'		=> 'reading-room-menu',
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
			//if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Left Sidebar"); 
			generated_dynamic_sidebar("Blog Single Left");
			?>
		</section>
		<section class="right-sidebar-single">
			<div class="sidebar-background">
				<?php if(have_posts()): ?>
					<?php while(have_posts()): the_post(); ?>
	                    <div class="post-header">
	                      <h2 class="first-line">Blog</h2>
	                      <h2 class="second-line"><?php the_category(', '); ?></h2>
	                    </div>
                    
	                    <div class="post">
							<?php
	                          the_post_thumbnail('post-wide-image', array('class' => 'featured-image'));
	                        ?>
	                      <div class="meta">
	                        <p class="byline">
	                          <?php the_category(', '); ?>
	                        </p>
	                        <p class="date">
	                          <?php the_date('F j Y'); ?>
	                        </p>
	                      </div>    
	                      <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	                      <div class="entry">
	                        <?php the_content(); ?>
	                      </div>
	                    </div>
	                    <div class="clearer"></div>
                    
	                    <p class="post-categories">
							Posted in | <?php the_category('&nbsp;|&nbsp;'); ?>
	                    </p>
	                    <p class="post-tags">
							<?php the_tags('Tagged |&nbsp;', '&nbsp;|&nbsp;'); ?>
	                    </p>
                    
                    
	                  <?php endwhile; wp_reset_query(); ?>
                  <?php endif; ?>
                  
                  <div class="clearer"></div>
                  
                  <?php comments_template(); ?>
			</div>
		</section>

		<div class="clearer"></div>

	</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>
