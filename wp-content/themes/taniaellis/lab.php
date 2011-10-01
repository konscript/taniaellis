<?php
/*
    Template Name: Lab
*/
?>
<?php get_header(); ?>

<script type="text/javascript">
	  jQuery(document).ready(function() {
	    jQuery(".lab-container").innerfade({
	      animationtype: 'fade',
	      containerheight: '172px',
	      timeout: 3500,
	      speed: 750
	    });
	  });
	</script>

<div id="header">
	<p id="sub-heading">The <span>Social</span> Business Company &reg;</p>
	<p id="language-picker">
		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
	</p>
	
	<div class="clearer"></div>

	<div id="header-container">
		
		<?php wp_nav_menu(array(
	    'theme_location' 	=> 'lab-menu',
			'menu_class'		=> 'navigation-header',
			'menu_id'			=> 'navigation-header-standard',
			'link_before'		=> '<span>&nbsp;</span>'
	        )); 
	    ?>
		<div class="header-content">		
			<div class="left-column" id="lab-left">
        <div class="header-title">
          <h2 class="first-line">Social Business</h2>
          <h2 class="second-line">Labs</h2>
        </div>
        
        <?php
        
        for($i = 1; $i < 4; $i++) { 
          $labs[$i]['title-line-1'] = get_post_meta($post->ID, 'te_lab-roller-' . $i . '-title-line-1', true);
          $labs[$i]['title-line-2'] = get_post_meta($post->ID, 'te_lab-roller-' . $i . '-title-line-2', true);
          $labs[$i]['content']      = get_post_meta($post->ID, 'te_lab-roller-' . $i . '-content', true);
          $labs[$i]['link-url']     = get_post_meta($post->ID, 'te_lab-roller-' . $i . '-link-address', true);
          $labs[$i]['link-text']    = get_post_meta($post->ID, 'te_lab-roller-' . $i . '-link-text', true);
        }
        
        //print_r($labs);
        
        ?>
        
        <div class="lab-container">
          <div class="flasks">
            <img src="<?php bloginfo('template_url'); ?>/images/events_header_flask_1.png" />
            <img src="<?php bloginfo('template_url'); ?>/images/events_header_flask_2.png" />
            <img src="<?php bloginfo('template_url'); ?>/images/events_header_flask_3.png" />
          </div>
          <?php for($i = 1 ; $i < 4 ; $i++): ?>
            <div class="lab lab-<?php echo $i; ?>">
              <div class="title">
                <p class="first-line"><?php echo $labs[$i]['title-line-1']; ?></p>
                <p class="second-line"><?php echo $labs[$i]['title-line-2']; ?></p>
              </div>
              
              <p class="content">
                <?php echo $labs[$i]['content']; ?>
              </p>
              
              <a href="<?php echo $labs[$i]['link-url']; ?>" class="lab-link"><?php echo $labs[$i]['link-text']; ?></a>
            </div>
          <?php endfor; ?>
        </div>
			
			</div>
			
			<div class="right-column" id="lab-right">
				<div class="header-right-box">
					<h2><?php echo get_post_meta($post->ID, 'te_lab-header-text-title', true); ?></h2>
					<p><?php echo get_post_meta($post->ID, 'te_lab-header-text-content', true); ?></p>

          <?php
            $header_link_url = get_post_meta($post->ID, 'te_lab-header-text-link-address', true);
            $header_link_text = get_post_meta($post->ID, 'te_lab-header-text-link-text', true);
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
        <p class="box-header purple-header">
          <?php
            $box_title_line_1 = get_post_meta($post->ID, 'te_lab-box-text-title-line-1', true);
            $box_title_line_2 = get_post_meta($post->ID, 'te_lab-box-text-title-line-2', true);
          ?>
          <span class="box-first-line"><?php echo $box_title_line_1; ?></span>
          <span class="box-second-line"><?php echo $box_title_line_2; ?></span>
        </p>
        <p class="box-content box-content-dark">
          <?php echo get_post_meta($post->ID, 'te_lab-box-text-content', true); ?>
        </p>
        <?php
          $box_link_address = get_post_meta($post->ID, 'te_lab-box-text-link-address', true);
          $box_link_text = get_post_meta($post->ID, 'te_lab-box-text-link-text', true);
        ?>
        <?php $bonus_sticker = get_post_meta($post->ID, 'te_lab-box-text-bonus-sticker', true); ?>
        <?php $sticker_url = get_post_meta($post->ID, 'te_lab-box-text-bonus-sticker-image', true); ?>
        
        <?php if($bonus_sticker == 'on' && $sticker_url): ?>
				  <img src="<?php echo $sticker_url; ?>" alt="" class="bonus-sticker" />
				<?php endif; ?>
        <a class="box-button purple-button" href="<?php echo $box_link_address; ?>" target="_blank"><?php echo $box_link_text; ?></a>                       
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