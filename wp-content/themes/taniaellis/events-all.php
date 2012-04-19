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
	  		<?php

	  			// Fetch the pages ID
	  			$page_id = $wp_query->post->ID;

          $post_meta['first-line']  = get_post_meta($page_id, 'te_page-text-title-first-line', true);
          $post_meta['second-line'] = get_post_meta($page_id, 'te_page-text-title-second-line', true);
          $post_meta['title-icon']  = get_post_meta($page_id, 'te_page-text-title-icon', true);
          $post_meta['lead-text']   = get_post_meta($page_id, 'te_page-text-lead-paragraph-text', true);
          $post_meta['left-meta']   = get_post_meta($page_id, 'te_page-text-meta-left', true);
          $post_meta['right-meta']  = get_post_meta($page_id, 'te_page-text-meta-right', true);

          if(empty($post_meta['first-line']))
          	$post_meta['first-line'] = 'Events';
         	if(empty($post_meta['second-line']))
          	$post_meta['second-line'] = 'All Evevnts';
        ?>

          <!-- The following way to add the correct icon to the header is a bit of a hack, but it is easy! Should this be changed? -->
          <?php
            $style = '';
            if($post_meta['title-icon']) {
              $style = 'background: url(' . $post_meta['title-icon'] . ') top left no-repeat;';
            }
          ?>
          <div class="post-header" style="<?php echo $style; ?>">
            <h2 class="first-line"><?php echo $post_meta['first-line']; ?></h2>
            <h2 class="second-line"><?php echo $post_meta['second-line']; ?></h2>
            <?php if(!empty($post_meta['lead-text'])): ?>
            	<p class="lead-text"><?php echo $post_meta['lead-text']; ?></p>
            <?php endif; ?>
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
