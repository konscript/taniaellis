<?php get_header(); ?>

<div id="header">
	<p id="sub-heading">The <span>Social</span> Business Company &reg;</p>
	<p id="language-picker">
		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
	</p>

	<div class="clearer"></div>

	<div id="header-container">
		<?php wp_nav_menu(array(
				'theme_location'		=> 'about-menu',
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
				generated_dynamic_sidebar("News Single Left");
			?>
		</section>
		<section class="right-sidebar-single">
<div class="sidebar-background">
	<?php if(have_posts()): ?>
		<?php while(have_posts()): the_post(); ?>
			<div class="post-header">
				<h2 class="first-line">News From The</h2>
				<h2 class="second-line">Social Business Company</h2>
			</div>
     
			<div class="post news">
				<?php if(has_post_thumbnail()): ?>
					<div class="thumb-wrapper">
						<div class="thumb-container">
							<?php the_post_thumbnail('post-square-thumbnail', array('class' => 'featured-image')); ?>
						</div>
					</div> <!-- .thumb-cotnainer //-->
				<?php endif; // #if has_post_thumbnail ?>


				<div class="meta">
					<p class="byline">
						 <?php
                $byline = get_post_meta($post->ID, 'te_news-options-id', true);
                
                if($byline)
                  echo $byline;
                else
                  echo "By " . get_the_author();
              ?>
					</p>
					<p class="date">
						<?php the_time('j M Y'); ?>
					</p>
				</div>    
				<h2 class="title"><?php the_title(); ?></h2>
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
