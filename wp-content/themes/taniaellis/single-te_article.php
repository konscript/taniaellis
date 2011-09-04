<?php get_header(); ?>

<div id="header">
  <p id="sub-heading">The <span>Social</span> Business Company</p>
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
			<?php if(function_exists('generated_dynamic_sidebar')) generated_dynamic_sidebar("Article Single Left"); ?>
		</section>

                        <section class="right-sidebar-single">
                          <div class="sidebar-background">
                              
                              <?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>
                                <div class="post-header">
                                  <?php 
                                    $primary_category_id = get_post_meta($post->ID, 'te_article-primary-category-cat', true);

                                    if(!$primary_category_id) {
                                      $primary_category_name = 'All Articles';
                                    } else {
                                      $primary_category_name = get_term($primary_category_id, 'te_article-category')->name;
                                    }
                                  ?>
                                  <h2 class="first-line">Articles</h2>
                                  <h2 class="second-line"><?php echo $primary_category_name; ?></h2>
                                </div>
                                                                
                                <div class="post">
                                  <div class="meta">
                                    <p class="byline">
                                      <?php echo te_get_article_author($post->ID); ?>
                                    </p>
                                    <p class="date">
                                      <?php echo te_get_article_date($post->ID); ?>
                                    </p>
                                  </div>    
                                  <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                  <div class="entry">
                                    <?php
                                      the_post_thumbnail(array(240, 240));
                                    ?>
                                    <?php the_content(); ?>
                                  </div>
                                  <p class="read-more">
                                    <!-- HTTP:// should be appended to the link if it is not already! -->
                                    <a href="<?php echo te_get_article_url($post->ID); ?>">Read more</a>
                                  </p>
                                </div>
                                <div class="clearer"></div>
                                                        
                                <?php if(has_term('', 'te_article-category', $post->ID) || has_term('', 'te_article-tag', $post->ID)): ?>
                                  <div class="post-identification">
                                    <?php if(has_term('', 'te_article-category', $post->ID)): ?>
                                      <p class="post-categories">
                                        <?php echo get_the_term_list($post->ID, 'te_article-category', 'Posted in |&nbsp;', '&nbsp;|&nbsp;', ''); ?>
                                      </p>
                                    <?php endif; ?>
                                    <?php if(has_term('', 'te_article-tag', $post->ID)): ?>
                                      <p class="post-tags">
                                        <?php echo get_the_term_list($post->ID, 'te_article-tag', 'Tagged |&nbsp;', '&nbsp;|&nbsp;', ''); ?>
                                      </p>
                                    <?php endif; ?>
                                  </div>
                                <?php endif; ?>
                                
                                
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