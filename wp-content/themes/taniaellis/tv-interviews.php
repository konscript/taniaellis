<?php
/*
Template Name: TV Interviews
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
			'theme_location'	=> 'reading-room-menu',
			'container'			=> '',
			'menu_id'			   => 'navigation-header-standard',
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
      <?php if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Left Sidebar"); ?>
    </section>

    <section class="right-sidebar-single">
      <div class="sidebar-background">
        
        <?php
          $post_id = $wp_query->post->ID;
        
          $post_meta['first-line']  = get_post_meta($post_id, 'te_page-tv-interviews-first-line', true);
          $post_meta['second-line'] = get_post_meta($post_id, 'te_page-tv-interviews-second-line', true);
          $post_meta['lead-text']   = get_post_meta($post_id, 'te_page-tv-interviews-lead-paragraph-text', true);
        ?>
        
          <div class="post-header" id="tv-interviews">
            <h2 class="first-line"><?php echo $post_meta['first-line']; ?></h2>
            <h2 class="second-line"><?php echo $post_meta['second-line']; ?></h2>
            <p class="lead-text"><?php echo $post_meta['lead-text']; ?></p>
          </div>
          
          <?php query_posts(array('post_type' => 'te_interview', 'post_status' => 'publish', 'paged' => $paged)); ?>
          <?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>                         
            <div class="post-feed">
                
              <?php 
                $video_id   = get_post_meta($post->ID, 'te_interview-video-id', true);
                $video_url  = get_post_meta($video_id, 'te_video_url', true);
              ?>
              <div class="vimeo-container">
                <?php echo te_vimeo_video($video_url, 120, 70); ?>
              </div>
              
              <div class="text-container"> <!-- This is because there is always a video attached to an interview -->
              
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
              
                <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <div class="entry">
                  <?php the_excerpt(); ?>
                </div>
  
                <div class="options">
  		            <a class="add-comment" href="<?php echo get_permalink($post->ID) . '#respond'; ?>">Add comment (<?php comments_number('0', '1', '%'); ?>)</a>
  		            <a class="read-more" href="<?php echo te_get_article_url($post->ID); ?>">Read more</a>                              
                </div>
              </div> <!-- // Text Container -->
            </div>
          <?php endwhile; ?>
          
          <div class="posts-nav-links">
            <?php posts_nav_link(' ', '« Previous Page', 'Next Page »'); ?>
          </div>
          
          <?php endif; ?>
          
          <div class="clearer"></div>
          
      </div>
    </section>

    <div class="clearer"></div>
  </div> <!-- #page -->

</div> <!-- #page-content -->
<?php get_footer(); ?>