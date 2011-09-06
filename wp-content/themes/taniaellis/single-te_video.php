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
      <div class="widget widget-books">
        <div class="header-container">
          <h2 class="first-line">My Books</h2>
          <h2 class="second-line">On Social Business</h2>
        </div>

        <div class="item book">
          <img class="featured-image" src="<?php bloginfo('template_url'); ?>/images/books_new_pioneers.png" />
          <p class="meta-data">
            20 jun 2010
            <p>

              <h2 class="title">The New Pioneers</h2>

              <p class="excerpt">
                The Net Pioneers is a book about the new lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </p>

              <div class="options">
                <img class="sharing" src="<?php bloginfo('template_url'); ?>/images/share_options.png" />
                <a class="read-more" href="javascript:void(0)">Read more</a>
              </div>
            </div>
            <div class="item book">
              <img class="featured-image" src="<?php bloginfo('template_url'); ?>/images/books_de_nye_pionerer.png" />
              <p class="meta-data">
                20 jun 2010
                <p>

                  <h2 class="title">De Nye Pionerer</h2>

                  <p class="excerpt">
                    The Net Pioneers is a book about the new lorem ipsum dolor sit amet, consectetur adipisicing elit.
                  </p>

                  <div class="options">
                    <img class="sharing" src="<?php bloginfo('template_url'); ?>/images/share_options.png" />
                    <a class="read-more" href="javascript:void(0)">Read more</a>
                  </div>
                </div>
                <div class="item book">
                  <img class="featured-image" src="<?php bloginfo('template_url'); ?>/images/ebooks_igreen.png" />
                  <p class="meta-data">
                    20 jun 2010
                    <p>

                      <h2 class="title">E-book On Green Business Ideas</h2>

                      <p class="excerpt">
                        Green Ideas have started to flourish all over the world, and the concept keeps growing. Get started with my e-book on the matter.
                      </p>

                      <div class="options">
                        <img class="sharing" src="<?php bloginfo('template_url'); ?>/images/share_options.png" />
                        <a class="read-more" href="javascript:void(0)">Read more</a>
                      </div>
                    </div>
                    <a class="view-all" href="javascript:void(0)">View all books</a>
                  </div>

                  <div class="widget widget-blog">
                    <div class="header-container">
                      <h2 class="first-line">My Blog</h2>
                      <h2 class="second-line">On Social Business</h2>
                    </div>

                    <div class="item blog">
                      <img class="featured-image" src="<?php bloginfo('template_url'); ?>/images/social_business_blog_bio.png" />
                      <p class="meta-data">
                        20 jun 2010
                        <p>

                          <span class="by-line">
                            By Tania Ellis
                          </span>

                          <h2 class="title">The New Pioneers</h2>

                          <p class="excerpt">
                            The Net Pioneers is a book about the new lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                          </p>

                          <div class="options">
                            <img class="sharing" src="<?php bloginfo('template_url'); ?>/images/share_options.png" />
                            <a class="read-more" href="javascript:void(0)">Read more</a>
                          </div>
                        </div>
                        <a class="view-all" href="javascript:void(0)">More blog posts</a>
                      </div>

                      <div class="widget widget-reading-room">
                        <div class="header-container">
                          <h2 class="first-line">Reading Room</h2>
                          <h2 class="second-line">To Social Business</h2>
                        </div>

                        <div class="item reading-room">
                          <img class="featured-image" src="<?php bloginfo('template_url'); ?>/images/reading_room_article.png" />

                          <p class="meta-data">
                            20 jun 2010
                            <p>

                              <span class="by-line">
                                Article
                              </span>

                              <h2 class="title">Get More Insights</h2>

                              <p class="excerpt">
                                Get further insight from the most recent articles, press clippings, books and already published newsletters.
                              </p>

                              <div class="options">
                                <img class="sharing" src="<?php bloginfo('template_url'); ?>/images/share_options.png" />
                                <a class="read-more" href="javascript:void(0)">Read more</a>
                              </div>
                            </div>
                          </div>

                        </section>

                        <section class="right-sidebar-single">
                          <div class="sidebar-background">
                              
                              <?php if(have_posts()): ?><?php while(have_posts()): the_post(); ?>
                                <div class="post-header">
                                  <h2 class="first-line">Articles</h2>
                                  <h2 class="second-line">Ethics / Sustainability</h2>
                                </div>
                                                                
                                <div class="post">
                                  <?php
                                    the_post_thumbnail(array(240, 240));
                                  ?>
                                  <?php 
                                    $url = get_post_meta($post->ID, 'te_video_url', true);
                                    echo te_vimeo_video($url, 534, 300);
                                  ?>
                                  <div class="meta">
                                    <p class="byline">
                                      <?php the_author(); ?>
                                    </p>
                                    <p class="date">
                                      <?php the_time(); ?>
                                    </p>
                                  </div>    
                                  <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                  <div class="entry">
                                    <?php the_content(); ?>
                                  </div>
                                  <p class="read-more">
                                    <!-- HTTP:// should be appended to the link if it is not already! -->
                                    <a href="<?php echo te_get_article_url($post->ID); ?>">Read more</a>
                                  </p>
                                </div>
                                <div class="clearer"></div>
                                                                                         
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