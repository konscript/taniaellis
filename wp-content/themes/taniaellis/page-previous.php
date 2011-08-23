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
			if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Events Single Left");
			?>
		</section>
		<section class="right-sidebar-single">
			<div class="sidebar-background">
				<div class="post-header">
					<h2 class="first-line">Previous</h2>
					<h2 class="second-line">Events</h2>
				</div>
				
				<?php 
				$time = time() + ( get_option( 'gmt_offset' ) * 3600 );
				//$today = gmdate( 'ymd', $time );
				
				$query = new WP_Query(array(
					'post_type' => 'te_event',
					'orderby'		=> 'meta_value',
					'order'			=> 'DESC',
					'meta_key'	=> 'te_event-options-start-date',
					'meta_value'	=> $time,
					'meta_compare'	=> '>=',
					'posts_per_page'	=> -1
				)); ?>
 				<?php if($query->have_posts()): ?>
 					<?php while($query->have_posts()): $query->the_post(); ?>                                
   					<div class="post-feed event">
     					<?php the_post_thumbnail(array(100, 100)); ?>

       				<p class="date">
								<b>Event Date:</b>
			          <?php
					
									$id = get_the_ID();
									$start_date = get_post_meta($id, 'te_event-options-start-date', true);
									if(!empty($start_date)) {
										echo date('j M Y', $start_date + (get_option('gmt_offset') * 3600));

										$start_time = get_post_meta($id, 'te_event-options-start-time', true);
										echo " $start_time";

										$end_date = get_post_meta($id, 'te_event-options-end-date', true);
										echo " - " . date('j M Y', $end_date + (get_option('gmt_offset') * 3600));

										$end_time = get_post_meta($id, 'te_event-options-end-time', true);
										echo " $start_time";
									}
				
							?>
       			</p>
       
     				<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
     				
						<div class="entry">
       				<?php the_content(); ?>
     				</div>
     
     				<p class="add-comment">
			        <a href="<?php echo get_permalink($post->ID) . '#respond'; ?>">Comments (<?php comments_number('0', '1', '%') ?>)</a>
			      </p>
			
     				<p class="read-more">
			          <a href="<?php echo te_get_article_url($post->ID); ?>">Read more</a>                              
			      </p> 
   				</div>
 				<?php endwhile; ?>
 			<?php endif; ?>
 		</div>
	</section>
		
	<div class="clearer"></div>
</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>
