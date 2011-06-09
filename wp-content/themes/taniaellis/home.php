<?php get_header(); ?>
			
    		<div id="header-content">
				<p id="sub-heading">The <span>Social</span> Business Company</p>
				<p id="language-picker">
		    		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
				</p>
				
				<div class="clearer"></div>

				<div id="frontpage-header-container">    
				    <?php wp_nav_menu(array(
				        'theme_location' => 'social-business-menu',
				        'container' => false,
				        'menu_id' => 'social-business-menu',
				        'menu-class' => false,
				        'link_before' => '<span class="social">Social</span> Business <br><span class="term">',
				        'link_after' => '</span>'
				        )); 
				    ?>
    
	    			<div id="frontpage-header-content">
	        			<img id="intro-movie" src="<?php bloginfo('template_url'); ?>/images/header_frontpage_tania_telly.png" />
	        			<!-- Video goes here! -->
	

	        			<div class="header-quote">
	            			<h6>Heartcore business for social and economic value!</h6>
	            			<p id="header-quote-text">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
	
	            			<div id="read-more-signature">
	                			<a href="javascript:void(0)">Read more</a>
	            			</div>
	        			</div>
	
	        			<div id="newsletter-signup-box">
	            			<p id="header">
	                			<span id="social-business-trends">Social business trends</span>
	                			<span id="newsletter">Newsletter</span>
	            			</p>
	            			
							<p id="content">Sign up for my newsletter and get the FREE bonus guide along with monthly inspiration on social business and heartcore value. Sign up and I will email you the guide.</p>
	            			<a id="newsletter-signup-button" href="javascript:void(0)">Subscribe</a>
	        			</div>
	
						<ul id="social-bar">
							<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_youtube.png" alt="YouTube" title="YouTube" /></a></li>
							<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_rss.png" alt="RSS" title="RSS" /></a></li>
							<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_twitter.png" alt="Twitter" title="Twitter" /></a></li>
							<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_facebook.png" alt="Facebook" title="Facebook" /></a></li>
							<li><a href="#"><img src="<?php bloginfo('template_url') ?>/images/social_media_icon_fairpages.png" alt="Fairpages" title="Fairpages" /></a></li>
						</ul>
						
						<img src="<?php bloginfo('template_url') ?>/images/newsletter_bonus_sticker.png" alt="" id="bouns-sticker" />
	    			</div> <!-- #frontpage-header-content -->
				</div> <!-- #frontpage-header-container -->
				
				
			</div> <!-- #header-content -->
			
			<div class="clearer"></div>

			<div id="page-content">
				<div id="page">
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

					    </div>
					</section>
					
					<section class="right-sidebar">
					</section>
					
					<div class="clearer"></div>
					
				</div> <!-- #page -->
				
			</div> <!-- #page-content -->

<?php get_footer(); ?>