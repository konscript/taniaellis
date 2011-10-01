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
          <h2 class="first-line">About</h2>
          <h2 class="second-line">The Company</h2>
          <img src="<?php bloginfo('template_url'); ?>/images/heartcore_tree.png" class="heartcore-tree" />
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
			  <!-- <li><a target="_blank" href="http://thefairpages.com/company-­‐profile/profile.aspx?company=tania-­‐ellis"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_fairpages.png" /></a></li>//-->
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
            <div class="key-service uneven">
              <div class="header">
                <p class="first-line">The Social Business</p>
                <p class="second-line">Club</p>
              </div>
              
              <p class="content">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
              </p>
              
              <ul>
                <li><span>&nbsp;</span>Monthly Lectures</li>
                <li><span>&nbsp;</span>Yearly Workshops</li>
                <li><span>&nbsp;</span>Connets You With LikeMinded</li>
                <li><span>&nbsp;</span>Lorem Ipsum Dolor</li>                
              </ul>

              <div class="push"></div>
              <a href="#" class="key-service-read-more">Read more</a>
            </div>
            
            <div class="key-service" id="purple">
              <div class="header">
                <p class="first-line">The Social Business</p>
                <p class="second-line">Club</p>
              </div>
              
              <p class="content">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
              </p>
              
              <ul>
                <li><span>&nbsp;</span>Monthly Lectures</li>
                <li><span>&nbsp;</span>Yearly Workshops</li>
                <li><span>&nbsp;</span>Connets You With LikeMinded</li>
                <li><span>&nbsp;</span>Lorem Ipsum Dolor</li>                
              </ul>

              <div class="push"></div>
              <a href="#" class="key-service-read-more">Read more</a>
            </div>
            
            <div class="key-service uneven" id="blue">
              <div class="header">
                <p class="first-line">The Social Business</p>
                <p class="second-line">Club</p>
              </div>
              
              <p class="content">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
              </p>
              
              <ul>
                <li><span>&nbsp;</span>Monthly Lectures</li>
                <li><span>&nbsp;</span>Yearly Workshops</li>
                <li><span>&nbsp;</span>Connets You With LikeMinded</li>
                <li><span>&nbsp;</span>Lorem Ipsum Dolor</li>                
              </ul>

              <div class="push"></div>
              <a href="#" class="key-service-read-more">Read more</a>
            </div>
          
            <div class="key-service" id="brown">
              <div class="header">
                <p class="first-line">The Social Business</p>
                <p class="second-line">Club</p>
              </div>
              
              <p class="content">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
              </p>
              
              <ul>
                <li><span>&nbsp;</span>Monthly Lectures</li>
                <li><span>&nbsp;</span>Yearly Workshops</li>
                <li><span>&nbsp;</span>Connets You With LikeMinded</li>
                <li><span>&nbsp;</span>Lorem Ipsum Dolor</li>                
              </ul>

              <div class="push"></div>
              <a href="#" class="key-service-read-more">Read more</a>
            </div>
          </div>
          
        	
        	
        	
      </div>
		</section>
		
		<div class="clearer"></div>
		
	</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>