<?php
/*
    Template Name: Events
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
	    'theme_location' 	=> 'events-menu',
			'menu_class'		=> 'navigation-header',
			'menu_id'			=> 'navigation-header-standard',
			'link_before'		=> '<span>&nbsp;</span>'
	        )); 
	    ?>
		<div class="header-content">		
			<div class="left-column" id="events-left">
        <div class="header-title">
          <h2 class="first-line">Social Business</h2>
          <h2 class="second-line">Events</h2>
        </div>
        
        <div class="event-testemonial">
          <?php
            $testemonial['id'] = get_post_meta($post->ID, 'te_events-header-text-testemonial', true);
            $testemonial['thumb'] = get_the_post_thumbnail($testemonial['id'], 'post-square-thumbnail');
            $testemonial['author'] = get_post_meta($testemonial['id'], 'te_testemonial-author', true);
            $testemonial['text'] = get_post_meta($testemonial['id'], 'te_testemonial-testemonial-text', true);
          
            $case['id'] = get_post_meta($testemonial['id'], 'te_testemonial-case-id', true);
            $case['url'] = get_permalink($case['id']);
          ?>
          <?php echo $testemonial['thumb']; ?>
          <div class="testemonial-content">
            <p class="testemonial-author"><?php echo $testemonial['author']; ?></p>
            <p class="testemonial-entry">
              <?php echo $testemonial['text']; ?>
            </p>
            <a href="<?php echo $case['url']; ?>" class="case-link">View case</a>
          </div>
        </div>
			
			</div>
			
			<div class="right-column" id="events-right">
				<div class="header-right-box">
					<h2><?php echo get_post_meta($post->ID, 'te_events-header-text-title', true); ?></h2>
					<p><?php echo get_post_meta($post->ID, 'te_events-header-text-content', true); ?></p>

          <?php
            $header_link_url = get_post_meta($post->ID, 'te_events-header-text-link-address', true);
            $header_link_text = get_post_meta($post->ID, 'te_events-header-text-link-text', true);
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
            $box_title_line_1 = get_post_meta($post->ID, 'te_events-box-text-title-line-1', true);
            $box_title_line_2 = get_post_meta($post->ID, 'te_events-box-text-title-line-2', true);
          ?>
          <span class="box-first-line"><?php echo $box_title_line_1; ?></span>
          <span class="box-second-line"><?php echo $box_title_line_2; ?></span>
        </p>
        <p class="box-content box-content-dark">
          <?php echo get_post_meta($post->ID, 'te_events-box-text-content', true); ?>
        </p>
        <?php
          $box_link_address = get_post_meta($post->ID, 'te_events-box-text-link-address', true);
          $box_link_text = get_post_meta($post->ID, 'te_events-box-text-link-text', true);
        ?>
        <a class="box-button green-button" href="<?php echo $box_link_address; ?>"><?php echo $box_link_text; ?></a>                       
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