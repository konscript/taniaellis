<?php
/*
    Template Name: About
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
	    'theme_location' 	=> 'reading-room-menu',
			'menu_class'		=> 'navigation-header',
			'menu_id'			=> 'navigation-header-standard',
			'link_before'		=> '<span>&nbsp;</span>'
	        )); 
	    ?>

		<div class="header-content">
			<div class="left-column" id="about-left">
        <div class="header-title">
          <h2 class="first-line">Social Business</h2>
          <h2 class="second-line">Reading Room</h2>
        </div>
			</div>
			
			<div class="right-column" id="about-right">
				<div class="header-right-box">
          <?php the_post_thumbnail('post-square-thumbnail'); ?>
          <p class="title"><?php echo get_post_meta($post->ID, 'te_about-header-text-title', true); ?></p>
          <p class="content"><?php echo get_post_meta($post->ID, 'te_about-header-text-content', true); ?></p> 
				
				  <a href="<?php echo get_post_meta($post->ID, 'te_about-header-text-link-address', true); ?>" class="read-more" id="read-more-about"><?php echo get_post_meta($post->ID, 'te_about-header-text-link-text', true); ?></a>
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
				<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_youtube.png" alt="YouTube" title="YouTube" /></a></li>
				<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_rss.png" alt="RSS" title="RSS" /></a></li>
				<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_twitter.png" alt="Twitter" title="Twitter" /></a></li>
				<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_facebook.png" alt="Facebook" title="Facebook" /></a></li>
				<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_fairpages.png" alt="Fairpages" title="Fairpages" /></a></li>
			</ul>
			<div class="box">
        <p class="box-header">
          <?php
            $box_title_line_1 = get_post_meta($post->ID, 'te_about-box-text-title-line-1', true);
            $box_title_line_2 = get_post_meta($post->ID, 'te_about-box-text-title-line-2', true);
          ?>
          <span class="box-first-line"><?php echo $box_title_line_1; ?></span>
          <span class="box-second-line"><?php echo $box_title_line_2; ?></span>
        </p>
        <p class="box-content box-content-dark">
          <?php echo get_post_meta($post->ID, 'te_about-box-text-content', true); ?>
        </p>
        <?php
          $box_link_address = get_post_meta($post->ID, 'te_about-box-text-link-address', true);
          $box_link_text = get_post_meta($post->ID, 'te_about-box-text-link-text', true);
        ?>
        <a class="box-button green-button" href="<?php echo $box_link_address; ?>"><?php echo $box_link_text; ?></a>                       
      </div>
    </div>
	  
		<section class="left-sidebar">
      <?php echo '<pre>'; print_r($menu_items); echo '</pre>'; ?>
	    
		</section>
		
		<section class="right-sidebar">
		  &nbsp;
		</section>
		
		<div class="clearer"></div>
		
	</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>