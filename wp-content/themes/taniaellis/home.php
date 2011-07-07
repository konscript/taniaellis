<?php
/*
Template Name: Home
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
        'theme_location' => 'social-business-menu',
          'container' => false,
          'menu_id' => 'navigation-social-business',
          'menu_class' => 'navigation-header',
          'link_before' => '<span class="social">Social</span> Business <br><span class="term">',
          'link_after' => '</span>'
          )); 
        ?>

        <div class="header-content" id="frontpage-header-content">
          <img id="intro-movie" src="<?php bloginfo('template_url'); ?>/images/header_frontpage_tania_telly.png" />
          <!-- Video goes here! -->


          <div class="header-quote">
            <h6>Heartcore business for social and economic value!</h6>
            <p id="header-quote-text">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>

            <div id="read-more-signature">
              <a href="javascript:void(0)">Read more</a>
            </div>
          </div>

          <!-- <div id="newsletter-signup-box">
            <p id="newsletter-header">
              <span id="social-business-trends">Social business trends</span>
              <span id="newsletter">Newsletter</span>
            </p>

            <p id="newsletter-content">
              Sign up for my newsletter and get the FREE bonus guide along with monthly inspiration on social business and heartcore value. Sign up and I will email you the guide.
            </p>
            <a id="newsletter-signup-button" href="javascript:void(0)">Subscribe</a>
          </div> -->

          <!-- <ul id="social-bar">
            <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_youtube.png" alt="YouTube" title="YouTube" /></a></li>
            <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_rss.png" alt="RSS" title="RSS" /></a></li>
            <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_twitter.png" alt="Twitter" title="Twitter" /></a></li>
            <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_facebook.png" alt="Facebook" title="Facebook" /></a></li>
            <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_fairpages.png" alt="Fairpages" title="Fairpages" /></a></li>
          </ul> -->

          <!-- <img src="<?php bloginfo('template_url') ?>/images/newsletter_bonus_sticker.png" alt="" id="bouns-sticker" /> -->
        </div> <!-- #frontpage-header-content -->
      </div> <!-- #frontpage-header-container -->


    </div> <!-- #header-content -->

    <div class="clearer"></div>

    <div id="page-content-frontpage">
      <div id="page">
        
        <!-- id="newsletter-signup-box" -->
        
        <ul id="social-bar-frontpage">
          <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_youtube.png" alt="YouTube" title="YouTube" /></a></li>
          <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_rss.png" alt="RSS" title="RSS" /></a></li>
          <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_twitter.png" alt="Twitter" title="Twitter" /></a></li>
          <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_facebook.png" alt="Facebook" title="Facebook" /></a></li>
          <li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_fairpages.png" alt="Fairpages" title="Fairpages" /></a></li>
        
          <div class="box" id="box-frontpage">
            <p class="box-header">
              <span class="box-first-line">Social business trends</span>
              <span class="box-second-line">Newsletter</span>
            </p>

            <p class="box-content">
              Sign up for my newsletter and get the FREE bonus guide along with monthly inspiration on social business and heartcore value. Sign up and I will email you the guide.
            </p>
            
            <img src="<?php bloginfo('template_url') ?>/images/newsletter_bonus_sticker.png" alt="" id="bonus-sticker" />
            <a class="box-button" href="javascript:void(0)">Subscribe</a>
          </div>
        </ul>
        
        <section class="left-sidebar">
          <div class="widget-container-left widget-books">
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

                      <div class="widget-container-left widget-blog">
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

                          <div class="widget-container-left widget-reading-room">
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

                            <section class="right-sidebar">
                              <div class="widget-container-right widget-event">
                                <div class="header-container">
                                  <h2 class="first-line">Upcoming</h2>
                                  <h2 class="second-line">Events</h2>
                                </div>

                                <div class="item event">
                                  <div class="item-content">
                                    <img class="featured-image" src="<?php bloginfo('template_url'); ?>/images/events_icon_1.png" />

                                    <p class="meta-data">
                                      Event Date: 11 Feb 2011, 9-5 P.M.
                                    </p>

                                    <h2 class="title">Lorem Ipsum Dolor Sit Amet</h2>

                                    <p class="excerpt">
                                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    </p>

                                    <div class="options">
                                      <img class="sharing" src="<?php bloginfo('template_url'); ?>/images/share_options.png" />
                                      <a class="read-more" href="javascript:void(0)">Read more</a>
                                    </div>
                                  </div>
                                </div>

                                <div class="item event">
                                  <div class="item-content">
                                    <img class="featured-image" src="<?php bloginfo('template_url'); ?>/images/events_icon_2.png" />

                                    <p class="meta-data">
                                      Event Date: 11 Feb 2011, 9-5 P.M.
                                    </p>

                                    <h2 class="title">Lorem Ipsum Dolor Sit Amet</h2>

                                    <p class="excerpt">
                                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    </p>

                                    <div class="options">
                                      <img class="sharing" src="<?php bloginfo('template_url'); ?>/images/share_options.png" />
                                      <a class="read-more" href="javascript:void(0)">Read more</a>
                                    </div>
                                  </div>
                                </div>

                                <a class="view-all" href="javascript:void(0)">View more events</a>
                              </div>

                              <div class="widget-container-right widget-featured-blog">
                                <div class="header-container">
                                  <h2 class="first-line">Featured</h2>
                                  <h2 class="second-line">Blog Posts By Tania Ellis</h2>
                                </div>

                                <div class="item featured-blog">
                                  <div class="item-content">
                                    <img class="featured-image" src="<?php bloginfo('template_url'); ?>/images/featured_blog_post_1.png" />

                                    <p class="meta-data">
                                      13 Mar 2011
                                    </p>

                                    <h2 class="title">Lorem Ipsum Dolor</h2>

                                    <p class="excerpt">
                                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                                    </p>

                                    <div class="options">
                                      <img class="sharing" src="<?php bloginfo('template_url'); ?>/images/share_options.png" />
                                      <a class="read-more" href="javascript:void(0)">Read more</a>
                                    </div>
                                  </div>
                                </div>

                                <div class="item featured-blog">
                                  <div class="item-content">
                                    <img class="featured-image" src="<?php bloginfo('template_url'); ?>/images/featured_blog_post_2.png" />

                                    <p class="meta-data">
                                      12 Feb 2011
                                    </p>

                                    <h2 class="title">Lorem Ipsum Dolor Sit Amet</h2>

                                    <p class="excerpt">
                                      Lorem ipsum dolor sit amet, et consectetur adipisicing elit, sed do eiusmod es tempor incididunt ut labore et dolore magna.
                                    </p>

                                    <div class="options">
                                      <img class="sharing" src="<?php bloginfo('template_url'); ?>/images/share_options.png" />
                                      <a class="read-more" href="javascript:void(0)">Read more</a>
                                    </div>
                                  </div>
                                </div>

                                <div class="item featured-blog">
                                  <div class="item-content">
                                    <img class="featured-image" src="<?php bloginfo('template_url'); ?>/images/featured_blog_post_3.png" />

                                    <p class="meta-data">
                                      11 Feb 2011
                                    </p>

                                    <h2 class="title">Lorem Ipsum Dolor Sit Amet</h2>

                                    <p class="excerpt">
                                      Lorem ipsum dolor sit amet, et consectetur adipisicing elit, sed do eiusmod es tempor incididunt ut labore et dolore magna.
                                    </p>

                                    <div class="options">
                                      <img class="sharing" src="<?php bloginfo('template_url'); ?>/images/share_options.png" />
                                      <a class="read-more" href="javascript:void(0)">Read more</a>
                                    </div>
                                  </div>
                                </div>

                                <a class="view-all" href="javascript:void(0)">View more blog posts</a>
                              </div>
                              <div class="widget-container-right widget-clients">
                                <div class="header-container">
                                  <h2 class="first-line">Featured Clients</h2>
                                  <h2 class="second-line">Click And Read The Cases</h2>
                                </div>

                                <div class="item client">
                                  <div class="item-content">

                                    <ul id="clients-viewer">
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_1.png" />
                                        </a>
                                      </li>
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_2.png" />
                                        </a>
                                      </li>
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_3.png" />
                                        </a>
                                      </li>
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_4.png" />
                                        </a>
                                      </li>
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_5.png" />
                                        </a>
                                      </li>
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_6.png" />
                                        </a>
                                      </li>
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_7.png" />
                                        </a>
                                      </li>
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_8.png" />
                                        </a>
                                      </li>
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_9.png" />
                                        </a>
                                      </li>
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_10.png" />
                                        </a>
                                      </li>
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_11.png" />
                                        </a>
                                      </li>
                                      <li>
                                        <a href="javascript:void(0)">
                                          <img src="<?php bloginfo('template_url') ?>/images/clients_case_12.png" />
                                        </a>
                                      </li>
                                    </ul>

                                    <div class="options">
                                      <a class="view-clients" href="javascript:void(0)">View all clients</a>
                                      <a class="view-cases" href="javascript:void(0)">View all cases</a>
                                    </div>
                                  </div>
                                </div>					        
                              </div>
                            </section>

                            <div class="clearer"></div>

                          </div> <!-- #page -->

                        </div> <!-- #page-content -->

                        <?php get_footer(); ?>