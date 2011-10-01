<?php
/*
Template Name: Club
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
	    'theme_location' 	=> 'club-menu',
			'menu_class'		=> 'navigation-header',
			'menu_id'			=> 'navigation-header-standard',
			'link_before'		=> '<span>&nbsp;</span>'
	        )); 
	    ?>
		<div class="header-content">
			
			<div class="left-column" id="club-left">
			  
			  <img src="<?php bloginfo('template_url'); ?>/images/club_logo.png" id="club-logo" />
        
        <p class="testemonials-title">
          <span class="first-line"><?php echo get_post_meta($post->ID, 'te_club-header-text-left-pane-first-line', true); ?></span>
          <span class="second-line"><?php echo get_post_meta($post->ID, 'te_club-header-text-left-pane-second-line', true); ?></span>
        </p>
        
        <?php 
          $testemonial_1_id = get_post_meta($post->ID, 'te_club-testemonials-testemonial-1-id', true);
          $testemonial_2_id = get_post_meta($post->ID, 'te_club-testemonials-testemonial-2-id', true);
          
          $testemonial_1['author'] = get_post_meta($testemonial_1_id, 'te_testemonial-author', true);
          $testemonial_1['video-id'] = get_post_meta($testemonial_1_id, 'te_testemonial-video-id', true);
          $testemonial_1['video-url'] = get_post_meta($testemonial_1['video-id'], 'te_video_url', true);
          $testemonial_1['author-url'] = get_post_meta($testemonial_1_id, 'te_testemonial-author-url', true);
          $testemonial_1['author-url-text'] = get_post_meta($testemonial_1_id, 'te_testemonial-author-url-text', true);
          
          $testemonial_2['author'] = get_post_meta($testemonial_2_id, 'te_testemonial-author', true);
          $testemonial_2['video-id'] = get_post_meta($testemonial_2_id, 'te_testemonial-video-id', true);
          $testemonial_2['video-url'] = get_post_meta($testemonial_2['video-id'], 'te_video_url', true);
          $testemonial_2['author-url'] = get_post_meta($testemonial_2_id, 'te_testemonial-author-url', true);
          $testemonial_2['author-url-text'] = get_post_meta($testemonial_2_id, 'te_testemonial-author-url-text', true);
          
        ?>
        
        <div class="club-videos">
            <div class="club-video">
              <?php echo te_vimeo_video($testemonial_1['video-url'], 150, 90); ?>
              <p class="testemonial-author"><?php echo $testemonial_1['author']; ?></p>
              <a href="<?php echo $testemonial_1['author-url']; ?>" class="author-url"><?php echo $testemonial_1['author-url-text']; ?></a>
            </div>
            
            <div class="club-video">
              <?php echo te_vimeo_video($testemonial_2['video-url'], 150, 90); ?>
              <p class="testemonial-author"><?php echo $testemonial_2['author']; ?></p>
              <a href="<?php echo $testemonial_2['author-url']; ?>" class="author-url"><?php echo $testemonial_2['author-url-text']; ?></a>
            </div>
        </div>
        
			</div>
			
			<div class="right-column" id="club-right">
				<div class="header-right-box">
					<h2><?php echo get_post_meta($post->ID, 'te_club-header-text-title', true); ?></h2>
					<p><?php echo get_post_meta($post->ID, 'te_club-header-text-content', true); ?></p>

          <?php
          $header_link_url = get_post_meta($post->ID, 'te_club-header-text-link-address', true);
          $header_link_text = get_post_meta($post->ID, 'te_club-header-text-link-text', true);
          ?>

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
			  <li><a target="_blank" href="http://thefairpages.com/company-profile/profile.aspx?company=tania-ellis"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_fairpages.png" /></a></li>
			</ul>
			<div class="box">
        <p class="box-header green-header">
          <?php
            $box_title_line_1 = get_post_meta($post->ID, 'te_club-box-text-title-line-1', true);
            $box_title_line_2 = get_post_meta($post->ID, 'te_club-box-text-title-line-2', true);
          ?>
          <span class="box-first-line"><?php echo $box_title_line_1; ?></span>
          <span class="box-second-line"><?php echo $box_title_line_2; ?></span>
        </p>
        <p class="box-content box-content-dark">
          <?php echo get_post_meta($post->ID, 'te_club-box-text-content', true); ?>
        </p>
        <?php
          $box_link_address = get_post_meta($post->ID, 'te_club-box-text-link-address', true);
          $box_link_text = get_post_meta($post->ID, 'te_club-box-text-link-text', true);
        ?>
        <?php $bonus_sticker = get_post_meta($post->ID, 'te_club-box-text-bonus-sticker', true); ?>
        <?php $sticker_url = get_post_meta($post->ID, 'te_club-box-text-bonus-sticker-image', true); ?>
        
        <?php if($bonus_sticker == 'on' && $sticker_url): ?>
				  <img src="<?php echo $sticker_url; ?>" alt="" class="bonus-sticker" />
				<?php endif; ?>
        <a class="box-button green-button" href="<?php echo $box_link_address; ?>" target="_blank"><?php echo $box_link_text; ?></a>                       
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