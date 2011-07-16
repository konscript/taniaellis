<?php

get_header();

?>

<div id="header">
  <p id="sub-heading">The <span>Social</span> Business Company</p>
  <p id="language-picker">
    <a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
  </p>

  <div class="clearer"></div>

  <div id="header-container">    

    <ul class="navigation-header" id="navigation-header-standard">
      <li><a href="#"><span>&nbsp;</span>Item</a></li>
      <li><a href="#"><span>&nbsp;</span>Item</a></li>
      <li><a href="#"><span>&nbsp;</span>Item</a></li>
      <li><a href="#"><span>&nbsp;</span>Item</a></li>

    </ul>
  </div> <!-- #header-container -->


</div> <!-- #header --> 

<div class="clearer"></div>

<div id="page-content-single">
  <div id="page">
    <div id="social-bar">
      <ul>
        <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_youtube.png" alt="YouTube" title="YouTube" /></a></li>
        <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_rss.png" alt="RSS" title="RSS" /></a></li>
        <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_twitter.png" alt="Twitter" title="Twitter" /></a></li>
        <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_facebook.png" alt="Facebook" title="Facebook" /></a></li>
        <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_fairpages.png" alt="Fairpages" title="Fairpages" /></a></li>
      </ul>
    </div>
    <section class="left-sidebar">
	</section>
	
	<section class="right-sidebar-single">
      <div class="sidebar-background">
          
          <?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>
            <?php
            $args = array(
            	'post_type' => 'attachment',
            	'numberposts' => null,
            	'post_status' => null,
            	'post_parent' => $post->ID
            );
            $attachments = get_posts($args);
            if ($attachments) {
            	foreach ($attachments as $attachment) {
            		//echo apply_filters('the_title', $attachment->post_title);
            		wp_get_attachment_link($attachment->ID, false);
            	  //echo get_permalink($attachment->ID);
            	}
            }
            ?>
            
            <div class="post-header">
              <h2 class="first-line">Articles</h2>
              <h2 class="second-line">Ethics / Sustainability</h2>
            </div>
            
            <div class="post">
              <div class="meta">
                <p class="byline">
                  By <?php the_author(); ?>
                </p>
                <p class="date">
                  <?php the_date('F j Y'); ?>
                </p>
              </div>    
              <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <div class="entry">
                <?php
                  the_post_thumbnail(array(240, 240));
                ?>
                <?php the_content(); ?>
              </div>
            </div>
            
            <?php //echo get_the_term_list(80, 'tomas', 'Tagged | ', ' | ', ''); ?>
            
          <?php endwhile; ?>
          <?php endif; ?>
          
          <div class="clearer"></div>
          
          <?php comments_template(); ?>
      </div>
    </section>

    <div class="clearer"></div>

  </div> <!-- #page -->

</div> <!-- #page-content -->
	
<?php

get_footer();


?>