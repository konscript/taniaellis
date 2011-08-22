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
	  
	  <div id="social-bar" class="addthis_toolbox addthis_32x32_style">
      <ul>
		  	<li><a class="addthis_button_facebook"></a></li>
			  <li><a class="addthis_button_twitter"></a></li>
			  <li><a class="addthis_button_linkedin"></a></li>
			  <li><a class="addthis_button_youtube"></a></li>
			  <li><a class="addthis_button_rss"></a></li>
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
			<?php 
			generated_dynamic_sidebar("Left Sidebar");
			?>	    
		</section>
		
		<section class="right-sidebar">
		  <div class="sidebar-background">
        <?php //generated_dynamic_sidebar("Right Sidebar"); ?>
        <div class="widget widget-blog">
          <div class="header-container">
            <h2 class="first-line">4 Key Services</h2>
            <h2 class="second-line">All Centered Around Social Business</h2>
          </div>


          <div class="key-services">
            <div class="key-service" id="club">
              <div class="header">
                <p class="first-line">The Social Business</p>
                <p class="seconnd-line">Club</p>
              </div>
              
              <p class="content">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
              </p>
              
              <ul>
                <li>Monthly Lectures</li>
                <li>Yearly Workshops</li>
                <li>Connets You With LikeMinded</li>
                <li>Lorem Ipsum Dolor</li>                
              </ul>
            </div>
          </div>
        	
      </div>
		</section>
		
		<div class="clearer"></div>
		
	</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>