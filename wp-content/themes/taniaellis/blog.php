<?php
/*
    Template Name: Blog
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
		
		<?php 
		
			wp_nav_menu(array(
				'theme_location' 	=> 'blog-menu',
				'menu_class'		=> 'navigation-header',
				'menu_id'			=> 'navigation-header-standard',
				'link_before'		=> '<span>&nbsp;</span>'
			));
		
			$header_titleA = get_post_meta($post->ID, 'te_blog-header-text-titleA', true);
			$header_titleB = get_post_meta($post->ID, 'te_blog-header-text-titleB', true);
			$header_title_right = get_post_meta($post->ID, 'te_blog-header-text-title-right', true);
			$header_content = get_post_meta($post->ID, 'te_blog-header-text-content', true);
	    $header_link_url = get_post_meta($post->ID, 'te_blog-header-text-link-address', true);
	   	$header_link_text = get_post_meta($post->ID, 'te_blog-header-text-link-text', true);

	  ?>
		<div class="header-content">
			<div class="left-column">
				<div class="header-title">
		            <h2 class="first-line"><?php echo $header_titleA; ?></h2>
			        <h2 class="second-line"><?php echo $header_titleB; ?></h2>
		        </div>
		
				<h3 id="tagcloud-title"><span>Most tagged words...</span></h3>
				<div id="tagcloud">
					<?php
					
					$terms = get_terms('post_tag', array(
						'number'				=> 6,
						'hierarchical'	=> 0,
						'orderby'				=> 'count',
						'order'					=> 'DESC'
					));
					
					$scores = array();
					foreach($terms as $term) {
						$scores[$term->term_id] = $term->count;
					}
					
					$max_score = max($scores);
					$min_score = min($scores);
					
					$score_spread = $max_score - $min_score;
					if($score_spread <= 0)
						$score_spread = 1;
					
					$max_class = 5;
					$min_class = 1;
					
					$class_spread = $max_class - $min_class;
					if($class_spread <= 0)
						$class_spread = 1;
						
					$step = $class_spread / $score_spread;
					
					// Shuffle it around
					shuffle($terms);
					
					foreach($terms as $term) :
						$id = $term->term_id;
						$link = clean_url(get_tag_link($id));
						//$class_id = ($min_class + (($scores[$id] - $min_score) * $step));
						$class_id = rand($min_class, $max_class);
						?>
						
						<a href="<?php echo $link ?>" class="tag-<?php echo $id; ?> s<?php echo $class_id; ?>"><?php echo $term->name; ?></a>&nbsp;
						
						<?php
					endforeach;
					
					?>
				</div>
			</div>
			<div class="right-column">
				<div class="header-right-box">
					<h2><?php echo $header_title_right; ?></h2>
					<p><?php echo $header_content; ?></p>

					<a class="join" href="<?php echo $header_link_url; ?>"><?php echo $header_link_text; ?></a>
				</div>
			</div>

		</div> <!-- .header-content -->
	</div> <!-- #.header-container -->
	
	
</div> <!-- #header -->

<div class="clearer"></div>

<div id="page-content">
	<div id="page">
	  
	  <div id="social-bar">
		  <ul>
		  	<li><a target="_blank" href="http://www.facebook.com/pages/TANIA-­‐ELLIS/110480409004141"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_facebook.png" /></a></li>
			  <li><a target="_blank" href="http://twitter.com/TaniaEllis_DK"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_twitter.png" /></a></li>
			  <li><a target="_blank" href="http://www.linkedin.com/groups?mostPopular=&gid=3776885"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_linkedin.png" /></a></li>
			  <li><a target="_blank" href="http://www.youtube.com/TheNewPioneers"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_youtube.png" /></a></li>
			  <li><a target="_blank" href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_rss.png" /></a></li>
			</ul>
			
			<?php
			
			$box_title_line_1 = get_post_meta($post->ID, 'te_blog-box-text-title-line-1', true);
      $box_title_line_2 = get_post_meta($post->ID, 'te_blog-box-text-title-line-2', true);
			$box_content = get_post_meta($post->ID, 'te_blog-box-text-content', true);
			$box_link_address = get_post_meta($post->ID, 'te_blog-box-text-link-address', true);
      $box_link_text = get_post_meta($post->ID, 'te_blog-box-text-link-text', true);

			$bonus_sticker = get_post_meta($post->ID, 'te_blog-box-text-bonus-sticker', true);
      $sticker_url = get_post_meta($post->ID, 'te_blog-box-text-bonus-sticker-image', true);

			$show_subscribe	= get_post_meta($post->ID, 'te_blog-box-text-subscribe', true);
			
			?>
			
      <div class="box">
        <p class="box-header">
          <span class="box-first-line"><?php echo $box_title_line_1; ?></span>
          <span class="box-second-line"><?php echo $box_title_line_2; ?></span>
        </p>
        <p class="box-content box-content-blog">
					<?php echo $box_content; ?>
				</p>
        
        <?php if($bonus_sticker == 'on' && $sticker_url): ?>
				  <img src="<?php echo $sticker_url; ?>" alt="" class="bonus-sticker" />
				<?php endif; ?>
				
				<?php if($show_subscribe == 'on'): ?>
					<form id="subscribe-to-blog" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=TaniaEllis-temp', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
						<input type="text" name="email" />
						<input type="hidden" value="taniaellis-test/feed-test-2" name="uri"/>
						<input type="hidden" name="loc" value="en_US"/>
						<input class="box-button green-button" type="submit" value="Subscribe" />
					</form>
				<?php endif; ?>
				
				<?php if($show_subscribe != 'on'): ?>
        	<a class="box-button" href="<?php echo $box_link_address; ?>" target="_blank"><?php echo $box_link_text; ?></a>                       
      	<?php endif; ?>
			</div>
    </div>
	  
	<section class="left-sidebar">
		<?php if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Left Sidebar"); ?>
	</section>
	
	<section class="right-sidebar">
		<div class="sidebar-background">
			<?php if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Right Sidebar"); ?>
		</div>
	</section>
	
	<div class="clearer"></div>
		
	</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>