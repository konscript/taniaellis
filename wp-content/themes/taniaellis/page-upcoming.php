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
		<?php @include("partials/social-bar.php"); ?>
		<section class="left-sidebar">
			<?php 
			if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Left Sidebar");
			?>
		</section>
		<section class="right-sidebar-single">
			<?php
			
			$post_meta['first-line']  = get_post_meta($post->ID, 'te_page-text-title-first-line', true);
      $post_meta['second-line'] = get_post_meta($post->ID, 'te_page-text-title-second-line', true);
      $post_meta['title-icon']  = get_post_meta($post->ID, 'te_page-text-title-icon', true);
      $post_meta['lead-text']   = get_post_meta($post->ID, 'te_page-text-lead-paragraph-text', true);
				
			?>
		
			<div class="sidebar-background">
        <?php
          $style = '';
          if($post_meta['title-icon']) {
            $style = 'background: url(' . $post_meta['title-icon'] . ') top left no-repeat;';
          }
        ?>
				<div class="post-header" style="<?php echo $style; ?>">
					<h2 class="first-line"><?php echo $post_meta['first-line']; ?></h2>
					<h2 class="second-line"><?php echo $post_meta['second-line']; ?></h2>
					<?php if(!empty($post_meta['lead-text'])) : ?>
						<p class="lead-text"><?php echo $post_meta['lead-text']; ?></p>
					<?php endif; ?>
				</div>
				
				<?php 
				$time = date_format(new DateTime(), 'Y/m/d');
				
				$query = new WP_Query(array(
					'post_type'		=> 'te_event',
					'orderby'			=> 'meta_value',
					'meta_key'		=>'te_event-options-start-date',
					'order'				=> 'DESC',
					'meta_query'	=> array(
						array(
							'key'	=> 'te_event-options-end-date',
							'value'	=> $time,
							'compare'	=> '>'
						),
					),
					'post_status' => 'publish',
					'paged' => $paged,
					'posts_per_page'	=> 10
				)); ?>
 				<?php if($query->have_posts()): ?>
 					<?php while($query->have_posts()): $query->the_post(); ?>                                
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
							<span>Event Date:</span> <?php echo date_format($start, 'j M Y H:i') . " - " . date_format($end, 'j M Y H:i'); ?>
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
				<div class="widget-view-all">
					<a href="<?php echo get_permalink(get_page_by_path('events/all')); ?>">View more events</a>
				</div>
 			<?php endif; ?>
 		</div>
	</section>
		
	<div class="clearer"></div>
</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>
