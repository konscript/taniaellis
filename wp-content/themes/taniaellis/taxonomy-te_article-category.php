<?php get_header(); ?>

<div id="header">
  <p id="sub-heading">The <span>Social</span> Business Company &reg;</p>
  <p id="language-picker">
    <a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
  </p>

  <div class="clearer"></div>

  <div id="header-container">    


    <?php wp_nav_menu(array(
			'theme_location'		=> 'reading-room-menu',
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
			<?php if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Article Categories Left"); ?>
 		</section>

                        <section class="right-sidebar-single">
                          <div class="sidebar-background">
                            
                              <div class="post-header">
                                <h2 class="first-line">Articles</h2>
                                <h2 class="second-line"><?php echo $wp_query->queried_object->name; ?></h2>
                              </div>
                              <?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>                                
                                <div class="post-feed">
                                  <?php if(has_post_thumbnail($post->ID)): ?>
                                    <div class="thumb-wrapper">
                                      <div class="thumb-container">
                                        <?php the_post_thumbnail('post-square-thumbnail', array("class" => "featured-image")); ?>
                                      </div>
                                    </div>
                                  <?php endif; ?>
                                  <!-- <div class="meta"> -->
                                    <p class="byline">
                                      <?php 
                                      if(get_post_type($post->ID) == 'te_article') {
                                        echo te_get_article_author($post->ID);
                                      } else {
                                        echo 'By' . get_the_author();
                                      }
                                      ?>
                                    </p>
                                    <p class="date">
                                      <?php 
                                      if(get_post_type($post->ID) == 'te_article') {
                                        echo te_get_article_date($post->ID);
                                      } else {
                                        the_time('F j, Y');
                                      }
                                      ?>
                                    </p>
                                  <!-- </div>     -->
                                  <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                  <div class="entry">
                                    <?php 
                                    // if(get_post_type($post->ID) == 'te_article') {
                                    //                                       the_content();
                                    //                                     } else {
                                    //                                       the_excerpt();
                                    //                                     }
																		the_excerpt();
                                    ?>
                                  </div>
                                  
																	<div class="options">
	                                  <a href="<?php the_permalink(); ?>#respond" class="add-comment"> Add Comment (<?php comments_number('0', '1', '') ?>)</a>
																		<a class="read-more" href="<?php echo te_get_article_url($post->ID); ?>">Read more</a>
																	</div>
                                </div>
                                
                              <?php endwhile; ?>
                              
                                <div class="posts-nav-links">
                                <?php
                                  // (Use wp-postnavi(); in the future)
                                  posts_nav_link(' ', '« Previous Page', 'Next Page »');
                                ?>
                                </div>
                              
                              <?php endif; ?>
                              
                              <div class="clearer"></div>
                              
                          </div>
                        </section>

                        <div class="clearer"></div>

                      </div> <!-- #page -->

                    </div> <!-- #page-content -->

                    <?php get_footer(); ?>