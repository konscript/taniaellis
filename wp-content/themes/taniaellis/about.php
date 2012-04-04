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
			'theme_location' 	=> 'about-menu',
			'menu_class'		=> 'navigation-header',
			'menu_id'			=> 'navigation-header-standard',
			'link_before'		=> '<span>&nbsp;</span>'
			)); 
		?>
		<div class="header-content">
			<div class="left-column" id="about-left">
				<div class="header-title">
					<h2 class="first-line">About us</h2>
          <h2 class="second-line">Who &amp; Why</h2>
          <img src="<?php bloginfo('template_url'); ?>/images/moneytree.png" class="heartcore-tree" />
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
		  	<li><a target="_blank" href="http://www.facebook.com/pages/TANIA-­‐ELLIS/110480409004141"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_facebook.png" /></a></li>
			  <li><a target="_blank" href="http://twitter.com/TaniaEllis_DK"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_twitter.png" /></a></li>
			  <li><a target="_blank" href="http://www.linkedin.com/groups?mostPopular=&gid=3776885"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_linkedin.png" /></a></li>
			  <li><a target="_blank" href="http://www.youtube.com/TheNewPioneers"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_youtube.png" /></a></li>
			  <li><a target="_blank" href="<?php bloginfo('rss2_url'); ?>"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_rss.png" /></a></li>
			  <li><a target="_blank" href="http://thefairpages.com/company-profile/profile.aspx?company=tania-ellis"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_fairpages.png" /></a></li>
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
        <?php $bonus_sticker = get_post_meta($post->ID, 'te_about-box-text-bonus-sticker', true); ?>
        <?php $sticker_url = get_post_meta($post->ID, 'te_about-box-text-bonus-sticker-image', true); ?>
        
        <?php if($bonus_sticker == 'on' && $sticker_url): ?>
				  <img src="<?php echo $sticker_url; ?>" alt="" class="bonus-sticker" />
				<?php endif; ?>
        <a class="box-button green-button" href="<?php echo $box_link_address; ?>" target="_blank"><?php echo $box_link_text; ?></a>                       
      </div>
    </div>
	  
		<section class="left-sidebar">
			<?php 
			generated_dynamic_sidebar("Left Sidebar");
			?>	    
		</section>
		
		<section class="right-sidebar">
		  <div class="sidebar-background">
        <?php //generated_dynamic_sidebar("Right Sidebar"); ?>
        <div class="widget widget-key-services">
          <div class="header-container">
            <h2 class="first-line">4 Key Services</h2>
            <h2 class="second-line">All Centered Around Social Business</h2>
          </div>


          <div class="key-services">
            
            <?php for($i = 1; $i < 5; $i++): ?>
              
              <?php
                $key_service['title-1']       = get_post_meta($post->ID, "te_about-key-service-$i-title-line-1", true);
                $key_service['title-2']       = get_post_meta($post->ID, "te_about-key-service-$i-title-line-2", true);
                $key_service['color']         = get_post_meta($post->ID, "te_about-key-service-$i-color", true);
                $key_service['content']       = get_post_meta($post->ID, "te_about-key-service-$i-content", true);
                $key_service['link-address']  = get_post_meta($post->ID, "te_about-key-service-$i-link-address", true);
                $key_service['link-text']     = get_post_meta($post->ID, "te_about-key-service-$i-link-text", true);
                
                for ($j = 1; $j < 6; $j++) { 
                  $key_service["bullet-$j"] = get_post_meta($post->ID, "te_about-key-service-$i-bullet-$j", true);
                }
                                
              ?>
              
              
              <?php if($i % 2 == 1): ?>
                <div class="key-service uneven" id="<?php echo $key_service['color']; ?>">
              <?php else: ?>
                <div class="key-service" id="<?php echo $key_service['color']; ?>">
              <?php endif; ?>
              
                <div class="header">
                  <p class="first-line"><?php echo $key_service['title-1']; ?></p>
                  <p class="second-line"><?php echo $key_service['title-2']; ?></p>
                </div>

                <p class="content">
                  <?php echo $key_service['content']; ?>
                </p>

                <ul>
                  <?php for($j = 1; $j < 6; $j++): ?>
                    <?php if($key_service["bullet-$j"]): ?>
                      <li><span>&nbsp;</span><?php echo $key_service["bullet-$j"]; ?></li>
                    <?php endif; ?>
                  <? endfor; ?>         
                </ul>

                <div class="push"></div>
                <a href="<?php echo $key_service['link-address'];?>" class="key-service-read-more"><?php echo $key_service['link-text']; ?></a>
              </div>
            <?php endfor; ?>
            
            <div class="clearer"></div>
                      
          </div>
          
        	
        	
        	
      </div>
		</section>
		
		<div class="clearer"></div>
		
	</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>