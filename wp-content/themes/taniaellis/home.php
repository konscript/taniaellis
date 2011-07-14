
<?php get_header(); ?>

<div id="header">
	<p id="sub-heading">The <span>Social</span> Business Company &reg;</p>
	<p id="language-picker">
		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
	</p>

	<div class="clearer"></div>

	<div id="header-container">    
		<?php wp_nav_menu(array(
			'theme_location'	=> 'social-business-menu',
			'container' 		=> false,
			'menu_id' 			=> 'navigation-social-business',
			'menu_class' 		=> 'navigation-header',
			'link_before' 		=> '<span class="social">Social</span> Business <br><span class="term">',
			'link_after' 		=> '</span>'
		)); ?>

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
		</div> <!-- #frontpage-header-content -->
	</div> <!-- #frontpage-header-container -->
</div> <!-- #header -->
	
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