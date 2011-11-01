<?php get_header(); ?>

<div id="header">
	<p id="sub-heading">The <span>Social</span> Business Company &reg;</p>
	<p id="language-picker">
		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
	</p>

	<div class="clearer"></div>

	<div id="header-container">
		<?php wp_nav_menu(array(
				'theme_location'		=> 'blog-menu',
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
			//if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Left Sidebar"); 
			generated_dynamic_sidebar("Blog Single Left");
			?>
		</section>
		<section class="right-sidebar-single">
<div class="sidebar-background">
  
  <?php
  
    $post_id = get_page_by_path('reading-room/tv-interviews')->ID;
    
    $post_meta['first-line']  = get_post_meta($post_id, 'te_page-tv-interviews-first-line', true);
    $post_meta['second-line'] = get_post_meta($post_id, 'te_page-tv-interviews-second-line', true);
    $post_meta['lead-text']   = get_post_meta($post_id, 'te_page-tv-interviews-lead-paragraph-text', true);
  ?>
  
  <div class="post-header" id="tv-interviews">
    <h2 class="first-line"><?php echo $post_meta['first-line']; ?></h2>
    <h2 class="second-line"><?php echo $post_meta['second-line']; ?></h2>
    <p class="lead-text"><?php echo $post_meta['lead-text']; ?></p>
  </div>
  
  
  
	<?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>
     
			<div class="post blog">
        <?php 
          $video_id   = get_post_meta($post->ID, 'te_interview-video-id', true);
          $video_url  = get_post_meta($video_id, 'te_video_url', true);
        ?>
        
        <div class="vimeo-container">
          <?php echo te_vimeo_video($video_url, 524, 250); ?>
        </div>


				<div class="meta">
          
					<p class="byline">  				  
						<?php echo get_post_meta($post->ID, 'te_interview-meta', true); ?>
					</p>
					<p class="date">
            <?php
              $interview_date = get_interview_date($post->ID);
              
              // Determine whether a date has been set. Echo publish date if not.
              if(isset($interview_date) && $interview_date != "") {
                echo $interview_date;
              } else {
                the_time('F j, Y');
              }
            ?>
					</p>
				</div>
				  
				<h2 class="title"><?php the_title(); ?></h2>
				<div class="entry">
					<?php the_content(); ?>
				</div>
				
			</div>
			
			<div class="clearer"></div>

      <?php if(has_term('', 'te_interview-category', $post->ID) || has_term('', 'te_interview-tag', $post->ID)): ?>
        <div class="post-identification">
          <?php if(has_term('', 'te_interview-category', $post->ID)): ?>
            <p class="post-categories">
              <?php echo get_the_term_list($post->ID, 'te_interview-category', 'Posted in |&nbsp;', '&nbsp;|&nbsp;', ''); ?>
            </p>
          <?php endif; ?>
          <?php if(has_term('', 'te_interview-tag', $post->ID)): ?>
            <p class="post-tags">
              <?php echo get_the_term_list($post->ID, 'te_interview-tag', 'Tagged |&nbsp;', '&nbsp;|&nbsp;', ''); ?>
            </p>
          <?php endif; ?>
        </div>
      <?php endif; ?>
			
			<?php 
			//if(function_exists('the_ratings')) { the_ratings(); } 
			?>
                                                                
			<?php endwhile; ?>
    <?php endif; ?>
     
     <div class="clearer"></div>
     
     <?php comments_template(); ?>
 </div>
</section>

		<div class="clearer"></div>

	</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>
