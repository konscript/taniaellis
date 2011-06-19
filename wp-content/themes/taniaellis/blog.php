<?php
/*
    Template Name: Blog
*/
?>
<?php get_header(); ?>

<div id="header">
	<p id="sub-heading">The <span>Social</span> Business Blog</p>
	<p id="language-picker">
		<a class="current" href="javascript:void(0)">ENG</a> / <a href="javascript:void(0)">DK</a>
	</p>
	
	<div class="clearer"></div>

	<div id="header-container">
		
		<?php wp_nav_menu(array(
	        'theme_location' 	=> 'blog-menu',
			'menu_class'		=> 'navigation-header',
			'menu_id'			=> 'navigation-header-standard',
			'link_before'		=> '<span>&nbsp;</span>'
	        )); 
	    ?>
		<div class="header-content">
			<div class="left-column">
				<div class="header-title">
		            <h2 class="first-line">Social Business</h2>
			        <h2 class="second-line">Blog</h2>
		        </div>
		
				<h3 id="tagcloud-title">Join the conversation...</h3>
				<div id="tagcloud">
					<?php
					
					$default_colors = array(
						'#a8a6cd',
						'#91b997',
						'#e7cd30',
						'#83a8c2',
						'#d7b590'
					);
					
					$options = array();
				    $options['color_names']     = $default_colors;
					$options['min_size']        = 14;
				    $options['max_size']        = 22;
					$options['use_colors']      = true;
					
					if (function_exists('ilwp_tag_cloud'))
						ilwp_tag_cloud($options);
					
					?>
				</div>
			</div>
			<div class="right-column">
				<div class="header-right-box">
					<h2>What are the focus of change that are opening up for new business opportunities and social innovations?</h2>
					<p>Lorem ipsum dolor sit amet, doalr sit consec tetuer adipscing elit, sed diam nonum my nibh euismod.</p>

					<a class="join" href="#">Join the conversation</a>
				</div>
			</div>

		</div> <!-- .header-content -->
	</div> <!-- #.header-container -->
	
	
</div> <!-- #header -->

<div class="clearer"></div>

<div id="page-content">
	<div id="page">
		<section class="left-sidebar">
			&nbsp;
		</section>
		
		<section class="right-sidebar">
		    &nbsp;
		</section>
		
		<div class="clearer"></div>
		
	</div> <!-- #page -->
</div> <!-- #page-content -->

<?php get_footer(); ?>