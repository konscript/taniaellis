<?php
/*
Template Name: Home
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
			'theme_location'	=> 'social-business-menu',
			'container' 		=> false,
			'menu_id' 			=> 'navigation-social-business',
			'menu_class' 		=> 'navigation-header',
			'link_before' 		=> '<span class="social">Social</span> Business <br><span class="term">',
			'link_after' 		=> '</span>'
		)); ?>

		<div class="header-content" id="frontpage-header-content">
      <!-- <img id="intro-movie" src="<?php bloginfo('template_url'); ?>/images/frontpage_header_tv.png" /> -->
      <!-- Insert video here! -->
      
      <?php
        $video_id = get_post_meta($post->ID, 'te_home-header-text-video', true);
        $video_url = get_post_meta($video_id, 'te_video_url', true);
      ?>
      
      <div class="intro-movie-container">
        <?php echo te_vimeo_video($video_url, 262, 180); ?>
      </div>
      
			<div class="header-quote">
				<h6><?php echo get_post_meta($post->ID, 'te_home-header-text-title', true); ?></h6>
				<p id="header-quote-text"><?php echo get_post_meta($post->ID, 'te_home-header-text-content', true); ?></p>

        <?php
          $header_link_url = get_post_meta($post->ID, 'te_home-header-text-link-address', true);
          $header_link_text = get_post_meta($post->ID, 'te_home-header-text-link-text', true);
        ?>
        
				<div id="read-more-signature">
					<a href="<?php echo $header_link_url; ?>"><?php echo $header_link_text; ?></a>
				</div>
			</div>
		</div> <!-- #frontpage-header-content -->
	</div> <!-- #frontpage-header-container -->
</div> <!-- #header -->
	
<div class="clearer"></div>

<div id="page-content-frontpage">
	<div id="page">

		<!-- id="newsletter-signup-box" -->
    <div id="social-bar-frontpage">
		  <ul>
		  	<li><a target="_blank" href="http://www.facebook.com/pages/TANIA-­‐ELLIS/110480409004141"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_facebook.png" /></a></li>
			  <li><a target="_blank" href="http://twitter.com/TaniaEllis_DK"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_twitter.png" /></a></li>
			  <li><a target="_blank" href="http://www.linkedin.com/groups?mostPopular=&gid=3776885"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_linkedin.png" /></a></li>
			  <li><a target="_blank" href="http://www.youtube.com/TheNewPioneers"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_youtube.png" /></a></li>
			  <li><a target="_blank" href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_rss.png" /></a></li>
			</ul>


      <?php
        $box_title_line_1 = get_post_meta($post->ID, 'te_home-box-text-title-line-1', true);
        $box_title_line_2 = get_post_meta($post->ID, 'te_home-box-text-title-line-2', true);
      ?>

			<div class="box" id="box-frontpage">
				<p class="box-header">
					<span class="box-first-line"><?php echo $box_title_line_1; ?></span>
					<span class="box-second-line"><?php echo $box_title_line_2; ?></span>
				</p>
				

				<p class="box-content">
  				<?php echo get_post_meta($post->ID, 'te_home-box-text-content', true); ?>
				</p>

        <?php
          $box_link_address = get_post_meta($post->ID, 'te_home-box-text-link-address', true);
          $box_link_text = get_post_meta($post->ID, 'te_home-box-text-link-text', true);
        ?>
        <?php $bonus_sticker = get_post_meta($post->ID, 'te_home-box-text-bonus-sticker', true); ?>
        <?php $sticker_url = get_post_meta($post->ID, 'te_home-box-text-bonus-sticker-image', true); ?>
        
        <?php if($bonus_sticker == 'on' && $sticker_url): ?>
				  <img src="<?php echo $sticker_url; ?>" alt="" class="bonus-sticker" />
				<?php endif; ?>
				<a class="box-button" target="_blank" href="<?php echo $box_link_address; ?>"><?php echo $box_link_text; ?></a>
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
